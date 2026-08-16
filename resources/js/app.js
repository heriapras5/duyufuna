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
        consult: { service_id: null, item_id: null, item_title: null, title: null },

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
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
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

    var fancyboxEls = document.querySelectorAll('[data-fancybox="galeri"]');
    if (fancyboxEls.length > 0) {
        Fancybox.bind('[data-fancybox="galeri"]', {
            Carousel: {
                infinite: true,
            },
            Images: {
                zoom: true,
            },
            Toolbar: {
                display: ['counter', 'zoom', 'download', 'close'],
            },
        });
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
