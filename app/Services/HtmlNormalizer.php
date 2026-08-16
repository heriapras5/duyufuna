<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMXPath;

class HtmlNormalizer
{
    public static function clean(?string $html): string
    {
        if ($html === null || trim($html) === '') {
            return '';
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);

        $loaded = $dom->loadHTML(
            '<?xml encoding="UTF-8">' . $html,
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING
        );
        libxml_clear_errors();

        if (!$loaded) {
            return trim($html);
        }

        $xpath = new DOMXPath($dom);

        // 1. Hapus elemen artefak tak terlihat (selection anchor dari AI/editor).
        $hidden = [];
        foreach ($xpath->query('//*[@aria-hidden="true"]') as $el) {
            $hidden[] = $el;
        }
        foreach ($hidden as $el) {
            $el->parentNode?->removeChild($el);
        }

        // 2. Hapus <p> kosong (hanya spasi / &nbsp;), kecuali memuat <img>.
        $emptyP = [];
        foreach ($xpath->query('//p') as $p) {
            $text = str_replace("\xC2\xA0", '', $p->textContent ?? '');
            if (trim($text) === '' && !$p->getElementsByTagName('img')->length) {
                $emptyP[] = $p;
            }
        }
        foreach ($emptyP as $p) {
            $p->parentNode?->removeChild($p);
        }

        // 3. Hapus atribut data-* sisa (data-section-id, data-start, data-end, dst).
        $attrHosts = [];
        foreach ($xpath->query('//*[@*[starts-with(name(), "data-")]]') as $el) {
            $attrHosts[] = $el;
        }
        foreach ($attrHosts as $el) {
            $remove = [];
            foreach ($el->attributes as $attr) {
                if (str_starts_with($attr->nodeName, 'data-')) {
                    $remove[] = $attr->nodeName;
                }
            }
            foreach ($remove as $name) {
                $el->removeAttribute($name);
            }
        }

        // 4. Hapus token class artefak (mis. PDq2pG_*) dari atribut class.
        $classHosts = [];
        foreach ($xpath->query('//*[contains(concat(" ", normalize-space(@class), " "), " PDq2pG")]') as $el) {
            $classHosts[] = $el;
        }
        foreach ($classHosts as $el) {
            $classes = preg_split('/\s+/', trim((string) $el->getAttribute('class')));
            $classes = array_values(array_filter($classes, static fn ($c) => !str_contains($c, 'PDq2pG')));
            if ($classes) {
                $el->setAttribute('class', implode(' ', $classes));
            } else {
                $el->removeAttribute('class');
            }
        }

        // 5. Bungkus <li> telanjang berurutan ke dalam <ul>.
        self::wrapBareLists($dom);

        $html = self::innerHtml($dom);
        libxml_use_internal_errors(false);

        return trim($html);
    }

    private static function wrapBareLists(DOMDocument $dom): void
    {
        $xpath = new DOMXPath($dom);

        $items = [];
        foreach ($xpath->query('//li') as $li) {
            $items[] = $li;
        }

        foreach ($items as $li) {
            $parent = $li->parentNode;
            if (!$parent) {
                continue;
            }
            $tag = $parent->nodeName;
            if (in_array($tag, ['ul', 'ol', 'menu'], true)) {
                continue;
            }

            $prev = self::previousElement($li);
            if ($prev !== null && $prev->nodeName === 'li') {
                continue;
            }

            $ul = $dom->createElement('ul');
            $parent->insertBefore($ul, $li);

            $current = $li;
            while ($current !== null && $current instanceof DOMElement && $current->nodeName === 'li') {
                $next = $current->nextSibling;
                $ul->appendChild($current);
                $current = $next;
                while ($current !== null && $current->nodeType === XML_TEXT_NODE && trim((string) $current->nodeValue) === '') {
                    $current = $current->nextSibling;
                }
            }
        }
    }

    private static function previousElement(DOMElement $node): ?DOMElement
    {
        $prev = $node->previousSibling;
        while ($prev !== null && $prev->nodeType === XML_TEXT_NODE && trim((string) $prev->nodeValue) === '') {
            $prev = $prev->previousSibling;
        }

        return $prev instanceof DOMElement ? $prev : null;
    }

    private static function innerHtml(DOMDocument $dom): string
    {
        $html = $dom->saveHTML();
        $html = preg_replace('/<\?xml[^>]*>\s*/i', '', $html);
        $html = preg_replace('/^\s*<html[^>]*>|<body[^>]*>|<\/body>|<\/html>\s*$/i', '', $html);

        return trim((string) $html);
    }
}
