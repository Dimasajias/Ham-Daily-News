-- MySQL dump 10.13  Distrib 9.3.0, for macos15 (arm64)
--
-- Host: 127.0.0.1    Database: daily_ham
-- ------------------------------------------------------
-- Server version	9.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `office_id` bigint unsigned NOT NULL,
  `wilker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extracted_title` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `social_media_links` json DEFAULT NULL,
  `extracted_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_dokumentasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `approved_by` bigint unsigned DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activities_user_id_foreign` (`user_id`),
  KEY `activities_approved_by_foreign` (`approved_by`),
  KEY `activities_status_index` (`status`),
  KEY `activities_office_id_status_index` (`office_id`,`status`),
  CONSTRAINT `activities_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `activities_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,5,10,'Daerah Khusus Jakarta','setjen','Sosialisasi HAM di Kelurahan Menteng — Kegiatan penyuluhan hak asasi manusia untuk masyarakat setempat.',NULL,'[{\"url\": \"https://www.instagram.com/p/example1/\", \"platform\": \"instagram\"}]','https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?w=600',NULL,'approved',NULL,1,'2026-04-10 22:17:12','2026-04-12 22:17:12','2026-04-12 22:17:12'),(2,5,10,'Daerah Khusus Jakarta','itjen','Workshop Pelayanan Publik Digital — Pelatihan digitalisasi layanan hukum untuk petugas Kanwil DKI.',NULL,'[{\"url\": \"https://www.tiktok.com/@example/video/123\", \"platform\": \"tiktok\"}]','https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600',NULL,'approved',NULL,1,'2026-04-11 22:17:12','2026-04-12 22:17:12','2026-04-12 22:17:12'),(3,4,8,'Jawa Barat','dit_pdk','Bakti Sosial Kanwil Jawa Barat — Pembagian sembako dan konsultasi hukum gratis di Bandung.',NULL,'[{\"url\": \"https://www.instagram.com/p/example3/\", \"platform\": \"instagram\"}]','https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600',NULL,'approved',NULL,1,'2026-04-12 10:17:12','2026-04-12 22:17:12','2026-04-12 22:17:12'),(4,7,12,'Jawa Timur','dit_idp','Upacara Hari Bhakti Imigrasi ke-74 — Peringatan hari besar di Kanwil Jawa Timur.',NULL,'[{\"url\": \"https://www.youtube.com/watch?v=example4\", \"platform\": \"youtube\"}]','https://images.unsplash.com/photo-1523050854058-8df90110c476?w=600',NULL,'approved',NULL,1,'2026-04-12 16:17:12','2026-04-12 22:17:12','2026-04-12 22:17:12'),(5,3,2,'Sumatera Utara','setjen','Kegiatan Pos Bantuan Hukum — Layanan bantuan hukum gratis di Medan untuk masyarakat kurang mampu.',NULL,'[{\"url\": \"https://www.instagram.com/p/example5/\", \"platform\": \"instagram\"}]','https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=600',NULL,'pending',NULL,NULL,NULL,'2026-04-12 22:17:12','2026-04-12 22:17:12'),(6,2,1,'Aceh','itjen','Festival Hukum dan HAM Aceh — Pameran interaktif tentang hak asasi manusia di Banda Aceh.',NULL,'[{\"url\": \"https://www.tiktok.com/@example/video/456\", \"platform\": \"tiktok\"}]','https://images.unsplash.com/photo-1511578314322-379afb476865?w=600',NULL,'pending',NULL,NULL,NULL,'2026-04-12 22:17:12','2026-04-12 22:17:12'),(7,6,11,'Jawa Tengah','dit_pdk','Penyuluhan Hukum di Semarang — Edukasi hak-hak warga negara untuk masyarakat Jawa Tengah.',NULL,'[{\"url\": \"https://www.youtube.com/watch?v=example7\", \"platform\": \"youtube\"}]','https://images.unsplash.com/photo-1497366216548-37526070297c?w=600',NULL,'approved',NULL,1,'2026-04-12 19:17:12','2026-04-12 22:17:12','2026-04-12 22:17:12'),(8,1,1,NULL,NULL,'Kementerian Hak Asasi Manusia membuka ruang partisipasi publik dalam penyusunan Rancangan Peraturan Menteri Hak Asasi Manusia tentang Pengelolaan Konflik Kepentingan','📢 SUARA ANDA BERARTI!\nhahahaha\n\nKeterlibatan masyarakat menjadi langkah penting untuk mewujudkan tata kelola yang transparan, akuntabel, dan berintegritas. Karena regulasi yang baik lahir dari masukan yang luas dan berpihak pada kepentingan publik.\n\n💬 Yuk ikut berpartisipasi!\nSampaikan pandangan, masukan, maupun saran terbaik Anda demi terciptanya kebijakan yang berkualitas.\n\nCaranya tinggal scan qr code berikut, dan berikan pendapatmu pada tautan berikut :\nhttps://tinyurl.com/saranrapermen126.\n\n#KementerianHAM #HAMUntukSemua #PartisipasiPublik #PenyusunaRancangan','[{\"url\": \"https://www.instagram.com/p/DX_KcwUE0G-/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==\", \"platform\": \"instagram\"}, {\"url\": \"https://youtu.be/loDt82oaRQU?si=4d2h4y-a93IjvbmR\", \"platform\": \"twitter\"}]',NULL,'dokumentasi/01KR0ADNHRDMGFVY62GKHSTHB3.jpg','approved',NULL,1,'2026-05-06 21:16:41','2026-05-06 21:16:34','2026-05-14 16:58:47'),(9,1,21,NULL,NULL,'UJI PUBLIK RUU PERUBAHAN UU NO. 39 TAHUN 1999 TENTANG HAK ASASI MANUSIA','📢 UJI PUBLIK RUU PERUBAHAN UU NO. 39 TAHUN 1999 TENTANG HAK ASASI MANUSIA\n\nKementerian Hak Asasi Manusia akan menyelenggarakan Uji Publik Rancangan Perubahan Undang-Undang Nomor 39 Tahun 1999 tentang Hak Asasi Manusia bersama Organisasi Masyarakat Sipil.\n\nKeterlibatan masyarakat menjadi langkah penting untuk memastikan pembaruan regulasi HAM yang transparan, partisipatif, dan berkeadilan bagi seluruh rakyat Indonesia. Karena regulasi yang baik lahir dari masukan yang luas dan berpihak pada kepentingan publik.\n\n📅 Senin, 11 Mei 2026\n🕐 13.00 WIB - Selesai\n📍 Gedung KH. Abdurrahman Wahid, Kementerian HAM\n🖥️ Via Zoom: https://s.kemenham.go.id/4vCoEy00\n\n#KementerianHAM #HAMUntukSemua #UjiPublik #RUUHAM #MasyarakatSipil','[{\"url\": \"https://www.instagram.com/p/DYMG6VSEyH8/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==\", \"platform\": \"instagram\"}]',NULL,'dokumentasi/01KRB1P8MAE0BJMEDH01P8VFK5.jpg','approved',NULL,1,'2026-05-11 08:15:41','2026-05-11 08:15:37','2026-05-11 08:15:41'),(10,1,21,NULL,NULL,'cek cek','hahaha','[{\"url\": \"http://127.0.0.1:8000/admin/activities/create\", \"platform\": \"instagram\"}]',NULL,'dokumentasi/01KRFNJ1QZ937CEMPSH5SRPPE0.jpg','pending',NULL,NULL,NULL,'2026-05-13 03:19:48','2026-05-13 03:19:48');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-spatie.permission.cache','a:3:{s:5:\"alias\";a:0:{}s:11:\"permissions\";a:0:{}s:5:\"roles\";a:0:{}}',1779248168);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hoaxes`
--

DROP TABLE IF EXISTS `hoaxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hoaxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `office_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hoax',
  `verdict` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hoax',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hoaxes_user_id_foreign` (`user_id`),
  KEY `hoaxes_is_published_index` (`is_published`),
  KEY `hoaxes_published_at_index` (`published_at`),
  KEY `hoaxes_office_id_foreign` (`office_id`),
  CONSTRAINT `hoaxes_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE SET NULL,
  CONSTRAINT `hoaxes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hoaxes`
--

LOCK TABLES `hoaxes` WRITE;
/*!40000 ALTER TABLE `hoaxes` DISABLE KEYS */;
INSERT INTO `hoaxes` VALUES (1,1,NULL,'hoax','<p>hoax</p>','https://www.kompas.com/kalimantan-barat/read/2026/01/07/161500188/rekrutmen-500-formasi-pppk-kementerian-ham-dibuka-cek-jadwal','hoax/01KPMCG26DKJPP004HPYZK8HB0.png','hoax','hoax',1,'2026-04-19 19:46:14','2026-04-19 19:46:14','2026-04-19 19:46:14');
/*!40000 ALTER TABLE `hoaxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'default','{\"uuid\":\"bebd5b46-2335-48da-bb67-8556e7f339cb\",\"displayName\":\"App\\\\Jobs\\\\ScrapeActivityJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":3,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":\"30\",\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\ScrapeActivityJob\",\"command\":\"O:26:\\\"App\\\\Jobs\\\\ScrapeActivityJob\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\",\"batchId\":null},\"createdAt\":1778127394,\"delay\":null}',0,NULL,1778127394,1778127394),(2,'default','{\"uuid\":\"c29241df-2694-4c11-b325-a144b17b9160\",\"displayName\":\"App\\\\Jobs\\\\ScrapeActivityJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":3,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":\"30\",\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\ScrapeActivityJob\",\"command\":\"O:26:\\\"App\\\\Jobs\\\\ScrapeActivityJob\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\",\"batchId\":null},\"createdAt\":1778487337,\"delay\":null}',0,NULL,1778487337,1778487337),(3,'default','{\"uuid\":\"8d653e4d-3d09-4f17-8e51-83fedb8437af\",\"displayName\":\"App\\\\Jobs\\\\ScrapeActivityJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":3,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":\"30\",\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\ScrapeActivityJob\",\"command\":\"O:26:\\\"App\\\\Jobs\\\\ScrapeActivityJob\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\",\"batchId\":null},\"createdAt\":1778642388,\"delay\":null}',0,NULL,1778642388,1778642388);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'0001_01_01_000003_create_offices_table',1),(5,'0001_01_01_000004_create_activities_table',1),(6,'2026_02_18_085642_create_permission_tables',1),(7,'2026_02_20_000001_add_kedudukan_wilker_unit',1),(8,'2026_02_20_000002_add_foto_dokumentasi',1),(9,'2026_02_27_030427_add_description_to_activities_table',1),(10,'2026_04_20_000001_create_hoaxes_table',2),(11,'2026_05_04_000001_create_otp_codes_table',3),(12,'2026_05_05_073707_add_social_media_links_to_activities_table',4),(13,'2026_05_12_152519_add_office_id_to_hoaxes_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(2,'App\\Models\\User',3),(2,'App\\Models\\User',4),(2,'App\\Models\\User',5),(2,'App\\Models\\User',6),(2,'App\\Models\\User',7);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offices`
--

DROP TABLE IF EXISTS `offices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_kedudukan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `offices_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offices`
--

LOCK TABLES `offices` WRITE;
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` VALUES (1,'Kantor Wilayah Aceh','ACEH','Banda Aceh','2026-04-12 22:17:10','2026-04-12 22:17:10'),(2,'Kantor Wilayah Sumatera Utara','SUMUT','Medan','2026-04-12 22:17:10','2026-04-12 22:17:10'),(3,'Kantor Wilayah Sumatera Barat','SUMBAR','Padang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(4,'Kantor Wilayah Jambi','JAMBI','Jambi','2026-04-12 22:17:10','2026-04-12 22:17:10'),(5,'Kantor Wilayah Kepulauan Bangka Belitung','BABEL','Pangkal Pinang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(6,'Kantor Wilayah Sumatera Selatan','SUMSEL','Palembang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(7,'Kantor Wilayah Lampung','LAMPUNG','Bandar Lampung','2026-04-12 22:17:10','2026-04-12 22:17:10'),(8,'Kantor Wilayah Jawa Barat','JABAR','Bandung','2026-04-12 22:17:10','2026-04-12 22:17:10'),(9,'Kantor Wilayah Banten','BANTEN','Serang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(10,'Kantor Wilayah Daerah Khusus Jakarta','DKI','Jakarta','2026-04-12 22:17:10','2026-04-12 22:17:10'),(11,'Kantor Wilayah Jawa Tengah','JATENG','Semarang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(12,'Kantor Wilayah Jawa Timur','JATIM','Surabaya','2026-04-12 22:17:10','2026-04-12 22:17:10'),(13,'Kantor Wilayah Nusa Tenggara Timur','NTT','Kupang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(14,'Kantor Wilayah Kalimantan Tengah','KALTENG','Palangkaraya','2026-04-12 22:17:10','2026-04-12 22:17:10'),(15,'Kantor Wilayah Kalimantan Timur','KALTIM','Samarinda','2026-04-12 22:17:10','2026-04-12 22:17:10'),(16,'Kantor Wilayah Kalimantan Selatan','KALSEL','Banjarmasin','2026-04-12 22:17:10','2026-04-12 22:17:10'),(17,'Kantor Wilayah Sulawesi Barat','SULBAR','Mamuju','2026-04-12 22:17:10','2026-04-12 22:17:10'),(18,'Kantor Wilayah Sulawesi Tengah','SULTENG','Palu','2026-04-12 22:17:10','2026-04-12 22:17:10'),(19,'Kantor Wilayah Sulawesi Selatan','SULSEL','Makassar','2026-04-12 22:17:10','2026-04-12 22:17:10'),(20,'Kantor Wilayah Papua Barat','PAPBAR','Manokwari','2026-04-12 22:17:10','2026-04-12 22:17:10'),(21,'Kementerian Hak Asasi Manusia',NULL,'Jakarta','2026-05-11 08:12:31','2026-05-11 08:12:31');
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otp_codes`
--

DROP TABLE IF EXISTS `otp_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `otp_codes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL,
  `used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `otp_codes_user_id_expires_at_index` (`user_id`,`expires_at`),
  CONSTRAINT `otp_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otp_codes`
--

LOCK TABLES `otp_codes` WRITE;
/*!40000 ALTER TABLE `otp_codes` DISABLE KEYS */;
INSERT INTO `otp_codes` VALUES (5,1,'$2y$12$grqLJLboOWTW/HTXK3UdwO479hUwoJ4A2JLX2lHdiFx5qOHohEPr.','2026-05-05 01:01:50','2026-05-05 00:56:59','2026-05-05 00:56:50','2026-05-05 00:56:59'),(6,1,'$2y$12$YoTbdDnP8/RhTGD3yRa.mu/4nL7G/d4tHLvAHklktuPsBH4BE/Lva','2026-05-06 21:16:13','2026-05-06 21:13:05','2026-05-06 21:11:13','2026-05-06 21:13:05'),(7,1,'$2y$12$wZ.3MEj06zPyQRATJQiaqu/ABtucCGx7e/AyvCiOWri4xCgEAtYXW','2026-05-11 07:42:44',NULL,'2026-05-11 07:37:44','2026-05-11 07:37:44');
/*!40000 ALTER TABLE `otp_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2026-04-12 22:17:10','2026-04-12 22:17:10'),(2,'regional','web','2026-04-12 22:17:10','2026-04-12 22:17:10');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('21CcOo7VaAgwEjWDTNhelCkjJasWZizKxaHaBZ0X',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','ZXlKcGRpSTZJbXhPUzBZNFdEZHRTR0ZCY1RWd1UwOXZkWFZuYUhjOVBTSXNJblpoYkhWbElqb2lSR2xCVFRSMU0wWjROVVJWVmtSTVZtSTBhblJhYWtaS2FHMXRjMmhTYm5WRlYxaFJWWGdyYkhsc05reFNSMFZqT0V4b2NVbGpTMUZDYzJSeVVWZEplR05xZW1Gd2JqaG9aR2xLWjIxWFNVSmtVRmw2VlM4clRuSlFXVTlVYTFCaEwwUkZjVmRyUVZkTmRVSlJOM2wxZEhaaFpscE1Sa1l5ZVRBdmFESmFaalZoYVVwdVpGQmpNV1ZVT0ZWUFVsSldXVGxPVmpnMVNpczNSemRCTDJKNFRtUmxZVEZpV25scVpteFRUVkl2ZFVabGFFRnpSVE5WUTBGTVJqaEhLMFZKYTNkMVNFMVJUWHBNTWxBcmVXTTBabFpsWTJwSmVVUkJaMHBPVFVaTmFHNW9TU3R0YzBOb1pWY3liVWc1UjJGbGVuaG5NMWRNTW5GTlZGSjRTM05MTVVSUFprUmtXbWx1ZEV0UE9UaENPSEpzVVRkTFZqSk5kSEUzTjNCMGRpODRiVkU1ZDJOTmQySkVNWGxOTTNjMlFsaEtZVkZCVlhRdlRqTTRUR280ZW5aTWFYbEtaSEV6UzB0U01HVnZXRVl4T1VOSVZWVnpkV3RyUjNGNUswWXhRMk5STkRZd0syMVJVbGw2VG1SMmEwVm1hR0oxVmpab05UZFVjVXhSUVRVNVV6WlNNemRpZWtzd2IwdHlOMFExVEZKclozTm9OMFJFWVN0MWNtaGlWVTAxUnpCdWFtNVFTV1ZxU1QwaUxDSnRZV01pT2lJME9UVmtPVGszT1Rsak5tRTVZakJrWlRSaVl6UmhPVE5pTW1VNU5EazFOMk5rTkdFMk5ETmxaak5oTmpSbFlqZGxPRFExWXpkbVltTmhOMkl5TmpBMUlpd2lkR0ZuSWpvaUluMD0=',1779091038),('IPOSE6yo7BfTkpmKzVBPopuBFabfDoKl3k3abfzJ',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','ZXlKcGRpSTZJbkZoZFV0amIzcGlkRXh0ZFVVd04wZDRlSG93WTBFOVBTSXNJblpoYkhWbElqb2lNMDVzYW1wVFVGa3hZV3hWUTNKMk1YbFFjR04yV2poMlRXMUhSM3BMZWxobmJuRm5MMWRRYjBoU1NXWkNiVVF4WkVSeldteE9hbTlYYzFSR1VWSjRhWEU1WWl0VlltRkVOR0pIYVhWbE9VdHRlVXhwZVc1WGMwMUdXREJrTm5SdGRWSlhkR3BOY2pSbU5pdHhkVnBWYVdGSk1DOWFjMWhVZEZCSmVreHpTamRrYVhWYWRrWk1hemwyTlVOUFJHSkNVbUYxUWtVNVpVUTVhV2RZUjBSc1VUTjJRMFZEWlVoVEwxSktjVVJ2VldoUVp6VldUSEJwYWpoNE9IQlhhVUZXYkV0SmVYZFJhbEl2ZWsxWFRIRk5UVTlTVEZkeGNuSllhRzUzWVRVNVZFZFJSRWhRWlhkeWRuaDFNR2xhZGxkcE9VVmpTekJOU0ZoQ2NYQjZVMDVOYTBkNmRFMHhSRlZMVkU1WE1sQkZSVTV6WTNGRlQxcGFLeXRSYWxGeWFYVlFUMmxHUVRGeWVETktTbHBUVjNwdVEzWTNPRkpVTWxKM2RHNXRSQ3MxT0RraUxDSnRZV01pT2lJMk1XWmtNamxoTlRBMFl6QmpOR0UzTUdWbFpHTXdZVEkzTm1ZMFlUVTJaVGd4WlRBeVltRmxaV1poTmpreE1qSXpOamxrT0dJMU1XTm1ObUU0TW1KaUlpd2lkR0ZuSWpvaUluMD0=',1779182202),('nU3UtBNaH8R4bI4dqQE92aNL4UOYBKll3PRVD9QG',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','ZXlKcGRpSTZJalF2YVZab1NUTlNiMWxTY1VSVlJ6SkdlVzkyWjNjOVBTSXNJblpoYkhWbElqb2lTSE5xYTBsUVltUk5PRWRZYnpKbVRXb3dTVlpYUTAxemVXRkpkRk52TkNzNVFURXdZa0ZIYVdaVmIzaDRVRFlyTkdoQmJXUkdTWGN5Y0RNck5ESmtaRVZOYVVoSFMxaE1LMUJtZFd4MEswNUlVbGhpUjJ4eVEzbFFPR00zYTJncmF6UlpURVppWW5sRmFFSmpVakZaWTNsM1RVUlpLelpyWVhwRVlqRndNRzlMUW5GMFpGb3dRbkpsUlRKYWVFbFJaVzVvZWxCRVVrSk9ORUZCWkhsdUwweHljMGROU25rMmFVY3pZVlY2TWxwTGJFWmlaREZ0WTBkc1RsSTFOWEY2VkVzd05HNXZiMkUwZDJscGExRmhNWEZ0VlZZd1lqWTFZVEJZWTFKQ1RHSldlWHBWWlhWTEt6UlliVzFXVnpsbU1ETkpVbXRUWWtsUWIzYzVibmt6ZW5JclNIQlNaVFp3UjIxNk9FbzNkVXBxYUZKeU5HeFVlRmN2Y1VZNFFYSjVWVTlQVGtSV2MwdzVTR3huYzFvMFlXeE9URGRIVDBwNVRGZFNSbE5PT0RGbU1EVTNVWEpXUjB4NVFtWjJaMUZGY1ZNeE5XMDVLMUZpZFRWeWFGa3pRa0pqTW5kemNEWTRiM0YwUTJwR05ETkxkMWhhVDJsSWVtazFZMlk1YkV4M1JXUkdVVTV1WmxsTlpVWndlVTlwT1Nzd2JWVlhaV0p4UTBwc2N6TkljbEF3ZVZkeFZXd3hWWGxvVnpKUVdtdFVVVTVwY25ablpGZFVTSGhGTlhkS01USm5NbXhCTjNFM0wxSlRSVzluYWxobFZuQjNkVUY1U1M5S2IyVlNWMnN2YjJkNFVVcGpSMnQ2Y0daR2RYRjJaRFY1Y3pOSFRqSkVTblUxWkhOV1dsVm1WVU51UWxad1NrRjRlVVJLU1hOclJIZGFWV3d2Um5ZMk1GTnhZbkZhTTFwS2MxSkZWVzlEYURseVVsaGhSalpzYlU5cmNUYzRkMGRQTDBWSVZYRm1OR3hpVTB3eWNEZGlWR3BOU0VzeWEzaERiM0Y1WkRGcmRERTFRWGx2VFVKM0wwOTJhVUV5TWxOSVkzVnZSV1ZpUVZkYWJHWmFhSGRRUVZsaWJVcFpVQzlTVFhObmRISk5aa1V2TVV0eFpFVXpNVkZxZUhCRGRUaDFaRlJsWVM5UldVeEhha1p0Tm1nemFtYzlJaXdpYldGaklqb2lNamhqWkRKbFltSmpaRFE1WkRVMk1HUTNaRGcwWldNNE9UTXhNREF6TkRoaU5HSmxPVFV5WWpWbU9HRTFOalUxTkdKalpEWm1ORGt5T0RGaU0yWXlNaUlzSW5SaFp5STZJaUo5',1779163324),('VjMysV8ypKiXG89yonOs1FkpVWVGcUwRfMFoEIIG',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','ZXlKcGRpSTZJalpIWTFSb1ZqVlNOR3RuT1dsbE5WRmhURXRSYkVFOVBTSXNJblpoYkhWbElqb2lWakJxVWpWbVYzcGhOREJNTTFKMlJHdzNTbXh1YlVScFZ5c3hVVnBRVGtNdllVSnJOakZ1THpOMU1qWkpSa1F6Tmsxa09IZzRSbXhwV0ROWmVIUlhiRXRJZEc5YWJXWklTbFJFUW5CcGNHRkRSRlJTY0dWTk0ycENPV2hIVWxWMmNuUlhRMWh2WjA5d1pHNUpRekJQVFRkeGNXTm5iMmhIUVhKaE1rdENZM2h5VURaTmJUZFZMMmhhVWprMWRuUnBZMDFNYzJNM2QySTNVM0poUTA1b2IyRnlla2h6YjNKeVRYQnpaWHB1TkdSbVNIQk1hVUp5Y0Rkd1RsRlpRelpSTWxwaVZuQjROMmxWWVZWc2NWQmhhVzk2TVM5SVNWTlFaRVpJZFhGdFRHaGpZWGwyTTNjemFqTnFSM0pXTTJaRFpuRktaMmR0WmtrdlozUXlUR295VFVodU1GZEVWVVZLZEhacWNVUlhSVE5zVDJwcmEyVk1hMFZhWkVobVN6WXJkRU5SVVRWa1YwTjJPVm9yUzJNclN5dDFaMVZYVUdzd1RVOTRNMDlPYW1wQlZVNUJURXhuZEZaNFVXUnpaM0pCVjBJelR6WTBURmhVZFZaakwxbDVSa1pTU3l0TFdYcDFaSGRuUWtWTGVXUnJRMmxJSzA1UGRqVm9hRGx2VWtwV1JEWnBjMnA0U1cxdWFXbzRhMnhYUWtoV1JWbHRabWxqZERJM1pHMVhSbEJOYXpFMU1rdE1hVWc1VFQwaUxDSnRZV01pT2lKa01qWTVOREU1WWpRNU5XWmtaVGRpWm1RNU56RTNOVFk1WVRRM01UZGlaV1JqWkRaaVpqRTVZVGt5TVdRMlpXUXpZalU1Tm1FNU0yTmhNMlpoTVROaUlpd2lkR0ZuSWpvaUluMD0=',1779182108);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `office_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_office_id_foreign` (`office_id`),
  CONSTRAINT `users_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,21,'Admin Pusat','admin@ham.go.id',NULL,'$2y$12$onIGMxro/UzDOhRP1Ji7K.q5GXrMKAyNwF31nKkaC2lqi5ZN2jQya',NULL,'2026-04-12 22:17:11','2026-05-11 08:13:36'),(2,1,'Staff ACEH','aceh@ham.go.id',NULL,'$2y$12$o0jAg2SE90uPJa3.Nj8LF.j7mrz1t/GbuNylcPW5.VT3cwXOmKYlu',NULL,'2026-04-12 22:17:11','2026-05-14 16:29:36'),(3,2,'Staff SUMUT','sumut@ham.go.id',NULL,'$2y$12$tcvxDeHG4ODBlOvAN8hEJ.lQuCcZ2AhT65gcqpExFfOi86jsY6M82',NULL,'2026-04-12 22:17:11','2026-04-12 22:17:11'),(4,8,'Staff JABAR','jabar@ham.go.id',NULL,'$2y$12$IQ61AqLVNmEXg5iDKUnF3.Hi.oWbmLr2L8.CGlEp6ByDlhwXhb1My',NULL,'2026-04-12 22:17:11','2026-04-12 22:17:11'),(5,10,'Staff DKI','dki@ham.go.id',NULL,'$2y$12$gInuneGDL0XGuDU5c0eM8.yiGI7Am9vlfXP21H97rcj8XOYaT.H9y',NULL,'2026-04-12 22:17:12','2026-04-12 22:17:12'),(6,11,'Staff JATENG','jateng@ham.go.id',NULL,'$2y$12$Z0phE6CplEOleQVpPAqog.fDzQ1SH0iSvURCRYBd9zVMpFefmOyo.',NULL,'2026-04-12 22:17:12','2026-04-12 22:17:12'),(7,12,'Staff JATIM','jatim@ham.go.id',NULL,'$2y$12$x1DEsUcj82T5Lt.ypQdB4eFOcFunB0yAYwLnO6c4UJkYN43jhFuaO',NULL,'2026-04-12 22:17:12','2026-04-12 22:17:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-26 11:55:23
