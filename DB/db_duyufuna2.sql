-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Agu 2026 pada 06.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_duyufuna`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` timestamp NULL DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `articles`
--

INSERT INTO `articles` (`id`, `article_category_id`, `title`, `slug`, `image`, `excerpt`, `content`, `status`, `published_at`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
(5, 1, 'Panduan Persiapan Umroh', 'panduan-persiapan-umroh', 'articles/wX70HQSuCcZDoU3Uxl856OAptw5ldS8ahT0OMCb8.jpeg', 'Hal Penting yang Perlu Disiapkan Sebelum Berangkat', '<p data-start=\"694\" data-end=\"1013\" class=\"PDq2pG_selectionAnchorContainer\">Menunaikan ibadah umroh merupakan perjalanan yang membutuhkan persiapan, bukan hanya secara fisik tetapi juga dari sisi administrasi, perlengkapan, pengetahuan ibadah, dan kesiapan mental. Persiapan yang baik akan membantu jamaah menjalani perjalanan dengan lebih tenang sejak keberangkatan hingga kembali ke tanah air.</p><p data-start=\"694\" data-end=\"1013\" class=\"PDq2pG_selectionAnchorContainer\"><br></p><p data-start=\"694\" data-end=\"1013\" class=\"PDq2pG_selectionAnchorContainer\"><span aria-hidden=\"true\" class=\"PDq2pG_selectionAnchor\"></span></p><p data-start=\"1015\" data-end=\"1634\">Sebelum berangkat, jamaah perlu memastikan dokumen perjalanan, visa, tiket, akomodasi, transportasi, serta perlengkapan pribadi telah dipersiapkan dengan baik. Selain itu, penting untuk memahami kembali tata cara ihram, tawaf, sa\'i, dan tahallul agar pelaksanaan ibadah dapat dilakukan dengan benar. Kementerian Haji dan Umrah Arab Saudi juga menyediakan <strong data-start=\"1370\" data-end=\"1395\">Umrah and Visit Guide</strong> yang membahas perjalanan jamaah mulai dari persiapan sebelum berangkat, prosedur visa, ihram, pelaksanaan manasik, perjalanan antarlokasi, hingga kepulangan. Panduan tersebut tersedia dalam 16 bahasa.</p><p data-start=\"1015\" data-end=\"1634\"><br></p><p data-start=\"1015\" data-end=\"1634\"> <span class=\"contents\" data-content-reference-start=\"1789\" data-content-reference-end=\"1822\"><span class=\"\" data-state=\"closed\"></span></span></p><p>\r\n\r\n</p><p data-start=\"1636\" data-end=\"1983\">Jamaah juga sebaiknya mempersiapkan kondisi fisik, membawa obat-obatan pribadi jika diperlukan, menggunakan pakaian dan alas kaki yang nyaman, serta tidak membawa barang secara berlebihan. Dengan persiapan yang matang, perjalanan menuju Tanah Suci dapat dijalani dengan lebih nyaman dan jamaah dapat lebih fokus pada tujuan utama, yaitu beribadah.</p>', 1, '2026-08-07 11:27:14', NULL, NULL, NULL, '2026-08-07 11:27:14', '2026-08-14 13:21:05'),
(6, 3, 'Memilih Hotel di Mekkah', 'memilih-hotel-di-mekkah', 'articles/oJCGOjv1UT7dvkxTFNbVjIH3I6Nq6sDaa96gB5YQ.jpeg', 'Dekat Masjidil Haram atau Lebih Ekonomis?', '<p data-start=\"2166\" data-end=\"2572\" class=\"PDq2pG_selectionAnchorContainer\">Pemilihan hotel menjadi salah satu hal yang perlu diperhatikan ketika merencanakan perjalanan umroh. Di Mekkah, perbedaan lokasi hotel dapat memberikan pengalaman yang cukup berbeda bagi jamaah. Hotel yang berada dekat Masjidil Haram biasanya memberikan kemudahan akses untuk melaksanakan shalat dan ibadah lainnya, tetapi umumnya memiliki harga yang lebih tinggi dibandingkan hotel yang berada lebih jauh.</p><p data-start=\"2166\" data-end=\"2572\" class=\"PDq2pG_selectionAnchorContainer\"><br></p><p data-start=\"2166\" data-end=\"2572\" class=\"PDq2pG_selectionAnchorContainer\"><span aria-hidden=\"true\" class=\"PDq2pG_selectionAnchor\"></span></p><p data-start=\"2574\" data-end=\"2925\">Bagi jamaah lansia, keluarga dengan anak-anak, atau jamaah yang memiliki keterbatasan dalam berjalan jauh, hotel yang dekat dengan Masjidil Haram dapat menjadi pilihan yang lebih nyaman. Sementara itu, jamaah yang ingin menekan biaya perjalanan dapat mempertimbangkan hotel yang lokasinya sedikit lebih jauh dengan fasilitas transportasi yang memadai.</p><p data-start=\"2574\" data-end=\"2925\"><br></p><p data-start=\"2927\" data-end=\"3233\">Selain jarak, jangan lupa memperhatikan akses masuk dan keluar hotel, kapasitas lift, fasilitas restoran, layanan transportasi, ukuran kamar, serta kondisi lingkungan sekitar. Pada musim ramai, jarak yang terlihat dekat di peta belum tentu terasa sama ketika kawasan sekitar Masjidil Haram dipenuhi jamaah.</p><p data-start=\"2927\" data-end=\"3233\"><br></p><p>\r\n\r\n\r\n</p><p data-start=\"3235\" data-end=\"3503\">Karena itu, hotel terbaik bukan selalu hotel yang paling mahal, melainkan hotel yang paling sesuai dengan kebutuhan dan kondisi jamaah. Duyufuna dapat membantu jamaah memilih akomodasi berdasarkan kebutuhan perjalanan, tingkat kenyamanan, serta anggaran yang tersedia.</p>', 1, '2026-08-07 11:29:31', NULL, NULL, NULL, '2026-08-07 11:29:31', '2026-08-07 11:29:31'),
(7, 6, 'Mengapa Madinah Menjadi Bagian Penting dalam Perjalanan Umroh?', 'mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', 'articles/Or2B5A7pOdrBngKW268UPlMfplbPT2zZNCVj6pMY.jpeg', NULL, '<p data-start=\"3682\" data-end=\"4054\" class=\"PDq2pG_selectionAnchorContainer\">Madinah memiliki tempat yang sangat istimewa dalam perjalanan spiritual umat Islam. Di kota inilah terdapat Masjid Nabawi, salah satu masjid yang memiliki kedudukan utama dalam Islam. Bagi banyak jamaah umroh, perjalanan ke Madinah menjadi kesempatan untuk memperbanyak ibadah, mengunjungi Masjid Nabawi, serta mengenal lebih dekat sejarah Rasulullah SAW dan para sahabat.</p><p data-start=\"3682\" data-end=\"4054\" class=\"PDq2pG_selectionAnchorContainer\"><br></p><p data-start=\"3682\" data-end=\"4054\" class=\"PDq2pG_selectionAnchorContainer\"><span aria-hidden=\"true\" class=\"PDq2pG_selectionAnchor\"></span></p><p data-start=\"4056\" data-end=\"4476\">Selama berada di Madinah, jamaah biasanya memiliki kesempatan untuk mengunjungi sejumlah tempat bersejarah seperti Masjid Quba, Masjid Qiblatain, kawasan Uhud, dan berbagai lokasi yang berkaitan dengan sejarah perkembangan Islam. Kementerian Haji dan Umrah Arab Saudi juga menyediakan panduan khusus mengenai landmark Makkah dan Madinah serta layanan yang tersedia di Masjid Nabawi.</p><p data-start=\"4056\" data-end=\"4476\"><br></p><p data-start=\"4056\" data-end=\"4476\"> <span class=\"contents\" data-content-reference-start=\"4989\" data-content-reference-end=\"5008\"><span class=\"\" data-state=\"closed\"></span></span></p><p data-start=\"4478\" data-end=\"4764\">Pemilihan hotel juga menjadi bagian penting. Hotel yang berada di kawasan pusat Madinah atau dekat Masjid Nabawi dapat memberikan kemudahan bagi jamaah untuk pergi dan kembali ke hotel tanpa perjalanan yang terlalu jauh. Hal ini sangat membantu terutama bagi jamaah lansia dan keluarga.</p><p data-start=\"4478\" data-end=\"4764\"><br></p><p>\r\n\r\n\r\n</p><p data-start=\"4766\" data-end=\"4994\">Lebih dari sekadar persinggahan, Madinah dapat menjadi bagian perjalanan yang memberikan ketenangan dan kesempatan bagi jamaah untuk memperbanyak ibadah serta mengenang perjuangan Rasulullah SAW dalam membangun masyarakat Islam.</p>', 1, '2026-08-07 11:31:56', NULL, NULL, NULL, '2026-08-07 11:31:56', '2026-08-07 11:31:56'),
(8, 7, 'Mengenal Perjalanan Haji', 'mengenal-perjalanan-haji', 'articles/RnvHgLs9NecUEPXMkxo0oWq1oixmtCOKm5HKVXjW.jpeg', 'Dari Arafah, Muzdalifah hingga Mina', '<p data-start=\"6778\" data-end=\"7200\" class=\"PDq2pG_selectionAnchorContainer\">Ibadah haji memiliki rangkaian perjalanan yang berbeda dengan umroh. Salah satu bagian terpentingnya adalah perjalanan jamaah menuju Arafah, Muzdalifah, dan Mina yang berlangsung dalam rangkaian waktu dan ketentuan tertentu. Arafah menjadi salah satu tempat yang sangat penting dalam pelaksanaan haji, kemudian jamaah melanjutkan perjalanan menuju Muzdalifah dan Mina sesuai dengan rangkaian manasik yang telah ditetapkan.<br><br><span aria-hidden=\"true\" class=\"PDq2pG_selectionAnchor\"></span></p><p data-start=\"7202\" data-end=\"7603\">Di Mina, jamaah melaksanakan rangkaian ibadah termasuk melempar jumrah. Setelah Iduladha, jamaah memasuki hari-hari Tasyrik yang berlangsung pada 11, 12, dan 13 Zulhijah. Kementerian Haji dan Umrah menjelaskan bahwa hari-hari tersebut merupakan bagian penting dari rangkaian akhir ibadah haji, sekaligus menjadi waktu bagi jamaah untuk terus memperbanyak zikir. <br><br><span class=\"contents\" data-content-reference-start=\"8427\" data-content-reference-end=\"8446\"><span class=\"\" data-state=\"closed\"></span></span></p><p data-start=\"7605\" data-end=\"7996\">Pelaksanaan haji juga membutuhkan kepatuhan terhadap prosedur resmi. Pemerintah Arab Saudi menegaskan bahwa pelaksanaan haji harus melalui jalur dan izin resmi. Ketentuan tersebut diterapkan untuk menjaga keamanan jamaah, mengatur kepadatan, serta memastikan layanan transportasi dan fasilitas di tempat-tempat suci dapat berjalan secara terorganisir. <br><br><span class=\"contents\" data-content-reference-start=\"8800\" data-content-reference-end=\"8820\"><span class=\"\" data-state=\"closed\"></span></span></p><p data-start=\"6778\" data-end=\"7200\" class=\"PDq2pG_selectionAnchorContainer\">\r\n\r\n\r\n</p><p data-start=\"7998\" data-end=\"8330\">Karena rangkaian haji memiliki banyak tahapan dan kondisi lapangan yang berbeda, jamaah sangat dianjurkan mengikuti arahan pembimbing dan penyelenggara resmi. Persiapan fisik, pemahaman manasik, serta kemampuan mengikuti jadwal perjalanan menjadi bagian penting agar seluruh rangkaian ibadah dapat dijalani dengan tertib dan nyaman.</p>', 1, '2026-08-07 11:38:38', NULL, NULL, NULL, '2026-08-07 11:38:38', '2026-08-07 11:38:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `article_categories`
--

CREATE TABLE `article_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `article_categories`
--

INSERT INTO `article_categories` (`id`, `name`, `slug`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Panduan Umroh', 'panduan-umroh', 1, 1, '2026-07-31 18:53:43', '2026-08-04 09:28:23'),
(2, 'Doa & Dzikir', 'doa-dzikir', 2, 1, '2026-07-31 18:53:43', '2026-07-31 18:53:43'),
(3, 'Tips Perjalanan', 'tips-perjalanan', 3, 1, '2026-07-31 18:53:43', '2026-07-31 18:53:43'),
(4, 'Berita Umroh', 'berita-umroh', 4, 1, '2026-07-31 18:53:43', '2026-07-31 18:53:43'),
(5, 'Kuliner & Oleh-oleh', 'kuliner-oleh-oleh', 5, 1, '2026-07-31 18:53:43', '2026-07-31 18:53:43'),
(6, 'Seputar Madinah', 'seputar-madinah', 6, 1, '2026-08-07 11:30:54', '2026-08-14 11:12:20'),
(7, 'Seputar Haji', 'seputar-haji', 7, 1, '2026-08-07 11:32:37', '2026-08-14 11:12:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(11) NOT NULL DEFAULT 0,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banners`
--

INSERT INTO `banners` (`id`, `image`, `title`, `subtitle`, `url`, `status`, `sort`, `service_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'banners/habByeocLVPiKiaVy8irEq76j3OvReK3GYomRr6m.webp', NULL, NULL, NULL, 1, 1, NULL, NULL, '2026-07-28 07:33:26', '2026-08-14 13:27:46'),
(5, 'banners/QzCoSEsaUOM69FJiRVUE39cojyVpU5NmQGgkVWAG.webp', NULL, NULL, NULL, 1, 2, NULL, NULL, '2026-08-07 00:46:59', '2026-08-14 11:12:20'),
(6, 'banners/MWn3gaKC0d3EMFqQNy2bLWVopaD3L8wxmcPxi3fp.webp', NULL, NULL, NULL, 1, 3, NULL, NULL, '2026-08-07 00:47:05', '2026-08-14 11:12:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('duyufuna-cache-headerBanners', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:3:{i:0;O:17:\"App\\Models\\Banner\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"banners\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:1;s:5:\"image\";s:53:\"banners/habByeocLVPiKiaVy8irEq76j3OvReK3GYomRr6m.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:1;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-07-28 14:33:26\";s:10:\"updated_at\";s:19:\"2026-08-14 20:27:46\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:1;s:5:\"image\";s:53:\"banners/habByeocLVPiKiaVy8irEq76j3OvReK3GYomRr6m.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:1;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-07-28 14:33:26\";s:10:\"updated_at\";s:19:\"2026-08-14 20:27:46\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:5:\"image\";i:1;s:5:\"title\";i:2;s:8:\"subtitle\";i:3;s:3:\"url\";i:4;s:6:\"status\";i:5;s:4:\"sort\";i:6;s:10:\"service_id\";i:7;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:17:\"App\\Models\\Banner\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"banners\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:5;s:5:\"image\";s:53:\"banners/QzCoSEsaUOM69FJiRVUE39cojyVpU5NmQGgkVWAG.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:2;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-08-07 07:46:59\";s:10:\"updated_at\";s:19:\"2026-08-14 18:12:20\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:5;s:5:\"image\";s:53:\"banners/QzCoSEsaUOM69FJiRVUE39cojyVpU5NmQGgkVWAG.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:2;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-08-07 07:46:59\";s:10:\"updated_at\";s:19:\"2026-08-14 18:12:20\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:5:\"image\";i:1;s:5:\"title\";i:2;s:8:\"subtitle\";i:3;s:3:\"url\";i:4;s:6:\"status\";i:5;s:4:\"sort\";i:6;s:10:\"service_id\";i:7;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:17:\"App\\Models\\Banner\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"banners\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:6;s:5:\"image\";s:53:\"banners/MWn3gaKC0d3EMFqQNy2bLWVopaD3L8wxmcPxi3fp.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:3;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-08-07 07:47:05\";s:10:\"updated_at\";s:19:\"2026-08-14 18:12:20\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:6;s:5:\"image\";s:53:\"banners/MWn3gaKC0d3EMFqQNy2bLWVopaD3L8wxmcPxi3fp.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:3;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-08-07 07:47:05\";s:10:\"updated_at\";s:19:\"2026-08-14 18:12:20\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:5:\"image\";i:1;s:5:\"title\";i:2;s:8:\"subtitle\";i:3;s:3:\"url\";i:4;s:6:\"status\";i:5;s:4:\"sort\";i:6;s:10:\"service_id\";i:7;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1787125168),
('duyufuna-cache-setting', 'O:18:\"App\\Models\\Setting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:89:{s:2:\"id\";i:1;s:4:\"logo\";s:54:\"settings/6LKAECp0CQRlRTwFMAEFWLjpEJzuvHaAHUvxDVEC.webp\";s:7:\"favicon\";s:53:\"settings/JES8f7juDQDiQsMEIM2CUgjwMYvjaNzNApTbdgtX.png\";s:8:\"og_image\";N;s:8:\"og_title\";N;s:14:\"og_description\";N;s:7:\"og_type\";N;s:12:\"og_site_name\";N;s:12:\"twitter_card\";N;s:13:\"twitter_title\";N;s:19:\"twitter_description\";N;s:13:\"twitter_image\";N;s:13:\"canonical_url\";N;s:6:\"robots\";s:13:\"index, follow\";s:24:\"google_site_verification\";N;s:22:\"bing_site_verification\";N;s:19:\"google_analytics_id\";N;s:21:\"google_tag_manager_id\";N;s:14:\"schema_enabled\";i:0;s:8:\"org_name\";N;s:8:\"org_logo\";N;s:9:\"org_phone\";N;s:9:\"org_email\";N;s:11:\"org_address\";N;s:11:\"org_geo_lat\";N;s:11:\"org_geo_lng\";N;s:15:\"sitemap_enabled\";i:1;s:12:\"banner_image\";s:54:\"settings/Nm83LXikUFXN8w9TOEF9s8ubuODNOhMTyzmZHDNM.webp\";s:12:\"banner_badge\";N;s:12:\"banner_title\";N;s:15:\"banner_cta_text\";N;s:14:\"banner_cta_url\";N;s:13:\"hero_subtitle\";s:4:\"Halo\";s:14:\"greeting_image\";s:54:\"settings/aDkXS8czm0NiRg7UBZ7XhbgNkygLpl1g0xDMDrVN.webp\";s:14:\"greeting_title\";s:16:\"Assalamu\'alaikum\";s:17:\"greeting_subtitle\";s:26:\"Selamat datang di Duyufuna\";s:13:\"greeting_text\";s:135:\"Temukan berbagai layanan umroh dan haji untuk menemani perjalanan ibadah Anda dengan lebih mudah, nyaman, dan tenang menuju Tanah Suci.\";s:9:\"why_label\";N;s:9:\"why_title\";N;s:12:\"why_subtitle\";N;s:12:\"about_banner\";s:54:\"settings/6LKAECp0CQRlRTwFMAEFWLjpEJzuvHaAHUvxDVEC.webp\";s:11:\"about_image\";s:54:\"settings/Hb985l3DWV3dUoHMM1cYnavXuErjEStvdzK3KSKW.webp\";s:11:\"about_title\";s:12:\"Tentang Kami\";s:10:\"about_body\";s:1943:\"<p>Duyufuna hadir sebagai penyedia layanan umroh dan haji yang berkomitmen membantu memenuhi berbagai kebutuhan perjalanan jamaah menuju Tanah Suci. Kami memahami bahwa perjalanan ibadah bukan sekadar perjalanan biasa, tetapi sebuah perjalanan yang membutuhkan persiapan, ketelitian, kenyamanan, dan pelayanan yang baik sejak sebelum keberangkatan hingga jamaah kembali ke tanah air.</p>\n<p>Melalui berbagai layanan yang terintegrasi, kami menyediakan kebutuhan pendukung perjalanan seperti pengurusan visa, akomodasi hotel di Mekkah, Madinah, dan Jeddah, transportasi, handling bandara, handling hotel, catering, laundry, serta berbagai kebutuhan lainnya. Setiap layanan disiapkan untuk membantu jamaah maupun penyelenggara perjalanan mendapatkan solusi yang lebih praktis dan terkoordinasi.</p>\n<p>Kami terus berupaya menghadirkan pelayanan yang responsif, fleksibel, dan berorientasi pada kebutuhan jamaah. Dengan memahami bahwa setiap rombongan memiliki kebutuhan yang berbeda, layanan dapat disesuaikan berdasarkan jumlah jamaah, jadwal perjalanan, pilihan akomodasi, serta kebutuhan khusus lainnya.</p>\n<h3>Visi</h3>\n<p>Menjadi penyedia layanan umroh dan haji yang terpercaya dan profesional dalam menghadirkan kemudahan, kenyamanan, serta layanan pendukung perjalanan ibadah yang berkualitas bagi setiap jamaah.</p>\n<h3>Misi</h3>\n<ol>\n<li>Menyediakan berbagai layanan pendukung perjalanan umroh dan haji secara lengkap dan terintegrasi.</li>\n<li>Memberikan pelayanan yang mudah, responsif, dan sesuai dengan kebutuhan jamaah.</li>\n<li>Mengutamakan kenyamanan, ketepatan, dan kualitas dalam setiap layanan.</li>\n<li>Membangun kerja sama yang baik dengan berbagai pihak untuk mendukung kelancaran perjalanan jamaah.</li>\n<li>Terus meningkatkan kualitas layanan dan mengikuti perkembangan kebutuhan perjalanan ibadah.</li>\n<li>Membantu menciptakan perjalanan menuju Tanah Suci yang lebih tertata, nyaman, dan tenang bagi jamaah.</li>\n</ol>\";s:18:\"trust_badge_1_icon\";N;s:18:\"trust_badge_1_text\";N;s:18:\"trust_badge_2_icon\";N;s:18:\"trust_badge_2_text\";N;s:18:\"trust_badge_3_icon\";N;s:18:\"trust_badge_3_text\";N;s:18:\"trust_badge_4_icon\";N;s:18:\"trust_badge_4_text\";N;s:17:\"testimonial_label\";N;s:17:\"testimonial_title\";N;s:20:\"testimonial_subtitle\";N;s:8:\"cta_pill\";N;s:9:\"cta_title\";N;s:12:\"cta_subtitle\";N;s:10:\"cta_button\";N;s:19:\"services_page_title\";N;s:22:\"services_page_subtitle\";N;s:17:\"galeri_page_title\";N;s:20:\"galeri_page_subtitle\";N;s:20:\"testimoni_page_title\";N;s:23:\"testimoni_page_subtitle\";N;s:14:\"faq_page_title\";N;s:17:\"faq_page_subtitle\";N;s:18:\"artikel_page_title\";N;s:21:\"artikel_page_subtitle\";N;s:12:\"website_name\";s:8:\"DUYUFUNA\";s:7:\"tagline\";s:33:\"MELAYANI TAMU ALLAH, SEPENUH HATI\";s:8:\"whatsapp\";s:13:\"6281293679502\";s:10:\"wa_message\";N;s:5:\"email\";s:17:\"info@duyufuna.com\";s:7:\"address\";s:18:\"Jakarta, Indonesia\";s:11:\"footer_text\";s:136:\"<p>Layanan perjalanan umroh dan haji yang membantu setiap langkah perjalanan menuju Tanah Suci dengan mudah, nyaman, dan terpercaya.</p>\";s:22:\"footer_contact_heading\";N;s:20:\"footer_links_heading\";N;s:12:\"footer_links\";N;s:16:\"footer_copyright\";s:16:\"© 2026 DUYUFUNA\";s:9:\"seo_title\";s:42:\"DUYUFUNA - Layanan Umroh & Haji Terpercaya\";s:15:\"seo_description\";s:91:\"Platform layanan umroh, haji, hotel, dan transportasi di tanah suci. Mudah, amanah, berkah.\";s:12:\"seo_keywords\";s:54:\"umroh, haji, travel umroh, hotel mekkah, hotel madinah\";s:16:\"social_instagram\";N;s:15:\"social_facebook\";N;s:14:\"social_youtube\";N;s:13:\"social_tiktok\";N;s:10:\"created_at\";s:19:\"2026-07-28 11:43:27\";s:10:\"updated_at\";s:19:\"2026-08-19 14:17:37\";}s:11:\"\0*\0original\";a:89:{s:2:\"id\";i:1;s:4:\"logo\";s:54:\"settings/6LKAECp0CQRlRTwFMAEFWLjpEJzuvHaAHUvxDVEC.webp\";s:7:\"favicon\";s:53:\"settings/JES8f7juDQDiQsMEIM2CUgjwMYvjaNzNApTbdgtX.png\";s:8:\"og_image\";N;s:8:\"og_title\";N;s:14:\"og_description\";N;s:7:\"og_type\";N;s:12:\"og_site_name\";N;s:12:\"twitter_card\";N;s:13:\"twitter_title\";N;s:19:\"twitter_description\";N;s:13:\"twitter_image\";N;s:13:\"canonical_url\";N;s:6:\"robots\";s:13:\"index, follow\";s:24:\"google_site_verification\";N;s:22:\"bing_site_verification\";N;s:19:\"google_analytics_id\";N;s:21:\"google_tag_manager_id\";N;s:14:\"schema_enabled\";i:0;s:8:\"org_name\";N;s:8:\"org_logo\";N;s:9:\"org_phone\";N;s:9:\"org_email\";N;s:11:\"org_address\";N;s:11:\"org_geo_lat\";N;s:11:\"org_geo_lng\";N;s:15:\"sitemap_enabled\";i:1;s:12:\"banner_image\";s:54:\"settings/Nm83LXikUFXN8w9TOEF9s8ubuODNOhMTyzmZHDNM.webp\";s:12:\"banner_badge\";N;s:12:\"banner_title\";N;s:15:\"banner_cta_text\";N;s:14:\"banner_cta_url\";N;s:13:\"hero_subtitle\";s:4:\"Halo\";s:14:\"greeting_image\";s:54:\"settings/aDkXS8czm0NiRg7UBZ7XhbgNkygLpl1g0xDMDrVN.webp\";s:14:\"greeting_title\";s:16:\"Assalamu\'alaikum\";s:17:\"greeting_subtitle\";s:26:\"Selamat datang di Duyufuna\";s:13:\"greeting_text\";s:135:\"Temukan berbagai layanan umroh dan haji untuk menemani perjalanan ibadah Anda dengan lebih mudah, nyaman, dan tenang menuju Tanah Suci.\";s:9:\"why_label\";N;s:9:\"why_title\";N;s:12:\"why_subtitle\";N;s:12:\"about_banner\";s:54:\"settings/6LKAECp0CQRlRTwFMAEFWLjpEJzuvHaAHUvxDVEC.webp\";s:11:\"about_image\";s:54:\"settings/Hb985l3DWV3dUoHMM1cYnavXuErjEStvdzK3KSKW.webp\";s:11:\"about_title\";s:12:\"Tentang Kami\";s:10:\"about_body\";s:1943:\"<p>Duyufuna hadir sebagai penyedia layanan umroh dan haji yang berkomitmen membantu memenuhi berbagai kebutuhan perjalanan jamaah menuju Tanah Suci. Kami memahami bahwa perjalanan ibadah bukan sekadar perjalanan biasa, tetapi sebuah perjalanan yang membutuhkan persiapan, ketelitian, kenyamanan, dan pelayanan yang baik sejak sebelum keberangkatan hingga jamaah kembali ke tanah air.</p>\n<p>Melalui berbagai layanan yang terintegrasi, kami menyediakan kebutuhan pendukung perjalanan seperti pengurusan visa, akomodasi hotel di Mekkah, Madinah, dan Jeddah, transportasi, handling bandara, handling hotel, catering, laundry, serta berbagai kebutuhan lainnya. Setiap layanan disiapkan untuk membantu jamaah maupun penyelenggara perjalanan mendapatkan solusi yang lebih praktis dan terkoordinasi.</p>\n<p>Kami terus berupaya menghadirkan pelayanan yang responsif, fleksibel, dan berorientasi pada kebutuhan jamaah. Dengan memahami bahwa setiap rombongan memiliki kebutuhan yang berbeda, layanan dapat disesuaikan berdasarkan jumlah jamaah, jadwal perjalanan, pilihan akomodasi, serta kebutuhan khusus lainnya.</p>\n<h3>Visi</h3>\n<p>Menjadi penyedia layanan umroh dan haji yang terpercaya dan profesional dalam menghadirkan kemudahan, kenyamanan, serta layanan pendukung perjalanan ibadah yang berkualitas bagi setiap jamaah.</p>\n<h3>Misi</h3>\n<ol>\n<li>Menyediakan berbagai layanan pendukung perjalanan umroh dan haji secara lengkap dan terintegrasi.</li>\n<li>Memberikan pelayanan yang mudah, responsif, dan sesuai dengan kebutuhan jamaah.</li>\n<li>Mengutamakan kenyamanan, ketepatan, dan kualitas dalam setiap layanan.</li>\n<li>Membangun kerja sama yang baik dengan berbagai pihak untuk mendukung kelancaran perjalanan jamaah.</li>\n<li>Terus meningkatkan kualitas layanan dan mengikuti perkembangan kebutuhan perjalanan ibadah.</li>\n<li>Membantu menciptakan perjalanan menuju Tanah Suci yang lebih tertata, nyaman, dan tenang bagi jamaah.</li>\n</ol>\";s:18:\"trust_badge_1_icon\";N;s:18:\"trust_badge_1_text\";N;s:18:\"trust_badge_2_icon\";N;s:18:\"trust_badge_2_text\";N;s:18:\"trust_badge_3_icon\";N;s:18:\"trust_badge_3_text\";N;s:18:\"trust_badge_4_icon\";N;s:18:\"trust_badge_4_text\";N;s:17:\"testimonial_label\";N;s:17:\"testimonial_title\";N;s:20:\"testimonial_subtitle\";N;s:8:\"cta_pill\";N;s:9:\"cta_title\";N;s:12:\"cta_subtitle\";N;s:10:\"cta_button\";N;s:19:\"services_page_title\";N;s:22:\"services_page_subtitle\";N;s:17:\"galeri_page_title\";N;s:20:\"galeri_page_subtitle\";N;s:20:\"testimoni_page_title\";N;s:23:\"testimoni_page_subtitle\";N;s:14:\"faq_page_title\";N;s:17:\"faq_page_subtitle\";N;s:18:\"artikel_page_title\";N;s:21:\"artikel_page_subtitle\";N;s:12:\"website_name\";s:8:\"DUYUFUNA\";s:7:\"tagline\";s:33:\"MELAYANI TAMU ALLAH, SEPENUH HATI\";s:8:\"whatsapp\";s:13:\"6281293679502\";s:10:\"wa_message\";N;s:5:\"email\";s:17:\"info@duyufuna.com\";s:7:\"address\";s:18:\"Jakarta, Indonesia\";s:11:\"footer_text\";s:136:\"<p>Layanan perjalanan umroh dan haji yang membantu setiap langkah perjalanan menuju Tanah Suci dengan mudah, nyaman, dan terpercaya.</p>\";s:22:\"footer_contact_heading\";N;s:20:\"footer_links_heading\";N;s:12:\"footer_links\";N;s:16:\"footer_copyright\";s:16:\"© 2026 DUYUFUNA\";s:9:\"seo_title\";s:42:\"DUYUFUNA - Layanan Umroh & Haji Terpercaya\";s:15:\"seo_description\";s:91:\"Platform layanan umroh, haji, hotel, dan transportasi di tanah suci. Mudah, amanah, berkah.\";s:12:\"seo_keywords\";s:54:\"umroh, haji, travel umroh, hotel mekkah, hotel madinah\";s:16:\"social_instagram\";N;s:15:\"social_facebook\";N;s:14:\"social_youtube\";N;s:13:\"social_tiktok\";N;s:10:\"created_at\";s:19:\"2026-07-28 11:43:27\";s:10:\"updated_at\";s:19:\"2026-08-19 14:17:37\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:14:\"schema_enabled\";s:7:\"boolean\";s:15:\"sitemap_enabled\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:78:{i:0;s:4:\"logo\";i:1;s:7:\"favicon\";i:2;s:12:\"website_name\";i:3;s:7:\"tagline\";i:4;s:8:\"whatsapp\";i:5;s:5:\"email\";i:6;s:7:\"address\";i:7;s:10:\"wa_message\";i:8;s:12:\"banner_image\";i:9;s:12:\"banner_badge\";i:10;s:12:\"banner_title\";i:11;s:15:\"banner_cta_text\";i:12;s:14:\"banner_cta_url\";i:13;s:14:\"greeting_image\";i:14;s:14:\"greeting_title\";i:15;s:17:\"greeting_subtitle\";i:16;s:13:\"greeting_text\";i:17;s:13:\"hero_subtitle\";i:18;s:12:\"about_banner\";i:19;s:11:\"about_image\";i:20;s:11:\"about_title\";i:21;s:10:\"about_body\";i:22;s:9:\"why_label\";i:23;s:9:\"why_title\";i:24;s:12:\"why_subtitle\";i:25;s:17:\"testimonial_label\";i:26;s:17:\"testimonial_title\";i:27;s:20:\"testimonial_subtitle\";i:28;s:8:\"cta_pill\";i:29;s:9:\"cta_title\";i:30;s:12:\"cta_subtitle\";i:31;s:10:\"cta_button\";i:32;s:19:\"services_page_title\";i:33;s:22:\"services_page_subtitle\";i:34;s:17:\"galeri_page_title\";i:35;s:20:\"galeri_page_subtitle\";i:36;s:20:\"testimoni_page_title\";i:37;s:23:\"testimoni_page_subtitle\";i:38;s:14:\"faq_page_title\";i:39;s:17:\"faq_page_subtitle\";i:40;s:18:\"artikel_page_title\";i:41;s:21:\"artikel_page_subtitle\";i:42;s:11:\"footer_text\";i:43;s:22:\"footer_contact_heading\";i:44;s:20:\"footer_links_heading\";i:45;s:12:\"footer_links\";i:46;s:16:\"footer_copyright\";i:47;s:8:\"og_image\";i:48;s:8:\"og_title\";i:49;s:14:\"og_description\";i:50;s:7:\"og_type\";i:51;s:12:\"og_site_name\";i:52;s:12:\"twitter_card\";i:53;s:13:\"twitter_title\";i:54;s:19:\"twitter_description\";i:55;s:13:\"twitter_image\";i:56;s:13:\"canonical_url\";i:57;s:6:\"robots\";i:58;s:24:\"google_site_verification\";i:59;s:22:\"bing_site_verification\";i:60;s:19:\"google_analytics_id\";i:61;s:21:\"google_tag_manager_id\";i:62;s:14:\"schema_enabled\";i:63;s:8:\"org_name\";i:64;s:8:\"org_logo\";i:65;s:9:\"org_phone\";i:66;s:9:\"org_email\";i:67;s:11:\"org_address\";i:68;s:11:\"org_geo_lat\";i:69;s:11:\"org_geo_lng\";i:70;s:15:\"sitemap_enabled\";i:71;s:9:\"seo_title\";i:72;s:15:\"seo_description\";i:73;s:12:\"seo_keywords\";i:74;s:16:\"social_instagram\";i:75;s:15:\"social_facebook\";i:76;s:14:\"social_youtube\";i:77;s:13:\"social_tiktok\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1787127586);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `wa_message` text DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `is_catalog` tinyint(1) NOT NULL DEFAULT 0,
  `page_type` varchar(20) NOT NULL DEFAULT 'cards',
  `group_label` varchar(255) DEFAULT NULL,
  `item_label` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `subtitle`, `whatsapp`, `wa_message`, `sort`, `is_catalog`, `page_type`, `group_label`, `item_label`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'Hotel', 'hotel', '🏨', 'Akomodasi terbaik', NULL, NULL, 1, 1, 'catalog', 'Kota', 'Hotel', 'Pilihan hotel terbaik di Mekkah, Madinah, dan Jeddah untuk kenyamanan ibadah Anda.', 'Hotel Umroh Mekkah Madinah Jeddah', 'Pilih hotel terbaik di area Masjidil Haram, Masjid Nabawi, dan Jeddah untuk perjalanan umroh Anda.', 'hotel umroh, hotel mekkah, hotel madinah, hotel jeddah', '2026-07-28 05:53:02', '2026-08-19 06:55:07'),
(2, 'Visa', 'visa', '📋', 'Proses cepat & aman', NULL, NULL, 2, 1, 'catalog', 'Jenis', 'Visa', 'Pengurusan visa umroh yang cepat, aman, dan terpercaya.', 'Visa Umroh', 'Pengurusan visa umroh cepat dan terpercaya.', 'visa umroh, paspor umroh, syarat visa', '2026-07-28 05:53:02', '2026-08-19 06:55:07'),
(3, 'Transportasi', 'transportasi', '🚐', 'Nyaman & terpercaya', NULL, NULL, 3, 0, 'transport', NULL, NULL, 'Armada transportasi nyaman untuk seluruh rute perjalanan umroh Anda.', 'Transportasi Umroh', 'Sewa transportasi umroh dengan armada nyaman dan terpercaya.', 'transportasi umroh, sewa bus umroh, travel umroh', '2026-07-28 05:53:02', '2026-08-19 06:55:07'),
(4, 'Handling Bandara', 'handling-bandara', '✈️', 'Layanan profesional', NULL, NULL, 4, 0, 'cards', NULL, NULL, 'Layanan handling bandara kedatangan dan kepulangan yang profesional.', 'Handling Bandara Umroh', 'Layanan handling bandara kedatangan dan kepulangan untuk jamaah umroh.', 'handling bandara, portir umroh, jemput bandara', '2026-07-28 05:53:02', '2026-08-19 06:55:07'),
(5, 'Handling Hotel', 'handling-hotel', '🛎️', 'Check-in mudah', NULL, NULL, 5, 0, 'cards', NULL, NULL, 'Layanan handling hotel check-in dan check-out agar perjalanan Anda lebih praktis.', 'Handling Hotel Umroh', 'Layanan handling hotel check-in dan check-out untuk jamaah umroh.', 'handling hotel, check in umroh, check out umroh', '2026-07-28 05:53:02', '2026-08-19 06:55:08'),
(7, 'Laundry', 'laundry', '👕', 'Bersih & wangi', NULL, NULL, 7, 0, 'form', NULL, NULL, 'Layanan laundry cepat, bersih, dan wangi selama di Tanah Suci.', 'Laundry Umroh', 'Layanan laundry untuk jamaah umroh dengan hasil bersih dan wangi.', 'laundry umroh, laundry mekkah, laundry madinah', '2026-07-28 05:53:02', '2026-08-19 06:55:08'),
(8, 'Buggy Car', 'buggy-car', '🚗', 'Fleksibel & nyaman', NULL, NULL, 8, 0, 'form', NULL, NULL, 'Layanan buggy car untuk mobilitas jamaah di sekitar Masjidil Haram.', 'Buggy Car Umroh', 'Sewa buggy car untuk mobilitas jamaah di area Masjidil Haram.', 'buggy car umroh, buggy mekkah', '2026-07-28 05:53:02', '2026-08-19 06:55:08'),
(9, 'Jastip Viral', 'jastip-viral', '🛍️', 'Oleh-oleh kekinian', NULL, NULL, 9, 1, 'catalog', 'Produk', 'Produk', 'Titip beli oleh-oleh viral dan kekinian dari Tanah Suci.', 'Jastip Viral Tanah Suci', 'Jastip oleh-oleh viral dan kekinian dari Tanah Suci.', 'jastip viral, jastip mekkah, oleh oleh umroh', '2026-07-28 05:53:02', '2026-08-19 06:55:08'),
(11, 'Fotografer', 'fotografer', '📸', 'Fasilitas Grup', NULL, NULL, 11, 0, 'form', NULL, NULL, 'Fotografer profesional untuk mendokumentasikan momen ibadah Anda.', 'Fotografer Umroh', 'Fotografer profesional untuk dokumentasi kegiatan umroh Anda.', 'fotografer umroh, foto umroh', '2026-07-28 05:53:02', '2026-08-19 06:55:08'),
(12, 'Penukaran Uang', 'penukaran-uang', '💵', 'Rate terbaik', NULL, NULL, 12, 0, 'form', NULL, NULL, 'Penukaran uang dengan kurs terbaik dan terpercaya.', 'Penukaran Uang Umroh', 'Penukaran uang Riyal dengan kurs terbaik dan terpercaya.', 'penukaran uang, money changer umroh', '2026-07-28 05:53:02', '2026-08-19 06:55:08'),
(14, 'Catering', 'catering', '🍽️', NULL, NULL, NULL, 6, 1, 'catalog', 'Paket', 'Paket', '<p>Catering halal berkualitas untuk kedatangan dan kepulangan jamaah.</p>', 'Catering Umroh', 'Catering halal untuk kedatangan dan kepulangan jamaah umroh dengan menu pilihan.', 'catering umroh, paket makan, katering bandara', '2026-07-29 05:22:43', '2026-08-14 06:49:45'),
(15, 'Kursi Roda Umroh', 'kursi-roda-umroh', '♿', 'Layanan khusus', NULL, NULL, 10, 0, 'form', NULL, NULL, 'Sewa kursi roda untuk jamaah lansia dan berkebutuhan khusus.', 'Sewa Kursi Roda Umroh', 'Sewa kursi roda untuk jamaah umroh lansia dan berkebutuhan khusus.', 'kursi roda umroh, sewa kursi roda mekkah', '2026-07-29 05:22:43', '2026-08-19 06:55:08'),
(16, 'Muthawif', 'muthawif', '🕋', 'Pembimbing ibadah', NULL, NULL, 13, 0, 'form', NULL, NULL, 'Muthawif berpengalaman sebagai pembimbing ibadah selama di Tanah Suci.', 'Muthawif Umroh', 'Muthawif berpengalaman sebagai pembimbing ibadah jamaah umroh.', 'muthawif, pembimbing ibadah umroh', '2026-07-31 18:53:43', '2026-08-19 06:55:08'),
(40, 'Catering', 'catering-bandara', '🍽️', 'Menu berkualitas', NULL, NULL, 6, 0, 'cards', NULL, NULL, 'Catering halal berkualitas untuk kedatangan dan kepulangan jamaah.', 'Catering Umroh', 'Catering halal untuk kedatangan dan kepulangan jamaah umroh dengan menu pilihan.', 'catering umroh, paket makan, katering bandara', '2026-08-19 06:55:08', '2026-08-19 06:55:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'baru',
  `sumber` varchar(255) DEFAULT NULL,
  `layanan` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `counts` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer_status_histories`
--

CREATE TABLE `customer_status_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Apa saja layanan yang disediakan Duyufuna?', '<p>Duyufuna menyediakan berbagai kebutuhan perjalanan ibadah umroh dan haji, mulai dari akomodasi hotel di Mekkah, Madinah, dan Jeddah, transportasi, visa, handling bandara, catering, laundry, hingga berbagai layanan pendukung jamaah selama berada di Tanah Suci.</p>', 1, 1, '2026-08-07 11:43:13', '2026-08-14 11:12:20'),
(6, 'Apakah Duyufuna melayani jamaah individu dan rombongan?`', '<p>Ya. Layanan Duyufuna dapat disesuaikan untuk jamaah individu, keluarga, maupun rombongan dalam jumlah besar. Kebutuhan akomodasi, transportasi, dan layanan lainnya dapat disesuaikan dengan itinerary dan kebutuhan perjalanan</p>', 2, 1, '2026-08-07 11:43:37', '2026-08-14 11:12:20'),
(7, 'Apakah Duyufuna melayani jamaah umroh dan haji?', '<p>Duyufuna menyediakan layanan yang mendukung perjalanan umroh maupun haji. Jenis layanan dan ketersediaannya dapat disesuaikan dengan periode perjalanan serta ketentuan yang berlaku.</p>', 3, 1, '2026-08-07 11:45:58', '2026-08-14 11:12:20'),
(8, 'Apakah transportasi dapat disediakan untuk rombongan besar?', '<p>Bisa. Armada dan jenis kendaraan dapat disesuaikan dengan jumlah jamaah serta rute perjalanan yang dibutuhkan.</p>', 4, 1, '2026-08-07 11:47:14', '2026-08-14 11:12:20'),
(10, 'Apakah paket DUYFUNA sudah termasuk visa dan hotel?', 'Ya, semua paket sudah mencakup visa, hotel, dan transportas i. Anda bisa menyesuaikan layanan sesuai kebutuhan.', 1, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:08'),
(11, 'Berapa lama proses pendaftaran dan visa?', 'Proses umumnya memakan waktu 2-5 minggu tergantung ketersediaan jadwal dan kelengkapan dokumen.', 2, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:08'),
(12, 'Apakah ada layanan khusus untuk jamaah lansia?', 'Tersedia layanan kursi roda umroh dan pendampingan khusus agar jamaah lansia tetap nyaman beribadah.', 3, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:09'),
(13, 'Bagaimana cara menghubungi customer service?', 'CS kami siap membantu 24 jam melalui WhatsApp. Klik tombol konsultasi gratis di halaman utama.', 4, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(10, 'Suasana Jamaah di Masjidil Haram - Mekkah', NULL, 'galleries/TrUlqlamR5ygOqK8pPoAk6ZOXJY68Y5464siasol.jpeg', '2026-08-07 10:27:46', '2026-08-07 10:28:13'),
(11, 'Jamaah di Masjid Nabawi - Madinah', NULL, 'galleries/lzLJYxJv9xmqpScSOedKFeyaQ8HMQHM32FdX2g6h.jpg', '2026-08-07 10:28:51', '2026-08-07 10:28:51'),
(12, 'Jamaah Melaksanakan Tawaf', NULL, 'galleries/pIHZfQFpKyHoSJ2eruDGCFFHtXDnql2hj2IrcuD3.jpeg', '2026-08-07 10:29:34', '2026-08-07 10:29:34'),
(13, 'Jamaah di Arafah - Haji', NULL, 'galleries/7yK00hWFFwzzoQJXyxaQMXtXgv3ZYJIJcPZmjzHm.jpg', '2026-08-07 10:30:27', '2026-08-07 10:30:27'),
(14, 'Jamaah Tiba di Jeddah', NULL, 'galleries/Cdzycq0UehRLfgkFnWR5x3bZYS3JfkzSUDM3xTWO.jpeg', '2026-08-07 10:31:05', '2026-08-07 10:31:05'),
(15, 'Jamaah di Pelataran Masjid Nabawi', NULL, 'galleries/g7N3SehFq2G6NUOKLBgXISuDkTJebHK4xQG9X4zb.jpeg', '2026-08-07 10:31:41', '2026-08-07 10:31:41'),
(16, 'Suasana Jamaah Haji di Mina', NULL, 'galleries/t1T7n5B3EBi2cMhT3JlTu6NISMu5V1nZYnCipkZJ.jpeg', '2026-08-07 10:32:12', '2026-08-07 10:32:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_28_112753_create_banners_table', 1),
(5, '2026_07_28_112756_create_categories_table', 1),
(6, '2026_07_28_112758_create_services_table', 1),
(7, '2026_07_28_112800_create_bookings_table', 1),
(8, '2026_07_28_112803_create_faqs_table', 1),
(9, '2026_07_28_112805_create_testimonials_table', 1),
(10, '2026_07_28_112807_create_galleries_table', 1),
(11, '2026_07_28_112809_create_settings_table', 1),
(12, '2026_07_28_112915_add_admin_fields_to_users_table', 1),
(13, '2026_07_28_120034_add_fields_to_settings_table', 2),
(14, '2026_07_28_120036_add_fields_to_services_table', 2),
(15, '2026_07_28_120039_add_fields_to_bookings_table', 2),
(16, '2026_07_28_120041_create_articles_table', 2),
(17, '2026_07_28_122237_add_status_to_testimonials_table', 3),
(18, '2026_07_28_125221_add_subtitle_to_categories_table', 4),
(19, '2026_07_28_145822_create_notifications_table', 5),
(20, '2026_07_28_154110_add_role_to_users_table', 6),
(21, '2026_07_29_000001_create_contact_messages_table', 7),
(22, '2026_07_29_000002_create_customers_table', 8),
(23, '2026_07_30_050902_add_address_to_bookings_table', 9),
(24, '2026_07_30_050902_add_layout_to_categories_table', 9),
(25, '2026_07_30_050902_add_service_id_to_banners_table', 9),
(26, '2026_07_30_052537_make_city_and_total_people_nullable_in_bookings', 10),
(27, '2026_07_30_053058_make_title_nullable_in_banners', 11),
(28, '2026_07_30_060000_add_service_id_and_message_to_customers', 12),
(29, '2026_07_30_060100_add_category_id_to_banners', 12),
(30, '2026_07_30_060200_drop_bookings_table', 12),
(31, '2026_08_01_014126_create_article_categories_table', 13),
(32, '2026_08_01_014129_add_category_and_seo_fields_to_articles_table', 13),
(33, '2026_08_01_014131_create_traffics_table', 13),
(34, '2026_08_01_014134_create_service_items_table', 13),
(35, '2026_08_01_014136_add_lead_fields_to_customers_table', 13),
(36, '2026_08_01_014138_add_seo_and_description_fields_to_categories_table', 13),
(37, '2026_08_01_014140_add_seo_fields_to_services_table', 13),
(38, '2026_08_01_020000_drop_price_from_service_items_table', 14),
(39, '2026_08_01_030000_add_description_to_galleries_table', 15),
(40, '2026_08_02_010000_add_about_fields_to_settings_table', 16),
(41, '2026_08_02_020000_simplify_customers_table', 17),
(42, '2026_08_02_030000_add_status_to_customers_table', 18),
(43, '2026_08_02_040000_create_customer_status_histories_table', 19),
(44, '2026_08_02_040100_add_sumber_to_customers_table', 19),
(45, '2026_08_03_010000_add_detail_fields_to_traffics_table', 20),
(46, '2026_08_03_000001_add_wa_message_to_settings_table', 21),
(47, '2026_08_03_000002_add_wa_message_to_services_table', 21),
(48, '2026_08_03_020000_drop_title_from_banners_table', 22),
(49, '2026_08_03_030000_drop_subtitle_from_banners_table', 23),
(50, '2026_08_04_000000_add_about_image_to_settings_table', 24),
(51, '2026_08_04_120000_add_frontend_content_settings_to_settings_table', 25),
(52, '2026_08_04_130000_add_seo_settings_to_settings_table', 26),
(53, '2026_08_04_140000_add_status_to_faqs_table', 27),
(54, '2026_08_04_150000_drop_layout_from_categories_table', 28),
(55, '2026_08_04_160000_add_title_and_subtitle_to_banners_table', 29),
(57, '2026_08_05_000000_add_catalog_fields_to_categories_table', 30),
(58, '2026_08_06_105536_add_counts_to_customers_table', 31),
(59, '2026_08_06_120000_add_avatar_to_users_table', 32),
(60, '2026_08_06_130000_add_greeting_subtitle_to_settings_table', 33),
(61, '2026_08_07_202420_set_visa_catalog', 34),
(62, '2026_08_07_220000_add_whatsapp_to_service_items_table', 35),
(63, '2026_08_07_223000_set_transportasi_non_catalog', 36),
(64, '2026_08_08_003054_delete_fotografer_services', 37),
(65, '2026_08_08_110000_seed_jastip_viral_catalog', 38),
(66, '2026_08_09_100000_remove_old_whatsapp_placeholder', 39),
(67, '2026_08_14_150000_add_sort_to_banners_table', 40),
(68, '2026_08_14_160000_add_wa_fields_to_categories_table', 41),
(69, '2026_08_15_000000_add_item_to_traffics_table', 42),
(70, '2026_08_15_000001_add_layanan_item_to_customers_table', 42),
(71, '2026_08_16_000000_add_page_type_to_categories_table', 43);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `requirement` text DEFAULT NULL,
  `information` text DEFAULT NULL,
  `benefit` text DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `wa_message` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `category_id`, `title`, `slug`, `image`, `short_description`, `description`, `requirement`, `information`, `benefit`, `price`, `duration`, `icon`, `meta_title`, `meta_description`, `meta_keywords`, `whatsapp`, `wa_message`, `status`, `created_at`, `updated_at`) VALUES
(97, 14, 'Kedatangan', 'kedatangan-2', 'services/kedatangan-ChY2Wi.jpg', 'Catering saat kedatangan bandara', '<p>Layanan catering kedatangan disiapkan untuk memberikan konsumsi kepada jamaah setelah menyelesaikan perjalanan ibadah. Makanan dikemas secara praktis sehingga mudah dibagikan kepada jamaah di titik kedatangan, area penjemputan, maupun lokasi yang telah ditentukan. Menu dapat disesuaikan dengan kebutuhan dan jumlah jamaah.</p>', NULL, NULL, NULL, NULL, NULL, '🛬', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-05 03:03:36', '2026-08-19 06:55:10'),
(98, 14, 'Kepulangan', 'kepulangan-2', 'services/kepulangan-vvUFDk.jpg', 'Konsumsi praktis untuk menemani jamaah sebelum melanjutkan perjalanan menuju Tanah Suci.', '<p>Layanan catering kepulangan disiapkan untuk memenuhi kebutuhan konsumsi jamaah sebelum atau selama perjalanan menuju bandara. Menu dikemas secara praktis dan mudah dibawa sehingga jamaah tetap dapat menikmati makanan tanpa mengganggu proses persiapan keberangkatan. Penyediaan makanan dapat disesuaikan dengan jadwal penerbangan, jumlah jamaah, dan kebutuhan rombongan.</p>', NULL, NULL, NULL, NULL, NULL, '🛫', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-05 03:03:36', '2026-08-19 06:55:10'),
(131, 1, 'Mekkah', 'hotel-mekkah', 'services/mekkah-df2CGY.jpg', 'Rekomendasi hotel untuk jamaah umroh di area Masjidil Haram', NULL, NULL, NULL, NULL, NULL, NULL, '🏨', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:07', '2026-08-19 06:55:15'),
(132, 1, 'Madinah', 'hotel-madinah', 'services/madinah-WMy1Lv.jpg', 'Rekomendasi hotel untuk jamaah umroh di area Masjid Nabawi', NULL, NULL, NULL, NULL, NULL, NULL, '🕌', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:07', '2026-08-19 06:55:15'),
(133, 1, 'Jeddah', 'hotel-jeddah', 'services/jeddah-qVy0dW.jpg', 'Rekomendasi hotel transit untuk jamaah umroh di Jeddah', NULL, NULL, NULL, NULL, NULL, NULL, '🌆', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:07', '2026-08-19 06:55:15'),
(134, 2, 'Visa Umroh', 'visa-umroh', 'services/visa-umroh-M8lmGA.jpg', 'Pengurusan visa umroh cepat & terpercaya', NULL, NULL, NULL, NULL, NULL, NULL, '📋', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:07', '2026-08-19 06:55:15'),
(135, 3, 'Bus Shalawat', 'transportasi-bus-shalawat', 'services/bus-shalawat-qY8pcY.jpg', 'Bus antar-jemput dari hotel ke Masjidil Haram', NULL, NULL, NULL, NULL, 150000.00, NULL, '🚌', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:07', '2026-08-19 06:55:15'),
(136, 3, 'Sewa Bus 24 Jam', 'transportasi-bus-24jam', 'services/sewa-bus-24-jam-qU7Xuc.jpg', 'Sewa bus khusus untuk kebutuhan perjalanan grup', NULL, NULL, NULL, NULL, 3500000.00, NULL, '🚌', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:07', '2026-08-19 06:55:15'),
(137, 3, 'Toyota Hiace', 'transportasi-hiace', 'services/toyota-hiace-8bGzmI.jpg', 'Mobil Hiace untuk perjalanan keluarga / grup kecil', NULL, NULL, NULL, NULL, 1800000.00, NULL, '🚐', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:07', '2026-08-19 06:55:15'),
(138, 4, 'Kedatangan', 'handling-bandara-datang', 'services/kedatangan-XNmZno.jpg', 'Layanan penyambutan & handling saat kedatangan', NULL, NULL, NULL, NULL, NULL, NULL, '🛬', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:16'),
(139, 4, 'Kepulangan', 'handling-bandara-pulang', 'services/kepulangan-EBaGDZ.jpg', 'Layanan handling saat kepulangan', NULL, NULL, NULL, NULL, NULL, NULL, '🛫', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:16'),
(140, 5, 'Check In', 'handling-hotel-check-in', 'services/check-in-p80xFZ.jpg', 'Handling check-in hotel, kunci & proses kamar diuruskan', NULL, NULL, NULL, NULL, NULL, NULL, '🔑', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:16'),
(141, 5, 'Check Out', 'handling-hotel-check-out', 'services/check-out-SBXWVb.jpg', 'Handling check-out hotel, bagasi & proses diuruskan', NULL, NULL, NULL, NULL, NULL, NULL, '🧳', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:16'),
(142, 40, 'Kedatangan', 'catering-bandara-datang', 'services/kedatangan-hXcVWa.jpg', 'Catering saat kedatangan bandara', NULL, NULL, NULL, NULL, NULL, NULL, '🛬', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:18'),
(143, 40, 'Kepulangan', 'catering-bandara-pulang', 'services/kepulangan-cm77fB.jpg', 'Catering saat kepulangan bandara', NULL, NULL, NULL, NULL, NULL, NULL, '🛫', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:18'),
(144, 7, 'Laundry Kilat', 'laundry-kilat', 'services/laundry-kilat-pVgSb7.jpg', 'Layanan laundry kilat, bersih & wangi', NULL, NULL, NULL, NULL, 50000.00, NULL, '👕', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:18'),
(145, 8, 'Buggy Car Area Haram', 'buggy-car-haram', 'services/buggy-car-area-haram-lTmG8V.jpg', 'Antar-jemput buggy di sekitar Masjidil Haram', NULL, NULL, NULL, NULL, 75000.00, NULL, '🚗', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:18'),
(146, 9, 'Tumbler Tanah Suci', 'jastip-tumbler', 'services/tumbler-tanah-suci-wzU768.jpg', 'Tumbler eksklusif oleh-oleh umroh', NULL, NULL, NULL, NULL, 85000.00, NULL, '🥤', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:18'),
(147, 9, 'Parfum Timur Tengah', 'jastip-parfum', 'services/parfum-timur-tengah-N0w9pf.jpg', 'Parfum khas Timur Tengah berkualitas', NULL, NULL, NULL, NULL, 150000.00, NULL, '🧴', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:18'),
(148, 9, 'Kurma Sukari', 'jastip-kurma-sukari', 'services/kurma-sukari-7X8LqE.jpg', 'Kurma Sukari premium asli Madinah', NULL, NULL, NULL, NULL, 120000.00, NULL, '🌴', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:18'),
(149, 9, 'Tasbih Kayu', 'jastip-tasbih', 'services/tasbih-kayu-q7kBeO.jpg', 'Tasbih kayu unik dan ringan', NULL, NULL, NULL, NULL, 45000.00, NULL, '📿', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:23'),
(150, 15, 'Sewa Kursi Roda', 'kursi-roda-sewa', 'services/sewa-kursi-roda-gdChd1.jpg', 'Sewa kursi roda untuk jamaah lansia / berkebutuhan khusus', NULL, NULL, NULL, NULL, 100000.00, NULL, '♿', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:23'),
(151, 11, 'Semua Jenis Kegiatan', 'foto-semua-kegiatan', 'services/semua-jenis-kegiatan-XuSxhr.jpg', 'Dokumentasi semua kegiatan ibadah', NULL, NULL, NULL, NULL, 300000.00, NULL, '📸', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:23'),
(152, 11, 'Khandamah & Kudai', 'foto-khandamah', 'services/khandamah-kudai-MvCv6A.jpg', 'Sesi foto di area Khandamah & Kudai', NULL, NULL, NULL, NULL, 300000.00, NULL, '📸', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:23'),
(153, 11, 'Pelataran', 'foto-pelataran', 'services/pelataran-A7YO4H.jpg', 'Sesi foto di pelataran Masjidil Haram', NULL, NULL, NULL, NULL, 300000.00, NULL, '📸', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:23'),
(154, 12, 'Penukaran Riyal', 'penukaran-riyal', 'services/penukaran-riyal-I5D7bB.jpg', 'Penukaran uang Riyal Saudi dengan rate terbaik', NULL, NULL, NULL, NULL, NULL, NULL, '💵', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:24'),
(155, 16, 'Muthawif Per Hari', 'muthawif-per-hari', 'services/muthawif-per-hari-pLAipn.jpg', 'Pembimbing ibadah muthawif selama di Tanah Suci', NULL, NULL, NULL, NULL, 250000.00, NULL, '🕋', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service_items`
--

CREATE TABLE `service_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `whatsapp` varchar(20) DEFAULT NULL,
  `wa_message` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `service_items`
--

INSERT INTO `service_items` (`id`, `service_id`, `title`, `image`, `description`, `sort`, `whatsapp`, `wa_message`, `status`, `created_at`, `updated_at`) VALUES
(136, 97, 'Nasi Box', 'service-items/kedatangan-nasi-box-wysLB1.jpg', '<p>Paket makanan lengkap dalam kemasan praktis yang terdiri dari nasi, lauk, sayuran, dan pelengkap. Cocok untuk konsumsi jamaah setelah tiba di Indonesia.</p>', 1, NULL, NULL, 1, '2026-08-05 03:03:37', '2026-08-19 06:55:28'),
(137, 97, 'Snack Box', 'service-items/kedatangan-snack-box-DIBvJY.jpg', '<p>Paket makanan ringan yang berisi pilihan kue, makanan ringan, dan minuman. Praktis untuk diberikan kepada jamaah sebagai makanan pendamping setelah perjalanan panjang.</p>', 2, NULL, NULL, 1, '2026-08-05 03:03:37', '2026-08-19 06:55:28'),
(139, 98, 'Nasi Box Perjalanan', 'service-items/kepulangan-nasi-box-perjalanan-EHqzIp.jpg', '<p>Paket makanan lengkap yang dikemas praktis untuk dibawa selama perjalanan menuju bandara atau titik keberangkatan.</p>', 1, NULL, NULL, 1, '2026-08-05 03:03:37', '2026-08-19 06:55:28'),
(140, 98, 'Snack Perjalanan', 'service-items/kepulangan-snack-perjalanan-XZb1HF.jpg', '<p>Paket makanan ringan yang praktis dibawa dan dikonsumsi jamaah selama perjalanan menuju bandara maupun saat menunggu keberangkatan.</p>', 2, NULL, NULL, 1, '2026-08-05 03:03:37', '2026-08-19 06:55:28'),
(214, 131, 'Swissôtel Al Maqam', 'service-items/mekkah-swissotel-al-maqam-KB0Bao.jpg', '<p>Hotel bintang 5 dengan akses langsung ke area Masjidil Haram. Kamar nyaman dengan pemandangan Ka\\u0027bah dan fasilitas lengkap untuk jamaah.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:28'),
(215, 131, 'Pullman ZamZam', 'service-items/mekkah-pullman-zamzam-aaITeD.jpg', '<p>Hotel bintang 5 menghadap Masjidil Haram, hanya beberapa langkah dari gerbang utama. Dilengkapi restoran halal dan layanan 24 jam.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:28'),
(216, 131, 'Anjum Hotel', 'service-items/mekkah-anjum-hotel-FzvBK1.jpg', '<p>Hotel bintang 5 di jantung Mekkah dengan pemandangan Masjidil Haram dari lantai atas, fasilitas rooftop dan akses mudah ke area tawaf.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:29'),
(217, 132, 'Madinah Hilton', 'service-items/madinah-madinah-hilton-wgGb3l.jpg', '<p>Hotel bintang 5 berhadapan langsung dengan Masjid Nabawi. Lokasi strategis dengan pemandangan Raudhah dan layanan kamar prima.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:30'),
(218, 132, 'Mövenpick Anwar Al Madinah', 'service-items/madinah-movenpick-anwar-al-madinah-eXOYga.jpg', '<p>Hotel bintang 5 di seberang Masjid Nabawi, setiap kamar menghadap ke kompleks masjid. Berdekatan dengan area ziarah utama.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:30'),
(219, 132, 'Dar Al Taqwa', 'service-items/madinah-dar-al-taqwa-YfXqrr.jpg', '<p>Hotel bintang 5 berada tepat di halaman Masjid Nabawi, akses paling mudah untuk menunaikan shalat berjamaah dan ziarah.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:30'),
(220, 133, 'Rosewood Jeddah', 'service-items/jeddah-rosewood-jeddah-pGxeOq.jpg', '<p>Hotel mewah di tepi Laut Merah Jeddah, nyaman untuk transit sebelum melanjutkan perjalanan ke Makkah atau Madinah.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:30'),
(221, 133, 'Radisson Blu Jeddah', 'service-items/jeddah-radisson-blu-jeddah-xa25RP.jpg', '<p>Hotel bintang 5 dekat Corniche Jeddah dengan fasilitas spa, kolam renang, dan restoran internasional untuk kenyamanan transit.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:30'),
(222, 133, 'Novotel Jeddah', 'service-items/jeddah-novotel-jeddah-zAkjp9.jpg', '<p>Hotel bintang 4 modern dengan harga terjangkau, cocok untuk transit singkat dengan fasilitas lengkap dan lokasi strategis.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:30'),
(223, 135, 'Shalawat Pagi', 'service-items/bus-shalawat-shalawat-pagi-TeSHzE.jpg', '<p>Antar-jemput bus dari hotel ke Masjidil Haram setiap pagi dengan armada nyaman dan berpendingin.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:32'),
(224, 135, 'Shalawat Malam', 'service-items/bus-shalawat-shalawat-malam-dCtypN.jpg', '<p>Layanan bus antar-jemput pada waktu shalat malam, memudahkan jamaah menjangkau Masjidil Haram dengan aman.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:32'),
(225, 135, 'Shalawat Harian', 'service-items/bus-shalawat-shalawat-harian-dmxKAy.jpg', '<p>Paket antar-jemput sepanjang hari untuk jamaah dengan mobilitas terbatas, jadwal fleksibel sesuai kebutuhan grup.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:33'),
(226, 136, 'Sewa Bus Grup 24 Jam', 'service-items/sewa-bus-24-jam-sewa-bus-grup-24-jam-8PiQfF.jpg', '<p>Sewa bus ekslusif 24 jam untuk kebutuhan perjalanan grup, ziarah, dan perpindahan antar kota dengan armada bersih dan berpengalaman.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:33'),
(227, 137, 'Sewa Hiace Keluarga', 'service-items/toyota-hiace-sewa-hiace-keluarga-DCnocd.jpg', '<p>Sewa Toyota Hiace untuk perjalanan keluarga atau grup kecil, sopir berpengalaman untuk rute dalam kota maupun antar kota.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:33'),
(228, 142, 'Paket Nasi Ayam Kabsah', 'service-items/kedatangan-paket-nasi-ayam-kabsah-WGomFQ.jpg', '<p>Nasi kabsah dengan ayam khas Timur Tengah, disajikan hangat saat kedatangan jamaah di bandara.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:09', '2026-08-19 06:55:34'),
(229, 142, 'Paket Nasi Kebuli', 'service-items/kedatangan-paket-nasi-kebuli-j9UajP.jpg', '<p>Nasi kebuli gurih dengan daging pilihan, hidangan pembuka yang mengenyangkan untuk jamaah yang baru tiba.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:34'),
(230, 142, 'Paket Snack Box', 'service-items/kedatangan-paket-snack-box-sRGKFO.jpg', '<p>Snack box praktis berisi roti, buah, dan minuman untuk jamaah dalam perjalanan.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:34'),
(231, 143, 'Paket Nasi Ayam Kabsah', 'service-items/kepulangan-paket-nasi-ayam-kabsah-Ht9xdD.jpg', '<p>Nasi kabsah dengan ayam khas Timur Tengah untuk bekal jamaah sebelum penerbangan pulang.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:34'),
(232, 143, 'Paket Nasi Mandhi', 'service-items/kepulangan-paket-nasi-mandhi-BytwsZ.jpg', '<p>Nasi mandhi dengan daging yang mengenyangkan, pilihan tepat sebagai bekal kepulangan jamaah.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:34'),
(233, 143, 'Paket Snack Box', 'service-items/kepulangan-paket-snack-box-eE4yqA.jpg', '<p>Snack box ringan dan higienis untuk perjalanan pulang jamaah umroh.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:34'),
(234, 146, 'Tumbler 350ml', 'service-items/tumbler-tanah-suci-tumbler-350ml-MbicP7.jpg', '<p>Botol minum eksklusif oleh-oleh Tanah Suci, ukuran pas dan desain khas.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:35'),
(235, 146, 'Tumbler 750ml', 'service-items/tumbler-tanah-suci-tumbler-750ml-JUVNDO.jpg', '<p>Botol minum besar dengan desain unik, cocok untuk menemani perjalanan ibadah.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:35'),
(236, 146, 'Tumbler Stainless', 'service-items/tumbler-tanah-suci-tumbler-stainless-KeGZmC.jpg', '<p>Tumbler tahan panas berbahan stainless steel, awet dan kekinian.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:35'),
(237, 147, 'Parfum 50ml', 'service-items/parfum-timur-tengah-parfum-50ml-THllpO.jpg', '<p>Parfum khas Timur Tengah dengan aroma tahan lama, ukuran 50ml.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:36'),
(238, 147, 'Parfum 100ml', 'service-items/parfum-timur-tengah-parfum-100ml-o7jRCA.jpg', '<p>Parfum premium Timur Tengah dalam kemasan 100ml dengan wangi elegan.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:36'),
(239, 147, 'Attar', 'service-items/parfum-timur-tengah-attar-SlBgKw.jpg', '<p>Attar minyak wangi murni tanpa alkohol, aroma pekat khas Timur Tengah.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:36'),
(240, 148, 'Kurma Sukari 1kg', 'service-items/kurma-sukari-kurma-sukari-1kg-k1FUCk.jpg', '<p>Kurma Sukari premium asli Madinah, manis dan lembut dalam kemasan 1kg.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:36'),
(241, 148, 'Kurma Sukari 3kg', 'service-items/kurma-sukari-kurma-sukari-3kg-CA1tb7.jpg', '<p>Kurma Sukari pilihan untuk oleh-oleh keluarga, kemasan 3kg.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:36'),
(242, 148, 'Kurma Sukari Premium', 'service-items/kurma-sukari-kurma-sukari-premium-FK58AZ.jpg', '<p>Kurma Sukari grade premium dengan ukuran besar dan kualitas terbaik.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:37'),
(243, 149, 'Tasbih Kayu', 'service-items/tasbih-kayu-tasbih-kayu-4ch8Js.jpg', '<p>Tasbih kayu ringan dan unik, oleh-oleh khas Tanah Suci yang berkesan.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:37'),
(244, 149, 'Tasbih Cemara', 'service-items/tasbih-kayu-tasbih-cemara-lLtT7K.jpg', '<p>Tasbih berbahan cemara dengan tekstur halus dan aroma khas.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:37'),
(245, 149, 'Tasbih Kuku', 'service-items/tasbih-kayu-tasbih-kuku-HwLA3b.jpg', '<p>Tasbih kuku awet dengan butiran rapi, cocok untuk jamaah yang aktif berdzikir.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:10', '2026-08-19 06:55:37'),
(246, 134, 'Visa 30 Hari', 'service-items/visa-umroh-visa-30-hari-XQCcbC.jpg', '<p>Pilihan Visa 30 Hari dari Visa Umroh yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:24', '2026-08-19 06:55:30'),
(247, 134, 'Visa 60 Hari', 'service-items/visa-umroh-visa-60-hari-43zh1O.jpg', '<p>Pilihan Visa 60 Hari dari Visa Umroh yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:24', '2026-08-19 06:55:31'),
(248, 134, 'Visa Perpanjangan', 'service-items/visa-umroh-visa-perpanjangan-N2niBP.jpg', '<p>Pilihan Visa Perpanjangan dari Visa Umroh yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:24', '2026-08-19 06:55:32'),
(249, 144, 'Cuci Reguler', 'service-items/laundry-kilat-cuci-reguler-0Hn5ZR.jpg', '<p>Pilihan Cuci Reguler dari Laundry Kilat yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:24', '2026-08-19 06:55:34'),
(250, 144, 'Setrika Express', 'service-items/laundry-kilat-setrika-express-7Vt8Nh.jpg', '<p>Pilihan Setrika Express dari Laundry Kilat yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:24', '2026-08-19 06:55:35'),
(251, 144, 'Laundry Harian', 'service-items/laundry-kilat-laundry-harian-a6RuRm.jpg', '<p>Pilihan Laundry Harian dari Laundry Kilat yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:24', '2026-08-19 06:55:35'),
(252, 145, 'Sewa Harian', 'service-items/buggy-car-area-haram-sewa-harian-VkPyNl.jpg', '<p>Pilihan Sewa Harian dari Buggy Car Area Haram yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:24', '2026-08-19 06:55:35'),
(253, 145, 'Sewa Paket Per Jam', 'service-items/buggy-car-area-haram-sewa-paket-per-jam-SWtfeP.jpg', '<p>Pilihan Sewa Paket Per Jam dari Buggy Car Area Haram yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:25', '2026-08-19 06:55:35'),
(254, 145, 'Buggy VIP', 'service-items/buggy-car-area-haram-buggy-vip-bs9dks.jpg', '<p>Pilihan Buggy VIP dari Buggy Car Area Haram yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:25', '2026-08-19 06:55:35'),
(255, 150, 'Kursi Roda Reguler', 'service-items/sewa-kursi-roda-kursi-roda-reguler-hXoysx.jpg', '<p>Pilihan Kursi Roda Reguler dari Sewa Kursi Roda yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:25', '2026-08-19 06:55:37'),
(256, 150, 'Kursi Motor Wheelchair', 'service-items/sewa-kursi-roda-kursi-motor-wheelchair-r77IBa.jpg', '<p>Pilihan Kursi Motor Wheelchair dari Sewa Kursi Roda yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:25', '2026-08-19 06:55:38'),
(257, 150, 'Kursi Roda Premium', 'service-items/sewa-kursi-roda-kursi-roda-premium-XY5Wwj.jpg', '<p>Pilihan Kursi Roda Premium dari Sewa Kursi Roda yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:25', '2026-08-19 06:55:38'),
(258, 154, 'Riyal Cash', 'service-items/penukaran-riyal-riyal-cash-heLkan.jpg', '<p>Pilihan Riyal Cash dari Penukaran Riyal yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:27', '2026-08-19 06:55:40'),
(259, 154, 'Dolar ke Riyal', 'service-items/penukaran-riyal-dolar-ke-riyal-jBZREL.jpg', '<p>Pilihan Dolar ke Riyal dari Penukaran Riyal yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:27', '2026-08-19 06:55:40'),
(260, 154, 'Kirim Uang', 'service-items/penukaran-riyal-kirim-uang-nBX8lD.jpg', '<p>Pilihan Kirim Uang dari Penukaran Riyal yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:27', '2026-08-19 06:55:40'),
(261, 155, 'Pendampingan Harian', 'service-items/muthawif-per-hari-pendampingan-harian-ll72jj.jpg', '<p>Pilihan Pendampingan Harian dari Muthawif Per Hari yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 1, NULL, NULL, 1, '2026-08-19 06:55:28', '2026-08-19 06:55:40'),
(262, 155, 'Pendamping Ziarah', 'service-items/muthawif-per-hari-pendamping-ziarah-I5sYxl.jpg', '<p>Pilihan Pendamping Ziarah dari Muthawif Per Hari yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 2, NULL, NULL, 1, '2026-08-19 06:55:28', '2026-08-19 06:55:40'),
(263, 155, 'Pendamping Manasik', 'service-items/muthawif-per-hari-pendamping-manasik-y4B8lN.jpg', '<p>Pilihan Pendamping Manasik dari Muthawif Per Hari yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 3, NULL, NULL, 1, '2026-08-19 06:55:28', '2026-08-19 06:55:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('oYLiOSvNFQi5OmkpV43Ozrgf9gZSHmwGUOBWUATs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiamtXbXFsMkFoeFRTdWY4MEFCTjc3MGh3STlLYXpLM2FSMHRQRnBYbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZW50YW5nLWthbWkiO3M6NToicm91dGUiO3M6MTM6InBhZ2VzLnRlbnRhbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1787123989);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `og_image` text DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text DEFAULT NULL,
  `og_type` varchar(255) DEFAULT NULL,
  `og_site_name` varchar(255) DEFAULT NULL,
  `twitter_card` varchar(255) DEFAULT NULL,
  `twitter_title` varchar(255) DEFAULT NULL,
  `twitter_description` text DEFAULT NULL,
  `twitter_image` text DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `robots` varchar(255) DEFAULT NULL,
  `google_site_verification` varchar(255) DEFAULT NULL,
  `bing_site_verification` varchar(255) DEFAULT NULL,
  `google_analytics_id` varchar(255) DEFAULT NULL,
  `google_tag_manager_id` varchar(255) DEFAULT NULL,
  `schema_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `org_name` varchar(255) DEFAULT NULL,
  `org_logo` text DEFAULT NULL,
  `org_phone` varchar(255) DEFAULT NULL,
  `org_email` varchar(255) DEFAULT NULL,
  `org_address` text DEFAULT NULL,
  `org_geo_lat` varchar(255) DEFAULT NULL,
  `org_geo_lng` varchar(255) DEFAULT NULL,
  `sitemap_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `banner_image` varchar(255) DEFAULT NULL,
  `banner_badge` varchar(255) DEFAULT NULL,
  `banner_title` varchar(255) DEFAULT NULL,
  `banner_cta_text` varchar(255) DEFAULT NULL,
  `banner_cta_url` varchar(255) DEFAULT NULL,
  `hero_subtitle` text DEFAULT NULL,
  `greeting_image` varchar(255) DEFAULT NULL,
  `greeting_title` text DEFAULT NULL,
  `greeting_subtitle` text DEFAULT NULL,
  `greeting_text` text DEFAULT NULL,
  `why_label` text DEFAULT NULL,
  `why_title` text DEFAULT NULL,
  `why_subtitle` text DEFAULT NULL,
  `about_banner` varchar(255) DEFAULT NULL,
  `about_image` varchar(255) DEFAULT NULL,
  `about_title` varchar(255) DEFAULT NULL,
  `about_body` text DEFAULT NULL,
  `trust_badge_1_icon` varchar(255) DEFAULT NULL,
  `trust_badge_1_text` varchar(255) DEFAULT NULL,
  `trust_badge_2_icon` varchar(255) DEFAULT NULL,
  `trust_badge_2_text` varchar(255) DEFAULT NULL,
  `trust_badge_3_icon` varchar(255) DEFAULT NULL,
  `trust_badge_3_text` varchar(255) DEFAULT NULL,
  `trust_badge_4_icon` varchar(255) DEFAULT NULL,
  `trust_badge_4_text` varchar(255) DEFAULT NULL,
  `testimonial_label` text DEFAULT NULL,
  `testimonial_title` text DEFAULT NULL,
  `testimonial_subtitle` text DEFAULT NULL,
  `cta_pill` text DEFAULT NULL,
  `cta_title` text DEFAULT NULL,
  `cta_subtitle` text DEFAULT NULL,
  `cta_button` text DEFAULT NULL,
  `services_page_title` text DEFAULT NULL,
  `services_page_subtitle` text DEFAULT NULL,
  `galeri_page_title` text DEFAULT NULL,
  `galeri_page_subtitle` text DEFAULT NULL,
  `testimoni_page_title` text DEFAULT NULL,
  `testimoni_page_subtitle` text DEFAULT NULL,
  `faq_page_title` text DEFAULT NULL,
  `faq_page_subtitle` text DEFAULT NULL,
  `artikel_page_title` text DEFAULT NULL,
  `artikel_page_subtitle` text DEFAULT NULL,
  `website_name` varchar(255) NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `wa_message` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `footer_text` text DEFAULT NULL,
  `footer_contact_heading` text DEFAULT NULL,
  `footer_links_heading` text DEFAULT NULL,
  `footer_links` text DEFAULT NULL,
  `footer_copyright` text DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `seo_keywords` text DEFAULT NULL,
  `social_instagram` varchar(255) DEFAULT NULL,
  `social_facebook` varchar(255) DEFAULT NULL,
  `social_youtube` varchar(255) DEFAULT NULL,
  `social_tiktok` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `og_image`, `og_title`, `og_description`, `og_type`, `og_site_name`, `twitter_card`, `twitter_title`, `twitter_description`, `twitter_image`, `canonical_url`, `robots`, `google_site_verification`, `bing_site_verification`, `google_analytics_id`, `google_tag_manager_id`, `schema_enabled`, `org_name`, `org_logo`, `org_phone`, `org_email`, `org_address`, `org_geo_lat`, `org_geo_lng`, `sitemap_enabled`, `banner_image`, `banner_badge`, `banner_title`, `banner_cta_text`, `banner_cta_url`, `hero_subtitle`, `greeting_image`, `greeting_title`, `greeting_subtitle`, `greeting_text`, `why_label`, `why_title`, `why_subtitle`, `about_banner`, `about_image`, `about_title`, `about_body`, `trust_badge_1_icon`, `trust_badge_1_text`, `trust_badge_2_icon`, `trust_badge_2_text`, `trust_badge_3_icon`, `trust_badge_3_text`, `trust_badge_4_icon`, `trust_badge_4_text`, `testimonial_label`, `testimonial_title`, `testimonial_subtitle`, `cta_pill`, `cta_title`, `cta_subtitle`, `cta_button`, `services_page_title`, `services_page_subtitle`, `galeri_page_title`, `galeri_page_subtitle`, `testimoni_page_title`, `testimoni_page_subtitle`, `faq_page_title`, `faq_page_subtitle`, `artikel_page_title`, `artikel_page_subtitle`, `website_name`, `tagline`, `whatsapp`, `wa_message`, `email`, `address`, `footer_text`, `footer_contact_heading`, `footer_links_heading`, `footer_links`, `footer_copyright`, `seo_title`, `seo_description`, `seo_keywords`, `social_instagram`, `social_facebook`, `social_youtube`, `social_tiktok`, `created_at`, `updated_at`) VALUES
(1, 'settings/6LKAECp0CQRlRTwFMAEFWLjpEJzuvHaAHUvxDVEC.webp', 'settings/JES8f7juDQDiQsMEIM2CUgjwMYvjaNzNApTbdgtX.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'index, follow', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'settings/Nm83LXikUFXN8w9TOEF9s8ubuODNOhMTyzmZHDNM.webp', NULL, NULL, NULL, NULL, 'Halo', 'settings/aDkXS8czm0NiRg7UBZ7XhbgNkygLpl1g0xDMDrVN.webp', 'Assalamu\'alaikum', 'Selamat datang di Duyufuna', 'Temukan berbagai layanan umroh dan haji untuk menemani perjalanan ibadah Anda dengan lebih mudah, nyaman, dan tenang menuju Tanah Suci.', NULL, NULL, NULL, 'settings/6LKAECp0CQRlRTwFMAEFWLjpEJzuvHaAHUvxDVEC.webp', 'settings/Hb985l3DWV3dUoHMM1cYnavXuErjEStvdzK3KSKW.webp', 'Tentang Kami', '<p>Duyufuna hadir sebagai penyedia layanan umroh dan haji yang berkomitmen membantu memenuhi berbagai kebutuhan perjalanan jamaah menuju Tanah Suci. Kami memahami bahwa perjalanan ibadah bukan sekadar perjalanan biasa, tetapi sebuah perjalanan yang membutuhkan persiapan, ketelitian, kenyamanan, dan pelayanan yang baik sejak sebelum keberangkatan hingga jamaah kembali ke tanah air.</p>\n<p>Melalui berbagai layanan yang terintegrasi, kami menyediakan kebutuhan pendukung perjalanan seperti pengurusan visa, akomodasi hotel di Mekkah, Madinah, dan Jeddah, transportasi, handling bandara, handling hotel, catering, laundry, serta berbagai kebutuhan lainnya. Setiap layanan disiapkan untuk membantu jamaah maupun penyelenggara perjalanan mendapatkan solusi yang lebih praktis dan terkoordinasi.</p>\n<p>Kami terus berupaya menghadirkan pelayanan yang responsif, fleksibel, dan berorientasi pada kebutuhan jamaah. Dengan memahami bahwa setiap rombongan memiliki kebutuhan yang berbeda, layanan dapat disesuaikan berdasarkan jumlah jamaah, jadwal perjalanan, pilihan akomodasi, serta kebutuhan khusus lainnya.</p>\n<h3>Visi</h3>\n<p>Menjadi penyedia layanan umroh dan haji yang terpercaya dan profesional dalam menghadirkan kemudahan, kenyamanan, serta layanan pendukung perjalanan ibadah yang berkualitas bagi setiap jamaah.</p>\n<h3>Misi</h3>\n<ol>\n<li>Menyediakan berbagai layanan pendukung perjalanan umroh dan haji secara lengkap dan terintegrasi.</li>\n<li>Memberikan pelayanan yang mudah, responsif, dan sesuai dengan kebutuhan jamaah.</li>\n<li>Mengutamakan kenyamanan, ketepatan, dan kualitas dalam setiap layanan.</li>\n<li>Membangun kerja sama yang baik dengan berbagai pihak untuk mendukung kelancaran perjalanan jamaah.</li>\n<li>Terus meningkatkan kualitas layanan dan mengikuti perkembangan kebutuhan perjalanan ibadah.</li>\n<li>Membantu menciptakan perjalanan menuju Tanah Suci yang lebih tertata, nyaman, dan tenang bagi jamaah.</li>\n</ol>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DUYUFUNA', 'MELAYANI TAMU ALLAH, SEPENUH HATI', '6281293679502', NULL, 'info@duyufuna.com', 'Jakarta, Indonesia', '<p>Layanan perjalanan umroh dan haji yang membantu setiap langkah perjalanan menuju Tanah Suci dengan mudah, nyaman, dan terpercaya.</p>', NULL, NULL, NULL, '© 2026 DUYUFUNA', 'DUYUFUNA - Layanan Umroh & Haji Terpercaya', 'Platform layanan umroh, haji, hotel, dan transportasi di tanah suci. Mudah, amanah, berkah.', 'umroh, haji, travel umroh, hotel mekkah, hotel madinah', NULL, NULL, NULL, NULL, '2026-07-28 04:43:27', '2026-08-19 07:17:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `image`, `review`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 'H. Ahmad Fauzi', NULL, 'Pelayanan DUYUFUNA sangat memuaskan, hotel dan catering nya nyaman. Sangat direkomendasikan.', 5, 1, '2026-08-01 20:18:25', '2026-08-01 20:18:25'),
(2, 'Ibu Siti Rahma', NULL, 'Transportasi dan handling bandara lancar, tim ramah dan siap. Perjalanan ibadah kami jadi tenang.', 5, 1, '2026-08-01 20:18:25', '2026-08-01 20:18:25'),
(3, 'Bp. Budi Santoso', NULL, 'Proses visa dan pengurusan dokumen cepat dan jelas. Alhamdulillah puas beribadah ke Tanah Suci.', 4, 1, '2026-08-01 20:18:25', '2026-08-01 20:18:25'),
(4, 'Ibu Asih', NULL, 'Terima kasih DUYUFUNA, semua diurus rapi mulai visa, hotel, sampai transportasi. Ibadah kami jadi tenang.', 5, 1, '2026-08-06 23:53:03', '2026-08-06 23:53:03'),
(5, 'Bp. Dwi Cahyono', NULL, 'Handling dan catering-nya top, petugas ramah. Sangat direkomendasikan untuk keluarga.', 4, 1, '2026-08-06 23:53:03', '2026-08-06 23:53:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `traffics`
--

CREATE TABLE `traffics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_name` varchar(255) DEFAULT NULL,
  `menu` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'baru',
  `url` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `is_lead` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `traffics`
--

INSERT INTO `traffics` (`id`, `route_name`, `menu`, `nama`, `no_hp`, `category`, `service`, `item`, `status`, `url`, `referrer`, `ip`, `user_agent`, `device`, `is_lead`, `created_at`, `updated_at`) VALUES
(2230, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/muthawif', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:50:37', '2026-08-19 06:50:37'),
(2231, 'pages.tentang', 'Tentang Kami', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/tentang-kami', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:51:09', '2026-08-19 06:51:09'),
(2232, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/tentang-kami', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:51:23', '2026-08-19 06:51:23'),
(2233, 'pages.galeri', 'Galeri', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/galeri', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:51:31', '2026-08-19 06:51:31'),
(2234, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/testimoni', 'http://127.0.0.1:8000/galeri', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:51:39', '2026-08-19 06:51:39'),
(2235, 'pages.faq', 'FAQ', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/faq', 'http://127.0.0.1:8000/testimoni', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:51:49', '2026-08-19 06:51:49'),
(2236, 'pages.galeri', 'Galeri', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/galeri', 'http://127.0.0.1:8000/testimoni', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:52:00', '2026-08-19 06:52:00'),
(2237, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/galeri', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:52:30', '2026-08-19 06:52:30'),
(2238, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:52:37', '2026-08-19 06:52:37'),
(2239, 'pages.galeri', 'Galeri', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/galeri', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:52:56', '2026-08-19 06:52:56'),
(2240, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/galeri', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:54:51', '2026-08-19 06:54:51'),
(2241, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/galeri', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:55:58', '2026-08-19 06:55:58'),
(2242, 'pages.galeri', 'Galeri', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/galeri', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:56:06', '2026-08-19 06:56:06'),
(2243, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/galeri', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:56:15', '2026-08-19 06:56:15'),
(2244, 'category.show', 'Muthawif', NULL, NULL, 'Muthawif', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/muthawif', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 06:56:24', '2026-08-19 06:56:24'),
(2245, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/muthawif', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 07:02:44', '2026-08-19 07:02:44'),
(2246, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/muthawif', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 07:04:39', '2026-08-19 07:04:39'),
(2247, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/muthawif', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 07:07:44', '2026-08-19 07:07:44'),
(2248, 'pages.tentang', 'Tentang Kami', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/tentang-kami', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 07:08:04', '2026-08-19 07:08:04'),
(2249, 'pages.tentang', 'Tentang Kami', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/tentang-kami', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 07:11:01', '2026-08-19 07:11:01'),
(2250, 'pages.tentang', 'Tentang Kami', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/tentang-kami', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 07:13:48', '2026-08-19 07:13:48'),
(2251, 'pages.tentang', 'Tentang Kami', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/tentang-kami', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 07:14:08', '2026-08-19 07:14:08'),
(2252, 'pages.tentang', 'Tentang Kami', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/tentang-kami', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 07:15:37', '2026-08-19 07:15:37'),
(2253, 'pages.tentang', 'Tentang Kami', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/tentang-kami', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 07:19:49', '2026-08-19 07:19:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `avatar`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin', 'superadmin@duyufuna.com', 'super_admin', 'avatars/PAG7gNUQfetICaFxQIvuZQwjn1F92nhc1PJ4eKA1.webp', NULL, '$2y$12$E.SoXDWhEDB.So81OGuOn..HS5wqFsnB7t4Na8/HX51Bqxo/DWg.K', 1, NULL, '2026-07-28 04:43:27', '2026-08-14 11:01:52'),
(32, 'Admin', 'admin', 'admin@duyufuna.com', 'super_admin', NULL, NULL, '$2y$12$W0jYxfZ1EHx8.pYWLSjIpOyen/VhoDIMZlQUVqeaLEEo6DWS6/JNK', 1, NULL, '2026-08-14 10:18:59', '2026-08-19 06:55:07'),
(33, 'Yahya Saptono', NULL, 'asman.lailasari@example.com', 'admin', NULL, '2026-08-16 16:18:20', '$2y$12$NjRsmIvVNAiTPpGRW/iZI.b4XEX7rzVc5Eww1mNIT7OEC5zAWuqdS', 1, 'FD2nipvSMK', '2026-08-16 16:18:20', '2026-08-16 16:18:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_article_category_id_foreign` (`article_category_id`);

--
-- Indeks untuk tabel `article_categories`
--
ALTER TABLE `article_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `article_categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_service_id_foreign` (`service_id`),
  ADD KEY `banners_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customer_status_histories`
--
ALTER TABLE `customer_status_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_status_histories_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_status_histories_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`),
  ADD KEY `services_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `service_items`
--
ALTER TABLE `service_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_items_service_id_foreign` (`service_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `traffics`
--
ALTER TABLE `traffics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `traffics_created_at_index` (`created_at`),
  ADD KEY `traffics_menu_index` (`menu`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `article_categories`
--
ALTER TABLE `article_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `customer_status_histories`
--
ALTER TABLE `customer_status_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT untuk tabel `service_items`
--
ALTER TABLE `service_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `traffics`
--
ALTER TABLE `traffics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2254;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_article_category_id_foreign` FOREIGN KEY (`article_category_id`) REFERENCES `article_categories` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `banners_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `customer_status_histories`
--
ALTER TABLE `customer_status_histories`
  ADD CONSTRAINT `customer_status_histories_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_status_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `service_items`
--
ALTER TABLE `service_items`
  ADD CONSTRAINT `service_items_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
