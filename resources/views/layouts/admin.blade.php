<!DOCTYPE html>
<html lang="id" class="admin-html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - {{ $globalSetting->website_name ?? config('app.name') }} Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="status-toggle-url" content="{{ route('admin.status.toggle') }}">
    @php $iconUrl = ($globalSetting && $globalSetting->favicon)
        ? Storage::url($globalSetting->favicon)
        : (($globalSetting && $globalSetting->logo) ? Storage::url($globalSetting->logo) : asset('favicon.ico')); @endphp
    <link rel="icon" type="image/png" sizes="128x128" href="{{ $iconUrl }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $iconUrl }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $iconUrl }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    @vite(['resources/css/app.css', 'resources/css/admin-summernote.css', 'resources/js/app.js', 'resources/js/admin.js'])
    @stack('head')
</head>
<body class="font-sans bg-gray-50 admin-content-bg" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">
    <div class="flex overflow-hidden admin-frame">
        <aside class="fixed inset-y-0 left-0 z-40 admin-sidebar text-white sidebar-transition flex flex-col
                    lg:static lg:inset-auto"
                :class="{
                    '-translate-x-full': !sidebarOpen,
                    'translate-x-0': sidebarOpen,
                    'lg:translate-x-0': true,
                    'is-collapsed': sidebarCollapsed
                }"
                @click.away="sidebarOpen = false">

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center h-[72px] px-4 border-b border-white/10 relative z-10 hover:bg-white/5 transition"
               :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                @if($globalSetting && $globalSetting->logo)
                <div class="w-16 h-16 rounded-xl bg-white/10 p-1 flex items-center justify-center shrink-0 transition-colors duration-300 hover:bg-white/15">
                    <img src="{{ Storage::url($globalSetting->logo) }}" alt="{{ $globalSetting->website_name ?? 'Logo' }}"
                         class="w-full h-full object-contain transition-all duration-300 hover:scale-105 hover:drop-shadow-[0_0_10px_rgba(245,215,110,0.55)] hover:brightness-110">
                </div>
                @else
                <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                </div>
                @endif
                <div class="min-w-0 ml-3" x-show="!sidebarCollapsed">
                    <h1 class="text-sm font-bold text-white leading-tight font-serif">{{ $globalSetting->website_name ?? 'DUYUFUNA' }}</h1>
                    <p class="text-[11px] text-gold leading-tight mt-0.5 tracking-wider uppercase font-semibold">{{ $globalSetting->tagline ?? 'MELAYANI TAMU ALLAH, SEPENUH HATI' }}</p>
                </div>
            </a>

            <nav class="px-3 py-4 space-y-1 overflow-y-auto flex-1 min-h-0 scrollbar-thin relative z-10">
                {{-- UTAMA --}}
                <div class="nav-section-label" x-show="!sidebarCollapsed">Utama</div>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.dashboard') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><rect width="7" height="9" x="3" y="3"/><rect width="7" height="5" x="14" y="3"/><rect width="7" height="9" x="14" y="12"/><rect width="7" height="5" x="3" y="16"/></svg>
                    <span x-show="!sidebarCollapsed">Dashboard</span>
                </a>

                {{-- KONTEN --}}
                <div class="nav-section-label" x-show="!sidebarCollapsed">Konten</div>
                <a href="{{ route('admin.banners.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.banners.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><rect width="18" height="14" x="3" y="3" rx="2"/><path d="M21 9h-6a3 3 0 0 0 0 6h6"/></svg>
                    <span x-show="!sidebarCollapsed">Banner Slider</span>
                </a>
                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.catalog.*') || request()->routeIs('admin.services.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2"/></svg>
                    <span x-show="!sidebarCollapsed">Kategori Layanan</span>
                </a>
                <a href="{{ route('admin.article_categories.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.article_categories.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2z"/><path d="M7 7h.01"/></svg>
                    <span x-show="!sidebarCollapsed">Kategori Artikel</span>
                </a>
                <a href="{{ route('admin.articles.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.articles.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    <span x-show="!sidebarCollapsed">Artikel</span>
                </a>
                <a href="{{ route('admin.faqs.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.faqs.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
                    <span x-show="!sidebarCollapsed">FAQ</span>
                </a>
                <a href="{{ route('admin.testimonials.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.testimonials.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span x-show="!sidebarCollapsed">Testimoni</span>
                </a>
                <a href="{{ route('admin.galleries.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.galleries.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.86-3.86a2 2 0 0 0-2.82 0L6 21"/></svg>
                    <span x-show="!sidebarCollapsed">Galeri</span>
                </a>

                {{-- DATA --}}
                <div class="nav-section-label" x-show="!sidebarCollapsed">Data</div>
                <a href="{{ route('admin.customers.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.customers.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/></svg>
                    <span x-show="!sidebarCollapsed">Leads</span>
                </a>
                <a href="{{ route('admin.traffics.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.traffics.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    <span x-show="!sidebarCollapsed">Traffic</span>
                </a>

                {{-- PENGATURAN --}}
                <div class="nav-section-label" x-show="!sidebarCollapsed">Pengaturan</div>
                <a href="{{ route('admin.settings.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.settings.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span x-show="!sidebarCollapsed">Pengaturan</span>
                </a>
                <a href="{{ route('admin.seo.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.seo.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <span x-show="!sidebarCollapsed">Pengaturan SEO</span>
                </a>
                @if(auth()->user()->isSuperAdmin())
                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group {{ request()->routeIs('admin.users.*') ? 'active-nav' : '' }}"
                   :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 nav-icon"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span x-show="!sidebarCollapsed">Pengguna</span>
                </a>
                @endif

            </nav>

            <div class="px-3 py-3 border-t border-white/10 relative z-10 text-center" x-show="!sidebarCollapsed">
                <p class="text-[10px] text-white/40 leading-snug whitespace-nowrap overflow-hidden text-ellipsis">
                    &copy; {{ date('Y') }} {{ $globalSetting->website_name ?? 'DUYUFUNA' }} &middot; All rights reserved.
                </p>
            </div>

        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-16 admin-header-glass flex items-center gap-3 px-4 lg:px-6 sticky top-0 z-30">
                <button @click.stop="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:flex p-2 rounded-lg hover:bg-gray-100 transition text-gray-500 shrink-0" title="Toggle sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" x-show="!sidebarCollapsed"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="15" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" x-show="sidebarCollapsed" x-cloak><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>

                <div class="min-w-0">
                    @if($__env->yieldContent('page_title', 'Dashboard') !== '')
                    <div class="flex items-center gap-2.5">
                        <span class="w-1 h-6 bg-gold rounded-full shrink-0"></span>
                        <h1 class="admin-page-title truncate">@yield('page_title', 'Dashboard')</h1>
                    </div>
                    @endif
                    @hasSection('page_subtitle')
                    <p class="text-xs text-gray-400 mt-0.5 truncate pl-3.5">@yield('page_subtitle')</p>
                    @endif
                </div>

                <div class="flex-1 min-w-0">
                </div>

                <div class="flex items-center gap-2.5 ml-auto">
                    <div class="flex items-center gap-2 relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2.5 p-1.5 rounded-lg hover:bg-gray-100 transition group">
                            @if(Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-9 h-9 rounded-full object-cover border border-gray-200">
                            @else
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-dark-green to-masjid flex items-center justify-center text-white text-sm font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            @endif
                            <div class="hidden sm:block min-w-0 text-left">
                                <p class="text-sm font-semibold text-gray-800 truncate max-w-[120px] leading-tight">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-gray-400 leading-tight">{{ Auth::user()->isSuperAdmin() ? 'Super Admin' : 'Admin' }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 group-hover:text-gray-600 transition"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        <div x-show="open" @click.outside="open = false" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 top-14 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden">
                            <div class="px-4 py-2.5 border-b border-gray-50 mb-1">
                                <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-amber-50 hover:text-gold transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                Profil
                            </a>
                            <hr class="my-1 border-gray-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 lg:p-5 xl:p-6">
                <div class="fixed top-4 right-4 z-50 max-w-sm w-full space-y-2">
                    <x-flash-message type="success" :message="session('success')" />
                    <x-flash-message type="error" :message="session('error')" />
                </div>

                <div x-show="sidebarOpen" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-30 lg:hidden" @click="sidebarOpen = false"></div>

                @yield('content')
            </main>

            @stack('modals')
        </div>
    </div>

    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
    window.confirmRemoveImage = function() {
        return Swal.fire({
            title: 'Hapus Gambar?',
            text: 'Gambar yang dipilih akan dihapus',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            buttonsStyling: false,
            customClass: {
                popup: 'rounded-2xl shadow-lg border border-gray-100',
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-secondary'
            }
        });
    };

    window.confirmDelete = function(url, options) {
        options = options || {};
        return Swal.fire({
            title: options.title || 'Yakin ingin menghapus?',
            text: options.text || 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: options.confirmText || 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            buttonsStyling: false,
            customClass: {
                popup: 'rounded-2xl shadow-lg border border-gray-100',
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = document.querySelector('meta[name="csrf-token"]').content;
                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(csrf);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        });
    };

    </script>
    @stack('scripts')
</body>
</html>
