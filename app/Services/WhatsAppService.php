<?php

namespace App\Services;

class WhatsAppService
{
    public function message(?string $template, array $data = []): string
    {
        $subject = trim((string) ($data['item'] ?? ''))
            ?: trim((string) ($data['layanan'] ?? ''))
            ?: trim((string) ($data['kategori'] ?? ''));

        if ($subject !== '') {
            $data['item'] = $subject;
        }

        $default = $subject !== ''
            ? "Assalamu'alaikum,\nSaya ingin berkonsultasi mengenai {item}."
            : "Assalamu'alaikum,\nSaya ingin berkonsultasi.";

        $source = $template !== null && trim($template) !== '' ? $template : $default;
        $text = $source;

        foreach ($data as $key => $value) {
            $text = str_replace('{' . $key . '}', (string) ($value ?? ''), $text);
        }

        $missing = [];
        if (!empty($data['nama']) && !str_contains($source, '{nama}')) {
            $missing[] = "Nama: {$data['nama']}";
        }
        if (!empty($data['no_hp']) && !str_contains($source, '{no_hp}')) {
            $missing[] = "No WhatsApp: {$data['no_hp']}";
        }
        if ($missing) {
            $text .= "\n\n" . implode("\n", $missing);
        }

        return trim(preg_replace('/\n{3,}/', "\n\n", $text));
    }

    public function number(?string $serviceNumber, ?string $globalNumber): string
    {
        $number = trim((string) ($serviceNumber ?: ($globalNumber ?: '6281293679502')));
        $number = preg_replace('/[^0-9]/', '', $number);

        if ($number === '') {
            return '6281293679502';
        }

        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }

        return $number;
    }

    public function url(?string $serviceNumber, ?string $globalNumber, string $message): string
    {
        return 'https://wa.me/' . $this->number($serviceNumber, $globalNumber)
            . '?text=' . rawurlencode($message);
    }
}
