-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Sep 2026 pada 13.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.3.33

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
('duyufuna-cache-headerBanners', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:3:{i:0;O:17:\"App\\Models\\Banner\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"banners\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:1;s:5:\"image\";s:53:\"banners/habByeocLVPiKiaVy8irEq76j3OvReK3GYomRr6m.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:1;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-07-28 14:33:26\";s:10:\"updated_at\";s:19:\"2026-08-14 20:27:46\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:1;s:5:\"image\";s:53:\"banners/habByeocLVPiKiaVy8irEq76j3OvReK3GYomRr6m.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:1;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-07-28 14:33:26\";s:10:\"updated_at\";s:19:\"2026-08-14 20:27:46\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:5:\"image\";i:1;s:5:\"title\";i:2;s:8:\"subtitle\";i:3;s:3:\"url\";i:4;s:6:\"status\";i:5;s:4:\"sort\";i:6;s:10:\"service_id\";i:7;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:17:\"App\\Models\\Banner\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"banners\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:5;s:5:\"image\";s:53:\"banners/QzCoSEsaUOM69FJiRVUE39cojyVpU5NmQGgkVWAG.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:2;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-08-07 07:46:59\";s:10:\"updated_at\";s:19:\"2026-08-14 18:12:20\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:5;s:5:\"image\";s:53:\"banners/QzCoSEsaUOM69FJiRVUE39cojyVpU5NmQGgkVWAG.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:2;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-08-07 07:46:59\";s:10:\"updated_at\";s:19:\"2026-08-14 18:12:20\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:5:\"image\";i:1;s:5:\"title\";i:2;s:8:\"subtitle\";i:3;s:3:\"url\";i:4;s:6:\"status\";i:5;s:4:\"sort\";i:6;s:10:\"service_id\";i:7;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:17:\"App\\Models\\Banner\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"banners\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:6;s:5:\"image\";s:53:\"banners/MWn3gaKC0d3EMFqQNy2bLWVopaD3L8wxmcPxi3fp.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:3;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-08-07 07:47:05\";s:10:\"updated_at\";s:19:\"2026-08-14 18:12:20\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:6;s:5:\"image\";s:53:\"banners/MWn3gaKC0d3EMFqQNy2bLWVopaD3L8wxmcPxi3fp.webp\";s:5:\"title\";N;s:8:\"subtitle\";N;s:3:\"url\";N;s:6:\"status\";i:1;s:4:\"sort\";i:3;s:10:\"service_id\";N;s:11:\"category_id\";N;s:10:\"created_at\";s:19:\"2026-08-07 07:47:05\";s:10:\"updated_at\";s:19:\"2026-08-14 18:12:20\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:5:\"image\";i:1;s:5:\"title\";i:2;s:8:\"subtitle\";i:3;s:3:\"url\";i:4;s:6:\"status\";i:5;s:4:\"sort\";i:6;s:10:\"service_id\";i:7;s:11:\"category_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1788244291),
('duyufuna-cache-setting', 'O:18:\"App\\Models\\Setting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:89:{s:2:\"id\";i:1;s:4:\"logo\";s:54:\"settings/6LKAECp0CQRlRTwFMAEFWLjpEJzuvHaAHUvxDVEC.webp\";s:7:\"favicon\";s:53:\"settings/JES8f7juDQDiQsMEIM2CUgjwMYvjaNzNApTbdgtX.png\";s:8:\"og_image\";N;s:8:\"og_title\";N;s:14:\"og_description\";N;s:7:\"og_type\";N;s:12:\"og_site_name\";N;s:12:\"twitter_card\";N;s:13:\"twitter_title\";N;s:19:\"twitter_description\";N;s:13:\"twitter_image\";N;s:13:\"canonical_url\";N;s:6:\"robots\";s:13:\"index, follow\";s:24:\"google_site_verification\";N;s:22:\"bing_site_verification\";N;s:19:\"google_analytics_id\";N;s:21:\"google_tag_manager_id\";N;s:14:\"schema_enabled\";i:0;s:8:\"org_name\";N;s:8:\"org_logo\";N;s:9:\"org_phone\";N;s:9:\"org_email\";N;s:11:\"org_address\";N;s:11:\"org_geo_lat\";N;s:11:\"org_geo_lng\";N;s:15:\"sitemap_enabled\";i:1;s:12:\"banner_image\";s:54:\"settings/Nm83LXikUFXN8w9TOEF9s8ubuODNOhMTyzmZHDNM.webp\";s:12:\"banner_badge\";N;s:12:\"banner_title\";N;s:15:\"banner_cta_text\";N;s:14:\"banner_cta_url\";N;s:13:\"hero_subtitle\";s:4:\"Halo\";s:14:\"greeting_image\";s:54:\"settings/aDkXS8czm0NiRg7UBZ7XhbgNkygLpl1g0xDMDrVN.webp\";s:14:\"greeting_title\";s:16:\"Assalamu\'alaikum\";s:17:\"greeting_subtitle\";s:26:\"Selamat datang di Duyufuna\";s:13:\"greeting_text\";s:135:\"Temukan berbagai layanan umroh dan haji untuk menemani perjalanan ibadah Anda dengan lebih mudah, nyaman, dan tenang menuju Tanah Suci.\";s:9:\"why_label\";N;s:9:\"why_title\";N;s:12:\"why_subtitle\";N;s:12:\"about_banner\";s:54:\"settings/6LKAECp0CQRlRTwFMAEFWLjpEJzuvHaAHUvxDVEC.webp\";s:11:\"about_image\";s:54:\"settings/Hb985l3DWV3dUoHMM1cYnavXuErjEStvdzK3KSKW.webp\";s:11:\"about_title\";s:12:\"Tentang Kami\";s:10:\"about_body\";s:1943:\"<p>Duyufuna hadir sebagai penyedia layanan umroh dan haji yang berkomitmen membantu memenuhi berbagai kebutuhan perjalanan jamaah menuju Tanah Suci. Kami memahami bahwa perjalanan ibadah bukan sekadar perjalanan biasa, tetapi sebuah perjalanan yang membutuhkan persiapan, ketelitian, kenyamanan, dan pelayanan yang baik sejak sebelum keberangkatan hingga jamaah kembali ke tanah air.</p>\n<p>Melalui berbagai layanan yang terintegrasi, kami menyediakan kebutuhan pendukung perjalanan seperti pengurusan visa, akomodasi hotel di Mekkah, Madinah, dan Jeddah, transportasi, handling bandara, handling hotel, catering, laundry, serta berbagai kebutuhan lainnya. Setiap layanan disiapkan untuk membantu jamaah maupun penyelenggara perjalanan mendapatkan solusi yang lebih praktis dan terkoordinasi.</p>\n<p>Kami terus berupaya menghadirkan pelayanan yang responsif, fleksibel, dan berorientasi pada kebutuhan jamaah. Dengan memahami bahwa setiap rombongan memiliki kebutuhan yang berbeda, layanan dapat disesuaikan berdasarkan jumlah jamaah, jadwal perjalanan, pilihan akomodasi, serta kebutuhan khusus lainnya.</p>\n<h3>Visi</h3>\n<p>Menjadi penyedia layanan umroh dan haji yang terpercaya dan profesional dalam menghadirkan kemudahan, kenyamanan, serta layanan pendukung perjalanan ibadah yang berkualitas bagi setiap jamaah.</p>\n<h3>Misi</h3>\n<ol>\n<li>Menyediakan berbagai layanan pendukung perjalanan umroh dan haji secara lengkap dan terintegrasi.</li>\n<li>Memberikan pelayanan yang mudah, responsif, dan sesuai dengan kebutuhan jamaah.</li>\n<li>Mengutamakan kenyamanan, ketepatan, dan kualitas dalam setiap layanan.</li>\n<li>Membangun kerja sama yang baik dengan berbagai pihak untuk mendukung kelancaran perjalanan jamaah.</li>\n<li>Terus meningkatkan kualitas layanan dan mengikuti perkembangan kebutuhan perjalanan ibadah.</li>\n<li>Membantu menciptakan perjalanan menuju Tanah Suci yang lebih tertata, nyaman, dan tenang bagi jamaah.</li>\n</ol>\";s:18:\"trust_badge_1_icon\";N;s:18:\"trust_badge_1_text\";N;s:18:\"trust_badge_2_icon\";N;s:18:\"trust_badge_2_text\";N;s:18:\"trust_badge_3_icon\";N;s:18:\"trust_badge_3_text\";N;s:18:\"trust_badge_4_icon\";N;s:18:\"trust_badge_4_text\";N;s:17:\"testimonial_label\";N;s:17:\"testimonial_title\";N;s:20:\"testimonial_subtitle\";N;s:8:\"cta_pill\";N;s:9:\"cta_title\";N;s:12:\"cta_subtitle\";N;s:10:\"cta_button\";N;s:19:\"services_page_title\";N;s:22:\"services_page_subtitle\";N;s:17:\"galeri_page_title\";N;s:20:\"galeri_page_subtitle\";N;s:20:\"testimoni_page_title\";N;s:23:\"testimoni_page_subtitle\";N;s:14:\"faq_page_title\";N;s:17:\"faq_page_subtitle\";N;s:18:\"artikel_page_title\";N;s:21:\"artikel_page_subtitle\";N;s:12:\"website_name\";s:8:\"DUYUFUNA\";s:7:\"tagline\";s:33:\"MELAYANI TAMU ALLAH, SEPENUH HATI\";s:8:\"whatsapp\";s:13:\"6281293679502\";s:10:\"wa_message\";N;s:5:\"email\";s:17:\"info@duyufuna.com\";s:7:\"address\";s:18:\"Jakarta, Indonesia\";s:11:\"footer_text\";s:136:\"<p>Layanan perjalanan umroh dan haji yang membantu setiap langkah perjalanan menuju Tanah Suci dengan mudah, nyaman, dan terpercaya.</p>\";s:22:\"footer_contact_heading\";N;s:20:\"footer_links_heading\";N;s:12:\"footer_links\";N;s:16:\"footer_copyright\";s:16:\"© 2026 DUYUFUNA\";s:9:\"seo_title\";s:42:\"DUYUFUNA - Layanan Umroh & Haji Terpercaya\";s:15:\"seo_description\";s:91:\"Platform layanan umroh, haji, hotel, dan transportasi di tanah suci. Mudah, amanah, berkah.\";s:12:\"seo_keywords\";s:54:\"umroh, haji, travel umroh, hotel mekkah, hotel madinah\";s:16:\"social_instagram\";N;s:15:\"social_facebook\";N;s:14:\"social_youtube\";N;s:13:\"social_tiktok\";N;s:10:\"created_at\";s:19:\"2026-07-28 11:43:27\";s:10:\"updated_at\";s:19:\"2026-08-19 14:17:37\";}s:11:\"\0*\0original\";a:89:{s:2:\"id\";i:1;s:4:\"logo\";s:54:\"settings/6LKAECp0CQRlRTwFMAEFWLjpEJzuvHaAHUvxDVEC.webp\";s:7:\"favicon\";s:53:\"settings/JES8f7juDQDiQsMEIM2CUgjwMYvjaNzNApTbdgtX.png\";s:8:\"og_image\";N;s:8:\"og_title\";N;s:14:\"og_description\";N;s:7:\"og_type\";N;s:12:\"og_site_name\";N;s:12:\"twitter_card\";N;s:13:\"twitter_title\";N;s:19:\"twitter_description\";N;s:13:\"twitter_image\";N;s:13:\"canonical_url\";N;s:6:\"robots\";s:13:\"index, follow\";s:24:\"google_site_verification\";N;s:22:\"bing_site_verification\";N;s:19:\"google_analytics_id\";N;s:21:\"google_tag_manager_id\";N;s:14:\"schema_enabled\";i:0;s:8:\"org_name\";N;s:8:\"org_logo\";N;s:9:\"org_phone\";N;s:9:\"org_email\";N;s:11:\"org_address\";N;s:11:\"org_geo_lat\";N;s:11:\"org_geo_lng\";N;s:15:\"sitemap_enabled\";i:1;s:12:\"banner_image\";s:54:\"settings/Nm83LXikUFXN8w9TOEF9s8ubuODNOhMTyzmZHDNM.webp\";s:12:\"banner_badge\";N;s:12:\"banner_title\";N;s:15:\"banner_cta_text\";N;s:14:\"banner_cta_url\";N;s:13:\"hero_subtitle\";s:4:\"Halo\";s:14:\"greeting_image\";s:54:\"settings/aDkXS8czm0NiRg7UBZ7XhbgNkygLpl1g0xDMDrVN.webp\";s:14:\"greeting_title\";s:16:\"Assalamu\'alaikum\";s:17:\"greeting_subtitle\";s:26:\"Selamat datang di Duyufuna\";s:13:\"greeting_text\";s:135:\"Temukan berbagai layanan umroh dan haji untuk menemani perjalanan ibadah Anda dengan lebih mudah, nyaman, dan tenang menuju Tanah Suci.\";s:9:\"why_label\";N;s:9:\"why_title\";N;s:12:\"why_subtitle\";N;s:12:\"about_banner\";s:54:\"settings/6LKAECp0CQRlRTwFMAEFWLjpEJzuvHaAHUvxDVEC.webp\";s:11:\"about_image\";s:54:\"settings/Hb985l3DWV3dUoHMM1cYnavXuErjEStvdzK3KSKW.webp\";s:11:\"about_title\";s:12:\"Tentang Kami\";s:10:\"about_body\";s:1943:\"<p>Duyufuna hadir sebagai penyedia layanan umroh dan haji yang berkomitmen membantu memenuhi berbagai kebutuhan perjalanan jamaah menuju Tanah Suci. Kami memahami bahwa perjalanan ibadah bukan sekadar perjalanan biasa, tetapi sebuah perjalanan yang membutuhkan persiapan, ketelitian, kenyamanan, dan pelayanan yang baik sejak sebelum keberangkatan hingga jamaah kembali ke tanah air.</p>\n<p>Melalui berbagai layanan yang terintegrasi, kami menyediakan kebutuhan pendukung perjalanan seperti pengurusan visa, akomodasi hotel di Mekkah, Madinah, dan Jeddah, transportasi, handling bandara, handling hotel, catering, laundry, serta berbagai kebutuhan lainnya. Setiap layanan disiapkan untuk membantu jamaah maupun penyelenggara perjalanan mendapatkan solusi yang lebih praktis dan terkoordinasi.</p>\n<p>Kami terus berupaya menghadirkan pelayanan yang responsif, fleksibel, dan berorientasi pada kebutuhan jamaah. Dengan memahami bahwa setiap rombongan memiliki kebutuhan yang berbeda, layanan dapat disesuaikan berdasarkan jumlah jamaah, jadwal perjalanan, pilihan akomodasi, serta kebutuhan khusus lainnya.</p>\n<h3>Visi</h3>\n<p>Menjadi penyedia layanan umroh dan haji yang terpercaya dan profesional dalam menghadirkan kemudahan, kenyamanan, serta layanan pendukung perjalanan ibadah yang berkualitas bagi setiap jamaah.</p>\n<h3>Misi</h3>\n<ol>\n<li>Menyediakan berbagai layanan pendukung perjalanan umroh dan haji secara lengkap dan terintegrasi.</li>\n<li>Memberikan pelayanan yang mudah, responsif, dan sesuai dengan kebutuhan jamaah.</li>\n<li>Mengutamakan kenyamanan, ketepatan, dan kualitas dalam setiap layanan.</li>\n<li>Membangun kerja sama yang baik dengan berbagai pihak untuk mendukung kelancaran perjalanan jamaah.</li>\n<li>Terus meningkatkan kualitas layanan dan mengikuti perkembangan kebutuhan perjalanan ibadah.</li>\n<li>Membantu menciptakan perjalanan menuju Tanah Suci yang lebih tertata, nyaman, dan tenang bagi jamaah.</li>\n</ol>\";s:18:\"trust_badge_1_icon\";N;s:18:\"trust_badge_1_text\";N;s:18:\"trust_badge_2_icon\";N;s:18:\"trust_badge_2_text\";N;s:18:\"trust_badge_3_icon\";N;s:18:\"trust_badge_3_text\";N;s:18:\"trust_badge_4_icon\";N;s:18:\"trust_badge_4_text\";N;s:17:\"testimonial_label\";N;s:17:\"testimonial_title\";N;s:20:\"testimonial_subtitle\";N;s:8:\"cta_pill\";N;s:9:\"cta_title\";N;s:12:\"cta_subtitle\";N;s:10:\"cta_button\";N;s:19:\"services_page_title\";N;s:22:\"services_page_subtitle\";N;s:17:\"galeri_page_title\";N;s:20:\"galeri_page_subtitle\";N;s:20:\"testimoni_page_title\";N;s:23:\"testimoni_page_subtitle\";N;s:14:\"faq_page_title\";N;s:17:\"faq_page_subtitle\";N;s:18:\"artikel_page_title\";N;s:21:\"artikel_page_subtitle\";N;s:12:\"website_name\";s:8:\"DUYUFUNA\";s:7:\"tagline\";s:33:\"MELAYANI TAMU ALLAH, SEPENUH HATI\";s:8:\"whatsapp\";s:13:\"6281293679502\";s:10:\"wa_message\";N;s:5:\"email\";s:17:\"info@duyufuna.com\";s:7:\"address\";s:18:\"Jakarta, Indonesia\";s:11:\"footer_text\";s:136:\"<p>Layanan perjalanan umroh dan haji yang membantu setiap langkah perjalanan menuju Tanah Suci dengan mudah, nyaman, dan terpercaya.</p>\";s:22:\"footer_contact_heading\";N;s:20:\"footer_links_heading\";N;s:12:\"footer_links\";N;s:16:\"footer_copyright\";s:16:\"© 2026 DUYUFUNA\";s:9:\"seo_title\";s:42:\"DUYUFUNA - Layanan Umroh & Haji Terpercaya\";s:15:\"seo_description\";s:91:\"Platform layanan umroh, haji, hotel, dan transportasi di tanah suci. Mudah, amanah, berkah.\";s:12:\"seo_keywords\";s:54:\"umroh, haji, travel umroh, hotel mekkah, hotel madinah\";s:16:\"social_instagram\";N;s:15:\"social_facebook\";N;s:14:\"social_youtube\";N;s:13:\"social_tiktok\";N;s:10:\"created_at\";s:19:\"2026-07-28 11:43:27\";s:10:\"updated_at\";s:19:\"2026-08-19 14:17:37\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:14:\"schema_enabled\";s:7:\"boolean\";s:15:\"sitemap_enabled\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:78:{i:0;s:4:\"logo\";i:1;s:7:\"favicon\";i:2;s:12:\"website_name\";i:3;s:7:\"tagline\";i:4;s:8:\"whatsapp\";i:5;s:5:\"email\";i:6;s:7:\"address\";i:7;s:10:\"wa_message\";i:8;s:12:\"banner_image\";i:9;s:12:\"banner_badge\";i:10;s:12:\"banner_title\";i:11;s:15:\"banner_cta_text\";i:12;s:14:\"banner_cta_url\";i:13;s:14:\"greeting_image\";i:14;s:14:\"greeting_title\";i:15;s:17:\"greeting_subtitle\";i:16;s:13:\"greeting_text\";i:17;s:13:\"hero_subtitle\";i:18;s:12:\"about_banner\";i:19;s:11:\"about_image\";i:20;s:11:\"about_title\";i:21;s:10:\"about_body\";i:22;s:9:\"why_label\";i:23;s:9:\"why_title\";i:24;s:12:\"why_subtitle\";i:25;s:17:\"testimonial_label\";i:26;s:17:\"testimonial_title\";i:27;s:20:\"testimonial_subtitle\";i:28;s:8:\"cta_pill\";i:29;s:9:\"cta_title\";i:30;s:12:\"cta_subtitle\";i:31;s:10:\"cta_button\";i:32;s:19:\"services_page_title\";i:33;s:22:\"services_page_subtitle\";i:34;s:17:\"galeri_page_title\";i:35;s:20:\"galeri_page_subtitle\";i:36;s:20:\"testimoni_page_title\";i:37;s:23:\"testimoni_page_subtitle\";i:38;s:14:\"faq_page_title\";i:39;s:17:\"faq_page_subtitle\";i:40;s:18:\"artikel_page_title\";i:41;s:21:\"artikel_page_subtitle\";i:42;s:11:\"footer_text\";i:43;s:22:\"footer_contact_heading\";i:44;s:20:\"footer_links_heading\";i:45;s:12:\"footer_links\";i:46;s:16:\"footer_copyright\";i:47;s:8:\"og_image\";i:48;s:8:\"og_title\";i:49;s:14:\"og_description\";i:50;s:7:\"og_type\";i:51;s:12:\"og_site_name\";i:52;s:12:\"twitter_card\";i:53;s:13:\"twitter_title\";i:54;s:19:\"twitter_description\";i:55;s:13:\"twitter_image\";i:56;s:13:\"canonical_url\";i:57;s:6:\"robots\";i:58;s:24:\"google_site_verification\";i:59;s:22:\"bing_site_verification\";i:60;s:19:\"google_analytics_id\";i:61;s:21:\"google_tag_manager_id\";i:62;s:14:\"schema_enabled\";i:63;s:8:\"org_name\";i:64;s:8:\"org_logo\";i:65;s:9:\"org_phone\";i:66;s:9:\"org_email\";i:67;s:11:\"org_address\";i:68;s:11:\"org_geo_lat\";i:69;s:11:\"org_geo_lng\";i:70;s:15:\"sitemap_enabled\";i:71;s:9:\"seo_title\";i:72;s:15:\"seo_description\";i:73;s:12:\"seo_keywords\";i:74;s:16:\"social_instagram\";i:75;s:15:\"social_facebook\";i:76;s:14:\"social_youtube\";i:77;s:13:\"social_tiktok\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1788244291);

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
(2, 'Visa', 'visa', '📋', 'Proses cepat & aman', NULL, NULL, 2, 1, 'catalog', 'Jenis', 'Visa', '<br>', 'Visa Umroh', 'Pengurusan visa umroh cepat dan terpercaya.', 'visa umroh, paspor umroh, syarat visa', '2026-07-28 05:53:02', '2026-09-01 00:18:40'),
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

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `nama`, `no_hp`, `alamat`, `status`, `sumber`, `layanan`, `item`, `counts`, `created_at`, `updated_at`) VALUES
(41, 'Martadi', '0876786568', NULL, 'baru', 'Hotel', 'Mekkah', 'Swissôtel Al Maqam', 1, '2026-08-31 13:38:12', '2026-08-31 13:38:12');

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

--
-- Dumping data untuk tabel `customer_status_histories`
--

INSERT INTO `customer_status_histories` (`id`, `customer_id`, `status`, `catatan`, `user_id`, `created_at`, `updated_at`) VALUES
(73, 41, 'baru', NULL, NULL, '2026-08-31 13:38:13', '2026-08-31 13:38:13');

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
(71, '2026_08_16_000000_add_page_type_to_categories_table', 43),
(72, '2026_08_31_000000_add_hotel_fields_to_service_items_table', 44),
(73, '2026_08_31_000001_drop_date_columns_from_service_items_table', 45),
(74, '2026_08_31_000002_add_detail_fields_to_service_items_table', 46),
(75, '2026_09_01_000000_clear_visa_images', 47);

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
(131, 1, 'Mekkah', 'mekkah', 'services/QXSW5nK4e2Pi9n0L4rWViI3nrHAxxltdqlH9Zi2w.jpeg', 'Rekomendasi hotel untuk jamaah umroh di area Masjidil Haram', '', NULL, NULL, NULL, NULL, NULL, '🏨', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:07', '2026-08-31 05:41:09'),
(132, 1, 'Madinah', 'madinah', 'services/dXPaD2eu5VRtwOsMZNs2OE7YhyOW7yrwjfHghDdn.jpg', 'Rekomendasi hotel untuk jamaah umroh di area Masjid Nabawi', '', NULL, NULL, NULL, NULL, NULL, '🕌', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:07', '2026-08-31 05:55:09'),
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
(150, 15, 'Sewa Kursi Roda', 'kursi-roda-sewa', 'services/sewa-kursi-roda-gdChd1.jpg', 'Sewa kursi roda untuk jamaah lansia / berkebutuhan khusus', NULL, NULL, NULL, NULL, 100000.00, NULL, '♿', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:23'),
(151, 11, 'Semua Jenis Kegiatan', 'foto-semua-kegiatan', 'services/semua-jenis-kegiatan-XuSxhr.jpg', 'Dokumentasi semua kegiatan ibadah', NULL, NULL, NULL, NULL, 300000.00, NULL, '📸', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:23'),
(152, 11, 'Khandamah & Kudai', 'foto-khandamah', 'services/khandamah-kudai-MvCv6A.jpg', 'Sesi foto di area Khandamah & Kudai', NULL, NULL, NULL, NULL, 300000.00, NULL, '📸', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:23'),
(153, 11, 'Pelataran', 'foto-pelataran', 'services/pelataran-A7YO4H.jpg', 'Sesi foto di pelataran Masjidil Haram', NULL, NULL, NULL, NULL, 300000.00, NULL, '📸', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:23'),
(154, 12, 'Penukaran Riyal', 'penukaran-riyal', 'services/penukaran-riyal-I5D7bB.jpg', 'Penukaran uang Riyal Saudi dengan rate terbaik', NULL, NULL, NULL, NULL, NULL, NULL, '💵', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:24'),
(155, 16, 'Muthawif Per Hari', 'muthawif-per-hari', 'services/muthawif-per-hari-pLAipn.jpg', 'Pembimbing ibadah muthawif selama di Tanah Suci', NULL, NULL, NULL, NULL, 250000.00, NULL, '🕋', NULL, NULL, NULL, NULL, NULL, 1, '2026-08-19 06:55:08', '2026-08-19 06:55:24'),
(156, 2, 'Visa Umroh', 'visa-umroh', NULL, 'Pengurusan visa umroh cepat & terpercaya', NULL, NULL, NULL, NULL, NULL, NULL, '📋', NULL, NULL, NULL, NULL, NULL, 1, '2026-09-01 01:22:38', '2026-09-01 01:41:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service_items`
--

CREATE TABLE `service_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `whatsapp` varchar(20) DEFAULT NULL,
  `wa_message` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `star` tinyint(4) DEFAULT NULL,
  `distance` decimal(8,1) DEFAULT NULL,
  `meals` varchar(255) DEFAULT NULL,
  `room_type` varchar(255) DEFAULT NULL,
  `price_per_night` decimal(15,2) DEFAULT NULL,
  `price_max` decimal(15,2) DEFAULT NULL,
  `map_link` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `walk_time` varchar(255) DEFAULT NULL,
  `room_types` varchar(255) DEFAULT NULL,
  `benefit` text DEFAULT NULL,
  `recommendation` text DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `service_items`
--

INSERT INTO `service_items` (`id`, `slug`, `service_id`, `title`, `image`, `description`, `sort`, `whatsapp`, `wa_message`, `status`, `star`, `distance`, `meals`, `room_type`, `price_per_night`, `price_max`, `map_link`, `area`, `walk_time`, `room_types`, `benefit`, `recommendation`, `gallery`, `created_at`, `updated_at`) VALUES
(136, 'nasi-box', 97, 'Nasi Box', 'service-items/kedatangan-nasi-box-wysLB1.jpg', '<p>Paket makanan lengkap dalam kemasan praktis yang terdiri dari nasi, lauk, sayuran, dan pelengkap. Cocok untuk konsumsi jamaah setelah tiba di Indonesia.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-05 03:03:37', '2026-08-19 06:55:28'),
(137, 'snack-box', 97, 'Snack Box', 'service-items/kedatangan-snack-box-DIBvJY.jpg', '<p>Paket makanan ringan yang berisi pilihan kue, makanan ringan, dan minuman. Praktis untuk diberikan kepada jamaah sebagai makanan pendamping setelah perjalanan panjang.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-05 03:03:37', '2026-08-19 06:55:28'),
(139, 'nasi-box-perjalanan', 98, 'Nasi Box Perjalanan', 'service-items/kepulangan-nasi-box-perjalanan-EHqzIp.jpg', '<p>Paket makanan lengkap yang dikemas praktis untuk dibawa selama perjalanan menuju bandara atau titik keberangkatan.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-05 03:03:37', '2026-08-19 06:55:28'),
(140, 'snack-perjalanan', 98, 'Snack Perjalanan', 'service-items/kepulangan-snack-perjalanan-XZb1HF.jpg', '<p>Paket makanan ringan yang praktis dibawa dan dikonsumsi jamaah selama perjalanan menuju bandara maupun saat menunggu keberangkatan.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-05 03:03:37', '2026-08-19 06:55:28'),
(214, 'swissotel-al-maqam', 131, 'Swissôtel Al Maqam', 'service-items/Ozb07KA2JMx59IUkQ8rnvf1vyIDcAZVajtnyGgqn.jpeg', '<p><span style=\'font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\'>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</span></p>', 1, NULL, NULL, 1, 3, 3300.0, 'Room Only', 'Triple', 200.00, 300.00, NULL, 'Ajyad', '8-10 menit', 'Double, Triple, Quad', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, \r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '<p>\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\" \"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...\"</p>', '[\"service-items\\/bSuxI67wgrDbvcweklc0N7aV8qhmZkMzotpsH7JD.jpeg\",\"service-items\\/wKo1dRMUtujcvKKOXxeEXuDB0vgk44yaGAZ03xOR.jpg\"]', '2026-08-19 06:55:09', '2026-08-31 15:23:21'),
(215, 'pullman-zamzam', 131, 'Pullman ZamZam', 'service-items/FWdcXT7TxQQFbMtXSxp7FyS7X4j0kCVHwCsQ80xB.jpeg', '<p>Hotel bintang 5 menghadap Masjidil Haram, hanya beberapa langkah dari gerbang utama. Dilengkapi restoran halal dan layanan 24 jam.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:09', '2026-08-31 05:57:28'),
(216, 'anjum-hotel', 131, 'Anjum Hotel', 'service-items/Bpx5gDcpS0sK8gtUfKL7dmqxosAuQwAZPBuXClRe.jpeg', '<p>Hotel bintang 5 di jantung Mekkah dengan pemandangan Masjidil Haram dari lantai atas, fasilitas rooftop dan akses mudah ke area tawaf.</p>', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:09', '2026-08-31 05:58:25'),
(217, 'madinah-hilton', 132, 'Madinah Hilton', 'service-items/zAb6tLdhadsgPDiQMOMKx3kxUCD2UxblHueyCTw6.jpeg', '<p>Hotel bintang 5 berhadapan langsung dengan Masjid Nabawi. Lokasi strategis dengan pemandangan Raudhah dan layanan kamar prima.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:09', '2026-08-31 05:58:50'),
(218, 'movenpick-anwar-al-madinah', 132, 'Mövenpick Anwar Al Madinah', 'service-items/EgBgvM2V7yjhnZItOj7zW9ktuHf39m6q8UoGnlKV.jpg', '<p>Hotel bintang 5 di seberang Masjid Nabawi, setiap kamar menghadap ke kompleks masjid. Berdekatan dengan area ziarah utama.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:09', '2026-08-31 05:59:13'),
(219, 'dar-al-taqwa', 132, 'Dar Al Taqwa', 'service-items/WU7d13BI1GtWcSXE8NYH9gii8ucf85ETSMUXcpBb.jpeg', '<p>Hotel bintang 5 berada tepat di halaman Masjid Nabawi, akses paling mudah untuk menunaikan shalat berjamaah dan ziarah.</p>', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:09', '2026-08-31 05:59:37'),
(223, 'shalawat-pagi', 135, 'Shalawat Pagi', 'service-items/bus-shalawat-shalawat-pagi-TeSHzE.jpg', '<p>Antar-jemput bus dari hotel ke Masjidil Haram setiap pagi dengan armada nyaman dan berpendingin.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:09', '2026-08-19 06:55:32'),
(224, 'shalawat-malam', 135, 'Shalawat Malam', 'service-items/bus-shalawat-shalawat-malam-dCtypN.jpg', '<p>Layanan bus antar-jemput pada waktu shalat malam, memudahkan jamaah menjangkau Masjidil Haram dengan aman.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:09', '2026-08-19 06:55:32'),
(225, 'shalawat-harian', 135, 'Shalawat Harian', 'service-items/bus-shalawat-shalawat-harian-dmxKAy.jpg', '<p>Paket antar-jemput sepanjang hari untuk jamaah dengan mobilitas terbatas, jadwal fleksibel sesuai kebutuhan grup.</p>', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:09', '2026-08-19 06:55:33'),
(226, 'sewa-bus-grup-24-jam', 136, 'Sewa Bus Grup 24 Jam', 'service-items/sewa-bus-24-jam-sewa-bus-grup-24-jam-8PiQfF.jpg', '<p>Sewa bus ekslusif 24 jam untuk kebutuhan perjalanan grup, ziarah, dan perpindahan antar kota dengan armada bersih dan berpengalaman.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:09', '2026-08-19 06:55:33'),
(227, 'sewa-hiace-keluarga', 137, 'Sewa Hiace Keluarga', 'service-items/toyota-hiace-sewa-hiace-keluarga-DCnocd.jpg', '<p>Sewa Toyota Hiace untuk perjalanan keluarga atau grup kecil, sopir berpengalaman untuk rute dalam kota maupun antar kota.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:09', '2026-08-19 06:55:33'),
(228, 'paket-nasi-ayam-kabsah', 142, 'Paket Nasi Ayam Kabsah', 'service-items/kedatangan-paket-nasi-ayam-kabsah-WGomFQ.jpg', '<p>Nasi kabsah dengan ayam khas Timur Tengah, disajikan hangat saat kedatangan jamaah di bandara.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:09', '2026-08-19 06:55:34'),
(229, 'paket-nasi-kebuli', 142, 'Paket Nasi Kebuli', 'service-items/kedatangan-paket-nasi-kebuli-j9UajP.jpg', '<p>Nasi kebuli gurih dengan daging pilihan, hidangan pembuka yang mengenyangkan untuk jamaah yang baru tiba.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:10', '2026-08-19 06:55:34'),
(230, 'paket-snack-box', 142, 'Paket Snack Box', 'service-items/kedatangan-paket-snack-box-sRGKFO.jpg', '<p>Snack box praktis berisi roti, buah, dan minuman untuk jamaah dalam perjalanan.</p>', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:10', '2026-08-19 06:55:34'),
(231, 'paket-nasi-ayam-kabsah-2', 143, 'Paket Nasi Ayam Kabsah', 'service-items/kepulangan-paket-nasi-ayam-kabsah-Ht9xdD.jpg', '<p>Nasi kabsah dengan ayam khas Timur Tengah untuk bekal jamaah sebelum penerbangan pulang.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:10', '2026-08-19 06:55:34'),
(232, 'paket-nasi-mandhi', 143, 'Paket Nasi Mandhi', 'service-items/kepulangan-paket-nasi-mandhi-BytwsZ.jpg', '<p>Nasi mandhi dengan daging yang mengenyangkan, pilihan tepat sebagai bekal kepulangan jamaah.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:10', '2026-08-19 06:55:34'),
(233, 'paket-snack-box-2', 143, 'Paket Snack Box', 'service-items/kepulangan-paket-snack-box-eE4yqA.jpg', '<p>Snack box ringan dan higienis untuk perjalanan pulang jamaah umroh.</p>', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:10', '2026-08-19 06:55:34'),
(249, 'cuci-reguler', 144, 'Cuci Reguler', 'service-items/laundry-kilat-cuci-reguler-0Hn5ZR.jpg', '<p>Pilihan Cuci Reguler dari Laundry Kilat yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:24', '2026-08-19 06:55:34'),
(250, 'setrika-express', 144, 'Setrika Express', 'service-items/laundry-kilat-setrika-express-7Vt8Nh.jpg', '<p>Pilihan Setrika Express dari Laundry Kilat yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:24', '2026-08-19 06:55:35'),
(251, 'laundry-harian', 144, 'Laundry Harian', 'service-items/laundry-kilat-laundry-harian-a6RuRm.jpg', '<p>Pilihan Laundry Harian dari Laundry Kilat yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:24', '2026-08-19 06:55:35'),
(252, 'sewa-harian', 145, 'Sewa Harian', 'service-items/buggy-car-area-haram-sewa-harian-VkPyNl.jpg', '<p>Pilihan Sewa Harian dari Buggy Car Area Haram yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:24', '2026-08-19 06:55:35'),
(253, 'sewa-paket-per-jam', 145, 'Sewa Paket Per Jam', 'service-items/buggy-car-area-haram-sewa-paket-per-jam-SWtfeP.jpg', '<p>Pilihan Sewa Paket Per Jam dari Buggy Car Area Haram yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:25', '2026-08-19 06:55:35'),
(254, 'buggy-vip', 145, 'Buggy VIP', 'service-items/buggy-car-area-haram-buggy-vip-bs9dks.jpg', '<p>Pilihan Buggy VIP dari Buggy Car Area Haram yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:25', '2026-08-19 06:55:35'),
(255, 'kursi-roda-reguler', 150, 'Kursi Roda Reguler', 'service-items/sewa-kursi-roda-kursi-roda-reguler-hXoysx.jpg', '<p>Pilihan Kursi Roda Reguler dari Sewa Kursi Roda yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:25', '2026-08-19 06:55:37'),
(256, 'kursi-motor-wheelchair', 150, 'Kursi Motor Wheelchair', 'service-items/sewa-kursi-roda-kursi-motor-wheelchair-r77IBa.jpg', '<p>Pilihan Kursi Motor Wheelchair dari Sewa Kursi Roda yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:25', '2026-08-19 06:55:38'),
(257, 'kursi-roda-premium', 150, 'Kursi Roda Premium', 'service-items/sewa-kursi-roda-kursi-roda-premium-XY5Wwj.jpg', '<p>Pilihan Kursi Roda Premium dari Sewa Kursi Roda yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:25', '2026-08-19 06:55:38'),
(258, 'riyal-cash', 154, 'Riyal Cash', 'service-items/penukaran-riyal-riyal-cash-heLkan.jpg', '<p>Pilihan Riyal Cash dari Penukaran Riyal yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:27', '2026-08-19 06:55:40'),
(259, 'dolar-ke-riyal', 154, 'Dolar ke Riyal', 'service-items/penukaran-riyal-dolar-ke-riyal-jBZREL.jpg', '<p>Pilihan Dolar ke Riyal dari Penukaran Riyal yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:27', '2026-08-19 06:55:40'),
(260, 'kirim-uang', 154, 'Kirim Uang', 'service-items/penukaran-riyal-kirim-uang-nBX8lD.jpg', '<p>Pilihan Kirim Uang dari Penukaran Riyal yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:27', '2026-08-19 06:55:40'),
(261, 'pendampingan-harian', 155, 'Pendampingan Harian', 'service-items/muthawif-per-hari-pendampingan-harian-ll72jj.jpg', '<p>Pilihan Pendampingan Harian dari Muthawif Per Hari yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:28', '2026-08-19 06:55:40'),
(262, 'pendamping-ziarah', 155, 'Pendamping Ziarah', 'service-items/muthawif-per-hari-pendamping-ziarah-I5sYxl.jpg', '<p>Pilihan Pendamping Ziarah dari Muthawif Per Hari yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:28', '2026-08-19 06:55:40'),
(263, 'pendamping-manasik', 155, 'Pendamping Manasik', 'service-items/muthawif-per-hari-pendamping-manasik-y4B8lN.jpg', '<p>Pilihan Pendamping Manasik dari Muthawif Per Hari yang nyaman dan terpercaya untuk perjalanan ibadah Anda.</p>', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-19 06:55:28', '2026-08-19 06:55:41'),
(271, 'visa-umroh', 156, 'Visa Umroh', 'service-items/zIuWGMJcw5P3wXdkUmML6aMQdN6AZAFKTpQwWqws.webp', '<p>Visa Umroh reguler dengan pengurusan cepat, aman, dan terpercaya oleh DUYUFUNA.</p>', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, 300.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-01 01:23:05', '2026-09-01 01:59:17'),
(272, 'visa-umroh-group-group', 156, 'Visa Umroh Group Group', NULL, '<p>Visa Umroh Group Group untuk rombongan dengan harga khusus dan pengurusan kolektif.</p>', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, 250.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-01 01:23:05', '2026-09-01 01:41:25'),
(273, 'visa-umroh-group-bis', 156, 'Visa Umroh Group + Bis', NULL, '<p>Visa Umroh Group + Bis untuk rombongan dengan layanan tambahan bis transportasi.</p>', 3, NULL, NULL, 1, NULL, NULL, NULL, NULL, 350.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-01 01:23:05', '2026-09-01 01:41:25'),
(274, 'visa-individu', 156, 'Visa Individu', NULL, '<p>Visa Individu untuk perjalanan umroh mandiri dengan pengurusan personal.</p>', 4, NULL, NULL, 1, NULL, NULL, NULL, NULL, 400.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-01 01:23:05', '2026-09-01 01:41:25'),
(275, 'visa-transit-saudi', 156, 'Visa Transit Saudi', NULL, '<p>Visa Transit Saudi untuk singgah sementara di Arab Saudi dalam perjalanan.</p>', 5, NULL, NULL, 1, NULL, NULL, NULL, NULL, 150.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-01 01:23:05', '2026-09-01 01:41:25'),
(276, 'visa-brn-hotel', 156, 'Visa BRN + Hotel', NULL, '<p>Visa BRN + Hotel, paket visa dengan akomodasi hotel di Tanah Suci.</p>', 6, NULL, NULL, 1, NULL, NULL, NULL, NULL, 500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-01 01:23:05', '2026-09-01 01:41:25'),
(277, 'visa-longstay-shorstay', 156, 'Visa Longstay/Shorstay', NULL, '<p>Visa Longstay/Shorstay untuk tinggal jangka panjang atau pendek di Arab Saudi.</p>', 7, NULL, NULL, 1, NULL, NULL, NULL, NULL, 600.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-01 01:23:05', '2026-09-01 01:41:25');

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
('0y62Ut5hZDXknTrYGII0Ec3QVSzY5jVMSFUSNP4t', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmhoZ0t2a2FGYml0aGo4ZngwWnJpemlwelIyRkd4eXZqMUdzdEZ0UyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvc3dpc3NvdGVsLWFsLW1hcWFtIjtzOjU6InJvdXRlIjtzOjExOiJkZXRhaWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788227434),
('1ak77rtja7nJi8knJ8TY4KHfMCOo2kBNoiicYWi7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidUdnVEtPbnRrY2VYcFpjazZHVnZ5bU5XcGhJR2p1UkZyVzM1V3RzRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODEzOS9hcnRpY2xlcyI7czo1OiJyb3V0ZSI7czoxNDoiYXJ0aWNsZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788237097),
('1JBezlILtUc8U74qVf2hnBeWhZM8N5QhBxQycrIE', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV09qU0R2TEdDOGtNdGc0TDRDeGVtRXlidndqQ1ZMQnkxMTJPNDdmcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788227028),
('3ItXltSZTsUa4KjmW9dTDrmpK07ed2KoELm5Cvhj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDAwZzVnd1djd2hEcWJJYnFRWlhWWk4yMXBxRkt6Qm51YXRKQktmWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MC9jYXRlZ29yeS9ob3RlbC9tZWtrYWgiO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788239908),
('3yAL5brorsAtJqCCXbnzIdUAG2ewlGqApkbNyCq4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazZwNXd5RU53UUhCQzlNdDBuakVNOGFsVXNsSzhlQ1hyTjFCMDFuNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODEzOS90ZXN0aW1vbmkiO3M6NToicm91dGUiO3M6MTU6InBhZ2VzLnRlc3RpbW9uaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788237192),
('4G3vDHEyjEbAfFhL9lebJ86UeNgFnzsabFEGjYP6', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUY0MlVGMkVCSEN6a0UwSmxlSk5BTTBnYlgyanBYQndYOXBhSk9tTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788225867),
('62OuHvTsUZgsAkkAbJ8JIpZpctS8QQhuqFUbdgN0', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblJPdmNmTjYzdDlqcDVRNWJuRVV5RDlXTTEyMlZ3Z2FGc05uRWdyZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS9ob3RlbCI7czo1OiJyb3V0ZSI7czoxMzoiY2F0ZWdvcnkuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788225852),
('6MQ8eufOgbvbiPbx1o5YmY8d9muVzJC7gQtOTvL6', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2k5aEpzZUdjRnZ1SEdwSDIyWEs4TkxMcFpZM2RoTUJjOEpmU01zeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvdmlzYS1sb25nc3RheS1zaG9yc3RheSI7czo1OiJyb3V0ZSI7czoxMToiZGV0YWlsLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788225850),
('77KqiGo8bTGiP1jczYoigrvZg4TA0gm0FTJWUdfP', 32, '127.0.0.1', 'curl/8.21.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibzZYRmt4RXl3NERzQVl0WDgxdE5tUld3aFJYZWJ2MFV5TmhZQnBFVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi90ZXN0aW1vbmlhbHMvY3JlYXRlIjtzOjU6InJvdXRlIjtzOjI1OiJhZG1pbi50ZXN0aW1vbmlhbHMuY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzI7fQ==', 1788230062),
('7kmgTC6BVB4nRp7Es8HMMZJRljChYlgZrvRV6W2D', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWE1IUFMzZUJ4bGQ3Q2liQVRpS0NnOHhZb3lHRGVZYjZqVm1DU0hZaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788225845),
('8z8QVw57pp1Q49ndJBLG1EcUrLFIBMmjrWFXok29', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlR4RDcyV0FUSUM5dlBoWlRrZFU1TDdBZXZmUmdDSzA0bmtkanZIYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788242256),
('9cgAM6jLhfdVe5ibK5oFkq35d0p3YsQH8EM6v1m7', NULL, '127.0.0.1', 'curl/8.21.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR1ZHWEVjaTMycXBkdWw5R3RLR3M1NnRsYkZOWUtvNDNJR01UUW90RyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi9jYXRhbG9nLzIvdmlzYS11bXJvaCI7czo1OiJyb3V0ZSI7czoxOToiYWRtaW4uY2F0YWxvZy5pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi9jYXRhbG9nLzIvdmlzYS11bXJvaCI7fX0=', 1788227284),
('a7SaIC1zj85dD4jNjqbRZ41sUQbXNLXhV86HdJrs', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFZ0N1ZmTTZZODZyWVl6OHhvQnhjUzhCTkV0cXdxd1J2RlEwQ3VKNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788225869),
('A8Hoo6WDAqiTorvYL1mBPVpvPYmaXoMWafPgzxA3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUktBd3lZaUV1bjdSZU1RYURjd2Z3alc0ZGNJYWdKQnBlMVdZc0prTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MC9jYXRlZ29yeS9ob3RlbC9tZWtrYWgiO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788239993),
('AbMWi911D99qRYEjZEddI9OgMHqU5Hn3X1MxQ4tD', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzZIYXIyOXNyNVdzdDlHbHBlaHNyNmxSbnAzUWVmWTFKTHpmcmx3UyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS9ob3RlbCI7czo1OiJyb3V0ZSI7czoxMzoiY2F0ZWdvcnkuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788227411),
('ACj8TBDDtR48hxe4Flug1NpoKaW7WsKa1VeP1kIx', 32, '127.0.0.1', 'curl/8.21.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZEhjbGh6TmJqVWtBR3owb0htZlRJQUhGaGV4Q28yQ1dFS0ZSS25HZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi9jYXRhbG9nLzIvMTU2IjtzOjU6InJvdXRlIjtzOjE5OiJhZG1pbi5jYXRhbG9nLml0ZW1zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzI7fQ==', 1788230120),
('Ah2kWX4NGo9LqHT8ot2F8DbRYXtyJb0wniRsBNI4', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekkxYklDaTF5RnJ0cmlFd1dVdmlqSndRdVc5ZnhBbVpCMWRUalgxdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788225871),
('apxjp7tBGWqsJTlZ7vVAPCJR8nIDXj7KrS5XDpOF', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjg2aEtNMnBQcFlQaTVzNTdzWjhFODYwVFBSNGZLT0N5MUg2Sm1VMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS9ob3RlbCI7czo1OiJyb3V0ZSI7czoxMzoiY2F0ZWdvcnkuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788227478),
('BlIRzM5OlrrXcte1hpaJEqZOSUuMLhKOd2wvGRKR', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGpHanNMRk1xRkwzWE5kclJqNXlIbjFKQ29GNnlPMDZWV1V1RUZ2cSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvdmlzYS1sb25nc3RheS1zaG9yc3RheSI7czo1OiJyb3V0ZSI7czoxMToiZGV0YWlsLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788225891),
('BYDvTfnwQe43kjmiD6gbUwsoIwHsX9kpyGjrWzxb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGdnbHF3STFhZzRDamJ5Rkx0bnNYVWhkdHowOTRwTGliQWVndFV0NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MS9kZXRhaWwvc3dpc3NvdGVsLWFsLW1hcWFtIjtzOjU6InJvdXRlIjtzOjExOiJkZXRhaWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788242254),
('cs41E7iS874L3MvXAr7g30GEhaQvHSTrqSZwa6ru', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXhWWFFLOGtROUtOQ2xKdjdvMEtiSnRvYkIzZExWZjh3UXVUTUhzVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS90ZXN0aW1vbmkiO3M6NToicm91dGUiO3M6MTU6InBhZ2VzLnRlc3RpbW9uaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788229787),
('cSIPqrRh4Nin0hpJtddBEAfsaSyTHh7wwjst9ka6', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1NUSHpqUnhyR1hHVU10UTNuSDdFOG9xZjREa1FheXhLWHhqOHpvUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788225865),
('DKgICepZfVkACJ61pNvGIDJW8ZBhdc7FYqgSUrEv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmQyRjloeElHdzR6Rk1CZ1ZHUldCVFBuWjc1VFBNUXhRdTlxR205RyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MC9hcnRpY2xlcy9wYW5kdWFuLXBlcnNpYXBhbi11bXJvaCI7czo1OiJyb3V0ZSI7czoxMzoiYXJ0aWNsZXMuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788239936),
('eGD3the1vxZMztCze4bGAO1C63heozNKiD6gSph4', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUFRLcHZQcjlmaFdWNzJzU3lmY0RlQXI2TmdSbmZWd08yOWxJbHh6RSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXRhaWwvc3dpc3NvdGVsLWFsLW1hcWFtIjtzOjU6InJvdXRlIjtzOjExOiJkZXRhaWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1788242444),
('eJIzkx6hgYIfVJu7XyydFZIcFuqQ5y9ECpEpmTjq', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1dRV2dOb2dleExxZWhZazFYeDdjOURkS0VVazFLNHpMRDJmOXVLeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhIjtzOjU6InJvdXRlIjtzOjEzOiJjYXRlZ29yeS5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788228274),
('eoZzwTsTr4CAKBfvEXu092MAuGTrmyJojOR3OO6b', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUE5GUnJSZmJFUHVwWklWcVgwcnV3UUZHaHJyTVFzWlFtdWhITXQyTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS9ob3RlbCI7czo1OiJyb3V0ZSI7czoxMzoiY2F0ZWdvcnkuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788227462),
('eq3cKhGNtG0Sorx7X5lSkcWpGa90lvrR49GtLa9t', 32, '127.0.0.1', 'curl/8.21.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZTBhUkJYakJjeTFGUVBJTTk4TDQxaVF1SktaSm0wVG44T3RxcnltcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi9jYXRhbG9nLzEiO3M6NToicm91dGUiO3M6MjA6ImFkbWluLmNhdGFsb2cuZ3JvdXBzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzI7fQ==', 1788227370),
('Fau65ksAVapMEhPS1LaWmkj0qnYgvx23hzTO04SQ', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicFdmbExyczliYTRrelc5Zmdpb2J0NjBRMEFidmcydks3ZmtQY2VROCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvc3dpc3NvdGVsLWFsLW1hcWFtIjtzOjU6InJvdXRlIjtzOjExOiJkZXRhaWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788229785),
('FsjV3hi0eqTlR4mUmwWpTVuo4K6Nx1HFbWPXWiMU', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2g0b1o2Q0QxSVY1SjBzanM1UGR0ZzlTQzdnTXFrQXRUcWkzVlNENSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hcnRpY2xlcyI7czo1OiJyb3V0ZSI7czoxNDoiYXJ0aWNsZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788229861),
('Fxlc8z8xYhmtV6GucLtS5QXEzC9TKJpE03lPoAXK', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMFU0NmsxeTQwZTBZSTFBeDE3VDdpUFhNU3JYMVFBZmVERWM2UElGQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9zZXJ2aWNlL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTQ6InNlcnZpY2UuZGV0YWlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788229782),
('GYxgygqZisFqiVVUPfwoxgnM005q9rMdkx4m1sLD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiajhCRUN0YVpudUphbDYwZ1ZUUVdJNFZJM2dtZlNlOHdsdXNiQ0UxYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788242220),
('HUrzP1FGcPWngu6vRSnZwz0VXcSgoPKSgWdHjvve', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMFBxM0IwMXF2UE1KVDh1c3NHU0pMT0MyVVNSanRFR1pFUTM4SHhFbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhIjtzOjU6InJvdXRlIjtzOjEzOiJjYXRlZ29yeS5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788229776),
('hZWd0VXjOESN3kNTFhDw1Jm5lMwW7o3bxve1xZCL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmZ0dzE5bWlFeFVCMGY3RmxUUm92U211Z2kzV0xXdFcxRjNsZ2xhNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MS9jYXRlZ29yeS9ob3RlbC9tZWtrYWgiO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788242252),
('k0SCbSiPbHvCXSYZRg2BFj5Jhmv5qDMDANXiVKhI', NULL, '127.0.0.1', 'curl/8.21.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicXg3Y0VyUkhjNmpab2Z6a2xQbkVPdkkyV0h5Z1QxM25FRnVJWjlDZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi9jYXRhbG9nLzIvdmlzYS11bXJvaCI7czo1OiJyb3V0ZSI7czoxOToiYWRtaW4uY2F0YWxvZy5pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi9jYXRhbG9nLzIvdmlzYS11bXJvaCI7fX0=', 1788227096),
('KgebzANPe8tKm7TYMRiT5AVe9jBOXOyQxDHw3ZXJ', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDNCNDhCS3hjUktvYjhoMXhGa2MyNkJYU3ZRV0xxOWNsWkZzMEQyOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788225911),
('KGHTL7DZQ59DoqqNVy3YDtCgZKGCmkAfSLxQ9QIM', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibloxNEt4d05oblpvVUlJT2JtOHQ2TU5XZ1k2UXBLQTBSb0xuSkFHcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvdmlzYS11bXJvaCI7czo1OiJyb3V0ZSI7czoxMToiZGV0YWlsLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788226999),
('l32KWpxlZwGVl6GZtmsnKd5KEXqT0CbQeRiLvQ68', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSTMwSWdkMkcxMG5RdGZnNWhna09ZekNOTzg1dkV3YVFtNnNJdFVDZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvdmlzYS11bXJvaCI7czo1OiJyb3V0ZSI7czoxMToiZGV0YWlsLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788228314),
('lMaabmHUvbg4iRUiBwu6S2VTbthSRw4gQCFTGfG1', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2M0VDlLeGRlNVJXTkpWRzVYSTZIb2JPMjVkSEF5MXBCUE42Uk80diI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS9ob3RlbCI7czo1OiJyb3V0ZSI7czoxMzoiY2F0ZWdvcnkuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788227409),
('LyLIIWOOJDgwEbu0i7OGkMqzeU9qdP09n4Rz7vH4', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUhXWEFraGdaaHlQNDdoUzlVWjFOT1Nzd0J6MWNvZjY3cTl3MEZJeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS90ZW50YW5nLWthbWkiO3M6NToicm91dGUiO3M6MTM6InBhZ2VzLnRlbnRhbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788227430),
('M0f8ihZNbtmjMpAtFeqXFcstSnc8Pt1EWcCZ074C', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieFJFUm9nMGs3eEFVc3RzNm9qVEpydmN0NklodDBtVHprU01ObmY0NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhIjtzOjU6InJvdXRlIjtzOjEzOiJjYXRlZ29yeS5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788228284),
('M1cTBgHUpBhBmGkJ1Xte8EBBQAaTHynSW7zIEHcA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUh3eWZXcFcwajN4UDk0d1liNXp1TmR5amd2NW1ISWh2Z1lZaGxSdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MC90ZXN0aW1vbmkiO3M6NToicm91dGUiO3M6MTU6InBhZ2VzLnRlc3RpbW9uaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788239986),
('mEgBUgRbR1gNd3jABeoca3yT1R53WTgddhlEDU4s', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUphb0owakNSSUpPT3lkYWtvd3dNRnAyRzluMzJiWTk3N3JQRktOZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MC9jYXRlZ29yeS9ob3RlbC9tYWRpbmFoIjtzOjU6InJvdXRlIjtzOjE2OiJjYXRlZ29yeS5zZXJ2aWNlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788239927),
('Mqmr2leuXb4h0RtsovQ0zxKN38hlZLHhJ0bRRxzI', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNEZNZHpzSkkwNDA5MTJkU0J2MDhQSndVcjQ0NFBaVkUwQmdQRU04TyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvdmlzYS1icm4taG90ZWwiO3M6NToicm91dGUiO3M6MTE6ImRldGFpbC5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788225848),
('MyTyi6q8ZHGE9eFtnqTQFVPoxqfkndJl7IO3wTou', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmJITU1FSFhmaGNJTkRrU1p6YmdiWVFtWmZyZmQ4Wmd0NU1Zd2RUOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hcnRpY2xlcyI7czo1OiJyb3V0ZSI7czoxNDoiYXJ0aWNsZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788229801),
('N5dwTex66KJ8WxSSGe4awmhdxi5SlKluuFijWuFF', NULL, '127.0.0.1', 'curl/8.21.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUXZaU0NkZG16dVBmQnRZY0ROMkJrcWUzNGpxWVp4dDNBR2hDVnpWYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi9jYXRhbG9nLzIvdmlzYS11bXJvaCI7czo1OiJyb3V0ZSI7czoxOToiYWRtaW4uY2F0YWxvZy5pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi9jYXRhbG9nLzIvdmlzYS11bXJvaCI7fX0=', 1788227247),
('nDlqnH1qmExZ3YhzGeZhZMX7mhNfpeDAqygVFCbX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGtQYXhzdk1OVTlob2NCWDdydXFwWHRqbUVtb3ZKSFc5SnNqYXZhUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODEzOS90ZXN0aW1vbmkiO3M6NToicm91dGUiO3M6MTU6InBhZ2VzLnRlc3RpbW9uaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788237213),
('NjhFvgnztoL50rxpMmwq5x9fSunhcSNlHrpcyFVh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOG9maHRkeXh4VUU1UGt1QWpseUhEdGhPUXJnbDJtUklQdzFPQ3pPViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MS9kZXRhaWwvc3dpc3NvdGVsLWFsLW1hcWFtIjtzOjU6InJvdXRlIjtzOjExOiJkZXRhaWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788242276),
('oqMs5qfbXZtTUvVf9ydnktHlR0S7lOUYWYN3UyaQ', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTZ0bkJVYXNFd25Tb3JHWVV2aHZVNUFxQW9YQWRrb0VkNjY0UHRZdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhIjtzOjU6InJvdXRlIjtzOjEzOiJjYXRlZ29yeS5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788229796),
('pEuADeTtclTQXEZ7tSc27Of5VkfAZu2T1Dac5A04', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHk5Q1FVekFqR3lXSVZoWWc0VXNoa0hLWW84dFJheTRCSEQyblJ5WiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MC9kZXRhaWwvc3dpc3NvdGVsLWFsLW1hcWFtIjtzOjU6InJvdXRlIjtzOjExOiJkZXRhaWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788239920),
('pIOyIveWFqIwVBTGgK0FDRbU36FnIba6jsawp0j7', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFAxVkVpUW1PWlF0Y1hiaWx5dWRjQ1RabFBPQTg2SkRBWWNRZjFsbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9zZXJ2aWNlL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTQ6InNlcnZpY2UuZGV0YWlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788229912),
('pIS2H1TEHBIsyJV6IUCykjW7ujhEEV0JBS3LZvBF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTWNSMzk0alFsMThlbnBkdnZOMWMwNm81dmxQT1JvQTBhYm9KY0RMZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MS9jYXRlZ29yeS9ob3RlbC9tZWtrYWgiO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788242225),
('ppwyMQiaa76ZlxeBvzeVlI6dxbzTverlO7y31rLt', NULL, '127.0.0.1', 'curl/8.21.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUmpadzlnRHVHaWg3eWs0U2o5M1VMT0VveWIwSmpKZ0NRRUwxaWUxbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi9jYXRhbG9nLzIvdmlzYS11bXJvaCI7czo1OiJyb3V0ZSI7czoxOToiYWRtaW4uY2F0YWxvZy5pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi9jYXRhbG9nLzIvdmlzYS11bXJvaCI7fX0=', 1788227196),
('q7nqzsimsTWkvFJkMkwmSuN41eFsoeWai1KrstKz', NULL, '127.0.0.1', 'curl/8.21.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM0JJOGxJOXVjVFNZZ05HQmhlQnZwcWtvdjZvRXZ6YUJhTU1TWnJmbiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0ODoiaHR0cDovLzEyNy4wLjAuMTo4NzY1L2FkbWluL2NhdGFsb2cvMi92aXNhLXVtcm9oIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbi9jYXRhbG9nLzIvdmlzYS11bXJvaCI7czo1OiJyb3V0ZSI7czoxOToiYWRtaW4uY2F0YWxvZy5pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788225892),
('qOkQTw1HLQXVnCaz0H2es8qPelmhpDRuC7wVyZe9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieG5HQVVxRXIwVnlQT1dZQ2xFYmVKMllyRmVhZTdydk9KaEJyQmZIMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MS9kZXRhaWwvc3dpc3NvdGVsLWFsLW1hcWFtIjtzOjU6InJvdXRlIjtzOjExOiJkZXRhaWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788242227),
('qpbqKsqnO5srxn5iFEfZeej2C8YgGim4OTaxWNHd', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUW9zU1E4T1VLN2t6eU0yN1BpT2d5T0JNRnY2VUkyb2laWW9id1N3TyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788227378),
('qSU5Z6qgf8QtCcJSbBi7LFFkD9ksKMEQzEdkfJMa', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkdQN1FZZm1jUnAwNUdZUWpOcHpnQVdtbWVkeDNXWThTd0JUTU4weSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788226992),
('rMBTR4qc3MZH1JNrL7zv5xUKUuiTwmEVoLBkDdGd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMTNOYllMYjBGU3VBb2NoN3B1WlRKZlIwdWhoQWhsYjZ6N2xBdTFYZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MS90ZXN0aW1vbmkiO3M6NToicm91dGUiO3M6MTU6InBhZ2VzLnRlc3RpbW9uaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788242232),
('RSHmFeucNjcEZc7dvS5gLVCKWQGBKZeF3TGc94vd', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibnlxc2xZSTJPM3JXMHVxamh2QzlqY3Robm5JdnVjZzNtSk13NE0xcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhIjtzOjU6InJvdXRlIjtzOjEzOiJjYXRlZ29yeS5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788228281),
('slctBAZA5Q4GMF6fLShDGHilTNivmVDmUXUbTsSn', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDBXeE5kTVdTTmdrWm14a2RLRkgzUkJwUjJ3WGVZcW5iY1NqSWJQSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvc3dpc3NvdGVsLWFsLW1hcWFtIjtzOjU6InJvdXRlIjtzOjExOiJkZXRhaWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788229910),
('tOnAv2MnjbDL7uGsvQ4gtZvLjhioVhSD5f4U4M1w', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia3hlQmNXSkw0RUh1SGtoM1Y4dE1haVpmS1pYRU04RUZzcUdTUG5HWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788225873),
('tP4kQdogmLTwbkn6NouAOfdwWKUgIahJzheLHpwa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVN6MEZDNU1xSGdNUFpRelB4eThCclpKVkJJU2plRGxQd2gxYzQ1WSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MC9kZXRhaWwvc3dpc3NvdGVsLWFsLW1hcWFtIjtzOjU6InJvdXRlIjtzOjExOiJkZXRhaWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788240001),
('tRpUBb8iHYwoygS9tpSlRYiZjmyCD4wUApeBOn0s', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2t5SWVTaFpveVlPd2d1dm9DYWhRdGgxeTZoMUU2RGczeHlYNnF6dCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788227461),
('UnTDDvVmtyY846PLvs5A3MbcfGlJnyAO7TLv7hWK', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDd4THp2Y1hONFFKbFU2UTlFTDNFeWtBeTZncTVZOFQ5U0M0RnlpUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788227407),
('UQf7j31QsmWEhQYKA8CGQ0PilUsSB74sS5gtQaMr', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3ZhMU9CRkw0OVdyNURWMU9lNnR5SDBrZzZ2VmZOOUJjWFNqMmtHNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS9ob3RlbCI7czo1OiJyb3V0ZSI7czoxMzoiY2F0ZWdvcnkuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788228316),
('uVSUSXaJoxuB9NagxaZ8WtvCXKc5wP6zbQhjLiak', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDdLaE5mNHkzNmpCWUh2anNseGhBVFNVMFJ5V2UyQTlBZ09iWXVIOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhIjtzOjU6InJvdXRlIjtzOjEzOiJjYXRlZ29yeS5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788225843),
('V2wqDGBNY9aDI3qFFmWcr8BIAW9m0g0wsiy2q3OS', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidnpUMGZDU1ZnMWpFQUhaU0hob0pyVXAySkV5VHNCaEI3YzY1aWlhMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS9ob3RlbC9tZWtrYWgiO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788229793),
('vdz8l95boFBdufvftfM5IbifXvtCxClW308DiU28', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ3hxVThVT0pIcVpIb0ZTb1ZlSlhGNkxaY2YyenVHZGZ4bHl4S1NiNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODEzOS9hcnRpY2xlcy9wYW5kdWFuLXBlcnNpYXBhbi11bXJvaCI7czo1OiJyb3V0ZSI7czoxMzoiYXJ0aWNsZXMuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788237171),
('WL7F0vU8rgq5lcmLXFaXj84nfgUkF70CTgZLcJvB', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlp1M2FVVmR3d3BCeXFxY25DbGM1R0hhOWVmNEVhdnprT1hqR1dRQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvdmlzYS11bXJvaCI7czo1OiJyb3V0ZSI7czoxMToiZGV0YWlsLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788225847),
('wnsM00WdFMu4JfH9TfyQ3kfF4Gv8f0PLpMPGlVOF', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibHRaRnQyaWhvR01TblFTOFJFTkhLNVpOU0FNMVhwY2prTXpYRHFNbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvdmlzYS11bXJvaCI7czo1OiJyb3V0ZSI7czoxMToiZGV0YWlsLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788226996),
('WnyAQlRBlf15MTFeDNAuAMEIgNa25RY0IUkktyp5', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFFPWFRUdjR2WTlOT0RQczd3UzZSNXVUazBaS3gxMzJDalBVNE1HRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhIjtzOjU6InJvdXRlIjtzOjEzOiJjYXRlZ29yeS5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788229703),
('XhbO7BzEXBTeRFSC2yZNWAUfZDWE8Pk6OuGli6xc', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoick5hV0VDSGdFSjF1OFJGUUcwUnZiY25KbldsZjA3c1JwRU5ZblRxUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788226988),
('xj8mXRJ0k11jN6nnGNQsH3qa6aCdQeXuo0fZ4FEH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3pnU1ZxSWdVSGZiMXBhNEUyVUlMOENNenZHSGtNU0NKNUJjWTFIciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MS9jYXRlZ29yeS9ob3RlbC9tYWRpbmFoIjtzOjU6InJvdXRlIjtzOjE2OiJjYXRlZ29yeS5zZXJ2aWNlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788242230),
('xMvGDj45hRtnncZNma296fWDk5ntTALHxyAOs4nZ', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibksycWVDRjZub1VUN3ZPaE1ra2F3OW41dElmaG1NZjBuSE1PWGlSWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvdmlzYS11bXJvaCI7czo1OiJyb3V0ZSI7czoxMToiZGV0YWlsLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788228287),
('yq8mO5dsr001vDXb3ty7xQD2TJb4QzaGMnbXXsPj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVg1b1FoNVc4VFB5TEhuNkh3ZGczWk5BdGtCeEFZNGRtNnVYem5HNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODE0MC90ZXN0aW1vbmkiO3M6NToicm91dGUiO3M6MTU6InBhZ2VzLnRlc3RpbW9uaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788239897),
('Z3Umaytn2HPkE9GKuykr5NhdhqO29ds0BwNq79Nj', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlBxR1FiT2FwYkFQMU9aSWdsY21mUzczNXlqVHB5RVZybTlFYmxrOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS9ob3RlbCI7czo1OiJyb3V0ZSI7czoxMzoiY2F0ZWdvcnkuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788229777),
('ZCrj1RRFLxQ5q2TChoiHysw7hSIjyGqRQDvtpOYp', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNFVHYnVXdzVscUlwUlBKRHlhWVFQTFNUWWh1blhsQTdvQUswb1lZYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2Ni9jYXRlZ29yeS92aXNhIjtzOjU6InJvdXRlIjtzOjEzOiJjYXRlZ29yeS5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1788229707),
('Znkoum5Za2aPPsyTX9cUWnr3iwrpvkAJcoaq7LRD', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGttQ2tRYzZIZnV6bVRQR0VGaFJLZVRRQU5wVFBEODhza3NLenFHZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kZXRhaWwvc3dpc3NvdGVsLWFsLW1hcWFtIjtzOjU6InJvdXRlIjtzOjExOiJkZXRhaWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788227001),
('zVnyBQlrj7FeLHQCAZlPm2EtQovzymwxaA7epL0l', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTcxdkJuemlmZFFHVHFVZmNvT2x0TVlLVTd2NlQ1b2xhNUJodGtURCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hcnRpY2xlcy9tZW5nZW5hbC1wZXJqYWxhbmFuLWhhamkiO3M6NToicm91dGUiO3M6MTM6ImFydGljbGVzLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788229908),
('zYlVimcYZK5V5j2zvARDujOacIy4n3E4xtaNDnIx', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTFOUEJ2T3lyNDFjWUpFYWxINVhsMVpvZWFuYTJkWVp5R2V3WXhEVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jYXRlZ29yeS92aXNhL3Zpc2EtdW1yb2giO3M6NToicm91dGUiO3M6MTY6ImNhdGVnb3J5LnNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788228319),
('Zz5XaKnT2hcji8c9nQwF0ytzQWah0bVCxO6A0CDk', NULL, '127.0.0.1', 'curl/8.21.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2FZVFVvaXdRSmJRbnpEWW53RUh0S3NlNEV0OFo2QlZ2S1VDT2k2RSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hcnRpY2xlcyI7czo1OiJyb3V0ZSI7czoxNDoiYXJ0aWNsZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1788229879);

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
(4, 'Ibu Asih', 'testimonials/e3FAiIWBIrGmF52ftWeGPPCu3ULYpWsdo8oOxT6C.jfif', 'Terima kasih DUYUFUNA, semua diurus rapi mulai visa, hotel, sampai transportasi. Ibadah kami jadi tenang.', 5, 1, '2026-08-06 23:53:03', '2026-09-01 02:42:10'),
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
(2253, 'pages.tentang', 'Tentang Kami', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/tentang-kami', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-19 07:19:49', '2026-08-19 07:19:49'),
(2254, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 00:28:32', '2026-08-31 00:28:32'),
(2255, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 04:56:14', '2026-08-31 04:56:14'),
(2256, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 04:56:20', '2026-08-31 04:56:20'),
(2257, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/transportasi', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 04:56:38', '2026-08-31 04:56:38'),
(2258, 'category.show', 'Jastip Viral', NULL, NULL, 'Jastip Viral', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/jastip-viral', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 04:56:50', '2026-08-31 04:56:50'),
(2259, 'category.service', 'Jastip Viral', NULL, NULL, 'Jastip Viral', 'Tumbler Tanah Suci', NULL, 'baru', 'http://127.0.0.1:8000/category/jastip-viral/jastip-tumbler', 'http://127.0.0.1:8000/category/jastip-viral', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 04:57:00', '2026-08-31 04:57:00'),
(2260, 'category.show', 'Kursi Roda Umroh', NULL, NULL, 'Kursi Roda Umroh', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/kursi-roda-umroh', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 04:57:13', '2026-08-31 04:57:13'),
(2261, 'category.show', 'Penukaran Uang', NULL, NULL, 'Penukaran Uang', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/penukaran-uang', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 04:57:19', '2026-08-31 04:57:19'),
(2262, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/penukaran-uang', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 04:57:38', '2026-08-31 04:57:38'),
(2263, 'category.show', 'Jastip Viral', NULL, NULL, 'Jastip Viral', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/jastip-viral', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 04:57:44', '2026-08-31 04:57:44'),
(2264, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:00:41', '2026-08-31 05:00:41'),
(2265, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/jastip-viral', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:02:28', '2026-08-31 05:02:28'),
(2266, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:02:43', '2026-08-31 05:02:43'),
(2267, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/hotel-mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:02:51', '2026-08-31 05:02:51'),
(2268, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/category/hotel/hotel-mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:05:02', '2026-08-31 05:05:02'),
(2269, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/category/hotel/hotel-mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:06:44', '2026-08-31 05:06:44'),
(2270, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Jeddah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/jeddah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:07:02', '2026-08-31 05:07:02'),
(2271, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/testimoni', 'http://127.0.0.1:8000/category/hotel/jeddah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:07:43', '2026-08-31 05:07:43'),
(2272, 'pages.galeri', 'Galeri', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/galeri', 'http://127.0.0.1:8000/testimoni', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:07:46', '2026-08-31 05:07:46'),
(2273, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/galeri', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:07:53', '2026-08-31 05:07:53'),
(2274, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:08:01', '2026-08-31 05:08:01'),
(2275, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:08:06', '2026-08-31 05:08:06'),
(2276, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:08:11', '2026-08-31 05:08:11'),
(2277, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:09:22', '2026-08-31 05:09:22'),
(2278, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:09:40', '2026-08-31 05:09:40'),
(2279, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:21:02', '2026-08-31 05:21:02'),
(2280, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:21:09', '2026-08-31 05:21:09'),
(2281, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:21:26', '2026-08-31 05:21:26'),
(2282, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:21:30', '2026-08-31 05:21:30'),
(2283, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:21:46', '2026-08-31 05:21:46'),
(2284, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:22:40', '2026-08-31 05:22:40'),
(2285, 'pages.tentang', 'Tentang Kami', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/tentang-kami', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:27:19', '2026-08-31 05:27:19'),
(2286, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/tentang-kami', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:27:22', '2026-08-31 05:27:22'),
(2287, 'pages.galeri', 'Galeri', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/galeri', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:27:29', '2026-08-31 05:27:29'),
(2288, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/testimoni', 'http://127.0.0.1:8000/galeri', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:27:36', '2026-08-31 05:27:36'),
(2289, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/testimoni', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:27:39', '2026-08-31 05:27:39'),
(2290, 'category.show', 'Catering', NULL, NULL, 'Catering', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/catering', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 05:27:45', '2026-08-31 05:27:45'),
(2291, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:38:09', '2026-08-31 06:38:09'),
(2292, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:38:28', '2026-08-31 06:38:28'),
(2293, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:38:39', '2026-08-31 06:38:39'),
(2294, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:44:20', '2026-08-31 06:44:20'),
(2295, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:44:30', '2026-08-31 06:44:30'),
(2296, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:45:05', '2026-08-31 06:45:05'),
(2297, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:47:09', '2026-08-31 06:47:09'),
(2298, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:47:43', '2026-08-31 06:47:43'),
(2299, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:47:57', '2026-08-31 06:47:57'),
(2300, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:49:19', '2026-08-31 06:49:19'),
(2301, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:49:47', '2026-08-31 06:49:47'),
(2302, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:50:17', '2026-08-31 06:50:17'),
(2303, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 06:52:05', '2026-08-31 06:52:05'),
(2304, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8123/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 07:33:16', '2026-08-31 07:33:16'),
(2305, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:33:42', '2026-08-31 07:33:42'),
(2306, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8123/produk/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 07:33:47', '2026-08-31 07:33:47'),
(2307, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:33:59', '2026-08-31 07:33:59'),
(2308, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:34:05', '2026-08-31 07:34:05'),
(2309, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/produk/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:34:12', '2026-08-31 07:34:12'),
(2310, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/produk/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:34:54', '2026-08-31 07:34:54'),
(2311, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8123/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 07:35:43', '2026-08-31 07:35:43'),
(2312, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/produk/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:35:58', '2026-08-31 07:35:58'),
(2313, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8123/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 07:36:07', '2026-08-31 07:36:07'),
(2314, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8123/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 07:36:28', '2026-08-31 07:36:28'),
(2315, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/produk/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:36:46', '2026-08-31 07:36:46'),
(2316, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/produk/pullman-zamzam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:38:32', '2026-08-31 07:38:32'),
(2317, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8123/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 07:39:40', '2026-08-31 07:39:40'),
(2318, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8123/produk/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 07:39:58', '2026-08-31 07:39:58'),
(2319, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8123/produk/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 07:40:31', '2026-08-31 07:40:31'),
(2320, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:41:03', '2026-08-31 07:41:03'),
(2321, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8123/produk/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 07:41:16', '2026-08-31 07:41:16'),
(2322, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:41:39', '2026-08-31 07:41:39'),
(2323, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/transportasi', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:41:47', '2026-08-31 07:41:47'),
(2324, 'category.show', 'Catering', NULL, NULL, 'Catering', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/catering', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:42:06', '2026-08-31 07:42:06'),
(2325, 'category.service', 'Catering', NULL, NULL, 'Catering', 'Kedatangan', NULL, 'baru', 'http://127.0.0.1:8000/category/catering/kedatangan-2', 'http://127.0.0.1:8000/category/catering', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:42:18', '2026-08-31 07:42:18'),
(2326, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/catering/kedatangan-2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:42:34', '2026-08-31 07:42:34'),
(2327, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:42:56', '2026-08-31 07:42:56'),
(2328, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:43:02', '2026-08-31 07:43:02'),
(2329, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8123/category/visa/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 07:45:51', '2026-08-31 07:45:51'),
(2330, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8123/produk/nasi-box', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 07:46:06', '2026-08-31 07:46:06'),
(2331, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:50:13', '2026-08-31 07:50:13'),
(2332, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/produk/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 07:50:23', '2026-08-31 07:50:23'),
(2333, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8124/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:00:10', '2026-08-31 08:00:10'),
(2334, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8124/produk/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:00:13', '2026-08-31 08:00:13'),
(2335, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8124/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:00:14', '2026-08-31 08:00:14'),
(2336, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8124/category/visa/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:00:16', '2026-08-31 08:00:16'),
(2337, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8124', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:00:21', '2026-08-31 08:00:21'),
(2338, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8124/category/hotel', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:00:23', '2026-08-31 08:00:23'),
(2339, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8124/produk/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:00:40', '2026-08-31 08:00:40'),
(2340, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8124/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:00:42', '2026-08-31 08:00:42'),
(2341, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8124/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:01:28', '2026-08-31 08:01:28'),
(2342, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8124/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:01:57', '2026-08-31 08:01:57'),
(2343, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/produk/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 08:03:25', '2026-08-31 08:03:25'),
(2344, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/produk/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 08:03:36', '2026-08-31 08:03:36'),
(2345, 'produk.show', 'Produk Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/produk/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 08:13:13', '2026-08-31 08:13:13'),
(2346, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8125/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:47:31', '2026-08-31 08:47:31'),
(2347, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8125/category/visa/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:47:35', '2026-08-31 08:47:35'),
(2348, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8125/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:47:38', '2026-08-31 08:47:38'),
(2349, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8125/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:48:05', '2026-08-31 08:48:05'),
(2350, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8125/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:48:23', '2026-08-31 08:48:23'),
(2351, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/produk/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 08:50:46', '2026-08-31 08:50:46'),
(2352, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 08:50:55', '2026-08-31 08:50:55'),
(2353, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 08:51:52', '2026-08-31 08:51:52'),
(2354, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8125/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:52:28', '2026-08-31 08:52:28'),
(2355, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8125/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:52:30', '2026-08-31 08:52:30'),
(2356, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8125/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:52:33', '2026-08-31 08:52:33'),
(2357, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8125/category/visa/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:52:35', '2026-08-31 08:52:35'),
(2358, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8125', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:52:40', '2026-08-31 08:52:40'),
(2359, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8125/category/hotel', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 08:52:44', '2026-08-31 08:52:44'),
(2360, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 08:55:25', '2026-08-31 08:55:25'),
(2361, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 08:56:13', '2026-08-31 08:56:13'),
(2362, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 08:57:40', '2026-08-31 08:57:40'),
(2363, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 08:59:34', '2026-08-31 08:59:34'),
(2364, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:19:53', '2026-08-31 09:19:53'),
(2365, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:25:39', '2026-08-31 09:25:39'),
(2366, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8126/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:26:32', '2026-08-31 09:26:32'),
(2367, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8126/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:26:33', '2026-08-31 09:26:33'),
(2368, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8126/category/visa/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:26:35', '2026-08-31 09:26:35'),
(2369, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8126/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:26:37', '2026-08-31 09:26:37'),
(2370, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8126/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:27:01', '2026-08-31 09:27:01'),
(2371, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8126/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:27:03', '2026-08-31 09:27:03'),
(2372, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:27:27', '2026-08-31 09:27:27'),
(2373, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:27:39', '2026-08-31 09:27:39'),
(2374, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8126/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:27:55', '2026-08-31 09:27:55'),
(2375, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:28:07', '2026-08-31 09:28:07'),
(2376, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:28:21', '2026-08-31 09:28:21'),
(2377, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8126/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:28:25', '2026-08-31 09:28:25'),
(2378, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:28:28', '2026-08-31 09:28:28'),
(2379, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:29:09', '2026-08-31 09:29:09'),
(2380, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:29:25', '2026-08-31 09:29:25'),
(2381, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8126/detail/pullman-zamzam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:29:32', '2026-08-31 09:29:32'),
(2382, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:29:44', '2026-08-31 09:29:44');
INSERT INTO `traffics` (`id`, `route_name`, `menu`, `nama`, `no_hp`, `category`, `service`, `item`, `status`, `url`, `referrer`, `ip`, `user_agent`, `device`, `is_lead`, `created_at`, `updated_at`) VALUES
(2383, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:29:50', '2026-08-31 09:29:50'),
(2384, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:31:35', '2026-08-31 09:31:35'),
(2385, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:38:10', '2026-08-31 09:38:10'),
(2386, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:44:38', '2026-08-31 09:44:38'),
(2387, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:46:54', '2026-08-31 09:46:54'),
(2388, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:49:40', '2026-08-31 09:49:40'),
(2389, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:50:19', '2026-08-31 09:50:19'),
(2390, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 09:50:58', '2026-08-31 09:50:58'),
(2391, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8128/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:55:12', '2026-08-31 09:55:12'),
(2392, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8128/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:55:14', '2026-08-31 09:55:14'),
(2393, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8128/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:55:15', '2026-08-31 09:55:15'),
(2394, 'service.detail', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8128/service/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:55:17', '2026-08-31 09:55:17'),
(2395, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8128/category/visa/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:55:20', '2026-08-31 09:55:20'),
(2396, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8128/detail/pullman-zamzam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:55:21', '2026-08-31 09:55:21'),
(2397, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8128/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:55:56', '2026-08-31 09:55:56'),
(2398, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8128/detail/pullman-zamzam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:56:11', '2026-08-31 09:56:11'),
(2399, 'service.detail', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8128/service/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 09:56:29', '2026-08-31 09:56:29'),
(2400, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:00:41', '2026-08-31 10:00:41'),
(2401, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:01:02', '2026-08-31 10:01:02'),
(2402, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:01:15', '2026-08-31 10:01:15'),
(2403, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:04:13', '2026-08-31 10:04:13'),
(2404, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:05:15', '2026-08-31 10:05:15'),
(2405, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:34:17', '2026-08-31 10:34:17'),
(2406, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:34:40', '2026-08-31 10:34:40'),
(2407, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8129/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:35:12', '2026-08-31 10:35:12'),
(2408, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8129/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:35:15', '2026-08-31 10:35:15'),
(2409, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8129/detail/pullman-zamzam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:35:18', '2026-08-31 10:35:18'),
(2410, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8129/category/visa/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:35:22', '2026-08-31 10:35:22'),
(2411, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:35:22', '2026-08-31 10:35:22'),
(2412, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8129/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:35:26', '2026-08-31 10:35:26'),
(2413, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8129/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:35:40', '2026-08-31 10:35:40'),
(2414, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8129/detail/pullman-zamzam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:35:41', '2026-08-31 10:35:41'),
(2415, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8129/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:35:54', '2026-08-31 10:35:54'),
(2416, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:36:37', '2026-08-31 10:36:37'),
(2417, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:39:22', '2026-08-31 10:39:22'),
(2418, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:41:34', '2026-08-31 10:41:34'),
(2419, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:54:23', '2026-08-31 10:54:23'),
(2420, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8131/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:54:46', '2026-08-31 10:54:46'),
(2421, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8131/detail/pullman-zamzam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:54:48', '2026-08-31 10:54:48'),
(2422, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8131/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:54:50', '2026-08-31 10:54:50'),
(2423, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8131/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:55:07', '2026-08-31 10:55:07'),
(2424, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8131/detail/pullman-zamzam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 10:55:09', '2026-08-31 10:55:09'),
(2425, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 10:59:18', '2026-08-31 10:59:18'),
(2426, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 11:03:58', '2026-08-31 11:03:58'),
(2427, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 11:04:17', '2026-08-31 11:04:17'),
(2428, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 11:04:27', '2026-08-31 11:04:27'),
(2429, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 11:06:23', '2026-08-31 11:06:23'),
(2430, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 11:34:39', '2026-08-31 11:34:39'),
(2431, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8132/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 11:35:43', '2026-08-31 11:35:43'),
(2432, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8132/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 11:35:44', '2026-08-31 11:35:44'),
(2433, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8132/detail/pullman-zamzam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 11:35:45', '2026-08-31 11:35:45'),
(2434, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8132/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 11:35:47', '2026-08-31 11:35:47'),
(2435, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8132/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 11:36:09', '2026-08-31 11:36:09'),
(2436, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8132/detail/pullman-zamzam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 11:36:10', '2026-08-31 11:36:10'),
(2437, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8132/detail/pullman-zamzam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 11:36:32', '2026-08-31 11:36:32'),
(2438, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8132/detail/pullman-zamzam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 11:36:59', '2026-08-31 11:36:59'),
(2439, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 11:37:51', '2026-08-31 11:37:51'),
(2440, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 11:38:03', '2026-08-31 11:38:03'),
(2441, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8132/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 11:38:37', '2026-08-31 11:38:37'),
(2442, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8132/category/visa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 11:39:08', '2026-08-31 11:39:08'),
(2443, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 11:52:16', '2026-08-31 11:52:16'),
(2444, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 12:50:08', '2026-08-31 12:50:08'),
(2445, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 12:53:07', '2026-08-31 12:53:07'),
(2446, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 13:00:32', '2026-08-31 13:00:32'),
(2447, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 13:01:05', '2026-08-31 13:01:05'),
(2448, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8133/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 13:03:27', '2026-08-31 13:03:27'),
(2449, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8133/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 13:03:29', '2026-08-31 13:03:29'),
(2450, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8134/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 13:04:12', '2026-08-31 13:04:12'),
(2451, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8134/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 13:04:37', '2026-08-31 13:04:37'),
(2452, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 13:05:25', '2026-08-31 13:05:25'),
(2453, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 13:07:11', '2026-08-31 13:07:11'),
(2454, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8135/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 13:32:27', '2026-08-31 13:32:27'),
(2455, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8135/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 13:32:29', '2026-08-31 13:32:29'),
(2456, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8135/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 13:33:42', '2026-08-31 13:33:42'),
(2457, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8135/category/visa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 13:33:58', '2026-08-31 13:33:58'),
(2458, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 13:36:47', '2026-08-31 13:36:47'),
(2459, 'customer.store', 'Hotel', 'Martadi', '0876786568', 'Hotel', 'Mekkah', 'Swissôtel Al Maqam', 'baru', 'http://127.0.0.1:8000/customer', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 1, '2026-08-31 13:38:13', '2026-08-31 13:38:13'),
(2460, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 13:38:54', '2026-08-31 13:38:54'),
(2461, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 13:39:01', '2026-08-31 13:39:01'),
(2462, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 13:39:05', '2026-08-31 13:39:05'),
(2463, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 13:40:17', '2026-08-31 13:40:17'),
(2464, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 13:42:44', '2026-08-31 13:42:44'),
(2465, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 13:44:23', '2026-08-31 13:44:23'),
(2466, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 14:00:21', '2026-08-31 14:00:21'),
(2467, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 14:01:45', '2026-08-31 14:01:45'),
(2468, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 14:03:17', '2026-08-31 14:03:17'),
(2469, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 14:06:00', '2026-08-31 14:06:00'),
(2470, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 14:06:17', '2026-08-31 14:06:17'),
(2471, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 14:07:23', '2026-08-31 14:07:23'),
(2472, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8136/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 14:07:51', '2026-08-31 14:07:51'),
(2473, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8136/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 14:07:55', '2026-08-31 14:07:55'),
(2474, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8136/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 14:07:58', '2026-08-31 14:07:58'),
(2475, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8136/category/visa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 14:08:02', '2026-08-31 14:08:02'),
(2476, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8136/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 14:08:33', '2026-08-31 14:08:33'),
(2477, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8136/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 14:08:36', '2026-08-31 14:08:36'),
(2478, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 14:10:08', '2026-08-31 14:10:08'),
(2479, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 14:13:20', '2026-08-31 14:13:20'),
(2480, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 14:50:08', '2026-08-31 14:50:08'),
(2481, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 14:50:35', '2026-08-31 14:50:35'),
(2482, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 14:51:06', '2026-08-31 14:51:06'),
(2483, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8137/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 15:02:47', '2026-08-31 15:02:47'),
(2484, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8137/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 15:02:50', '2026-08-31 15:02:50'),
(2485, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8137/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 15:02:52', '2026-08-31 15:02:52'),
(2486, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8137/category/visa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 15:02:54', '2026-08-31 15:02:54'),
(2487, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8137/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 15:03:17', '2026-08-31 15:03:17'),
(2488, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8137/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 15:03:22', '2026-08-31 15:03:22'),
(2489, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:03:27', '2026-08-31 15:03:27'),
(2490, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:04:37', '2026-08-31 15:04:37'),
(2491, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:12:11', '2026-08-31 15:12:11'),
(2492, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:12:19', '2026-08-31 15:12:19'),
(2493, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:12:22', '2026-08-31 15:12:22'),
(2494, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:13:32', '2026-08-31 15:13:32'),
(2495, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/pullman-zamzam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:13:47', '2026-08-31 15:13:47'),
(2496, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/pullman-zamzam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:13:58', '2026-08-31 15:13:58'),
(2497, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:14:06', '2026-08-31 15:14:06'),
(2498, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:17:35', '2026-08-31 15:17:35'),
(2499, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:17:52', '2026-08-31 15:17:52'),
(2500, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/madinah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:17:55', '2026-08-31 15:17:55'),
(2501, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:18:04', '2026-08-31 15:18:04'),
(2502, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:18:31', '2026-08-31 15:18:31'),
(2503, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:23:26', '2026-08-31 15:23:26'),
(2504, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:27:54', '2026-08-31 15:27:54'),
(2505, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:31:30', '2026-08-31 15:31:30'),
(2506, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:33:14', '2026-08-31 15:33:14'),
(2507, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 15:45:44', '2026-08-31 15:45:44'),
(2508, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 17:56:31', '2026-08-31 17:56:31'),
(2509, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 18:30:11', '2026-08-31 18:30:11'),
(2510, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:30:19', '2026-08-31 18:30:19'),
(2511, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:30:46', '2026-08-31 18:30:46'),
(2512, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 18:30:47', '2026-08-31 18:30:47'),
(2513, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:30:49', '2026-08-31 18:30:49'),
(2514, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:31:59', '2026-08-31 18:31:59'),
(2515, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:32:14', '2026-08-31 18:32:14'),
(2516, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:32:29', '2026-08-31 18:32:29'),
(2517, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:32:55', '2026-08-31 18:32:55'),
(2518, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/anjum-hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:33:30', '2026-08-31 18:33:30'),
(2519, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:33:55', '2026-08-31 18:33:55'),
(2520, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:33:58', '2026-08-31 18:33:58'),
(2521, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:34:00', '2026-08-31 18:34:00'),
(2522, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/anjum-hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:34:02', '2026-08-31 18:34:02'),
(2523, 'category.show', 'Muthawif', NULL, NULL, 'Muthawif', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/muthawif', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:34:21', '2026-08-31 18:34:21'),
(2524, 'category.show', 'Muthawif', NULL, NULL, 'Muthawif', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/muthawif', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:34:47', '2026-08-31 18:34:47'),
(2525, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 18:36:39', '2026-08-31 18:36:39'),
(2526, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8001/category/hotel/mekkah', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:45:57', '2026-08-31 18:45:57'),
(2527, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8001/detail/anjum-hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:46:01', '2026-08-31 18:46:01'),
(2528, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8001/category/hotel/mekkah', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:46:23', '2026-08-31 18:46:23'),
(2529, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8001/detail/anjum-hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:46:30', '2026-08-31 18:46:30'),
(2530, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8001/detail/anjum-hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:47:03', '2026-08-31 18:47:03'),
(2531, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8001/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:48:08', '2026-08-31 18:48:08'),
(2532, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8001/category/hotel/mekkah', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 18:49:15', '2026-08-31 18:49:15'),
(2533, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:01:23', '2026-08-31 19:01:23'),
(2534, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:02:14', '2026-08-31 19:02:14'),
(2535, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:02:20', '2026-08-31 19:02:20'),
(2536, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:15:25', '2026-08-31 19:15:25'),
(2537, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8002/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-08-31 19:15:46', '2026-08-31 19:15:46'),
(2538, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:16:21', '2026-08-31 19:16:21'),
(2539, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8003/detail/anjum-hotel', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:23:38', '2026-08-31 19:23:38'),
(2540, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8003/detail/anjum-hotel', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:23:58', '2026-08-31 19:23:58'),
(2541, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:24:30', '2026-08-31 19:24:30');
INSERT INTO `traffics` (`id`, `route_name`, `menu`, `nama`, `no_hp`, `category`, `service`, `item`, `status`, `url`, `referrer`, `ip`, `user_agent`, `device`, `is_lead`, `created_at`, `updated_at`) VALUES
(2542, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8003/detail/anjum-hotel', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:28:48', '2026-08-31 19:28:48'),
(2543, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:29:03', '2026-08-31 19:29:03'),
(2544, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8003/detail/anjum-hotel', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:29:17', '2026-08-31 19:29:17'),
(2545, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8003/detail/anjum-hotel', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:29:49', '2026-08-31 19:29:49'),
(2546, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:30:03', '2026-08-31 19:30:03'),
(2547, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:31:03', '2026-08-31 19:31:03'),
(2548, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:31:10', '2026-08-31 19:31:10'),
(2549, 'services.index', 'Layanan', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8003/services', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:37:48', '2026-08-31 19:37:48'),
(2550, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8003/category/hotel', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:38:09', '2026-08-31 19:38:09'),
(2551, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:38:17', '2026-08-31 19:38:17'),
(2552, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:38:37', '2026-08-31 19:38:37'),
(2553, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/transportasi', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:38:44', '2026-08-31 19:38:44'),
(2554, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:39:02', '2026-08-31 19:39:02'),
(2555, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:39:26', '2026-08-31 19:39:26'),
(2556, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:39:34', '2026-08-31 19:39:34'),
(2557, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:39:50', '2026-08-31 19:39:50'),
(2558, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/transportasi', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:39:56', '2026-08-31 19:39:56'),
(2559, 'category.show', 'Handling Hotel', NULL, NULL, 'Handling Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/handling-hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:40:07', '2026-08-31 19:40:07'),
(2560, 'service.detail', 'Handling Hotel', NULL, NULL, 'Handling Hotel', 'Check In', NULL, 'baru', 'http://127.0.0.1:8000/service/handling-hotel-check-in', 'http://127.0.0.1:8000/category/handling-hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:40:14', '2026-08-31 19:40:14'),
(2561, 'category.show', 'Handling Hotel', NULL, NULL, 'Handling Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/handling-hotel', 'http://127.0.0.1:8000/service/handling-hotel-check-in', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:41:54', '2026-08-31 19:41:54'),
(2562, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/handling-hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:42:08', '2026-08-31 19:42:08'),
(2563, 'category.show', 'Handling Hotel', NULL, NULL, 'Handling Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/handling-hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:42:17', '2026-08-31 19:42:17'),
(2564, 'category.show', 'Catering', NULL, NULL, 'Catering', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/catering-bandara', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:42:25', '2026-08-31 19:42:25'),
(2565, 'service.detail', 'Catering', NULL, NULL, 'Catering', 'Kedatangan', NULL, 'baru', 'http://127.0.0.1:8000/service/catering-bandara-datang', 'http://127.0.0.1:8000/category/catering-bandara', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:42:30', '2026-08-31 19:42:30'),
(2566, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/catering-bandara', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:42:40', '2026-08-31 19:42:40'),
(2567, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/transportasi', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:42:49', '2026-08-31 19:42:49'),
(2568, 'services.index', 'Layanan', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8003/services', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:42:58', '2026-08-31 19:42:58'),
(2569, 'services.index', 'Layanan', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8003/services', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:43:18', '2026-08-31 19:43:18'),
(2570, 'category.service', 'Transportasi', NULL, NULL, 'Transportasi', 'Bus Shalawat', NULL, 'baru', 'http://127.0.0.1:8003/category/transportasi/transportasi-bus-shalawat', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:43:36', '2026-08-31 19:43:36'),
(2571, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8003/category/layanan/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:43:37', '2026-08-31 19:43:37'),
(2572, 'category.service', 'Catering', NULL, NULL, 'Catering', 'Kedatangan', NULL, 'baru', 'http://127.0.0.1:8003/category/kedatangan/kedatangan-2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:43:38', '2026-08-31 19:43:38'),
(2573, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8003/category/transportasi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:44:10', '2026-08-31 19:44:10'),
(2574, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/transportasi', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:44:26', '2026-08-31 19:44:26'),
(2575, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/transportasi', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:45:49', '2026-08-31 19:45:49'),
(2576, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/transportasi', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:46:19', '2026-08-31 19:46:19'),
(2577, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/transportasi', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:46:35', '2026-08-31 19:46:35'),
(2578, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8003/category/transportasi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:47:37', '2026-08-31 19:47:37'),
(2579, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 19:47:55', '2026-08-31 19:47:55'),
(2580, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8003/category/transportasi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:48:13', '2026-08-31 19:48:13'),
(2581, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8003/category/transportasi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:48:41', '2026-08-31 19:48:41'),
(2582, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8003/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:49:03', '2026-08-31 19:49:03'),
(2583, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8003/detail/anjum-hotel', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:49:21', '2026-08-31 19:49:21'),
(2584, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8003/category/transportasi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:50:37', '2026-08-31 19:50:37'),
(2585, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8003/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:50:39', '2026-08-31 19:50:39'),
(2586, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8003/detail/anjum-hotel', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:50:40', '2026-08-31 19:50:40'),
(2587, 'services.index', 'Layanan', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8003/services', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-08-31 19:50:42', '2026-08-31 19:50:42'),
(2588, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-08-31 23:55:41', '2026-08-31 23:55:41'),
(2589, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:01:21', '2026-09-01 00:01:21'),
(2590, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:01:31', '2026-09-01 00:01:31'),
(2591, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:01:40', '2026-09-01 00:01:40'),
(2592, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:02:04', '2026-09-01 00:02:04'),
(2593, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:14:19', '2026-09-01 00:14:19'),
(2594, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:14:31', '2026-09-01 00:14:31'),
(2595, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:14:41', '2026-09-01 00:14:41'),
(2596, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:14:59', '2026-09-01 00:14:59'),
(2597, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:15:23', '2026-09-01 00:15:23'),
(2598, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:17:01', '2026-09-01 00:17:01'),
(2599, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:17:07', '2026-09-01 00:17:07'),
(2600, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:17:41', '2026-09-01 00:17:41'),
(2601, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:18:11', '2026-09-01 00:18:11'),
(2602, 'service.detail', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/service/visa-umroh', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:18:16', '2026-09-01 00:18:16'),
(2603, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:19:40', '2026-09-01 00:19:40'),
(2604, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:19:41', '2026-09-01 00:19:41'),
(2605, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:19:43', '2026-09-01 00:19:43'),
(2606, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-brn-hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:19:44', '2026-09-01 00:19:44'),
(2607, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:19:47', '2026-09-01 00:19:47'),
(2608, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:20:02', '2026-09-01 00:20:02'),
(2609, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:20:03', '2026-09-01 00:20:03'),
(2610, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:20:26', '2026-09-01 00:20:26'),
(2611, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:21:00', '2026-09-01 00:21:00'),
(2612, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:21:20', '2026-09-01 00:21:20'),
(2613, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:21:22', '2026-09-01 00:21:22'),
(2614, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/service/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:22:03', '2026-09-01 00:22:03'),
(2615, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:22:08', '2026-09-01 00:22:08'),
(2616, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:23:39', '2026-09-01 00:23:39'),
(2617, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:23:58', '2026-09-01 00:23:58'),
(2618, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:34:06', '2026-09-01 00:34:06'),
(2619, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 00:34:09', '2026-09-01 00:34:09'),
(2620, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:34:25', '2026-09-01 00:34:25'),
(2621, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:34:37', '2026-09-01 00:34:37'),
(2622, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:36:14', '2026-09-01 00:36:14'),
(2623, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:58:38', '2026-09-01 00:58:38'),
(2624, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 00:58:47', '2026-09-01 00:58:47'),
(2625, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:00:56', '2026-09-01 01:00:56'),
(2626, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8138/category/visa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 01:01:06', '2026-09-01 01:01:06'),
(2627, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:01:06', '2026-09-01 01:01:06'),
(2628, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:01:12', '2026-09-01 01:01:12'),
(2629, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8138/category/visa', NULL, '127.0.0.1', 'curl/7.55.1', 'Desktop', 0, '2026-09-01 01:01:38', '2026-09-01 01:01:38'),
(2630, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:01:42', '2026-09-01 01:01:42'),
(2631, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:01:44', '2026-09-01 01:01:44'),
(2632, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:02:06', '2026-09-01 01:02:06'),
(2633, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8138/category/visa/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 01:02:09', '2026-09-01 01:02:09'),
(2634, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:02:12', '2026-09-01 01:02:12'),
(2635, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-individu', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:02:23', '2026-09-01 01:02:23'),
(2636, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8138/detail/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 01:02:36', '2026-09-01 01:02:36'),
(2637, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8138/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 01:02:38', '2026-09-01 01:02:38'),
(2638, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8138/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 01:03:29', '2026-09-01 01:03:29'),
(2639, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8138/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 01:03:31', '2026-09-01 01:03:31'),
(2640, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8138/detail/visa-transit-saudi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 01:03:33', '2026-09-01 01:03:33'),
(2641, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/detail/visa-individu', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:03:43', '2026-09-01 01:03:43'),
(2642, 'category.service', NULL, NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/detail/visa-individu', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:12:24', '2026-09-01 01:12:24'),
(2643, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:12:31', '2026-09-01 01:12:31'),
(2644, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8765/category/visa', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:24:03', '2026-09-01 01:24:03'),
(2645, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8765/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:24:05', '2026-09-01 01:24:05'),
(2646, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/detail/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:24:06', '2026-09-01 01:24:06'),
(2647, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/detail/visa-brn-hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:24:08', '2026-09-01 01:24:08'),
(2648, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/detail/visa-longstay-shorstay', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:24:10', '2026-09-01 01:24:10'),
(2649, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8765/category/hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:24:12', '2026-09-01 01:24:12'),
(2650, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8765/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:24:25', '2026-09-01 01:24:25'),
(2651, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/detail/visa-longstay-shorstay', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:24:51', '2026-09-01 01:24:51'),
(2652, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:25:11', '2026-09-01 01:25:11'),
(2653, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:26:12', '2026-09-01 01:26:12'),
(2654, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:26:14', '2026-09-01 01:26:14'),
(2655, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:26:31', '2026-09-01 01:26:31'),
(2656, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:27:06', '2026-09-01 01:27:06'),
(2657, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:27:13', '2026-09-01 01:27:13'),
(2658, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:27:14', '2026-09-01 01:27:14'),
(2659, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:27:21', '2026-09-01 01:27:21'),
(2660, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:28:47', '2026-09-01 01:28:47'),
(2661, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:33:06', '2026-09-01 01:33:06'),
(2662, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:42:11', '2026-09-01 01:42:11'),
(2663, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:42:52', '2026-09-01 01:42:52'),
(2664, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/detail/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:43:00', '2026-09-01 01:43:00'),
(2665, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8765/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:43:08', '2026-09-01 01:43:08'),
(2666, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/detail/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:43:16', '2026-09-01 01:43:16'),
(2667, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:43:21', '2026-09-01 01:43:21'),
(2668, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:43:32', '2026-09-01 01:43:32'),
(2669, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8765/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:43:48', '2026-09-01 01:43:48'),
(2670, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/detail/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:43:49', '2026-09-01 01:43:49'),
(2671, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:43:55', '2026-09-01 01:43:55'),
(2672, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8765/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:49:38', '2026-09-01 01:49:38'),
(2673, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8765/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:50:07', '2026-09-01 01:50:07'),
(2674, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8765/category/hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:50:09', '2026-09-01 01:50:09'),
(2675, 'pages.tentang', 'Tentang Kami', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/tentang-kami', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:50:30', '2026-09-01 01:50:30'),
(2676, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:50:34', '2026-09-01 01:50:34'),
(2677, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8765/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:51:01', '2026-09-01 01:51:01'),
(2678, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8765/category/hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 01:51:02', '2026-09-01 01:51:02'),
(2679, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:51:27', '2026-09-01 01:51:27'),
(2680, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:51:43', '2026-09-01 01:51:43'),
(2681, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:51:55', '2026-09-01 01:51:55'),
(2682, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:52:02', '2026-09-01 01:52:02'),
(2683, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:52:08', '2026-09-01 01:52:08'),
(2684, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:52:43', '2026-09-01 01:52:43'),
(2685, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:52:55', '2026-09-01 01:52:55'),
(2686, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:53:43', '2026-09-01 01:53:43'),
(2687, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:53:47', '2026-09-01 01:53:47'),
(2688, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:53:48', '2026-09-01 01:53:48'),
(2689, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:54:40', '2026-09-01 01:54:40'),
(2690, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:58:36', '2026-09-01 01:58:36'),
(2691, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8000/category/visa/visa-umroh', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 01:59:25', '2026-09-01 01:59:25'),
(2692, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:03:21', '2026-09-01 02:03:21'),
(2693, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:03:25', '2026-09-01 02:03:25'),
(2694, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:03:56', '2026-09-01 02:03:56'),
(2695, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8765/category/visa', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:04:34', '2026-09-01 02:04:34'),
(2696, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/detail/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:04:47', '2026-09-01 02:04:47'),
(2697, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/detail/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:05:14', '2026-09-01 02:05:14'),
(2698, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8765/category/hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:05:16', '2026-09-01 02:05:16'),
(2699, 'category.service', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8765/category/visa/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:05:19', '2026-09-01 02:05:19'),
(2700, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:23:45', '2026-09-01 02:23:45'),
(2701, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:23:54', '2026-09-01 02:23:54'),
(2702, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:24:04', '2026-09-01 02:24:04'),
(2703, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:25:10', '2026-09-01 02:25:10'),
(2704, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/mengenal-perjalanan-haji', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:25:15', '2026-09-01 02:25:15'),
(2705, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/testimoni', 'http://127.0.0.1:8000/articles/mengenal-perjalanan-haji', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:27:04', '2026-09-01 02:27:04');
INSERT INTO `traffics` (`id`, `route_name`, `menu`, `nama`, `no_hp`, `category`, `service`, `item`, `status`, `url`, `referrer`, `ip`, `user_agent`, `device`, `is_lead`, `created_at`, `updated_at`) VALUES
(2706, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/testimoni', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:27:49', '2026-09-01 02:27:49'),
(2707, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:27:58', '2026-09-01 02:27:58'),
(2708, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8765/category/visa', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:28:23', '2026-09-01 02:28:23'),
(2709, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8766/category/visa', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:28:27', '2026-09-01 02:28:27'),
(2710, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8765/category/visa', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:29:36', '2026-09-01 02:29:36'),
(2711, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8765/category/hotel', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:29:37', '2026-09-01 02:29:37'),
(2712, 'service.detail', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8765/service/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:29:42', '2026-09-01 02:29:42'),
(2713, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:29:45', '2026-09-01 02:29:45'),
(2714, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/testimoni', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:29:47', '2026-09-01 02:29:47'),
(2715, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8765/category/hotel/mekkah', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:29:53', '2026-09-01 02:29:53'),
(2716, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8765/category/visa', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:29:56', '2026-09-01 02:29:56'),
(2717, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/articles', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:30:01', '2026-09-01 02:30:01'),
(2718, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/articles', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:31:01', '2026-09-01 02:31:01'),
(2719, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/articles/mengenal-perjalanan-haji', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:31:48', '2026-09-01 02:31:48'),
(2720, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8765/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:31:50', '2026-09-01 02:31:50'),
(2721, 'service.detail', 'Visa', NULL, NULL, 'Visa', 'Visa Umroh', NULL, 'baru', 'http://127.0.0.1:8765/service/visa-umroh', NULL, '127.0.0.1', 'curl/8.21.0', 'Desktop', 0, '2026-09-01 02:31:52', '2026-09-01 02:31:52'),
(2722, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/testimoni', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:40:48', '2026-09-01 02:40:48'),
(2723, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/testimoni', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:42:15', '2026-09-01 02:42:15'),
(2724, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/testimoni', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:46:19', '2026-09-01 02:46:19'),
(2725, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:46:24', '2026-09-01 02:46:24'),
(2726, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:47:18', '2026-09-01 02:47:18'),
(2727, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/detail/visa-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 02:48:25', '2026-09-01 02:48:25'),
(2728, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:21:42', '2026-09-01 03:21:42'),
(2729, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/memilih-hotel-di-mekkah', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:21:48', '2026-09-01 03:21:48'),
(2730, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/testimoni', 'http://127.0.0.1:8000/articles/memilih-hotel-di-mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:22:31', '2026-09-01 03:22:31'),
(2731, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/testimoni', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:24:36', '2026-09-01 03:24:36'),
(2732, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:24:41', '2026-09-01 03:24:41'),
(2733, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:27:40', '2026-09-01 03:27:40'),
(2734, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:27:51', '2026-09-01 03:27:51'),
(2735, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:31:29', '2026-09-01 03:31:29'),
(2736, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:31:34', '2026-09-01 03:31:34'),
(2737, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:33:40', '2026-09-01 03:33:40'),
(2738, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:34:07', '2026-09-01 03:34:07'),
(2739, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:36:47', '2026-09-01 03:36:47'),
(2740, 'category.show', 'Visa', NULL, NULL, 'Visa', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/visa', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 03:36:59', '2026-09-01 03:36:59'),
(2741, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/visa-umroh-group-group', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:01:51', '2026-09-01 04:01:51'),
(2742, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/category/visa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:01:53', '2026-09-01 04:01:53'),
(2743, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:02:02', '2026-09-01 04:02:02'),
(2744, 'pages.galeri', 'Galeri', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/galeri', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:02:14', '2026-09-01 04:02:14'),
(2745, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/testimoni', 'http://127.0.0.1:8000/galeri', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:02:16', '2026-09-01 04:02:16'),
(2746, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/testimoni', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:03:16', '2026-09-01 04:03:16'),
(2747, 'category.show', 'Transportasi', NULL, NULL, 'Transportasi', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/transportasi', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:03:22', '2026-09-01 04:03:22'),
(2748, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:09:08', '2026-09-01 04:09:08'),
(2749, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/panduan-persiapan-umroh', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:09:16', '2026-09-01 04:09:16'),
(2750, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/testimoni', 'http://127.0.0.1:8000/articles/panduan-persiapan-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:10:10', '2026-09-01 04:10:10'),
(2751, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/testimoni', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:14:45', '2026-09-01 04:14:45'),
(2752, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:14:52', '2026-09-01 04:14:52'),
(2753, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/testimoni', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:17:30', '2026-09-01 04:17:30'),
(2754, 'pages.tentang', 'Tentang Kami', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/tentang-kami', 'http://127.0.0.1:8000/testimoni', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:20:49', '2026-09-01 04:20:49'),
(2755, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/tentang-kami', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:20:51', '2026-09-01 04:20:51'),
(2756, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:25:20', '2026-09-01 04:25:20'),
(2757, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:25:29', '2026-09-01 04:25:29'),
(2758, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:25:40', '2026-09-01 04:25:40'),
(2759, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:26:14', '2026-09-01 04:26:14'),
(2760, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/madinah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:26:33', '2026-09-01 04:26:33'),
(2761, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/madinah-hilton', 'http://127.0.0.1:8000/category/hotel/madinah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:26:42', '2026-09-01 04:26:42'),
(2762, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/madinah', 'http://127.0.0.1:8000/detail/madinah-hilton', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:26:53', '2026-09-01 04:26:53'),
(2763, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/category/hotel/madinah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:27:05', '2026-09-01 04:27:05'),
(2764, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:27:25', '2026-09-01 04:27:25'),
(2765, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:31:00', '2026-09-01 04:31:00'),
(2766, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', 'http://127.0.0.1:8000/articles', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:31:10', '2026-09-01 04:31:10'),
(2767, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8139/articles', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 04:31:37', '2026-09-01 04:31:37'),
(2768, 'articles.category', 'Seputar Madinah', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/artikel/kategori/seputar-madinah', 'http://127.0.0.1:8000/articles/mengapa-madinah-menjadi-bagian-penting-dalam-perjalanan-umroh', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:31:56', '2026-09-01 04:31:56'),
(2769, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/artikel/kategori/seputar-madinah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:32:28', '2026-09-01 04:32:28'),
(2770, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:32:40', '2026-09-01 04:32:40'),
(2771, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:32:49', '2026-09-01 04:32:49'),
(2772, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8139/articles/panduan-persiapan-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 04:32:51', '2026-09-01 04:32:51'),
(2773, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8139/testimoni', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 04:33:12', '2026-09-01 04:33:12'),
(2774, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8139/testimoni', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 04:33:33', '2026-09-01 04:33:33'),
(2775, 'articles.index', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/articles', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:37:03', '2026-09-01 04:37:03'),
(2776, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/testimoni', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:37:05', '2026-09-01 04:37:05'),
(2777, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/testimoni', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:55:28', '2026-09-01 04:55:28'),
(2778, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:55:31', '2026-09-01 04:55:31'),
(2779, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:55:35', '2026-09-01 04:55:35'),
(2780, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:58:18', '2026-09-01 04:58:18'),
(2781, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 04:59:37', '2026-09-01 04:59:37'),
(2782, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8140/testimoni', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:18:17', '2026-09-01 05:18:17'),
(2783, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8140/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:18:28', '2026-09-01 05:18:28'),
(2784, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8140/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:18:40', '2026-09-01 05:18:40'),
(2785, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8140/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:18:47', '2026-09-01 05:18:47'),
(2786, 'articles.show', 'Artikel', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8140/articles/panduan-persiapan-umroh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:18:56', '2026-09-01 05:18:56'),
(2787, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8140/testimoni', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:19:46', '2026-09-01 05:19:46'),
(2788, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8140/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:19:53', '2026-09-01 05:19:53'),
(2789, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8140/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:20:01', '2026-09-01 05:20:01'),
(2790, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 05:31:43', '2026-09-01 05:31:43'),
(2791, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 05:32:54', '2026-09-01 05:32:54'),
(2792, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 05:39:47', '2026-09-01 05:39:47'),
(2793, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 05:40:21', '2026-09-01 05:40:21'),
(2794, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8141', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:57:00', '2026-09-01 05:57:00'),
(2795, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8141/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:57:05', '2026-09-01 05:57:05'),
(2796, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8141/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:57:07', '2026-09-01 05:57:07'),
(2797, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Madinah', NULL, 'baru', 'http://127.0.0.1:8141/category/hotel/madinah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:57:10', '2026-09-01 05:57:10'),
(2798, 'pages.testimoni', 'Testimoni', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8141/testimoni', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:57:12', '2026-09-01 05:57:12'),
(2799, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8141/category/hotel/mekkah', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:57:32', '2026-09-01 05:57:32'),
(2800, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8141/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:57:34', '2026-09-01 05:57:34'),
(2801, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8141', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:57:36', '2026-09-01 05:57:36'),
(2802, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8141/detail/swissotel-al-maqam', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.22000.282', 'Desktop', 0, '2026-09-01 05:57:56', '2026-09-01 05:57:56'),
(2803, 'home', 'Beranda', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 05:59:35', '2026-09-01 05:59:35'),
(2804, 'category.show', 'Hotel', NULL, NULL, 'Hotel', NULL, NULL, 'baru', 'http://127.0.0.1:8000/category/hotel', 'http://127.0.0.1:8000/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 06:00:04', '2026-09-01 06:00:04'),
(2805, 'category.service', 'Hotel', NULL, NULL, 'Hotel', 'Mekkah', NULL, 'baru', 'http://127.0.0.1:8000/category/hotel/mekkah', 'http://127.0.0.1:8000/category/hotel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 06:00:11', '2026-09-01 06:00:11'),
(2806, 'detail.show', 'Detail Show', NULL, NULL, NULL, NULL, NULL, 'baru', 'http://127.0.0.1:8000/detail/swissotel-al-maqam', 'http://127.0.0.1:8000/category/hotel/mekkah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'Desktop', 0, '2026-09-01 06:00:44', '2026-09-01 06:00:44');

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
(33, 'Yahya Saptono', NULL, 'asman.lailasari@example.com', 'admin', NULL, '2026-08-16 16:18:20', '$2y$12$NjRsmIvVNAiTPpGRW/iZI.b4XEX7rzVc5Eww1mNIT7OEC5zAWuqdS', 1, 'FD2nipvSMK', '2026-08-16 16:18:20', '2026-08-16 16:18:20'),
(36, 'test', NULL, 'test@duyufuna.com', 'super_admin', NULL, NULL, '$2y$12$7LJkgf3lv33Q3imY3KfEquRog7Rne/Ttn26a/gYEH9HGbZc9PrMdi', 0, NULL, '2026-08-31 08:49:23', '2026-08-31 08:49:23');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `customer_status_histories`
--
ALTER TABLE `customer_status_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT untuk tabel `service_items`
--
ALTER TABLE `service_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2807;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
