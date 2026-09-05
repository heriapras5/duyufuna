import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
window.Alpine = Alpine;

import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

Alpine.plugin(collapse);

document.addEventListener('alpine:init', function () {
    Alpine.store('modal', {
        openDetail: false,
        openConsult: false,
        loadingConsult: false,
        detail: { service_id: null, item_id: null, item_title: null, image: null, title: null, description: null },
        consult: { service_id: null, item_id: null, item_title: null, title: null, unit_price: null, currency: null, unit_label: null, extra_note: null },

        lockScroll() {
            document.body.style.overflow = (this.openDetail || this.openConsult) ? 'hidden' : '';
        },
        setDetail(c) {
            this.detail = c;
            this.openDetail = true;
            this.lockScroll();
        },
        setConsult(c) {
            this.consult = c;
            this.openConsult = true;
            this.lockScroll();
        },
        closeDetail() {
            this.openDetail = false;
            this.lockScroll();
        },
        closeConsult() {
            this.openConsult = false;
            this.lockScroll();
        },
        gotoConsult() {
            this.consult = {
                service_id: this.detail.service_id,
                item_id: this.detail.item_id,
                item_title: this.detail.item_title,
                title: this.detail.title,
                unit_price: this.detail.unit_price ?? this.detail.unitPrice ?? null,
                currency: this.detail.currency ?? null,
                unit_label: this.detail.unit_label ?? this.detail.unitLabel ?? null,
                extra_note: this.detail.extra_note ?? null,
            };
            this.closeDetail();
            this.openConsult = true;
            this.lockScroll();
        },
        submitConsult(form) {
            this.loadingConsult = true;
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name=_token]').value,
                    'Accept': 'application/json',
                },
                body: new FormData(form),
            })
            .then(async response => {
                let data = null;
                try { data = await response.json(); } catch (e) { data = null; }
                if (response.ok && data && data.redirect_url) {
                    window.location.href = data.redirect_url;
                    return;
                }
                throw new Error((data && data.message) ? data.message : 'Gagal mengirim konsultasi.');
            })
            .catch(err => {
                alert(err.message || 'Terjadi kesalahan.');
            })
            .finally(() => { this.loadingConsult = false; });
        },
    });

    window.addEventListener('pageshow', function () {
        Alpine.store('modal').loadingConsult = false;
    });
});

Alpine.start();

import Chart from 'chart.js/auto';
window.Chart = Chart;

import Swiper from 'swiper';
import { Autoplay, Pagination, Navigation, EffectFade } from 'swiper/modules';
window.Swiper = Swiper;
window.SwiperModules = { Autoplay, Pagination, Navigation, EffectFade };

document.addEventListener('DOMContentLoaded', function () {
    const revealEls = () => document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right, .scroll-reveal-scale');
    const revealAll = function () {
        revealEls().forEach(function (el) {
            el.classList.add('revealed');
        });
    };

    if (typeof IntersectionObserver !== 'function') {
        revealAll();
    } else {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.05, rootMargin: '0px 0px -10px 0px' });
        revealEls().forEach(function (el) {
            observer.observe(el);
        });

        // Safety net: if the observer didn't reveal everything shortly after load
        // (e.g. below-the-fold sections without an IO trigger), show all.
        setTimeout(function () {
            revealEls().forEach(function (el) {
                if (!el.classList.contains('revealed')) {
                    el.classList.add('revealed');
                    el.style.opacity = '';
                    el.style.transform = '';
                }
            });
        }, 1500);
    }

    var counterObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                var counters = entry.currentTarget.querySelectorAll('[data-counter]');
                counters.forEach(function (counter) {
                    var target = parseInt(counter.getAttribute('data-counter'), 10);
                    var duration = parseInt(counter.getAttribute('data-duration') || '2000', 10);
                    var suffix = counter.getAttribute('data-suffix') || '';
                    var prefix = counter.getAttribute('data-prefix') || '';
                    var start = 0;
                    var step = Math.max(1, Math.floor(target / (duration / 16)));
                    var timer = setInterval(function () {
                        start += step;
                        if (start >= target) {
                            start = target;
                            clearInterval(timer);
                        }
                        counter.textContent = prefix + start.toLocaleString('id-ID') + suffix;
                    }, 16);
                });
                counterObserver.unobserve(entry.currentTarget);
            }
        });
    }, { threshold: 0.3 });
    document.querySelectorAll('[data-counter-group]').forEach(function (el) {
        counterObserver.observe(el);
    });

    var header = document.querySelector('[data-scroll-header]');
    if (header) {
        window.addEventListener('scroll', function () {
            header.classList.toggle('header-scrolled', window.scrollY > 80);
        }, { passive: true });
    }

    // --- 3D Parallax Tilt ---
    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!prefersReduced && window.matchMedia('(hover: hover)').matches) {
        // Tilt pada elemen [data-parallax-3d]: kartu berputar mengikuti kursor,
        // anak-anak berlapis (.parallax-3d-layer / .parallax-3d-pop) ikut melayang.
        document.querySelectorAll('[data-parallax-3d]').forEach(function (el) {
            var wrap = el.closest('.parallax-3d-wrap') || el.parentElement;
            if (!wrap) return;
            var raf = null;
            var lastEvent = null;
            var layers = el.querySelectorAll('.parallax-3d-layer, .parallax-3d-pop');
            function applyTilt() {
                raf = null;
                if (!lastEvent) return;
                var rect = wrap.getBoundingClientRect();
                var px = (lastEvent.clientX - rect.left) / rect.width - 0.5;
                var py = (lastEvent.clientY - rect.top) / rect.height - 0.5;
                el.style.transform = 'rotateX(' + (-py * 8) + 'deg) rotateY(' + (px * 8) + 'deg) translateZ(6px)';
                layers.forEach(function (layer) {
                    layer.style.transform = 'translateZ(' + (layer.classList.contains('parallax-3d-pop') ? 40 : 22) + 'px)';
                });
            }
            wrap.addEventListener('mousemove', function (e) {
                lastEvent = e;
                if (!raf) raf = requestAnimationFrame(applyTilt);
            });
            wrap.addEventListener('mouseleave', function () {
                lastEvent = null;
                if (raf) { cancelAnimationFrame(raf); raf = null; }
                el.style.transform = 'rotateX(0deg) rotateY(0deg) translateZ(0)';
                layers.forEach(function (layer) {
                    layer.style.transform = 'translateZ(0)';
                });
            });
        });

        // Tilt ringan pada kartu kategori (parallax-3d-card): 3D dari CSS hover saja.
        // Tile "Keunggulan" bergerak mengikuti kursor di dalam section.
        document.querySelectorAll('.parallax-3d-section').forEach(function (section) {
            var tiles = section.querySelectorAll('.parallax-3d-tile');
            var orbs = section.querySelectorAll('.parallax-3d-orb');
            var sRaf = null;
            var sEvent = null;
            function applySectionTilt() {
                sRaf = null;
                if (!sEvent) return;
                var rect = section.getBoundingClientRect();
                var px = (sEvent.clientX - rect.left) / rect.width - 0.5;
                var py = (sEvent.clientY - rect.top) / rect.height - 0.5;
                tiles.forEach(function (tile, i) {
                    var depth = 1 + (i % 3) * 0.4;
                    tile.style.transform = 'perspective(800px) rotateX(' + (-py * 3 * depth) + 'deg) rotateY(' + (px * 3 * depth) + 'deg) translateZ(' + (4 * depth) + 'px)';
                });
                orbs.forEach(function (orb) {
                    var d = parseFloat(orb.getAttribute('data-parallax-depth') || '0.25');
                    orb.style.transform = 'translate(' + (px * 40 * d) + 'px, ' + (py * 40 * d) + 'px)';
                });
            }
            section.addEventListener('mousemove', function (e) {
                sEvent = e;
                if (!sRaf) sRaf = requestAnimationFrame(applySectionTilt);
            });
            section.addEventListener('mouseleave', function () {
                sEvent = null;
                if (sRaf) { cancelAnimationFrame(sRaf); sRaf = null; }
                tiles.forEach(function (tile) { tile.style.transform = ''; });
                orbs.forEach(function (orb) { orb.style.transform = ''; });
            });
        });

        // Parallax scroll halus untuk orb dekoratif pada section gelap.
        var scrollOrbs = Array.prototype.slice.call(document.querySelectorAll('.parallax-3d-orb'));
        if (scrollOrbs.length > 0) {
            var orbTicking = false;
            window.addEventListener('scroll', function () {
                if (orbTicking) return;
                orbTicking = true;
                requestAnimationFrame(function () {
                    orbTicking = false;
                    var vh = window.innerHeight;
                    scrollOrbs.forEach(function (orb) {
                        var rect = orb.getBoundingClientRect();
                        if (rect.bottom < -100 || rect.top > vh + 100) return;
                        var d = parseFloat(orb.getAttribute('data-parallax-depth') || '0.25');
                        var progress = (rect.top + rect.height / 2 - vh / 2) / vh;
                        orb.style.translate = '0 ' + (-progress * 60 * d) + 'px';
                    });
                });
            }, { passive: true });
        }
    }

    var fancyboxEls = document.querySelectorAll('[data-fancybox]');
    if (fancyboxEls.length > 0) {
        var fancyboxBase = {
            Carousel: {
                infinite: true,
            },
            Images: {
                zoom: true,
            },
            Toolbar: {
                display: ['counter', 'zoom', 'download', 'close'],
            },
        };
        Fancybox.bind('[data-fancybox]:not([data-fancybox^="testimoni"])', fancyboxBase);
        // Popup gambar testimoni: tanpa strip thumbnail
        if (document.querySelectorAll('[data-fancybox^="testimoni"]').length > 0) {
            var fancyboxTestimoni = Object.assign({}, fancyboxBase, { Thumbs: false, mainClass: 'testimoni-popup' });
            Fancybox.bind('[data-fancybox^="testimoni"]', fancyboxTestimoni);
        }
    }

    var drawerToggle = document.querySelector('[data-drawer-toggle]');
    var drawerOverlay = document.querySelector('.mobile-drawer-overlay');
    var drawer = document.querySelector('.mobile-drawer');
    if (drawerToggle && drawerOverlay && drawer) {
        drawerToggle.addEventListener('click', function () {
            drawer.classList.toggle('open');
            drawerOverlay.classList.toggle('open');
            document.body.classList.toggle('overflow-hidden');
        });
        drawerOverlay.addEventListener('click', function () {
            drawer.classList.remove('open');
            drawerOverlay.classList.remove('open');
            document.body.classList.remove('overflow-hidden');
        });
        document.querySelectorAll('.mobile-drawer a').forEach(function (link) {
            link.addEventListener('click', function () {
                drawer.classList.remove('open');
                drawerOverlay.classList.remove('open');
                document.body.classList.remove('overflow-hidden');
            });
        });
    }

    document.querySelectorAll('[data-banner-slider]').forEach(function (slider) {
        var bsSlides = slider.querySelectorAll('[data-slide]');
        if (bsSlides.length === 0) return;
        var bsIndex = 0;
        var bsTimer = null;
        var bsLocked = false;
        function bsShow(i) {
            bsIndex = (i + bsSlides.length) % bsSlides.length;
            bsSlides.forEach(function (s, n) { s.classList.toggle('is-active', n === bsIndex); });
        }
        function bsAdvance(dir) {
            if (bsLocked) return;
            bsLocked = true;
            bsShow(bsIndex + dir);
            bsRestart();
            setTimeout(function () { bsLocked = false; }, 400);
        }
        function bsNext() { bsAdvance(1); }
        function bsPrev() { bsAdvance(-1); }
        function bsRestart() {
            if (bsTimer) clearInterval(bsTimer);
            if (bsSlides.length > 1) bsTimer = setInterval(bsNext, 5000);
        }
        var bsPrevBtn = slider.querySelector('[data-banner-prev]');
        var bsNextBtn = slider.querySelector('[data-banner-next]');
        if (bsPrevBtn) bsPrevBtn.addEventListener('click', bsPrev);
        if (bsNextBtn) bsNextBtn.addEventListener('click', bsNext);
        bsRestart();
    });

    document.addEventListener('click', function (e) {
        var toggle = e.target.closest('[data-modal-toggle]');
        if (toggle) {
            var target = document.querySelector(toggle.getAttribute('data-modal-toggle'));
            if (target) {
                target.classList.toggle('hidden');
                document.body.classList.toggle('modal-body-lock');
            }
        }
        var close = e.target.closest('[data-modal-close]');
        if (close) {
            var modal = close.closest('.modal-overlay');
            if (modal) {
                modal.classList.add('hidden');
                document.body.classList.remove('modal-body-lock');
            }
        }
        var overlay = e.target.closest('.modal-overlay');
        if (overlay && e.target === overlay) {
            overlay.classList.add('hidden');
            document.body.classList.remove('modal-body-lock');
        }
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay:not(.hidden)').forEach(function (modal) {
                modal.classList.add('hidden');
                document.body.classList.remove('modal-body-lock');
            });
        }
    });
});
