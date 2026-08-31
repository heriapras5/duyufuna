@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="mt-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <p class="text-xs text-gray-500">
                Menampilkan <span class="font-semibold text-gray-700">{{ $paginator->firstItem() ?? 0 }}</span>–<span class="font-semibold text-gray-700">{{ $paginator->lastItem() ?? 0 }}</span> dari <span class="font-semibold text-gray-700">{{ $paginator->total() }}</span> data
                · Halaman <span class="font-semibold text-gray-700">{{ $paginator->currentPage() }}</span> dari <span class="font-semibold text-gray-700">{{ $paginator->lastPage() }}</span>
            </p>
            <div class="flex flex-wrap items-center gap-3">
                {{-- Lompat ke halaman --}}
                <form method="GET" action="{{ $paginator->path() }}" class="inline-flex items-center gap-1.5">
                    @foreach (request()->except(['page']) as $key => $value)
                        @if (!is_array($value) && $value !== '' && $value !== null)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach
                    <span class="text-xs text-gray-500">Lompat ke</span>
                    <input type="number" name="page" min="1" max="{{ $paginator->lastPage() }}" value="{{ $paginator->currentPage() }}" class="admin-input w-16 text-center tabular-nums" title="Lompat ke halaman" aria-label="Nomor halaman">
                    <button type="submit" class="bg-white border border-gray-200 hover:bg-gray-50 rounded-lg text-xs font-semibold text-gray-700 px-2 py-1.5 cursor-pointer">Go</button>
                </form>
                <ul class="admin-pagination pagination flex items-center gap-1">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Sebelumnya">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Berikutnya">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif