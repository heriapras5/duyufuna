@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi halaman" class="mt-8">
        <div class="flex flex-col items-center gap-4">
            <p class="text-xs text-gray-500 order-2 sm:order-1">
                Menampilkan <span class="font-semibold text-gray-700">{{ $paginator->firstItem() ?? 0 }}</span>–<span class="font-semibold text-gray-700">{{ $paginator->lastItem() ?? 0 }}</span> dari <span class="font-semibold text-gray-700">{{ $paginator->total() }}</span> data
                · Halaman <span class="font-semibold text-gray-700">{{ $paginator->currentPage() }}</span> dari <span class="font-semibold text-gray-700">{{ $paginator->lastPage() }}</span>
            </p>
            <ul class="order-1 sm:order-2 flex flex-wrap items-center justify-center gap-1.5">
                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <li aria-disabled="true">
                        <span class="inline-flex items-center justify-center min-w-9 h-9 px-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-300 text-sm font-semibold select-none" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Halaman sebelumnya" class="inline-flex items-center justify-center min-w-9 h-9 px-2.5 rounded-xl border border-gray-200 bg-white text-gray-600 text-sm font-semibold hover:border-gold/50 hover:text-dark-green hover:bg-gold/5 transition">&lsaquo;</a>
                    </li>
                @endif

                {{-- Numbers --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li aria-disabled="true" class="hidden sm:list-item">
                            <span class="inline-flex items-center justify-center min-w-9 h-9 px-2 rounded-xl text-gray-400 text-sm select-none">{{ $element }}</span>
                        </li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li aria-current="page">
                                    <span class="inline-flex items-center justify-center min-w-9 h-9 px-2.5 rounded-xl bg-dark-green text-white text-sm font-bold shadow-md shadow-dark-green/20 ring-1 ring-dark-green">{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}" aria-label="Halaman {{ $page }}" class="inline-flex items-center justify-center min-w-9 h-9 px-2.5 rounded-xl border border-gray-200 bg-white text-gray-600 text-sm font-semibold hover:border-gold/50 hover:text-dark-green hover:bg-gold/5 transition">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Halaman berikutnya" class="inline-flex items-center justify-center min-w-9 h-9 px-2.5 rounded-xl border border-gray-200 bg-white text-gray-600 text-sm font-semibold hover:border-gold/50 hover:text-dark-green hover:bg-gold/5 transition">&rsaquo;</a>
                    </li>
                @else
                    <li aria-disabled="true">
                        <span class="inline-flex items-center justify-center min-w-9 h-9 px-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-300 text-sm font-semibold select-none" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@elseif ($paginator->total() > 0)
    <p class="mt-8 text-center text-xs text-gray-500">
        Menampilkan <span class="font-semibold text-gray-700">{{ $paginator->total() }}</span> data
    </p>
@endif
