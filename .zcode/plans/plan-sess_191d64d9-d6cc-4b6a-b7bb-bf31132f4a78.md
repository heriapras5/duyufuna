# Perbaikan: Halaman scroll saat picker kalender muncul

## Penyebab
Handler `onclick` tombol tanggal (yang saya tambahkan sebelumnya) memuat auto-scroll: ketika ruang di bawah field < 360px, halaman di-scroll ke bawah sebelum `showPicker()` dipanggil agar picker terbuka ke bawah. Gerakan halaman itulah yang terasa saat picker muncul.

## Perubahan (keputusan: tanpa scroll, perilaku native)
Hapus segmen scroll dari `onclick` di 4 file, kembalikan menjadi:
```html
onclick="const el = this.parentElement.querySelector('input[type=date]'); try { el.showPicker() } catch (e) { el.focus() }"
```

Lokasi edit:
1. `resources/views/categories/show_form.blade.php` — Tanggal Laundry (~baris 170)
2. `resources/views/categories/show_fotografer.blade.php` — Tanggal Kegiatan (~baris 168)
3. `resources/views/categories/show_transportasis.blade.php` — filter Tanggal Penjemputan (~baris 338)
4. `resources/views/services/detail.blade.php` — Tanggal Penjemputan form booking (~baris 281)

Perilaku setelah perbaikan:
- Klik field/ikon → picker langsung terbuka, halaman sama sekali tidak bergerak.
- Saat ruang di bawah field cukup (kasus umum) → picker terbuka ke bawah.
- Saat field menempel dasar viewport → picker terbuka ke atas field (perilaku native Chromium, tanpa scroll).
- Chevron tetap terhapus, field Jam (laundry) tidak tersentuh, input transparan tetap `pointer-events-none`.

## Verifikasi
- Grep memastikan tidak ada sisa `window.scrollBy` di keempat file.
- Reload halaman laundry di browser, klik field tanggal pada posisi rendah di layar → halaman tetap di tempat, picker muncul.