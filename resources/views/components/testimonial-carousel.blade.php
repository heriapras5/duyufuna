@push('head')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.testiSwiper').forEach(function (el) {
        if (el.swiper !== undefined) return;
        var slides = el.querySelectorAll('.swiper-slide');
        if (slides.length === 0) return;
        new Swiper(el, {
            modules: [SwiperModules.Autoplay, SwiperModules.Pagination],
            loop: slides.length > 3,
            autoplay: { delay: 3000, disableOnInteraction: false, pauseOnMouseEnter: true },
            pagination: { el: el.querySelector('.testi-pagination'), clickable: true },
            breakpoints: {
                0: { slidesPerView: 1, spaceBetween: 12 },
                1024: { slidesPerView: 3, spaceBetween: 24 },
            },
            speed: 700,
        });
    });
});
</script>
@endpush
<section class="py-14 md:py-20 relative scroll-reveal">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-10 md:mb-14">
            <span class="section-label">{{ $globalSetting->testimonial_label ?? 'Testimonial' }}</span>
            <h2 class="font-serif text-2xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mt-3">{!! $globalSetting->testimonial_title ?? 'Apa Kata <span class="text-dark-green">Jamaah</span>?' !!}</h2>
            <p class="text-gray-500 text-sm md:text-base mt-3 max-w-lg mx-auto">{{ $globalSetting->testimonial_subtitle ?? 'Pengalaman nyata dari jamaah yang telah menggunakan layanan kami' }}</p>
        </div>

        {{-- Satu kartu membungkus seluruh gambar: slide polos di dalamnya --}}
        <div class="card-glass-gold rounded-2xl p-4 sm:p-6 md:p-8 hover:border-gold/30 hover:shadow-xl hover:shadow-gold/10 transition-all duration-500">
        <div class="swiper testiSwiper relative overflow-visible">
            <div class="swiper-wrapper items-stretch">
            @foreach($testimonials as $t)
            <div class="swiper-slide h-auto">
            <div class="h-full flex flex-col">
                @if($t->image)
                <a href="{{ Storage::url($t->image) }}" data-fancybox="testimoni-carousel" data-caption="Screenshot chat {{ $t->name }}" target="_blank" rel="noreferrer" class="flex justify-center">
                    <img src="{{ Storage::url($t->image) }}" alt="Screenshot chat {{ $t->name }}" loading="lazy" class="h-100 sm:h-110 lg:h-112 w-auto max-w-full object-contain rounded-xl border border-gray-200/60 hover:opacity-95 transition">
                </a>
                @endif
                <div class="mt-4 pt-3 border-t border-gray-100 text-center">
                    @if($t->name)
                    <p class="text-sm font-semibold text-gray-900">{{ $t->name }}</p>
                    @endif
                    @if($t->review)
                    <p class="mt-2.5 text-gray-500 text-xs leading-relaxed italic line-clamp-3">"{{ strip_tags($t->review) }}"</p>
                    @endif
                </div>
            </div>
            </div>
            @endforeach
            </div>
            <div class="testi-pagination mt-5 flex items-center justify-center gap-1.5"></div>
        </div>
        </div>
    </div>
</section>
