# Perbaikan Format Tanggal Terbalik (MM/DD → DD/MM)

## Masalah
Input tanggal di halaman **Kategori Layanan Transportasi**, **Layanan Fotografer**, **Detail Layanan**, dan **Laundry** tampil terbalik (MM/DD/YYYY) karena `<input type="date">` bawaan browser mengikuti locale browser/OS — atribut `lang="id"` diabaikan Chrome desktop locale Inggris. Commit bc3cf98 sebelumnya belum menyelesaikan tampilan di desktop.

## Solusi (disetujui user)
Format target: **DD/MM/YYYY** (contoh `21/09/2026`). Perbaiki SEMUA 4 halaman.
Teknik: overlay custom + native input transparan (tanpa library baru, calendar picker native tetap berfungsi):
- Tampilkan tanggal via `<span x-text="tanggal ? fmtDate(tanggal) : 'Pilih tanggal'">` + ikon kalender
- Input native jadi overlay `absolute inset-0 opacity-0 cursor-pointer`
- Klik label memicu `showPicker()` dengan fallback `focus()`
- Hapus span placeholder mobile "dd/mm/yyyy" yang tidak perlu lagi

## File & Perubahan

### 1. `resources/views/categories/show_transportasis.blade.php`
- **Tambah helper** setelah `fmtDate()` (baris ~146):
  ```js
  openDatePicker() {
      const el = this.$refs.tanggalInput;
      if (!el) return;
      try { el.showPicker(); } catch (e) { el.focus(); }
  },
  ```
- **Ganti field tanggal** (baris 334–340) dari input date langsung menjadi:
  ```html
  <div class="relative">
      <button type="button" @click="openDatePicker()"
              class="w-full flex items-center justify-between gap-2 px-3 py-2.5 rounded-xl border bg-gray-50/50 focus:bg-white text-sm ..."
              :class="tanggal ? 'text-gray-900 border-gray-200' : 'text-gray-400 border-gray-200'">
          <span x-text="tanggal ? fmtDate(tanggal) : 'Pilih tanggal'"></span>
          <svg (ikon kalender)></svg>
      </button>
      <input type="date" x-ref="tanggalInput" x-model="tanggal" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
  </div>
  ```
- fmtDate() sudah ada (baris 146–152), sudah DD/MM/YYYY.

### 2. `resources/views/categories/show_fotografer.blade.php`
- **Tambah 2 helper** ke x-data (baris 61–88):
  ```js
  fmtDate(d) { /* sama seperti transportasi */ },
  openDatePicker() { /* sama, $refs.tanggalInput */ },
  ```
- **Ganti field tanggal** (baris 157–164) dengan pola overlay yang sama.
- Pertahankan `required` + `min="{{ date('Y-m-d') }}"` di input native (validasi tetap jalan walau transparan).

### 3. `resources/views/services/detail.blade.php`
- **Tambah fmtDate + openDatePicker** ke x-data (cek blok x-data di baris ~88–93; fmtDate Intl 'id-ID' sudah day-first, ganti dengan versi manual DD/MM/YYYY agar konsisten).
- **Ganti field tanggal** (baris 276–280) dengan pola overlay. Pertahankan `required`.

### 4. `resources/views/categories/show_form.blade.php` (Laundry)
- **Field date** (baris ~165) + **field time** (baris ~173): pola overlay sama.
- Time pakai helper `fmtTime(t)` → `HH:MM` (input time punya masalah locale yang sama).
- Ada x-data dengan `laundryDate`/`laundryTime` — tambah helper di sana.

## Catatan Teknis
- Jangan sentuh: chip filter (baris 299), sidebar summary (426), consultContext (223) — semuanya sudah benar via fmtDate.
- Submit tetap kirim `Y-m-d` via hidden input `pickup_date` — backend (CustomerController) tidak berubah.
- `showPicker()` butuh user gesture (klik) — aman. Fallback `focus()` untuk browser lama.
- CSS `placeholder-empty` di `app.css:1752` jadi tidak terpakai di 4 file ini (biarkan, dipakai admin).

## Verifikasi
1. `npm run build` (Vite) — build CSS/JS assets
2. Buka `/category/transportasi` & `/category/fotografer`: pilih 25 Des → field tampil `25/12/2026` di semua browser (desktop Chrome en-US termasuk)
3. Klik field → calendar picker native muncul
4. Filter & submit WhatsApp tetap berfungsi (tanggal terkirim Y-m-d)
5. Cek `/services/{slug}` dan halaman laundry juga
