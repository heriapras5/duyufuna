@extends('layouts.admin')
@section('title', 'Pencarian: ' . $q)
@section('page_title', 'Pencarian')

@section('content')
<div class="mb-6">
    <p class="text-sm text-gray-500 mt-1">Menampilkan hasil untuk "<strong>{{ $q }}</strong>" — {{ $total }} hasil ditemukan</p>
</div>

<div class="space-y-5">
    @if($articles->count() > 0)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1 h-5 bg-gold rounded-full"></span>
                Artikel ({{ $articles->count() }})
            </h2>
            <a href="{{ route('admin.articles.index') }}" class="text-xs font-semibold text-gold hover:text-amber-600 transition">Lihat Semua</a>
        </div>
        <div class="space-y-2">
            @foreach($articles as $item)
            <a href="{{ route('admin.articles.edit', $item->id) }}" class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-3 rounded-lg transition">
                <span class="text-sm font-medium text-gray-900">{{ $item->title }}</span>
                <span class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($customers->count() > 0)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1 h-5 bg-gold rounded-full"></span>
                Leads ({{ $customers->count() }})
            </h2>
            <a href="{{ route('admin.customers.index') }}" class="text-xs font-semibold text-gold hover:text-amber-600 transition">Lihat Semua</a>
        </div>
        <div class="space-y-2">
            @foreach($customers as $item)
            <a href="{{ route('admin.customers.edit', $item->id) }}" class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-3 rounded-lg transition">
                <span class="text-sm font-medium text-gray-900">{{ $item->nama }}</span>
                <span class="text-xs text-gray-400">{{ $item->no_hp }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($headerBanners->count() > 0)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1 h-5 bg-gold rounded-full"></span>
                Banner ({{ $headerBanners->count() }})
            </h2>
            <a href="{{ route('admin.banners.index') }}" class="text-xs font-semibold text-gold hover:text-amber-600 transition">Lihat Semua</a>
        </div>
        <div class="space-y-2">
            @foreach($headerBanners as $item)
            <a href="{{ route('admin.banners.edit', $item->id) }}" class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-3 rounded-lg transition">
                <span class="text-sm font-medium text-gray-900">{{ $item->title ?? 'Banner' }}</span>
                <span class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($categories->count() > 0)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1 h-5 bg-gold rounded-full"></span>
                Kategori ({{ $categories->count() }})
            </h2>
            <a href="{{ route('admin.categories.index') }}" class="text-xs font-semibold text-gold hover:text-amber-600 transition">Lihat Semua</a>
        </div>
        <div class="space-y-2">
            @foreach($categories as $item)
            <a href="{{ route('admin.categories.edit', $item->id) }}" class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-3 rounded-lg transition">
                <span class="text-sm font-medium text-gray-900">{{ $item->name }}</span>
                <span class="text-xs text-gray-400">{{ $item->slug }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($services->count() > 0)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1 h-5 bg-gold rounded-full"></span>
                Layanan ({{ $services->count() }})
            </h2>
            <a href="{{ route('admin.categories.index') }}" class="text-xs font-semibold text-gold hover:text-amber-600 transition">Lihat Semua</a>
        </div>
        <div class="space-y-2">
            @foreach($services as $item)
            <a href="{{ route('admin.catalog.groups', $item->category_id) }}" class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-3 rounded-lg transition">
                <span class="text-sm font-medium text-gray-900">{{ $item->title }}</span>
                <span class="text-xs text-gray-400">{{ $item->category?->name ?? '-' }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($faqs->count() > 0)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1 h-5 bg-gold rounded-full"></span>
                FAQ ({{ $faqs->count() }})
            </h2>
            <a href="{{ route('admin.faqs.index') }}" class="text-xs font-semibold text-gold hover:text-amber-600 transition">Lihat Semua</a>
        </div>
        <div class="space-y-2">
            @foreach($faqs as $item)
            <a href="{{ route('admin.faqs.edit', $item->id) }}" class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-3 rounded-lg transition">
                <span class="text-sm font-medium text-gray-900">{{ $item->question }}</span>
                <span class="text-xs text-gray-400">FAQ</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($testimonials->count() > 0)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1 h-5 bg-gold rounded-full"></span>
                Testimoni ({{ $testimonials->count() }})
            </h2>
            <a href="{{ route('admin.testimonials.index') }}" class="text-xs font-semibold text-gold hover:text-amber-600 transition">Lihat Semua</a>
        </div>
        <div class="space-y-2">
            @foreach($testimonials as $item)
            <a href="{{ route('admin.testimonials.edit', $item->id) }}" class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-3 rounded-lg transition">
                <span class="text-sm font-medium text-gray-900">{{ $item->name }}</span>
                <span class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($galleries->count() > 0)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1 h-5 bg-gold rounded-full"></span>
                Galeri ({{ $galleries->count() }})
            </h2>
            <a href="{{ route('admin.galleries.index') }}" class="text-xs font-semibold text-gold hover:text-amber-600 transition">Lihat Semua</a>
        </div>
        <div class="space-y-2">
            @foreach($galleries as $item)
            <a href="{{ route('admin.galleries.edit', $item->id) }}" class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-3 rounded-lg transition">
                <span class="text-sm font-medium text-gray-900">{{ $item->title }}</span>
                <span class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($notifications->count() > 0)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1 h-5 bg-gold rounded-full"></span>
                Notifikasi ({{ $notifications->count() }})
            </h2>
            <a href="{{ route('admin.notifications.index') }}" class="text-xs font-semibold text-gold hover:text-amber-600 transition">Lihat Semua</a>
        </div>
        <div class="space-y-2">
            @foreach($notifications as $item)
            <a href="{{ route('admin.notifications.edit', $item->id) }}" class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-3 rounded-lg transition">
                <span class="text-sm font-medium text-gray-900">{{ $item->title }}</span>
                <span class="text-xs text-gray-400">{{ $item->is_active ? 'Aktif' : 'Nonaktif' }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if(auth()->user()->isSuperAdmin() && $users->count() > 0)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                <span class="w-1 h-5 bg-gold rounded-full"></span>
                Pengguna ({{ $users->count() }})
            </h2>
            <a href="{{ route('admin.users.index') }}" class="text-xs font-semibold text-gold hover:text-amber-600 transition">Lihat Semua</a>
        </div>
        <div class="space-y-2">
            @foreach($users as $item)
            <a href="{{ route('admin.users.edit', $item->id) }}" class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-3 rounded-lg transition">
                <span class="text-sm font-medium text-gray-900">{{ $item->name }}</span>
                <span class="text-xs text-gray-400">{{ $item->email }}</span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($total === 0)
    <div class="bg-white rounded-2xl border border-gray-200 p-10 text-center">
        <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        </div>
        <p class="text-gray-500 font-medium">Tidak ada hasil untuk "<strong>{{ $q }}</strong>"</p>
        <p class="text-sm text-gray-400 mt-1">Coba gunakan kata kunci lain yang lebih spesifik.</p>
    </div>
    @endif
</div>
@endsection