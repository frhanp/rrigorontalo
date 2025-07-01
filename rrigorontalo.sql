-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+deb12u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2025 at 08:48 AM
-- Server version: 10.11.11-MariaDB-0+deb12u1
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rrigorontalo`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'WARTA PAGI', 'warta-pagi', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(2, 'WARTA SIANG', 'warta-siang', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(3, 'MAGOTA', 'magota', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(4, 'PUASA ORANG SUSAH', 'puasa-orang-susah', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(5, 'PAS JAM', 'pas-jam', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(6, 'CEK FAKTA', 'cek-fakta', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(7, 'ARUS MUDIK / BALIK', 'arus-mudik-balik', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(9, 'PRO 2 NEWS', 'pro-2-news', '2025-06-25 07:21:19', '2025-06-25 07:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 16, 2, 'test komentar', '2025-06-21 00:42:31', '2025-06-21 00:42:31'),
(2, 16, 2, 'jangan di baca', '2025-06-21 00:43:08', '2025-06-21 00:43:08'),
(3, 16, 1, 'komen admin', '2025-06-21 00:45:42', '2025-06-21 00:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_20_142958_create_categories_table', 1),
(5, '2025_06_20_143005_create_posts_table', 1),
(6, '2025_06_20_143012_create_comments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `media_type` enum('image','audio','video') DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `slug`, `content`, `media`, `media_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 'Sed quos assumenda enim mollitia.', 'sed-quos-assumenda-enim-mollitia-1750432822', 'Est voluptatum eos molestiae cupiditate eos blanditiis et. Sunt necessitatibus quae suscipit repudiandae magni.\n\nNumquam enim voluptatem id error accusamus et nihil sunt. Ducimus provident corporis ut et accusamus incidunt qui natus. Neque ab velit voluptatem voluptas minus autem est.\n\nMinima quaerat placeat velit sit dolorum dolor vero. Omnis qui ratione ratione rerum et. Facere assumenda sit quis repudiandae eaque debitis. Officiis laboriosam eum ipsa aliquam ipsum accusantium.\n\nUt nihil libero perspiciatis. Itaque consequatur sit id explicabo eius ipsam non. Aut molestiae qui fugit dolor autem.\n\nEst autem esse dolores laboriosam. Ut quibusdam soluta architecto dolorem. Eaque veritatis vero excepturi impedit. Quibusdam suscipit sit repellendus vel repellendus facere esse qui.\n\nVoluptatem dicta consequatur et facere. Aut ut hic ipsum aut est quo autem minima. Corporis ducimus iste deleniti.\n\nEst quia nihil nostrum dolor ducimus possimus. Atque ipsum rerum suscipit. Qui sit quis ipsa doloribus eos. Sunt sit maxime et eum.\n\nMagnam qui aut et qui veniam eveniet deserunt. Consequatur rerum eligendi error accusamus odio laborum. Explicabo distinctio sit non exercitationem dolor quia.\n\nEt vel quo illo maiores et. Voluptatem minus est tempore quidem perspiciatis occaecati praesentium. Voluptates in non excepturi. Aut officia qui aut nostrum sit consequatur a.\n\nQuia at quis voluptas magnam ut optio. Quaerat provident mollitia error iste. Temporibus accusantium optio veniam autem quia. Sit occaecati voluptatibus ut optio et est aut.', NULL, NULL, 'published', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(2, 2, 2, 'Nihil eius molestiae qui omnis eum.', 'nihil-eius-molestiae-qui-omnis-eum-1750432822', 'Dolore placeat dolores autem molestias laudantium vitae. Nihil rem in dolore ut culpa accusantium sed. Officiis est velit reiciendis hic.\n\nHarum earum vel dolores. Quibusdam est autem et aut nesciunt est. Perferendis pariatur error omnis libero ducimus sed sunt. Impedit quia qui aut reiciendis similique ut velit.\n\nQui rerum voluptas ullam nostrum saepe similique modi qui. Dolores reiciendis nulla aut suscipit nam facere.\n\nAccusantium odio sint molestias ut doloremque ullam libero alias. Non voluptate officiis praesentium ipsam. Libero perferendis provident praesentium consectetur est laudantium ea. Fugiat ducimus et deserunt mollitia.\n\nLaborum ipsum nihil tenetur necessitatibus. Aut quasi omnis totam. Aut nihil veniam possimus totam sit eos.\n\nCorrupti libero consequatur hic natus excepturi sint. In autem nulla cum quas eaque. Nisi dolorem et sed qui quisquam dolorem laborum eligendi. Nisi quia rerum provident nostrum.\n\nMaxime quae sed qui minima. Qui laborum qui voluptas harum excepturi dignissimos omnis velit. Vel id animi laborum exercitationem qui aut odit.\n\nVeniam optio deserunt dolores aut nesciunt odit. Temporibus consequatur impedit mollitia dolor molestiae. Officia autem nisi eius dolor sed eius vel. Blanditiis laboriosam cumque voluptatibus aut accusamus.\n\nEt ut voluptatibus beatae placeat. Omnis et quia enim corrupti fugiat hic. Non ipsam recusandae non autem et et molestiae voluptatem. Adipisci tempora repudiandae quos dolore.\n\nSed voluptas accusantium animi est. Labore est similique qui nihil in ipsam. Delectus dicta ea in delectus sed quis.', NULL, NULL, 'published', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(3, 2, 1, 'Et aliquid facilis ullam est qui cum quis.', 'et-aliquid-facilis-ullam-est-qui-cum-quis-1750432822', 'Illum quis rerum quos fugit debitis animi. Consectetur et odio rem dolores libero ex tempore. Blanditiis quia quo nulla velit. Fuga nostrum sit assumenda veritatis labore praesentium.\n\nEt qui voluptatem dignissimos consectetur aut ratione aut. Itaque reiciendis vitae facilis officia beatae. Quidem quaerat delectus fugit minus et.\n\nNumquam placeat alias molestias aut. Ut facere minus odit nostrum rem distinctio eligendi. Deserunt mollitia voluptate deserunt velit sed nesciunt suscipit. Eveniet deleniti voluptatem aut necessitatibus voluptas consectetur quas debitis.\n\nOfficiis sit sed minima et fugit. Velit totam architecto est ducimus numquam qui praesentium voluptatem. Nostrum consequatur quam dolor ullam consequatur molestias accusamus. Omnis in et omnis laborum aliquam non sit commodi.\n\nEx quis expedita debitis velit maiores maxime. Quisquam quasi distinctio id est. Dolore perspiciatis impedit aperiam in. Illum excepturi ullam nobis possimus sequi quia delectus.\n\nIpsum tempora possimus voluptatem optio dolorem. Expedita quia ut error mollitia fugit. Distinctio minus qui officia esse nihil dolor. Nesciunt corrupti minus est magni deleniti modi. Odio ut saepe incidunt debitis.\n\nNeque autem nesciunt aliquam illo voluptatem earum eligendi. Id repudiandae omnis rerum itaque placeat magnam a. Est maxime vel adipisci ex ducimus et ut. Qui et eius distinctio a voluptates.\n\nEst doloremque eaque asperiores facilis ullam laboriosam. Culpa cumque rerum maiores. Blanditiis sit id facilis.\n\nQui veniam velit similique commodi aut. Vel autem dolores dolorem eos itaque. Qui perspiciatis quibusdam cum dolorem.\n\nVoluptas voluptatem qui ab et in aut. Ut repellendus amet eveniet. Ipsam labore pariatur ut nulla eos qui. Saepe vel excepturi repellendus neque. Id voluptas aliquam rerum.', NULL, NULL, 'published', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(4, 1, 6, 'Est nostrum debitis ipsam quis hic minus est.', 'est-nostrum-debitis-ipsam-quis-hic-minus-est-1750432822', 'Ut cum autem dolor cupiditate maxime et. Quasi corporis aut delectus est et. Occaecati voluptatem sequi eveniet pariatur est earum magni quis. Id officia et placeat.\n\nQuos alias deleniti voluptas. In eos occaecati ducimus aspernatur temporibus voluptatibus. Perferendis ut omnis aspernatur hic in natus. Incidunt sed sit reiciendis. Temporibus et quis reprehenderit explicabo minus suscipit sed.\n\nIure velit ut asperiores modi dolorem. Pariatur labore maiores deserunt rerum. Incidunt omnis quae repellat impedit neque atque vel placeat.\n\nTempora dolore fugiat consequuntur ipsum. Earum ut aut illo quia dolores ut. Ut pariatur voluptate mollitia. Consectetur vel ab autem deleniti.\n\nVel ea tenetur laborum ex dolor ut. Dolorem tempore et voluptatem explicabo optio in non. Accusamus repellendus officiis voluptatibus quisquam in commodi esse corporis.\n\nNam enim modi numquam qui. Ipsum recusandae dolor in. Consequatur nulla necessitatibus velit totam voluptatem modi voluptate. Aut sed non accusamus quae corporis.\n\nRerum est libero esse consectetur voluptatem. Et quidem in et voluptatem dolorum. Fugiat voluptatem maxime suscipit sequi tempora et.\n\nVoluptate ipsum itaque veritatis tenetur facilis suscipit et. Illo eos deleniti et. Id blanditiis molestiae et eligendi. Quis doloremque neque dolorum ipsam sunt quia. Rerum praesentium corporis accusamus.\n\nFugiat enim consequatur maxime quaerat expedita est. Atque velit omnis sequi qui sit ea fugit. Consequatur maxime neque magnam ducimus dolor vitae neque voluptatibus. Temporibus a quisquam optio quae et soluta dolores omnis.\n\nDolores aliquam ut odio. Corrupti velit dolorum amet sapiente odit consequatur voluptas.', NULL, NULL, 'published', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(5, 2, 4, 'Tenetur voluptas aliquam doloribus dolorem ex a.', 'tenetur-voluptas-aliquam-doloribus-dolorem-ex-a-1750432822', 'Tempore libero rerum maiores tempore non nam. Accusamus debitis alias non quia soluta quidem delectus quos. Voluptatem quas consequatur aut nam qui. Molestiae ad quasi mollitia. Beatae magnam sint rerum ullam qui.\n\nIn ut nostrum nihil nobis qui ut. Vel repellat tenetur quam. Voluptatem et sit praesentium est velit. Nobis facere enim vero pariatur hic.\n\nPossimus ullam omnis ut ipsum. Quas eaque ratione eum aut vel. Ullam totam voluptatem et eos. Quidem cum voluptates impedit culpa beatae fuga ipsam.\n\nEt debitis soluta iste eligendi eum facilis. Velit libero porro maiores voluptatum ab. Et ipsam veritatis exercitationem in. Occaecati et voluptatem tempora aut similique unde corporis.\n\nLabore sit eligendi excepturi possimus in. Aut molestias qui illo nesciunt sit. Est sed officiis eaque nihil recusandae commodi. Sit qui aut voluptatibus odit.\n\nEt eos iure in quaerat repellat est sunt. Autem et modi officia. Esse et inventore est velit ut. Aut consequatur quam aut voluptatem quae laudantium. Aut autem ratione consequatur excepturi vero maiores ex.\n\nAdipisci ipsa aut et repellendus ipsum. Minus sunt autem dolor accusamus. Exercitationem ipsam animi error ullam eos. Minima praesentium asperiores cupiditate dolore qui odit dolorem. Dicta itaque vel architecto.\n\nVoluptate facilis eos quas natus quia. Non inventore aut blanditiis fugiat illo. Magnam dicta officiis voluptatem mollitia delectus harum sit expedita. Expedita minus distinctio eos facilis ut eius. Nihil expedita sed quia eaque illo quia quia.\n\nAut doloribus nemo laboriosam deleniti quaerat asperiores magni. Adipisci voluptate quibusdam expedita adipisci praesentium. Dolor et et minus assumenda aut quis consequatur. Ea inventore itaque error voluptates sit.\n\nAperiam deleniti consequuntur voluptatum pariatur ullam qui. Quasi fugiat et natus delectus sit nihil consectetur ut. Dolore harum recusandae assumenda voluptas voluptatem tempora.', NULL, NULL, 'published', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(6, 2, 5, 'Aut et placeat sint officia sint.', 'aut-et-placeat-sint-officia-sint-1750432822', 'Voluptatem exercitationem minus dolore nesciunt perspiciatis aut modi. Fugiat ut molestiae assumenda nobis voluptatem. Rem ut magni reprehenderit harum minus.\n\nNumquam optio laboriosam aut. Cumque voluptatem iure et esse et perferendis quis. Ut cum reiciendis minus quae nostrum alias.\n\nSunt cum nostrum dolor alias iure et ut. Adipisci et ea officia unde provident modi. Vitae ad sit in earum et. Ullam maiores dolorem magni ab ea.\n\nNumquam qui non enim autem minus ratione. Explicabo voluptatem accusantium voluptas voluptas. Et vero nobis perspiciatis unde mollitia maiores sint qui. Veritatis aperiam et doloribus aut ab officiis numquam.\n\nMolestiae laboriosam eum nihil iste voluptatem alias. Voluptatem autem laborum occaecati labore quo voluptatem quidem ipsum. Qui dolor temporibus et quae modi.\n\nEos quae qui iure ea in rerum. Reprehenderit voluptas minima odit vel omnis ut necessitatibus. Aliquam aut cumque ex consequatur doloribus voluptates. Laudantium perferendis eum ad eius porro ex accusamus et.\n\nOmnis in nemo doloremque neque est laboriosam molestiae. Repellendus deserunt veritatis recusandae architecto numquam unde in voluptatibus. Esse sint maxime voluptas officia aspernatur sit suscipit.\n\nDolores qui soluta ipsa at. Amet sunt et architecto aut. Est eveniet cumque blanditiis veritatis distinctio et. Omnis vitae accusamus quam et laudantium modi.\n\nVoluptate totam exercitationem excepturi facere quidem et. Sed suscipit ipsa et ut officia voluptas eum quas. Voluptatem a maiores itaque.\n\nBlanditiis atque est voluptas eos nobis. Accusantium praesentium quo sed et ducimus quasi. Autem ipsa numquam voluptas amet.', NULL, NULL, 'published', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(7, 1, 6, 'Ea eveniet repellat suscipit temporibus.', 'ea-eveniet-repellat-suscipit-temporibus-1750432822', 'Aut quia voluptas cumque qui. Autem adipisci repudiandae rem aut corrupti. Eaque dolorem maiores ea omnis odio. Sint et ut necessitatibus iste ipsum.\n\nSunt eaque vero numquam voluptatem iusto. Expedita vero quas deleniti ipsum. Facere ut necessitatibus et non. Temporibus incidunt corporis amet est possimus delectus numquam non. Ea quisquam quis quas facere esse sed.\n\nVoluptas et minima corrupti dignissimos. Sunt neque quam expedita nisi deserunt vel illo incidunt. Et tempora dolorem sit nam dolore necessitatibus fuga placeat. Et quasi aliquam qui tempore earum voluptas quo. Aut molestiae sequi sapiente eos.\n\nAtque sit accusamus quia itaque. Et maiores quasi quos unde iste vitae. Assumenda autem aperiam dicta nostrum voluptatem. Est hic fugit sit magni vel quae reprehenderit. Tenetur quis doloribus est mollitia qui libero.\n\nIn dolor perferendis blanditiis assumenda necessitatibus. Ea sit minus quis impedit. Aliquid at quod quibusdam atque recusandae deleniti. Magni corrupti ab soluta sit mollitia et consequatur est.\n\nEt porro asperiores possimus cupiditate. Rerum quos possimus aut. Magnam veritatis velit doloribus accusamus doloribus atque.\n\nUt aperiam et quas nisi. Aliquam in qui quisquam pariatur hic est eveniet. Odio doloremque quo qui doloribus. Error est ut occaecati delectus.\n\nLaborum est dolorem impedit. Beatae et et atque laudantium quis ut dignissimos. Eos maxime reiciendis et sed omnis consectetur quo.\n\nArchitecto culpa ut quis consequuntur omnis dolorum similique. Nihil quisquam maiores error. Aspernatur recusandae aliquid sed quidem rerum. Ipsa enim et quaerat voluptatibus quae.\n\nLibero exercitationem harum sit aut et aspernatur in. Cum natus saepe omnis et qui quis. Vitae omnis animi sunt qui id ex quo.', NULL, NULL, 'published', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(10, 2, 7, 'INFO ARUS MUDIK BALIK 6 APRIL 2025', 'info-arus-mudik-balik-6-april-2025-1750830654', '<p>Kapolsek Kawasan Pelabuhan Gorontalo (KPG), Ipda Reza Reyzaldy, bersama dengan Wasatpel Pelabuhan Penyeberangan Gorontalo, berhasil melakukan penanganan cepat terhadap gangguan teknis yang terjadi pada kapal motor penumpang (KMP) Tuna Tomini. Kejadian ini sempat menyebabkan penundaan keberangkatan kapal yang mengangkut 117 penumpang dari Pelabuhan Ferry Gorontalo menuju Ampana dan Wakai, Provinsi Sulawesi Tengah.// Menurut penjelasan Kapolresta Gorontalo Kota, Kombespol Ade Permana melalui Ipda Reza, masalah tersebut bermula saat supervisi kesiapan kapal oleh anak buah kapal (ABK) menemukan adanya ketidakstabilan pada mesin penggerak kapal. //&nbsp; Sebagai langkah tanggap, Ipda Reza bersama tim Wasatpel memanfaatkan alat selam dari Oceana Resort untuk menyelam ke bawah kapal dan menemukan tali yang melilit pada propeller (baling-baling) kapal. // Setelah dilakukan penanganan, mesin kapal kembali stabil, dan propeller berputar normal. Kapal yang semula direncanakan berangkat pada pukul 15.00 WITA mengalami penundaan selama 45 menit akibat masalah teknis tersebut. Penundaan ini pun tidak berdampak besar terhadap operasional kapal, yang segera siap untuk berlayar.//&nbsp; Wasatpel Deni S.M. Abdul, mengapresiasi kolaborasi antara Pelabuhan dan Polsek KPG dalam menangani masalah ini dengan cepat dan efektif. //</p>', NULL, NULL, 'published', '2025-06-20 07:20:23', '2025-06-25 05:50:54'),
(11, 2, 6, 'Evakuasi Korban Pesawat Perintis SAM AIR', 'evakuasi-korban-pesawat-perintis-sam-air-1750828937', '<p>KORBAN PESAWAT PERINTIS ATR MILIK SAM AIR RUTE GORONTALO-POHUWATO YANG MENGALAMI KECELAKAAN SAAT MENDARAT DI BANDARA PANUA POHUWATO/ HARI INI/ PUKUL 07.30/ SUDAH DIEVAKUASI OLEH TIM SAR GORONTALO// ADA TOTAL 3 CREW PESAWAT DAN SATU PENUMPANG// SELENGKAPNYA KITA IKUTI WAWANCARA BUDI AKANTU BERSAMA KEPALA BASARNAS GORONTALO HARIYANTO///</p>', NULL, NULL, 'published', '2025-06-20 07:20:23', '2025-06-25 05:22:17'),
(13, 1, 2, 'WARTA SIANG 25 JUNI 2025', 'warta-siang-25-juni-2025-1750830999', '<p><strong>PUKUL 14.00 WAKTU INDONESIA TENGAH, RADIO REPUBLIK INDONESIA GORONTALO DENGAN WARTA SIANG</strong></p>\r\n<p><strong>Warta Siang/25 Juni 2025/14.00/008/Sosial/Kab-Gtlo</strong></p>\r\n<p><strong>&nbsp;</strong>Kunjungan Menteri desa dan PDT di Provinsi Gorontalo fokus pada pengembangan koperasi merah putih di seluruh wilayah yang ada di Kabupaten Kota.// Pada kesempatan itu disampaikan kepada para pengurus agar mulai memilih dan memperhatikan berbagai puluang bisnis yang akan dikembangkan.// Pembina Kopdes Merah Putih Desa Tinelo Kabupaten Gorontalo Rusdiyanto Achmad mengutarakan pihaknya terus berdiskusi dengan para pengurus tentang peluang bisnis yang&nbsp; dikembangkan di desa berdampak pada meningkatkan kesejahteran &nbsp;masyarakat.// Diperkirakan rencana peluang bisnis kedepan mengacu pada pengelolaan gas elpigi, kemudian membuat gerai sembako maupun pertanian.// Pemerintah pusat berharap semua peluang bisnis yang akan dilaksanakan nanti muaranya harus dapat menciptakan kesejahteraan bagi seluruh masyarakat yang ada di desa ini.//</p>\r\n<p>&nbsp;</p>', 'posts/OPvpq6bxdgkGf0ADtE3F5l8QGLAnezy7xwGVNa1B.mp3', 'audio', 'published', '2025-06-20 07:20:23', '2025-06-25 05:56:39'),
(14, 2, 4, 'Occaecati explicabo vel minus et quas cumque quaerat qui.', 'occaecati-explicabo-vel-minus-et-quas-cumque-quaerat-qui-1750432823', 'Et est ipsa quia porro accusantium. Aspernatur sint commodi fuga qui expedita delectus temporibus. In natus velit ex voluptatem voluptas assumenda voluptates.\n\nQuis facere ut dolorum non ullam asperiores recusandae eos. Dolores omnis consequatur veritatis esse ipsam ut dolores. Temporibus inventore voluptas et sed quae est. Sit optio odit ipsum veritatis placeat quas autem eligendi.\n\nAut amet non quisquam eos aut aut id. Alias minima facilis maiores est et nihil incidunt. Aperiam sit illo nulla enim sequi deserunt illum quaerat. Et fugit quis cumque consequuntur ea amet omnis.\n\nAliquam atque corrupti officia. Reiciendis nulla consequatur eaque aperiam incidunt vel a. Iste illo voluptatem saepe voluptatum laboriosam.\n\nEt quod dolore quaerat rerum doloremque. Voluptatem est eligendi dolor sit. Quos in quaerat reprehenderit laborum provident. Laborum totam ut porro numquam.\n\nVeniam et ipsum possimus consequatur quaerat tempore. Rem rerum consequatur expedita perferendis. Sed sit voluptatem consequatur atque qui ab. Officia eos molestiae quos cumque nobis est.\n\nOdio voluptatem voluptatem repudiandae culpa sapiente nihil aut. Et et eum sapiente tenetur dolorem blanditiis eos. Vitae magni qui tenetur ut aperiam et nemo consequuntur. Placeat aut culpa sit est porro ut.\n\nSapiente quia aliquid exercitationem ex. Similique ut accusamus error excepturi quaerat.\n\nUllam itaque qui est laborum odio rerum. Sed et reiciendis et vel enim deleniti repudiandae. Eos expedita rerum quam eaque architecto. Tempora corporis consectetur odit nobis iure in repellat.\n\nAut veniam atque odit consectetur voluptas eaque mollitia. Repellat illo at omnis voluptatem. Aliquid expedita saepe vitae sint. Cum numquam porro occaecati. Excepturi explicabo recusandae quia a modi dolor.', NULL, NULL, 'published', '2025-06-20 07:20:23', '2025-06-20 07:20:23'),
(15, 1, 4, 'Magnam quia recusandae dolores eum explicabo accusamus libero.', 'magnam-quia-recusandae-dolores-eum-explicabo-accusamus-libero-1750432823', 'Tenetur voluptas voluptatem nam sunt velit rem consectetur. Aut ullam eligendi sint dignissimos odit. Fuga quaerat et minus occaecati esse alias qui.\n\nIusto dignissimos dicta voluptates blanditiis quis. Doloribus illum nihil aut quo omnis. Aut aut tempore qui illum.\n\nQuis sint molestiae impedit. Consequatur laudantium quia cum enim. Rerum velit incidunt vel eveniet at sequi repellendus. Omnis dolores natus accusamus dicta et.\n\nAut nulla ipsum ab magni. Amet deleniti perferendis quia dolor quo qui. Earum autem alias quidem omnis qui.\n\nReiciendis maxime aliquid nesciunt omnis laudantium dolore. Suscipit nulla totam voluptas adipisci repellat deserunt. Architecto atque totam cum ea.\n\nAut totam provident doloremque dolore delectus qui quos. Qui vero ut et corrupti animi ipsa. Minus ea ab pariatur officiis ea magni porro. Qui magnam alias enim eaque ut libero.\n\nConsequatur magni amet facere ullam. Vel eligendi ipsum explicabo quis. Odio at eaque laborum.\n\nVoluptatem magni earum animi accusamus a placeat ut ut. Consequuntur magnam nostrum cum ut. Odio et labore sit fuga. Fuga omnis est quia repudiandae recusandae aut.\n\nDolores nihil qui tenetur minima porro eius magnam. Iusto ullam quasi quam et necessitatibus quis at. Perferendis blanditiis aperiam fugiat modi quam accusantium et.\n\nNon est eum iure suscipit. Enim vitae dicta officiis molestiae est quia. Voluptates temporibus voluptates expedita quia accusantium et.', NULL, NULL, 'published', '2025-06-20 07:20:23', '2025-06-20 07:20:23'),
(16, 2, 6, 'Fakta Masa Pubertas Anak Pengaruhi Tinggi Badan', 'fakta-masa-pubertas-anak-pengaruhi-tinggi-badan-1750828727', '<p>Masa pubertas pengaruhi tinggi badan anak, benarkah demikian?</p>\r\n<p>Pendengar tinggi badan seorang anak bukan hanya dipengaruhi faktor genetik dan gizinya saja tapi juga cepat lambatnya iya memasuki usia pubertas.</p>\r\n<p>Hal tersebut bisa menjelaskan mengapa anak perempuan terlihat lebih tinggi di usia sekolah dasar, tapi di usia remaja anak laki-laki bisa lebih jangkung lagi.</p>\r\n<p>Mengutip dari health.com, dr. Aman Pulungan, SP.Ak ahli endokrinologi dari fakultas kedokteran Universitas Indonesia mengatakan, selama masa puber seorang anak akan mengalami pertumbuhan yang pesat sehingga tinggi badannya juga ikut bertambah. Saat pubertas tinggi badan anak bisa bertambah maksimal sampai 23 cm. Berbeda dengan anak perempuan, anak laki-laki justru baru mengalami percepatan tinggi badan diakhir masa pubertasnya. Ini sebabnya meski di usia sekolah dasar anak perempuan dan anak laki-laki akan sama tingginya, namun setelah masuk usia remaja anak laki-laki akan lebih tinggi.</p>', NULL, NULL, 'published', '2025-06-20 21:47:03', '2025-06-25 05:18:47'),
(17, 1, 6, 'Mitos Bayi Botak Karena Bumil Makan Pedas', 'mitos-bayi-botak-karena-bumil-makan-pedas-1750828650', '<p>Pendengar banyak kabar mengenai pantangan makanan yang harus dipatuhi oleh ibu hamil salah satunya adalah makanan pedas. Makanan ini dianggap bisa menimbulkan keguguran bahkan dipercaya dapat menyebabkan bayi botak, mitos atau fakta?</p>\r\n<p>Mengutip dari alodokter.com kehamilan membuat bumil perlu lebih selektif dalam memilih makanan atau minuman, soalnya segala yang bumil konsumsi bisa mempengaruhi proses &nbsp;tumbuh kembang janin didalam kandungan. Namun makanan pedas tidak termasuk dalam makanan yang perlu bumil hindari kok.</p>\r\n<p>Bila sebelum hamil bumil sangat gemar mengkonsumsi makanan pedas dan berbumbu tajam, misalnya yang mengandung banyak cabai, lada, atau jahe.<br>Saat hamil pun bumil tidak perlu menghindari makanan ini. Mengonsumsi makanan pedas saat hamil boleh-boleh saja dan tidak akan membahayakan janin. Jadi anggapan bahwa makanan pedas bisa menyebabkan kegururan dan menyebabkan kebotakan pada bayi hanyalah mitos yang tidak didukung oleh penelitian mauopun bukti klinis.</p>', 'posts/JOMig8zloHdCSKFfBxtkXQVqn0STT9p2pPQcmvyP.mp3', 'audio', 'published', '2025-06-21 01:36:00', '2025-06-25 05:17:30'),
(18, 1, 1, 'WARTA PAGI 25 JUNI', 'warta-pagi-25-juni-1750830401', '<p><span style=\"font-family: \'times new roman\', times, serif;\"><strong>PUKUL 06.00 WAKTU INDONESIA TENGAH, RADIO REPUBLIK INDONESIA GORONTALO DENGAN WARTA PAGI</strong></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif;\"><strong>TOPIK UTAMA TERSEBUT MERANGKAI SEJUMLAH BERITA LAINNYA YANG&nbsp; DIHIMPUN TIM REDAKSI RRI GORONTALO//&nbsp; INILAH WARTA PAGI SELENGKAPNYA, BERSAMA SAYA &hellip;&hellip;.</strong></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif;\"><strong>Warta Pagi 25 Juni 2025 009 RRI Ekon</strong></span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">Kabupaten Gorontalo menjadi daerah dengan serapan anggaran tertinggi se-provinsi Gorontalo pada periode triwulan pertama tahun 2025 // laporan Andi Sanga</span></p>', 'posts/RJ8e6PGGreSgBLvmkMIw6U3ZpDI1gOtxkBL9qqon.mp3', 'audio', 'published', '2025-06-23 06:12:25', '2025-06-25 05:46:41'),
(19, 1, 1, 'warta pagi 23 juni 2025 006', 'warta-pagi-23-juni-2025-006-1750660187', 'Pembentukan Koperasi Desa Merah Putih di seluruh desa dan kelurahan diharapkan dapat menjadi solusi konkret bagi masyarakat yang kerap terjerat Pinjaman Online  atau Pinjol.//  Koperasi ini hadir untuk memberikan akses pembiayaan yang lebih aman, terjangkau, dan mengutamakan kesejahteraan warga.//  Elvis Umar, Ketua Koperasi Merah Putih Desa Hulawa, Kabupaten Pohuwato, kepada RRI menyampaikan bahwa maraknya praktik pinjol ilegal telah meresahkan masyarakat.// Oleh karena itu, keberadaan koperasi ini diharapkan mampu menjadi alternatif yang lebih baik dan terpercaya.//', 'posts/m50E9eWCyiAMcBaDK3YVvYDOtXQfgiH7ht28A598.mp3', 'audio', 'published', '2025-06-23 06:29:47', '2025-06-23 06:29:47'),
(20, 1, 3, 'LINTAS MAGOTA 3 MARET 2025', 'lintas-magota-3-maret-2025-1750828471', '<p style=\"text-align: left;\"><strong>OBB (TUNE BUKA)&nbsp; LINTAS MAGOTA</strong></p>\r\n<p style=\"text-align: left;\"><strong>PUKUL 17.00 WAKTU INDONESIA TENGAH, RADIO REPUBLIK INDONESIA GORONTALO DENGAN LINTAS MAGOTA&nbsp;&nbsp; MANADO, GORONTALO, TAHUNA DAN TALAUD.// BERITA&nbsp; SELENGKAPNYA, BERSAMA SAYA &hellip;&hellip;</strong></p>\r\n<p style=\"text-align: left;\"><strong>LINTAS MAGOTA 3 MARET 2025</strong></p>\r\n<p style=\"text-align: left;\">Lintas Magota kami awali dari Gorontalo.// Selama bulan ramadan, Balai POM dan pihak terkait akan melakukan pengawasan jajanan buka puasa.//Pengawasan itu dilakukan untuk memberikan keamanan bagi konsumen untuk mendapatkan takjil yang mengandung bahan yang tidak diperbolehkan sebagai campuran makanan.//</p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\">&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;- BERITA BUDI AKANTU</p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><strong>LINTAS MAGOTA 3 MARET 2025</strong></p>\r\n<p style=\"text-align: left;\">Dari Gorontalo kita langsung menuju ke Talaud.// Lanal Melonguane Mendukung Penuh Program Hanpangan Nasional Lewat Pembudidayaan berbagai jenis tanaman dan sektor perikanan.//</p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\">&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&ndash; BERITA ROBERT TAMAROBA</p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><strong>PENDENGAR/ DEMIKIAN LINTAS MAGOTA&nbsp;&nbsp; MAGOTA, MANADO, GORONTALO, TAHUNA TALAUD.</strong></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><strong>SAYA &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;. ATAS NAMA KERABAT KERJA YANG BERTUGAS MENGUCAPKAN TERIMA KASIH ATAS PERHATIAN DAN KEBERSAMAAN ANDA// SAMPAI JUMPA//&nbsp;</strong></p>', NULL, NULL, 'published', '2025-06-25 05:13:24', '2025-06-25 05:14:31'),
(21, 1, 9, 'PRO2 NEWS 25 JUNI 2025', 'pro2-news-25-juni-2025-1750836253', '<p>Porto akan menghadapi Al Ahly dalam turnamen Piala Dunia Antarklub 2025. Pertandingan ini bakal dimainkan di MetLife Stadium, New Jersey,&nbsp; Amerika Serikat&nbsp; , Selasa (24/6/ 2025) pukul 8.00 WIB.// Pelatih Porto asal Portugal Mart&iacute;n Anselmi menilai Al Ahly adalah lawan yang kuat. Apalagi, Al Ahly memiliki pelatih yang bagus dan pemain yang dinamis, dan merupakan juara Mesir.//Meski demikian, ia bertekad memenangkan pertandingan melawan Al Ahly guna memberi kebanggaan bagi para penggemar Porto.</p>', NULL, NULL, 'draft', '2025-06-25 07:24:13', '2025-06-25 07:24:13'),
(22, 1, 5, 'warta', 'warta-1750838516', '<p>apakah</p>\r\n<p>http://11.9.45.15:8080/sharedrive/Warta%20Pagi%2023%20Juni%202025/Actuality%20Insert%20Arifasno%20Napu%20Warta%20Pagi%2023%20Juni%202025%20On%20Air.mp3</p>', NULL, NULL, 'published', '2025-06-25 08:01:42', '2025-06-25 08:01:56'),
(24, 1, 1, 'warta pagi', 'warta-pagi-1751014086', '<p>KBRN, Jakarta: Wakil Ketua DPR RI// Cucun Ahmad Syamsurijal mendorong//</p>\r\n<p>&nbsp;pemerintah membentuk Direktorat Jenderal (Ditjen) Pesantren di kementerian terkait/</p>\r\n<p>Semua itu, demi pemerintah bisa fokus mengatur tata kelola</p>\r\n<p>dan pengembangan lembaga pendidikan pesantren.&nbsp;</p>\r\n<p>&ldquo;Jelas, kita akan dorong (pembentukan Ditjen Pesantren),</p>\r\n<p>ini baru 350 pesantren, yang pasti semua ingin kehadiran (Ditjen) pesantren.</p>\r\n<p>Negara bisa hadir, bisa melihat bagaimana</p>\r\n<p>entitas pesantren punya peran penting terhadap pembangunan karakter anak bangsa,&rdquo; kata politikus PKB ini dalam keterangannya, di Jakarta, Jumat (27/6/2025).&nbsp;</p>', NULL, NULL, 'published', '2025-06-27 08:48:06', '2025-06-27 08:48:06'),
(25, 1, 2, 'WARTA SIANG 23 JUNI 2025', 'warta-siang-23-juni-2025-1751015816', '<p><strong>Warta siang /23 juni 2025/14.00.008/sosial kab-gor</strong></p>\r\n<p>Menurutnya, keberadaan Ditjen Pesantren dapat menjadi</p>\r\n<p>tindak lanjut dari Undang-Undang Nomor 18 Tahun 2019</p>\r\n<p>tentang Pesantren. Beleid tersebut, menjadi dasar</p>\r\n<p>hukum untuk mengkaji pembentukan direktorat khusus tersebut.&nbsp;</p>\r\n<p>--------------------------------------------------------- audio</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Warta siang/23 juni 2025 006 RRI Sosial</strong></p>\r\n<p>&ldquo;Kita punya Undang-Undang 18 tahun 2019 ini//</p>\r\n<p>itu menjadi satu upaya hukum cantolan//</p>\r\n<p>Tindak lanjut dari sini ada Komisi VIII yang membidangi agam//</p>\r\n<p>apakah perlu segera didorong Direktorat Jenderal (Ditjen) Pesantren//</p>\r\n<p>&nbsp;sehingga fokus,\" ucap Cucun//</p>\r\n<p>---------------------------------audio</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Warta siang 23 juni 2025 006 RRI Sosial</strong></p>\r\n<p>Pelaksanaan RUPSLB merupakan tindak lanjut atas ketentuan//</p>\r\n<p>regulator yang mewajibkan penyampaian RKAP kepada OJK sebelum akhir Juni//</p>\r\n<p>Selain itu//&nbsp; juga untuk memastikan struktur tata kelola</p>\r\n<p>perusahaan sesuai dengan POJK No. 23 Tahun 2023.</p>\r\n<p>------------------------------------------- audio</p>\r\n<p>&nbsp;</p>', NULL, NULL, 'published', '2025-06-27 09:16:02', '2025-06-27 09:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2xrEYCxpc5nJzXSOqJDGRW7HMyZwCzCnOUE8IMhK', NULL, '43.153.54.14', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDd6MkkwaHA5bFluRXJ0MjNnRGFyWmlralRabDdWcW5HWW43QzRncSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly83MC4xNTMuMTM3LjExNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751032796),
('CQLizHUpMnEInxRSa4gl0t5v9RB4UV0AxQTkjR8m', NULL, '222.112.53.206', 'curl/7.88.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmN4Nm92dXNBWW05U2x4eUhFWlFLZDVKd0NkVFRaN0JrT1RnRFhzWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly83MC4xNTMuMTM3LjExNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751034515),
('CwrlgOy7PRshBSKY74wcc1id5AA7d3vOpvfMWvNg', NULL, '185.218.84.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidlJsM1pva0c5cW9lUkd6ZVpMUUp5ZEswU3IzS1BERXdCc0RoREJneCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly83MC4xNTMuMTM3LjExNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751032063),
('deyNhyoCbf8OSaz8FLVh9gUB2FkO6A3IH6ADZMqc', NULL, '185.218.84.40', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQWlCMU10SFZDeEhWTnhjNkRVd2FvYms3VExJQXd5Nlk2cTZLV2k5ViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly83MC4xNTMuMTM3LjExNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751025065),
('dZKk9nk5I2kjgAwf3A3eEshMRw1UgLGXl93PD6wo', NULL, '185.218.84.46', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1ZpUG5meTIzNlVtWWRLYzVGR3BpYUxQWWNHVjB0SFNZYnFkclFSbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly83MC4xNTMuMTM3LjExNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751026894),
('ECkwt71d1nrFVNFDx6JxbDpaN0RGm3r76TjCHGXv', NULL, '185.218.84.47', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMFBnTVZGc1BvZjdISTlYZ1RnOU5saFdJTVNDRE9xc3ZoTzZIQ051RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly83MC4xNTMuMTM3LjExNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751027145),
('g02auzi0tiAMwFto8fX7F0V8vqQckZwSZLp8qwTp', NULL, '185.218.84.45', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR254ejdyWkdHZnBVdnEwS1FUMEJmcUtseUZrR0tWMDYyNXdyQU5UMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly83MC4xNTMuMTM3LjExNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751026651),
('hLrHq5t1tsP4HkkMRnzD7JTWrClsWY2OfA8sFJk0', NULL, '204.76.203.206', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidXYwTjBJMzdQcVVCVTBxbHB4NW02RFptV3M1MzJTQlVBenNBMGFEVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly83MC4xNTMuMTM3LjExNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751030407),
('PRos8LvVcL8ppnyu8EmGrIRXO77rkBGdeUutjQwJ', NULL, '70.153.137.115', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidkpwYXpDdnEwQXlTTUlNa0hZYUxMNldRN0lpNTVCbk1RVWZ6Y0pwciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9ycmlnb3JvbnRhbG8ubWFnYW5ndW5nLnNpdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751036768),
('Pv0WoafPbGiLaCnAHcHpjrgRkObhGwmd6eh6NkE3', NULL, '3.131.215.38', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTdpZXpoVDcyWG1aekM3S3F6akFzNWlQanNPUnRQbkQ0aUU1SkttYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly83MC4xNTMuMTM3LjExNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751031664),
('QQxVDFtVK1v7DGRnrEX9hIm0AEi13DWNgSXGH2nK', NULL, '108.165.153.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiaGk3V0I3RzF0YXJrM3VTT3pJUGZPNHBnbWJCSlczN1paa1Z2ZURhSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1751034868),
('T1IiRpTzk8UciLFOiBPYiuKiHI0c1xFbDu1WJhKZ', NULL, '79.124.58.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1ZuRE45UmNyc0cyUzFMeTBoVzVYYjRFQU9XeVRHZVVlYjdncnZHeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly83MC4xNTMuMTM3LjExNS8/WERFQlVHX1NFU1NJT05fU1RBUlQ9cGhwc3Rvcm0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1751034131),
('uwcjJeSzPHD2SCMJwZA9LHRc5vsAGxr2zDfp5h9l', NULL, '3.131.215.38', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDAwUmNqamZ0TGpUeGN5c1hWYnRabHFpTjFneXlJV2VlbTV0TGI1dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly83MC4xNTMuMTM3LjExNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751031828),
('vPwYHwLdyzL1Ue4zmB40Fowf97WAUIDXD9inZwaB', NULL, '87.121.84.212', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYVU3UGdxOVlkV2JtZ1owWXBHQlh4cW5ZbVVjUkoyM3V1Rk9JaktLZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1751036177),
('Xq6vqGHA6GWSucKxOkpiEX2vK5wwdiqw5bLHjKQe', NULL, '157.230.93.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/118.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHh3TGUxTzF5T3JFQTFXY0FhNUlaMXVqeFEwZlBFaG5zSWN5Q2ZPSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly83MC4xNTMuMTM3LjExNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751025221);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','editor') NOT NULL DEFAULT 'editor',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@gmail.com', '2025-06-20 07:20:21', '$2y$12$IvAr9JHowFEnzphwAgGJf.5aNBQ5JTo6PKNzOzHcdCzcUqrIiwJ2K', 'admin', 'vLdOOy9lyk0CbMkT1feVeeaWkDi0EeUJgx8CAHj47PztfnWHZcm9Q6IrcAX0', '2025-06-20 07:20:22', '2025-06-20 07:20:22'),
(2, 'Editor User', 'editor@gmail.com', '2025-06-20 07:20:22', '$2y$12$IvAr9JHowFEnzphwAgGJf.5aNBQ5JTo6PKNzOzHcdCzcUqrIiwJ2K', 'editor', '6zpBOr0CQqg1JPzfp5HvYgl6GEU3VszSWdcJFwFBjKKRjXp9rAdj8ODonQIp', '2025-06-20 07:20:22', '2025-06-20 07:20:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
