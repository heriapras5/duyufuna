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
                768: { slidesPerView: 2, spaceBetween: 16 },
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

        {{-- Kartu per-slide gaya handling: border bersih + header gradasi hijau + halo --}}
        <div class="swiper testiSwiper relative overflow-visible">
            <div class="swiper-wrapper items-stretch">
            @foreach($testimonials as $t)
            <div class="swiper-slide h-auto">
            <div class="group h-full flex flex-col rounded-2xl border bg-white overflow-hidden border-slate-300 shadow-[0_10px_24px_rgba(15,23,42,0.06)] hover:border-emerald-500/60 hover:shadow-[0_14px_30px_rgba(5,92,59,0.10)] hover:-translate-y-0.5 active:scale-[0.99] transition-all duration-300">
                {{-- Header gambar: gradasi hijau muda + halo di belakang --}}
                <div class="relative p-2.5 border-b border-slate-100 bg-gradient-to-b from-emerald-50/50 to-white shrink-0">
                    <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-20 h-20 rounded-full opacity-20 blur-2xl bg-emerald-400"></div>
                    @if($t->image)
                    <a href="{{ Storage::url($t->image) }}" data-fancybox="testimoni-carousel" data-caption="Screenshot chat {{ $t->name }}" target="_blank" rel="noreferrer" class="relative block">
                        <div class="w-full aspect-[3/4] rounded-xl overflow-hidden border border-slate-200 bg-white">
                            <img src="{{ Storage::url($t->image) }}" alt="Screenshot chat {{ $t->name }}" loading="lazy" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105">
                        </div>
                    </a>
                    @else
                    <div class="relative w-full aspect-[3/4] rounded-xl border border-slate-200 bg-white flex items-center justify-center">
                        <div class="w-14 h-14 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </div>
                    </div>
                    @endif
                </div>
                {{-- Caption menempel di bawah kartu --}}
                <div class="p-3 flex-1 flex flex-col justify-end text-center">
                    @if($t->name)
                    <p class="font-serif text-sm font-bold text-slate-950 leading-tight line-clamp-1">{{ $t->name }}</p>
                    @endif
                    @if($t->review)
                    <p class="mt-1.5 text-[13px] font-medium text-slate-700 leading-relaxed italic line-clamp-3">"{{ strip_tags($t->review) }}"</p>
                    @endif
                </div>
            </div>
            </div>
            @endforeach
            </div>
            <div class="testi-pagination mt-5 flex items-center justify-center gap-1.5"></div>
        </div>
    </div>
</section>
