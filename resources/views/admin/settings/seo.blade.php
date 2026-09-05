@extends('layouts.admin')
@section('title', 'Pengaturan SEO')
@section('page_title', 'Pengaturan SEO')
@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>
<div class="max-w-3xl mx-auto">
    <div class="mb-6 rounded-xl border border-blue-100 bg-blue-50/60 p-4 text-sm text-gray-600 leading-relaxed">
        <p><strong class="text-gray-800">Cukup isi sekali di sini</strong> — dipakai di seluruh halaman website. Halaman yang sudah mengisi sendiri (misalnya Artikel) tetap memakai meta miliknya.</p>
    </div>

    <form method="POST" action="{{ route('admin.seo.update', $setting->id) }}" enctype="multipart/form-data"
          x-data="{ tab: 'google' }">
        @csrf @method('PUT')

        {{-- Navigasi Tab --}}
        <div class="sticky top-0 z-20 py-2 mb-6 bg-white/95 backdrop-blur border-b border-gray-200">
            <div class="flex items-center gap-1 overflow-x-auto scrollbar-none">
                @foreach([
                    'google' => 'Pencarian Google',
                    'medsos' => 'Bagikan di Medsos',
                    'lanjutan' => 'Lanjutan (opsional)',
                ] as $key => $label)
                <button type="button" @click="tab = '{{ $key }}'"
                        class="shrink-0 px-3.5 py-2 rounded-lg text-sm font-semibold transition-all whitespace-nowrap"
                        :class="tab === '{{ $key }}' ? 'bg-dark-green text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100'">
                    {{ $label }}
                </button>
                @endforeach
            </div>
        </div>

        <div class="space-y-6">
            <div x-show="tab === 'google'">
                <x-admin.form-card title="Pencarian Google" description="Judul & deskripsi yang tampil di hasil pencarian Google." tone="blue">
                    <div x-data="{ title: @js(old('seo_title', $setting->seo_title ?? '')), desc: @js(old('seo_description', $setting->seo_description ?? '')) }" class="space-y-5">
                        <div>
                            <x-admin.input name="seo_title" label="Judul (SEO Title)" x-model="title"
                                :value="old('seo_title', $setting->seo_title)"
                                help="Judul halaman di hasil pencarian. Direkomendasikan 50–60 karakter." />
                            <div class="mt-2 flex items-center gap-2.5">
                                <div class="flex-1 h-1.5 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-300"
                                         :class="title.length > 60 ? 'bg-red-500' : 'bg-emerald-500'"
                                         :style="'width: ' + Math.min((title.length / 60) * 100, 100) + '%'"></div>
                                </div>
                                <span class="text-xs tabular-nums shrink-0" :class="title.length > 60 ? 'text-red-500 font-semibold' : 'text-gray-400'">
                                    <span x-text="title.length"></span> / 60
                                </span>
                            </div>
                        </div>

                        <div>
                            <x-admin.textarea name="seo_description" label="Deskripsi (Meta Description)" rows="2" x-model="desc"
                                :value="old('seo_description', $setting->seo_description)"
                                help="Ringkasan singkat isi website. Direkomendasikan 150–160 karakter." />
                            <div class="mt-2 flex items-center gap-2.5">
                                <div class="flex-1 h-1.5 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-300"
                                         :class="desc.length > 160 ? 'bg-red-500' : 'bg-emerald-500'"
                                         :style="'width: ' + Math.min((desc.length / 160) * 100, 100) + '%'"></div>
                                </div>
                                <span class="text-xs tabular-nums shrink-0" :class="desc.length > 160 ? 'text-red-500 font-semibold' : 'text-gray-400'">
                                    <span x-text="desc.length"></span> / 160
                                </span>
                            </div>
                        </div>

                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide mb-2">Preview Hasil Google</p>
                            <div class="bg-white rounded-lg border border-gray-200 p-4">
                                <p class="text-xs text-gray-500 truncate" x-text="'{{ str_replace("'", "\'", url('/')) }}'"></p>
                                <p class="text-[15px] leading-snug text-blue-700 hover:underline font-medium cursor-pointer" x-text="(title || @js($setting->website_name ?? 'DUYUFUNA')).slice(0, 60)"></p>
                                <p class="text-xs text-gray-500 leading-snug mt-1" x-text="(desc || 'Deskripsi hasil pencarian website.').slice(0, 160)"></p>
                            </div>
                        </div>
                    </div>
                </x-admin.form-card>

                <x-admin.form-card title="Lanjutan Pencarian Google" description="Kata kunci, arahan robot, dan URL kanonik." tone="blue">
                    <div class="space-y-5">
                        <x-admin.input name="seo_keywords" label="Kata Kunci (Meta Keywords)" :value="old('seo_keywords', $setting->seo_keywords)"
                            help="Opsional. Dipisah koma. Contoh: umroh, haji, travel umroh, biro perjalanan." />
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-admin.input name="robots" label="Arahan Robot (Meta Robots)" placeholder="Contoh: index, follow" :value="old('robots', $setting->robots)"
                                help="Kosongkan = index, follow (default). Contoh lain: noindex, nofollow." />
                            <x-admin.input name="canonical_url" label="URL Kanonik" placeholder="https://duyufuna.com/" :value="old('canonical_url', $setting->canonical_url)"
                                help="Opsional. Kosongkan untuk memakai URL halaman otomatis." />
                        </div>
                    </div>
                </x-admin.form-card>
            </div>

            <div x-show="tab === 'medsos'">
                <x-admin.form-card title="Bagikan di Medsos" description="Judul & gambar yang tampil saat link dibagikan di WhatsApp, Facebook, dsb." tone="purple">
                    <div x-data="{ ogTitle: @js(old('og_title', $setting->og_title ?? '')), ogDesc: @js(old('og_description', $setting->og_description ?? '')) }" class="space-y-5">
                        <x-admin.image-upload name="og_image" label="Gambar" :existing="$setting->og_image"
                            preview-class="h-32 w-full object-cover rounded-lg border border-gray-200"
                            hint="Ukuran disarankan 1200x630px. Format: JPG, PNG, WEBP. Maks 4MB" />

                        <div>
                            <x-admin.input name="og_title" label="Judul" x-model="ogTitle" :value="old('og_title', $setting->og_title)"
                                help="Judul kartu share, dipakai untuk Beranda. Kosongkan = pakai Nama Website." />
                            <div class="mt-2 flex items-center gap-2.5">
                                <div class="flex-1 h-1.5 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-300"
                                         :class="ogTitle.length > 60 ? 'bg-red-500' : 'bg-emerald-500'"
                                         :style="'width: ' + Math.min((ogTitle.length / 60) * 100, 100) + '%'"></div>
                                </div>
                                <span class="text-xs tabular-nums shrink-0" :class="ogTitle.length > 60 ? 'text-red-500 font-semibold' : 'text-gray-400'">
                                    <span x-text="ogTitle.length"></span> / 60
                                </span>
                            </div>
                        </div>

                        <div>
                            <x-admin.textarea name="og_description" label="Deskripsi" rows="2" x-model="ogDesc" :value="old('og_description', $setting->og_description)"
                                help="Deskripsi kartu share, dipakai untuk Beranda. Kosongkan = Slogan + Deskripsi Google." />
                            <div class="mt-2 flex items-center gap-2.5">
                                <div class="flex-1 h-1.5 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-300"
                                         :class="ogDesc.length > 160 ? 'bg-red-500' : 'bg-emerald-500'"
                                         :style="'width: ' + Math.min((ogDesc.length / 160) * 100, 100) + '%'"></div>
                                </div>
                                <span class="text-xs tabular-nums shrink-0" :class="ogDesc.length > 160 ? 'text-red-500 font-semibold' : 'text-gray-400'">
                                    <span x-text="ogDesc.length"></span> / 160
                                </span>
                            </div>
                        </div>

                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide mb-2">Preview Saat Dibagikan (WhatsApp / Medsos)</p>
                            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                                @if($setting->og_image)
                                <div class="h-24 w-full bg-gray-100 bg-cover bg-center" style="background-image: url('{{ Storage::url($setting->og_image) }}')"></div>
                                @else
                                <div class="h-24 w-full bg-gradient-to-br from-mint to-emerald-50 flex items-center justify-center text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                </div>
                                @endif
                                <div class="p-3">
                                    <p class="text-xs text-gray-400 truncate">{{ url('/') }}</p>
                                    <p class="text-[13px] leading-snug text-blue-700 font-medium truncate" x-text="(ogTitle || @js($setting->seo_title ?? '')).slice(0, 60)"></p>
                                    <p class="text-xs text-gray-500 leading-snug line-clamp-2 mt-0.5" x-text="(ogDesc || 'Deskripsi hasil pencarian website.').slice(0, 160)"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-admin.form-card>

                <x-admin.form-card title="Twitter / X" description="Tampilan saat tautan dibagikan di X (Twitter). Kosongkan = otomatis memakai pengaturan Google & Medsos." tone="blue">
                    <div x-data="{ twTitle: @js(old('twitter_title', $setting->twitter_title ?? '')), twDesc: @js(old('twitter_description', $setting->twitter_description ?? '')) }" class="space-y-5">
                        <x-admin.image-upload name="twitter_image" label="Gambar" :existing="$setting->twitter_image"
                            preview-class="h-32 w-full object-cover rounded-lg border border-gray-200"
                            hint="Ukuran disarankan 1200x630px. Kosongkan = pakai gambar OG." />
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-admin.input name="og_type" label="Tipe Konten (og:type)" placeholder="website" :value="old('og_type', $setting->og_type)"
                                help="Kosongkan = website. Contoh lain: article, profile." />
                            <x-admin.input name="og_site_name" label="Nama Situs (og:site_name)" placeholder="DUYUFUNA" :value="old('og_site_name', $setting->og_site_name)"
                                help="Kosongkan = nama website." />
                        </div>
                        <x-admin.input name="twitter_title" label="Judul" x-model="twTitle" :value="old('twitter_title', $setting->twitter_title)"
                            help="Kosongkan = pakai Judul OG." />
                        <x-admin.textarea name="twitter_description" label="Deskripsi" rows="2" x-model="twDesc" :value="old('twitter_description', $setting->twitter_description)"
                            help="Kosongkan = pakai Deskripsi OG." />
                    </div>
                </x-admin.form-card>
            </div>

            <div x-show="tab === 'lanjutan'">
                <x-admin.form-card title="Lanjutan" description="Pencatatan pengunjung, verifikasi situs, dan sitemap — hanya untuk kebutuhan teknis. Bisa dikosongkan." tone="red">
                    <div class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-admin.input name="google_analytics_id" label="Google Analytics"
                                :value="old('google_analytics_id', $setting->google_analytics_id)"
                                help="Opsional. Kode pencatatan pengunjung. Contoh: G-ABC12345XYZ." />
                            <x-admin.input name="google_tag_manager_id" label="Google Tag Manager"
                                :value="old('google_tag_manager_id', $setting->google_tag_manager_id)"
                                help="Opsional. Contoh: GTM-ABC1234." />
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-admin.input name="google_site_verification" label="Kode Verifikasi Google" placeholder="Opsional. Paste kode dari Google Search Console."
                                :value="old('google_site_verification', $setting->google_site_verification)" />
                            <x-admin.input name="bing_site_verification" label="Kode Verifikasi Bing" placeholder="Opsional. Paste kode dari Bing Webmaster."
                                :value="old('bing_site_verification', $setting->bing_site_verification)" />
                        </div>
                        <div class="border-t border-gray-100 pt-4">
                            <x-admin.switch name="sitemap_enabled" label="Aktifkan Sitemap Otomatis" :checked="$setting->sitemap_enabled ?? true" />
                            <div class="rounded-xl border border-gray-200 bg-gray-50/50 p-4 mt-3">
                                <p class="text-xs text-gray-500 mb-1">URL Sitemap Anda:</p>
                                <code class="text-sm font-semibold text-gray-800">{{ url('/sitemap.xml') }}</code>
                                <p class="text-xs text-gray-400 mt-2">Daftarkan URL ini di Google Search Console.</p>
                            </div>
                        </div>
                    </div>
                </x-admin.form-card>

                <x-admin.form-card title="Struktur Data (Schema.org)" description="Data terstruktur Organization agar website lebih mudah dipahami Google (Rich Results)." tone="green">
                    <div class="space-y-5">
                        <x-admin.switch name="schema_enabled" label="Aktifkan Struktur Data" :checked="$setting->schema_enabled ?? true"
                            help="Menambahkan JSON-LD Organization ke seluruh halaman website." />
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-gray-100 pt-4">
                            <x-admin.input name="org_name" label="Nama Organisasi" :value="old('org_name', $setting->org_name)"
                                help="Kosongkan = nama website." />
                            <x-admin.image-upload name="org_logo" label="Logo" :existing="$setting->org_logo" preview-class="h-16 rounded-lg border border-gray-200"
                                hint="Kosongkan jika tidak ingin mengubah. Format: JPG, PNG, WEBP. Maks 2MB" />
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-admin.input name="org_phone" label="Telepon" placeholder="+62 812 3456 7890" :value="old('org_phone', $setting->org_phone)" />
                            <x-admin.input name="org_email" label="Email" type="email" :value="old('org_email', $setting->org_email)" />
                        </div>
                        <x-admin.textarea name="org_address" label="Alamat" rows="2" :value="old('org_address', $setting->org_address)" />
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-admin.input name="org_geo_lat" label="Latitude" placeholder="Contoh: -6.200000" :value="old('org_geo_lat', $setting->org_geo_lat)" />
                            <x-admin.input name="org_geo_lng" label="Longitude" placeholder="Contoh: 106.816666" :value="old('org_geo_lng', $setting->org_geo_lng)" />
                        </div>
                    </div>
                </x-admin.form-card>
            </div>
        </div>

        {{-- Bilah simpan sticky --}}
        <div class="sticky bottom-0 z-30 bg-white/95 backdrop-blur border-t border-gray-200 mt-2 py-3.5 flex justify-end rounded-b-xl">
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                Simpan Pengaturan SEO
            </button>
        </div>
    </form>
</div>
@endsection