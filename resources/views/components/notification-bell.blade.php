@php $notifications = \App\Models\Notification::active()->latest()->get(); @endphp
<div class="relative" x-data="{ open: false }" @click.outside="open = false">
    <button @click="open = !open" class="relative w-9 h-9 rounded-xl flex items-center justify-center text-white/70 hover:text-white hover:bg-white/10 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        @if($notifications->count() > 0)
        <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-gold rounded-full flex items-center justify-center text-white text-[8px] font-bold ring-2 ring-dark-green shadow-sm">{{ $notifications->count() > 9 ? '9+' : $notifications->count() }}</span>
        @endif
    </button>
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden" @click="open = false">
        <div class="p-4 border-b border-gray-50 flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-gold to-amber-500 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-900">Notifikasi</p>
                <p class="text-[10px] text-gray-400">{{ $notifications->count() }} pemberitahuan</p>
            </div>
        </div>
        <div class="max-h-80 overflow-y-auto divide-y divide-gray-50">
            @forelse($notifications as $n)
            <a href="{{ $n->url ? $n->url : '#' }}" @if($n->url) target="_blank" @endif class="flex gap-3 px-4 py-3.5 hover:bg-gray-50/50 transition group">
                @if($n->image)
                <img src="{{ Storage::url($n->image) }}" width="40" height="40" loading="lazy" class="w-10 h-10 rounded-xl object-cover shrink-0 ring-1 ring-gray-100">
                @else
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-gold/10 to-amber-500/10 flex items-center justify-center shrink-0 ring-1 ring-gold/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#C9A227" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                </div>
                @endif
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-900 group-hover:text-dark-green transition-colors">{{ $n->title }}</p>
                    @if($n->body)<p class="text-[11px] text-gray-400 line-clamp-2 mt-0.5">{{ $n->body }}</p>@endif
                    <p class="text-[10px] text-gray-300 mt-1">{{ $n->created_at->diffForHumans() }}</p>
                </div>
            </a>
            @empty
            <div class="px-4 py-10 text-center">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-mint to-dark-green/5 flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#005C3B" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                </div>
                <p class="text-sm font-medium text-gray-900">Belum ada notifikasi</p>
                <p class="text-xs text-gray-400 mt-1">Notifikasi akan muncul di sini</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
