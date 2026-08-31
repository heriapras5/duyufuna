@push('head')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var el = document.querySelector('.testimonialSwiper');
    if (el && el.swiper === undefined) {
        var slides = el.querySelectorAll('.swiper-slide');
        if (slides.length > 0) {
            new Swiper(el, {
                modules: [SwiperModules.Autoplay, SwiperModules.Pagination],
                loop: false,
                rewind: slides.length > 1,
                autoplay: slides.length > 1 ? { delay: 4000, disableOnInteraction: false, pauseOnMouseEnter: true } : false,
                pagination: {
                    el: el.parentElement.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                breakpoints: {
                    0: { slidesPerView: 2, spaceBetween: 12 },
                    640: { slidesPerView: 2, spaceBetween: 20 },
                    1024: { slidesPerView: 3, spaceBetween: 24 },
                },
                speed: 600,
            });
        }
    }
});
</script>
@endpush

<section class="py-14 md:py-20 bg-gradient-to-br from-masjid via-dark-green to-emerald-900 relative overflow-hidden islamic-pattern scroll-reveal">
    <div class="absolute inset-0 masjid-silhouette"></div>
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-10 md:mb-14">
            <span class="section-label section-label-gold">{{ $globalSetting->testimonial_label ?? 'Testimonial' }}</span>
            <h2 class="font-serif text-2xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">{!! $globalSetting->testimonial_title ?? 'Apa Kata <span class="text-gradient-gold">Jamaah</span>?' !!}</h2>
            <p class="text-white/50 text-sm md:text-base mt-3 max-w-lg mx-auto">{{ $globalSetting->testimonial_subtitle ?? 'Pengalaman nyata dari jamaah yang telah menggunakan layanan kami' }}</p>
        </div>
        <div class="swiper testimonialSwiper overflow-visible">
            <div class="swiper-wrapper">
                @foreach($testimonials as $t)
                <div class="swiper-slide h-auto">
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-4 md:p-8 h-full flex flex-col hover:bg-white/[0.08] hover:border-gold/30 transition-all duration-500 group">
                        <div class="flex items-center gap-0.5 mb-3 md:mb-4 text-gold">
                            @for($i = 0; $i < 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="{{ $i < ($t->rating ?? 5) ? '#C9A227' : 'none' }}" stroke="#C9A227" stroke-width="1.5" class="md:w-4 md:h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            @endfor
                        </div>
                        <div class="relative flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="rgba(201,162,39,0.2)" stroke-width="1" class="absolute -top-1 -left-1 hidden md:block"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg>
                            <p class="text-white/70 text-xs sm:text-sm leading-relaxed pl-0 md:pl-4 relative z-10 line-clamp-4">"{!! $t->review !!}"</p>
                        </div>
                        <div class="flex items-center gap-3 mt-4 md:mt-5 pt-4 border-t border-white/5">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-xl bg-gradient-to-br from-gold/20 to-amber-500/20 flex items-center justify-center text-gold-light text-xs md:text-sm font-bold ring-1 ring-gold/20">
                                {{ strtoupper(substr($t->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs md:text-sm font-semibold text-white truncate">{{ $t->name }}</p>
                                <p class="text-[10px] md:text-[11px] text-white/40 truncate">{{ $t->occupation ?? 'Jamaah Umroh' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="testimonial-pagination mt-8 md:mt-10 flex items-center justify-center">
            <div class="swiper-pagination !static !bottom-auto"></div>
        </div>
    </div>
</section>

<style>
.testimonial-pagination .swiper-pagination-bullet {
    background: rgba(255,255,255,0.25);
    opacity: 1;
    width: 8px;
    height: 8px;
    border-radius: 999px;
    transition: all 0.4s ease;
}
.testimonial-pagination .swiper-pagination-bullet-active {
    width: 28px;
    background: #C9A227;
    border-radius: 999px;
    box-shadow: 0 0 12px rgba(201,162,39,0.4);
}
</style>
