<?php

namespace Database\Seeders;

use App\Models\FAQ;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $fallbackImage = Storage::disk('public')->files('settings')[0] ?? 'settings/logo-duyufuna.jpg';

        Setting::updateOrCreate(
            ['id' => 1],
            [
                'about_title' => 'DUYUFUNA - Pelayanan Umroh & Haji Profesional',
                'about_banner' => $fallbackImage,
                'about_body' => '<p>DUYUFUNA melayani kebutuhan umroh dan haji Anda mulai dari hotel, visa, transportasi, handling bandara dan hotel, catering, hingga laundry dan layanan penunjang lainnya.</p><p>Kami berkomitmen memberikan pelayanan yang amanah, profesional, dan nyaman agar ibadah Anda berjalan lancar dan khusyuk.</p>',
            ]
        );

        $testimonials = [
            ['name' => 'H. Ahmad Fauzi', 'review' => 'Pelayanan DUYUFUNA sangat memuaskan, hotel dan catering nya nyaman. Sangat direkomendasikan.', 'rating' => 5],
            ['name' => 'Ibu Siti Rahma', 'review' => 'Transportasi dan handling bandara lancar, tim ramah dan siap. Perjalanan ibadah kami jadi tenang.', 'rating' => 5],
            ['name' => 'Bp. Budi Santoso', 'review' => 'Proses visa dan pengurusan dokumen cepat dan jelas. Alhamdulillah puas beribadah ke Tanah Suci.', 'rating' => 4],
        ];
        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['name' => $t['name']],
                ['review' => $t['review'], 'rating' => $t['rating'], 'status' => true]
            );
        }

        $faqs = [
            ['question' => 'Apakah paket DUYFUNA sudah termasuk visa dan hotel?', 'answer' => 'Ya, semua paket sudah mencakup visa, hotel, dan transportas i. Anda bisa menyesuaikan layanan sesuai kebutuhan.', 'sort' => 1],
            ['question' => 'Berapa lama proses pendaftaran dan visa?', 'answer' => 'Proses umumnya memakan waktu 2-5 minggu tergantung ketersediaan jadwal dan kelengkapan dokumen.', 'sort' => 2],
            ['question' => 'Apakah ada layanan khusus untuk jamaah lansia?', 'answer' => 'Tersedia layanan kursi roda umroh dan pendampingan khusus agar jamaah lansia tetap nyaman beribadah.', 'sort' => 3],
            ['question' => 'Bagaimana cara menghubungi customer service?', 'answer' => 'CS kami siap membantu 24 jam melalui WhatsApp. Klik tombol konsultasi gratis di halaman utama.', 'sort' => 4],
        ];
        foreach ($faqs as $f) {
            FAQ::updateOrCreate(
                ['question' => $f['question']],
                ['answer' => $f['answer'], 'sort' => $f['sort']]
            );
        }
    }
}