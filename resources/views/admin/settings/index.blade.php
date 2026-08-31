@extends('layouts.admin')
@section('title', 'Pengaturan')
@section('page_title', 'Pengaturan')
@section('content')

<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        Kembali
    </a>
</div>

<div class="max-w-6xl mx-auto">
    <form method="POST" action="{{ route('admin.settings.update', $setting) }}" enctype="multipart/form-data"
          x-data="{ tab: 'umum' }">
        @csrf @method('PUT')

        {{-- Navigasi Tab --}}
        <div class="sticky top-0 z-20 py-2 mb-6 bg-white/95 backdrop-blur border-b border-gray-200">
            <div class="flex items-center gap-1 overflow-x-auto scrollbar-none">
                @foreach([
                    'umum' => 'Umum & Kontak',
                    'identitas' => 'Identitas',
                    'beranda' => 'Beranda',
                    'tentang' => 'Tentang Kami',
                    'footer' => 'Footer & Sosmed',
                ] as $key => $label)
                <button type="button" @click="tab = '{{ $key }}'; $nextTick(() => window.dispatchEvent(new Event('resize')))"
                        class="shrink-0 px-3.5 py-2 rounded-lg text-sm font-semibold transition-all whitespace-nowrap"
                        :class="tab === '{{ $key }}' ? 'bg-dark-green text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100'">
                    {{ $label }}
                </button>
                @endforeach
            </div>
        </div>

        <div class="space-y-6">
        <div x-show="tab === 'umum'">
            {{-- Umum & Kontak --}}
            <x-admin.form-card title="Umum & Kontak" description="Informasi dasar dan kontak website.">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 11c0 4-1.5 6-3 8"/><path d="M16 16c-1 1.5-2 3-2 5"/><path d="M8 5a4 4 0 0 1 8 0c0 3-1 5-1 8"/><path d="M4 9a8 8 0 0 1 12-2"/></svg>
                </x-slot:icon>
                <div class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-admin.input name="website_name" label="Nama Website" required placeholder="Contoh: DUYUFUNA" :value="old('website_name', $setting->website_name)" />
                        <x-admin.input name="email" label="Email" type="email" autocomplete="off" placeholder="info@contoh.com" :value="old('email', $setting->email)" />
                    </div>
                    <x-admin.input name="tagline" label="Tagline" help="Slogan yang tampil di samping nama website (header, footer, halaman login, dan sidebar admin)." placeholder="Slogan bisnis Anda" :value="old('tagline', $setting->tagline)" />
                    <x-admin.textarea name="address" label="Alamat" rows="1" placeholder="Alamat lengkap kantor" :value="old('address', $setting->address)" />
                    <div class="max-w-xl pt-2 border-t border-gray-100">
                        <x-admin.input name="whatsapp" label="No WhatsApp" placeholder="6281293679502" :value="old('whatsapp', $setting->whatsapp)"
                            help="Format internasional tanpa +. Contoh: 6281293679502" />
                        <x-admin.textarea name="wa_message" label="Teks Pesan WhatsApp" rows="4" :value="old('wa_message', $setting->wa_message)"
                            help="Pesan otomatis saat pengunjung menekan Konsultasi (menu bawah) atau tombol WhatsApp. Kosongkan untuk memakai pesan bawaan. Variabel: {website}." />
                        <x-admin.wa-preview name="wa_message" :with-identity="false" />
                    </div>
                </div>
            </x-admin.form-card>
        </div>

        <div x-show="tab === 'identitas'">
            {{-- Identitas --}}
            <x-admin.form-card title="Identitas" description="Logo dan favicon brand website." tone="amber">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                </x-slot:icon>
                <div class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-admin.image-upload name="logo" label="Logo Website" :existing="$setting->logo" preview-class="h-16 rounded-lg border border-gray-200"
                            hint="Kosongkan jika tidak ingin mengubah. Format: JPG, PNG, WEBP. Maks 10MB" />
                        <x-admin.image-upload name="favicon" label="Favicon" :existing="$setting->favicon" preview-class="h-12 rounded-lg border border-gray-200"
                            hint="Kosongkan jika tidak ingin mengubah. Format: ICO, PNG, WEBP, JPG. Maks 2MB" />
                    </div>
                    <p class="text-xs text-gray-400">Gambar OG (Open Graph) kini dikelola di menu <a href="{{ route('admin.seo.index') }}" class="text-gold hover:underline font-medium">SEO Pengaturan</a>.</p>
                </div>
            </x-admin.form-card>
        </div>

        <div x-show="tab === 'beranda'">
            <div class="mb-4 rounded-xl border border-emerald-100 bg-emerald-50/60 p-3.5 text-xs text-gray-600">
                Semua isian <strong class="text-gray-800">opsional</strong> — kosongkan untuk memakai teks bawaan. Klik bagian untuk membuka.
            </div>
            <div class="space-y-4">
                <x-admin.collapse-card title="Welcome" description="Kartu sambutan yang tampil di bawah hero." tone="emerald" :default-open="true">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                    </x-slot:icon>
                    <div class="space-y-5">
                        <x-admin.image-upload name="greeting_image" label="Gambar" :existing="$setting->greeting_image"
                            hint="Kosongkan jika tidak ingin mengubah. Format: JPG, PNG, WEBP. Maks 2MB" />
                        <x-admin.input name="greeting_title" label="Judul" :value="old('greeting_title', $setting->greeting_title)"
                            help="Kosongkan untuk memakai teks bawaan (cth: Assalamu'alaikum)" />
                        <x-admin.input name="greeting_subtitle" label="Sub Judul" :value="old('greeting_subtitle', $setting->greeting_subtitle)"
                            help="Sub judul kartu sambutan. Kosongkan jika tidak dipakai." />
                        <x-admin.textarea name="greeting_text" label="Deskripsi / Keterangan" rows="2" :value="old('greeting_text', $setting->greeting_text)"
                            help="Kosongkan untuk memakai teks bawaan." />
                    </div>
                </x-admin.collapse-card>

                <x-admin.collapse-card title="Mengapa Kami" description="Judul & pengantar bagian 'Mengapa Kami' pada beranda." tone="blue">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.5"/><circle cx="12" cy="12" r="9"/><path d="M12 17.5h.01"/></svg>
                    </x-slot:icon>
                    <div class="space-y-5">
                        <x-admin.input name="why_label" label="Label Bagian" :value="old('why_label', $setting->why_label)"
                            help="Kosongkan untuk memakai 'Mengapa Kami'." />
                        <x-admin.input name="why_title" label="Judul" placeholder="Contoh: Kenapa Memilih DUYUFUNA?" :value="old('why_title', $setting->why_title)" />
                        <x-admin.textarea name="why_subtitle" label="Sub Judul / Deskripsi" rows="2" placeholder="Satu-dua kalimat pengantar bagian ini" :value="old('why_subtitle', $setting->why_subtitle)" />
                    </div>
                </x-admin.collapse-card>

                <x-admin.collapse-card title="Judul Testimoni" description="Judul & pengantar bagian testimoni pada beranda." tone="purple">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21c0-3 2-5 6-5"/><path d="M21 21c0-3-2-5-6-5"/><circle cx="9" cy="9" r="4"/><circle cx="15" cy="11" r="3"/><path d="M5 21h14"/></svg>
                    </x-slot:icon>
                    <div class="space-y-5">
                        <x-admin.input name="testimonial_label" label="Label Bagian" :value="old('testimonial_label', $setting->testimonial_label)"
                            help="Kosongkan untuk memakai 'Testimonial'." />
                        <x-admin.input name="testimonial_title" label="Judul" placeholder="Contoh: Apa Kata Mereka" :value="old('testimonial_title', $setting->testimonial_title)" />
                        <x-admin.textarea name="testimonial_subtitle" label="Sub Judul / Deskripsi" rows="2" placeholder="Satu-dua kalimat pengantar bagian ini" :value="old('testimonial_subtitle', $setting->testimonial_subtitle)" />
                    </div>
                </x-admin.collapse-card>
            </div>
        </div>

        <div x-show="tab === 'tentang'">
            {{-- Tentang Kami --}}
            <x-admin.form-card title="Tentang Kami" description="Isi konten untuk halaman publik Tentang Kami." tone="emerald">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </x-slot:icon>
                <div class="space-y-5">
                    <x-admin.image-upload name="about_image" label="Gambar" :existing="$setting->about_image"
                        hint="Kosongkan jika tidak ingin mengubah. Format: JPG, PNG, WEBP. Maks 10MB" />
                    <x-admin.input name="about_title" label="Judul" placeholder="Contoh: Tentang DUYUFUNA" :value="old('about_title', $setting->about_title)" />
                    <x-admin.textarea name="about_body" label="Isi Konten" :value="old('about_body', $setting->about_body)" class="summernote" />
                </div>
            </x-admin.form-card>
        </div>

        <div x-show="tab === 'footer'">
            {{-- Footer --}}
            <x-admin.form-card title="Footer" description="Konten yang ditampilkan di bagian footer website." tone="red">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="12" x="3" y="8" rx="1"/><path d="M10 8V5c0-.6-.4-1-1-1H6a1 1 0 0 0-1 1v3c0 .6.4 1 1 1h3c.6 0 1-.4 1-1Z"/><path d="M19 8V5c0-.6-.4-1-1-1h-3a1 1 0 0 0-1 1v3c0 .6.4 1 1 1h3c.6 0 1-.4 1-1Z"/></svg>
                </x-slot:icon>
                <div class="space-y-5">
                    <x-admin.textarea name="footer_text" label="Teks Footer (Deskripsi Brand)" rows="3" :value="old('footer_text', $setting->footer_text)" class="summernote sm-short" />
                    <x-admin.input name="footer_contact_heading" label="Judul Kolom Hubungi Kami" placeholder="Contoh: Hubungi Kami" :value="old('footer_contact_heading', $setting->footer_contact_heading)"
                        help="Kosongkan untuk memakai 'Hubungi Kami'." />
                    <div class="border-t border-gray-100 pt-4">
                        <x-admin.input name="footer_links_heading" label="Judul Kolom Tautan Cepat" placeholder="Contoh: Quick Links" :value="old('footer_links_heading', $setting->footer_links_heading)"
                            help="Kosongkan untuk memakai 'Quick Links'." />
                        <x-admin.textarea name="footer_links" label="Daftar Tautan Cepat" rows="5" :value="old('footer_links', $setting->footer_links)"
                            help="Satu tautan per baris dengan format: &lt;Label&gt;|&lt;URL&gt;. Contoh: Beranda|/   Tentang Kami|/tentang   Artikel|/artikel. Kosongkan untuk memakai tautan bawaan." />
                    </div>
                    <x-admin.textarea name="footer_copyright" label="Teks Copyright" rows="2" placeholder="Contoh: © {year} {website}. All rights reserved." :value="old('footer_copyright', $setting->footer_copyright)"
                        help="Variabel yang didukung: {year} (tahun saat ini) dan {website} (nama website). Kosongkan untuk memakai teks bawaan." />
                </div>
            </x-admin.form-card>

            {{-- Sosial Media --}}
            <x-admin.form-card title="Sosial Media" description="Tautan media sosial website." tone="purple">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </x-slot:icon>
                <div class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Instagram</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E4405F" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="5"/><circle cx="12" cy="12" r="4"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></div>
                                <input type="text" name="social_instagram" placeholder="https://instagram.com/…" value="{{ old('social_instagram', $setting->social_instagram) }}" class="admin-input pl-10">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Facebook</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#1877F2" stroke="none"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></div>
                                <input type="text" name="social_facebook" placeholder="https://facebook.com/…" value="{{ old('social_facebook', $setting->social_facebook) }}" class="admin-input pl-10">
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">YouTube</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#FF0000" stroke="none"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.94 2C5.12 20 12 20 12 20s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98" fill="white"/></svg></div>
                                <input type="text" name="social_youtube" placeholder="https://youtube.com/@…" value="{{ old('social_youtube', $setting->social_youtube) }}" class="admin-input pl-10">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">TikTok</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#111827" stroke="none"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg></div>
                                <input type="text" name="social_tiktok" placeholder="https://tiktok.com/@…" value="{{ old('social_tiktok', $setting->social_tiktok) }}" class="admin-input pl-10">
                            </div>
                        </div>
                    </div>
                </div>
            </x-admin.form-card>
        </div>

        {{-- Bilah simpan sticky --}}
        <div class="sticky bottom-0 z-30 bg-white/95 backdrop-blur border-t border-gray-200 mt-2 py-3.5 flex justify-end rounded-b-xl">
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection