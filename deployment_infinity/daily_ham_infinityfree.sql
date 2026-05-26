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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,5,10,'Daerah Khusus Jakarta','setjen','Sosialisasi HAM di Kelurahan Menteng — Kegiatan penyuluhan hak asasi manusia untuk masyarakat setempat.',NULL,'[{\"url\": \"https://www.instagram.com/p/example1/\", \"platform\": \"instagram\"}]','https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?w=600',NULL,'approved',NULL,1,'2026-04-10 22:17:12','2026-04-12 22:17:12','2026-04-12 22:17:12'),(2,5,10,'Daerah Khusus Jakarta','itjen','Workshop Pelayanan Publik Digital — Pelatihan digitalisasi layanan hukum untuk petugas Kanwil DKI.',NULL,'[{\"url\": \"https://www.tiktok.com/@example/video/123\", \"platform\": \"tiktok\"}]','https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600',NULL,'approved',NULL,1,'2026-04-11 22:17:12','2026-04-12 22:17:12','2026-04-12 22:17:12'),(3,4,8,'Jawa Barat','dit_pdk','Bakti Sosial Kanwil Jawa Barat — Pembagian sembako dan konsultasi hukum gratis di Bandung.',NULL,'[{\"url\": \"https://www.instagram.com/p/example3/\", \"platform\": \"instagram\"}]','https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600',NULL,'approved',NULL,1,'2026-04-12 10:17:12','2026-04-12 22:17:12','2026-04-12 22:17:12'),(4,7,12,'Jawa Timur','dit_idp','Upacara Hari Bhakti Imigrasi ke-74 — Peringatan hari besar di Kanwil Jawa Timur.',NULL,'[{\"url\": \"https://www.youtube.com/watch?v=example4\", \"platform\": \"youtube\"}]','https://images.unsplash.com/photo-1523050854058-8df90110c476?w=600',NULL,'approved',NULL,1,'2026-04-12 16:17:12','2026-04-12 22:17:12','2026-04-12 22:17:12'),(5,3,2,'Sumatera Utara','setjen','Kegiatan Pos Bantuan Hukum — Layanan bantuan hukum gratis di Medan untuk masyarakat kurang mampu.',NULL,'[{\"url\": \"https://www.instagram.com/p/example5/\", \"platform\": \"instagram\"}]','https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=600',NULL,'pending',NULL,NULL,NULL,'2026-04-12 22:17:12','2026-04-12 22:17:12'),(6,2,1,'Aceh','itjen','Festival Hukum dan HAM Aceh — Pameran interaktif tentang hak asasi manusia di Banda Aceh.',NULL,'[{\"url\": \"https://www.tiktok.com/@example/video/456\", \"platform\": \"tiktok\"}]','https://images.unsplash.com/photo-1511578314322-379afb476865?w=600',NULL,'pending',NULL,NULL,NULL,'2026-04-12 22:17:12','2026-04-12 22:17:12'),(7,6,11,'Jawa Tengah','dit_pdk','Penyuluhan Hukum di Semarang — Edukasi hak-hak warga negara untuk masyarakat Jawa Tengah.',NULL,'[{\"url\": \"https://www.youtube.com/watch?v=example7\", \"platform\": \"youtube\"}]','https://images.unsplash.com/photo-1497366216548-37526070297c?w=600',NULL,'approved',NULL,1,'2026-04-12 19:17:12','2026-04-12 22:17:12','2026-04-12 22:17:12'),(8,1,1,NULL,NULL,'Kementerian Hak Asasi Manusia membuka ruang partisipasi publik dalam penyusunan Rancangan Peraturan Menteri Hak Asasi Manusia tentang Pengelolaan Konflik Kepentingan','📢 SUARA ANDA BERARTI!\n\nKementerian Hak Asasi Manusia membuka ruang partisipasi publik dalam penyusunan Rancangan Peraturan Menteri Hak Asasi Manusia tentang Pengelolaan Konflik Kepentingan. 🤝⚖️\n\nKeterlibatan masyarakat menjadi langkah penting untuk mewujudkan tata kelola yang transparan, akuntabel, dan berintegritas. Karena regulasi yang baik lahir dari masukan yang luas dan berpihak pada kepentingan publik.\n\n💬 Yuk ikut berpartisipasi!\nSampaikan pandangan, masukan, maupun saran terbaik Anda demi terciptanya kebijakan yang berkualitas.\n\nCaranya tinggal scan qr code berikut, dan berikan pendapatmu pada tautan berikut :\nhttps://tinyurl.com/saranrapermen126.\n\n#KementerianHAM #HAMUntukSemua #PartisipasiPublik #PenyusunaRancangan','[{\"url\": \"https://www.instagram.com/p/DX_KcwUE0G-/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==\", \"platform\": \"instagram\"}, {\"url\": \"https://youtu.be/loDt82oaRQU?si=4d2h4y-a93IjvbmR\", \"platform\": \"twitter\"}]',NULL,'dokumentasi/01KR0ADNHRDMGFVY62GKHSTHB3.jpg','approved',NULL,1,'2026-05-06 21:16:41','2026-05-06 21:16:34','2026-05-06 21:16:41');
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
INSERT INTO `cache` VALUES ('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1778127421),('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1778127421;',1778127421),('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba','i:1;',1777880504),('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer','i:1777880504;',1777880504),('laravel-cache-hama@kemenham.go.id|127.0.0.1','i:1;',1777879945),('laravel-cache-hama@kemenham.go.id|127.0.0.1:timer','i:1777879945;',1777879945),('laravel-cache-otp-resend:1','i:1;',1777880504),('laravel-cache-otp-resend:1:timer','i:1777880504;',1777880504),('laravel-cache-spatie.permission.cache','a:3:{s:5:\"alias\";a:0:{}s:11:\"permissions\";a:0:{}s:5:\"roles\";a:0:{}}',1778213585);
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
  CONSTRAINT `hoaxes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hoaxes`
--

LOCK TABLES `hoaxes` WRITE;
/*!40000 ALTER TABLE `hoaxes` DISABLE KEYS */;
INSERT INTO `hoaxes` VALUES (1,1,'hoax','<p>hoax</p>','https://www.kompas.com/kalimantan-barat/read/2026/01/07/161500188/rekrutmen-500-formasi-pppk-kementerian-ham-dibuka-cek-jadwal','hoax/01KPMCG26DKJPP004HPYZK8HB0.png','hoax','hoax',1,'2026-04-19 19:46:14','2026-04-19 19:46:14','2026-04-19 19:46:14');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'default','{\"uuid\":\"bebd5b46-2335-48da-bb67-8556e7f339cb\",\"displayName\":\"App\\\\Jobs\\\\ScrapeActivityJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":3,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":\"30\",\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\ScrapeActivityJob\",\"command\":\"O:26:\\\"App\\\\Jobs\\\\ScrapeActivityJob\\\":1:{s:8:\\\"activity\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Activity\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\",\"batchId\":null},\"createdAt\":1778127394,\"delay\":null}',0,NULL,1778127394,1778127394);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'0001_01_01_000003_create_offices_table',1),(5,'0001_01_01_000004_create_activities_table',1),(6,'2026_02_18_085642_create_permission_tables',1),(7,'2026_02_20_000001_add_kedudukan_wilker_unit',1),(8,'2026_02_20_000002_add_foto_dokumentasi',1),(9,'2026_02_27_030427_add_description_to_activities_table',1),(10,'2026_04_20_000001_create_hoaxes_table',2),(11,'2026_05_04_000001_create_otp_codes_table',3),(12,'2026_05_05_073707_add_social_media_links_to_activities_table',4);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offices`
--

LOCK TABLES `offices` WRITE;
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` VALUES (1,'Kantor Wilayah Aceh','ACEH','Banda Aceh','2026-04-12 22:17:10','2026-04-12 22:17:10'),(2,'Kantor Wilayah Sumatera Utara','SUMUT','Medan','2026-04-12 22:17:10','2026-04-12 22:17:10'),(3,'Kantor Wilayah Sumatera Barat','SUMBAR','Padang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(4,'Kantor Wilayah Jambi','JAMBI','Jambi','2026-04-12 22:17:10','2026-04-12 22:17:10'),(5,'Kantor Wilayah Kepulauan Bangka Belitung','BABEL','Pangkal Pinang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(6,'Kantor Wilayah Sumatera Selatan','SUMSEL','Palembang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(7,'Kantor Wilayah Lampung','LAMPUNG','Bandar Lampung','2026-04-12 22:17:10','2026-04-12 22:17:10'),(8,'Kantor Wilayah Jawa Barat','JABAR','Bandung','2026-04-12 22:17:10','2026-04-12 22:17:10'),(9,'Kantor Wilayah Banten','BANTEN','Serang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(10,'Kantor Wilayah Daerah Khusus Jakarta','DKI','Jakarta','2026-04-12 22:17:10','2026-04-12 22:17:10'),(11,'Kantor Wilayah Jawa Tengah','JATENG','Semarang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(12,'Kantor Wilayah Jawa Timur','JATIM','Surabaya','2026-04-12 22:17:10','2026-04-12 22:17:10'),(13,'Kantor Wilayah Nusa Tenggara Timur','NTT','Kupang','2026-04-12 22:17:10','2026-04-12 22:17:10'),(14,'Kantor Wilayah Kalimantan Tengah','KALTENG','Palangkaraya','2026-04-12 22:17:10','2026-04-12 22:17:10'),(15,'Kantor Wilayah Kalimantan Timur','KALTIM','Samarinda','2026-04-12 22:17:10','2026-04-12 22:17:10'),(16,'Kantor Wilayah Kalimantan Selatan','KALSEL','Banjarmasin','2026-04-12 22:17:10','2026-04-12 22:17:10'),(17,'Kantor Wilayah Sulawesi Barat','SULBAR','Mamuju','2026-04-12 22:17:10','2026-04-12 22:17:10'),(18,'Kantor Wilayah Sulawesi Tengah','SULTENG','Palu','2026-04-12 22:17:10','2026-04-12 22:17:10'),(19,'Kantor Wilayah Sulawesi Selatan','SULSEL','Makassar','2026-04-12 22:17:10','2026-04-12 22:17:10'),(20,'Kantor Wilayah Papua Barat','PAPBAR','Manokwari','2026-04-12 22:17:10','2026-04-12 22:17:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otp_codes`
--

LOCK TABLES `otp_codes` WRITE;
/*!40000 ALTER TABLE `otp_codes` DISABLE KEYS */;
INSERT INTO `otp_codes` VALUES (5,1,'$2y$12$grqLJLboOWTW/HTXK3UdwO479hUwoJ4A2JLX2lHdiFx5qOHohEPr.','2026-05-05 01:01:50','2026-05-05 00:56:59','2026-05-05 00:56:50','2026-05-05 00:56:59'),(6,1,'$2y$12$YoTbdDnP8/RhTGD3yRa.mu/4nL7G/d4tHLvAHklktuPsBH4BE/Lva','2026-05-06 21:16:13','2026-05-06 21:13:05','2026-05-06 21:11:13','2026-05-06 21:13:05');
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
INSERT INTO `sessions` VALUES ('8NQqJAQvm8gf2WEFA5t2FTYLPy0XVB95fI31JAeY',NULL,'127.0.0.1','curl/8.7.1','ZXlKcGRpSTZJakJWYldFMloySkVRM054VG0xclpXRXlSM3BuU1djOVBTSXNJblpoYkhWbElqb2lWbkZNUlhJMVRtSkJkWEZWTlZaclQweE1XRGx1TldObGJVbHVTbEJvZWtSU1dYZ3hjMDlOVjNkR2QxbFVRMGRQYldaU1MyYzFNMk01TkVaTlpVMVphMHA1U1RaMFFtSjFlbVpFZFhjME1qazROelZrUWxVM1RXWmhSSFl5VHl0eVRHOHZaSEpEVFU1b1VYZFZWaTlCV1U5d1JuUXhjME56YkdsRVRHZ3dNVWwxZG1kSGN6SkJVWFJ6V0dVeVJXVnJaSGhrUW5aRlZERnpXRlJ0V2tGRVZESTNaWEpIYmtOV1FUSlFORzg1UjFaTGJGRnllVW80VkVScFNWWkpka05EYVVKWE9WVk1hMkZhU1ZwNVVrSlZhMDUxZGtOb2VGSndXVE5oVldNMFIyNTRXQ3RSY2paWWVIbERjblV3UnpkdGNuQXpSM2wxT1VkYWVHUnRlbEZ0V1cxR1ZIbEdPRTVDWkdWUk9IWTBVekoyVXpKTFRuaDZSbE5qVkdKSWEyRXhVM1YyVXpjMWJUTTVkbEpyYjI5MGNDdHJiM0JSYUM5U2EzRlZVV0kxTjFBaUxDSnRZV01pT2lJek5UbG1aVE5pTmpJNFkyUXlNR1k0WXpFNU5UZzJObVl5TnpjMk1qZGpOR0ptTW1OalpUbGlNelV4Tm1ObE5ETXhZamxoTVRobE9XTTFZemd5WlRSaklpd2lkR0ZuSWpvaUluMD0=',1778128779),('bQLdYJa2l1AN11BQhOgTslCIR0OP83ZFOco5BvKa',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','ZXlKcGRpSTZJazFKWVhnMlduQlpXVmREVUU0d1VERkpORUY1V2tFOVBTSXNJblpoYkhWbElqb2lkVmd6V1N0VFFsQlBjVk5aYjFKMFp6UlNNMGhCTURseFNtOHljbU5ST0UxdFYybzVjRTlSZVVaamREZ3ZNelp1V1ZaSGMyc3dkekp2TVRWc2VVMVhVM2RaWVZNdmVVSlhRVzhyTUVrMWEyVmhWM3B0Y1N0S2JuTldSVk41WTJ3NFMwVkxLMlJqY0hOQ1VEUkNVRzlQWWlzck1ETm9TUzl4WldoWlNIRkxZV05XY25sU1dFRnNVakZhVkdsR1kwTkVOWFZCT1ZVeFZsaGtlWEJtYjJwSU1rODVRVEZwVDNBNFNXOWhWbXBoTkdabldUSlVjRXQ2YUUwM2FuWkxSbmhtV1VSYVNUQjBibGx4TjNRdlVtMTNZbkJ0YVdsUllrbFRUSGRrWnpBMU9GcFJWMmt4WlROTVZIazFaVVZ3YUZORlJWbzJWVWcxSzNKVmQyTm9kMjVNU0VSdk4yUkJZa3hpVVhGRWEwa3lXa1ozY0c0NFJGcExZM1ZFWTJwR2NXNXJhaXN3Y0RaQ1RYaEhOV3M5SWl3aWJXRmpJam9pTUdFMU9ESXlOR013TkRRek16bGtaamd3WlRBelptWTVZVE13WkdNeU1HWTROVFUzTnpWbU0yUTVaVGhsWXpVek1EaGlZekpoWWpGa1pXVmlaV0ZsWlNJc0luUmhaeUk2SWlKOQ==',1778131593),('dgXCU9AcDYVfSTuH5cOBGdHpEHNrTTTyHgc8oedi',NULL,'127.0.0.1','curl/8.7.1','ZXlKcGRpSTZJbmgxUlZkWFRVc3JWRXhOUjJsb2NrcG1TbFl6ZEVFOVBTSXNJblpoYkhWbElqb2lXSFZ5Wlc1a2JVVkNlaXRXTjBkblkwUXlOSEJTYkVZMmNsUktNMmxNYnpBMmNFbEZOVXhTZDFkUVpXbGtibGw0ZEM5aVRqaFNVa2h6Y2k4MlNHeE9lV2RJVVVKMVMwbHJPWGwyYkVGMVZpOXNNVXBzUkVwRllXeE1VbTFOSzFWa1lsUkRiVU5PYjJodGVWaE9lbkFyTkhkUmFFaEZlVkJDTm1wb2JqQnBaVFozUjBVMFdVWnBWbkoyUmxSR01qTlBkelpwVEdSWGNVazBOR2QwYWxNM1pWWmFSMmhOTmsxWGVuaHZkM2szVWpKcGIxcHRhV3N4VVRoaWVtdDVia3RGYzBRd05IazNMekJ1VldaTFVHczFURFYyWm5KSVZUQlNiVXMyYm5WUGFtODVZemhFUW01R2VHRlRaMXBwUzBkeVVFUjNaakJUWWt0VVFpc3pSRGRLVDBKMGRuQXdOR05JV0RscVQwZHViVUpoU1VWS01uRkpTQ3RyYUhSVVNIUmplVTEzVkdJeEwySnliME5YVTJabFNDc3dNMUJ3UWpNM1pIQlNRVkI1TVNzaUxDSnRZV01pT2lJNU9UUTJZbUl5WTJNeVlqWXpNekk0WkRJeE9HVmxOVGxpWkdRNU5EVTVaR1ZoTmpjeU5ERTBOamczTVdVeE9UYzVOR0kwWWpGaFpqaGpNekE1TVRObElpd2lkR0ZuSWpvaUluMD0=',1778124004),('g4Yxn7REStsNBhrhTmIpnyTV3Wd4XAK3kcXrHVss',NULL,'127.0.0.1','curl/8.7.1','ZXlKcGRpSTZJakZPVldka2REaG9TSGN3YmlzdlJpOXRXVlI2YTBFOVBTSXNJblpoYkhWbElqb2lWSHA1Tm1sc2FUVXJjeTlLT1ZBeGRqSTRZbFFyYlROVWJ6bDRjelV4Tm1OWVpIQjNWMHRTYlRWdVQyVnBVVmxxUjJWVFpVaEVabUpKWWtOSVowSjNVV2hMUWxkb2NEQklXVGR2VG5KWlFVOVJNMHgzUmtnMVZEWnlSR1ZTVDJwbmVsSkVka3B3V1VJclJXaHlTRkpNV0d4VlZrOXhVbHB3Tm10RVNHNHpXbWN4T1VOMVFteHZWVTlhZVRCWVVIVkRhR0pRVjI5VU1VWXpkRTQwY2psdmFVeDFiWHByY0VGUU1rcGlNa2h3YTJOMk0zUXdTWHB6V0hWT1QxSm1lVFJxT1d0cVEyOXBZVzFRTVZOWU1FZEtaVk5FWldsM05uZHVTazFhYTBndlRqazRWVXBpT1dkcmJXVldLM0ZSTVdZeWVIQXhSMDh6UWxCbU9XMVlXVWRQTm01Uk5tcExUMWxGTlRKYVpUZE9hRmhYUkN0WloyZG5TMFZ3WTFrd1VEVlBTalI0VWxWRFEzVjFVV1V6V1hNMVVEWlJVSFpJVjNCdFJ6WkdiV05yTHpraUxDSnRZV01pT2lJeFpURXlaVGczT0RCaU1tSmpZVEl6WkRRelpEUmtabUV3TVRnMk9XRXlZV000WkRZME1HTTFNVFZpTldNelpURTVPV0V5TjJGaFlXWmxNemcyWTJVeUlpd2lkR0ZuSWpvaUluMD0=',1778124558),('GJkM9yZrK8DWyYqgXEIVr2CYyaEoTr4uDiMPNT5K',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','ZXlKcGRpSTZJbWxZUzFCaVMwazRjV04yYVM5TVUxTkpWVzFFWTBFOVBTSXNJblpoYkhWbElqb2lNRzk2Y1VvMVVrTnFUM0pRWkc1T0wyaEhka0ZuS3pWa1dIVlJZaTh4UkZKd1VqRnhUbVZPVVRjd1YzZEpXRXd5TTB4MGQwZDJWMHhsWjJkTFpWRkpUQ3RpTVc5MWRXcEJjVTlTZUZkalNFODRVMmxoWVUxb04wMXpTSHBIUTJZNFIzcHljMHBTYTBkcmJWcHZWRmQwVW1WNFpXdzRPRzgwVFdOUlNsQm1kRXRQZVdJNVdHbEtVbTl4ZG5OSUx6aEJhRXBDWTNWNFluQkxaR05wYkdGa05rbFRTMnR1T1RWQ1ZqaHdORzFKVkdWdVJ6TjBNRFEzTkN0MFRrcFRja295ZFVWNFdtbGxjR2RyU0ZSSFdIZFdTMk55WWpjek5tcDJXazVWY2tsV05YTXJTVFY0YUdwS2VIZFlSM1U0VW5sNk9VRnlRaTl3WTB4SmVYWk9jVEJGTTFOS1QxZG9UbmxvYlVvM1p5OW9hSFUyV1RGRmVXdFhaV2h3UmtKeGNqaDBiVmx6TXlzelp6bFZXblp1Yldzd1ZqaHBXbmxJUVRGNVNXTnlaRTVwTlVZaUxDSnRZV01pT2lJd1lUVTVOVEZqTmpOaE1tWXhOVEpsWldNNVpHRXlaVEF5TVRBNVpXRXhNR05tWXpFM05EVTROamd4WWpJMk0yTTRObU15TlRVM05qYzBOV1V6TVdOa0lpd2lkR0ZuSWpvaUluMD0=',1778128809),('INoRwHobI5nSQ6vNV7FxXJYFk789d0ToXvEn2tdF',NULL,'127.0.0.1','curl/8.7.1','ZXlKcGRpSTZJbTlKVW14WFRtVk1kbmN3WWpjM2EyRlFNRFJyTUZFOVBTSXNJblpoYkhWbElqb2lRUzloUXpGaFFuTTFkRkZXYlZZdmR6ZDBhWGgzU1RaaWNIaEJlRzF6WVZKQ2FHbFRjMGx2YWpVeVVuaEhUa1J3YW10YVRUTXdTV3cwVTFWV2JrOU5UMU42YVVweVRrbGlaa0Z3ZUdaUk5qWTVOakZ3V0ZoS1kwNHlaeXRSWjJKWmRYRjJPVGhXYUcwM1MxUjZaa05VVkZRNGIzcEJkRVJyV1c1UEwzQnJhR2hLYnpoNFZ5OU5hWEozWkd0b2RYSkxaSFp3VEN0RU1IUnJTMnQyVmtGU05FMHJkMlkzUjFFeVdqQmhZVmhHYjJsaVIyMVJlWFYyZEhJNGRXcGlha1ZZWmt0SFlsbHBNV3BMVUZZNWRXMUlZVEJTV1RWdldWSnBOelpGZUZsYVVVZHdSRTh3UWpCRWFqTlhURFZCZWpReWFHaHRPV280TlRsTmFWVm1UVTgzUjJkcVZtWkVPU3QyUm1FM05EbGtZVVJpV2pWck56RTRlV2xLUW5BMlJpOVRNWE5KU0ZWNVVtSjRSMEYyV1dsNlpWaFBaMnMyVkRWbWExRk9RVmN4YVRnaUxDSnRZV01pT2lJM1pEZGtZemsyTWpJMFpqY3dOVGt3WXpZeFpHSTNabUk1TVRNM1pUSTJObUptTVdRMk5XUmhZemc0Wm1Fd01HSmlOamxrTXpjMFpUY3hOakk1WkRBd0lpd2lkR0ZuSWpvaUluMD0=',1778126836),('isTasIoxLHQAWlvFbeNSRt8bbLTJ5rR6n9D4fM51',NULL,'127.0.0.1','curl/8.7.1','ZXlKcGRpSTZJbkF5UnpCcGRIWkJZV3N2TkRsWmFuaHpWMFZOTkdjOVBTSXNJblpoYkhWbElqb2lNa013VUZwVVQwNVlOMnN4V1Zrd2R6QnNWMnBQZFZSRFJsVlNjRVp5ZEU1U2F5dFBkMU5xTjNNMU1tWXJORkpCZG5WdlNsaGhZemQ2VEhObFpYcHRVVWswYXl0UFQxQmtZelJNU0V3cmR6QlZZME42U1U0eGQyTlFRMHROUml0SGVUQXZOekJTTTI1QllscG1ia1JIUmtGWGNHRnJVV3BQYVcxcWRXZGtlVWR0VUZoNk0zRmhkRVYxZDA1TVIyOHJXREZhYkN0QlJsWlhNV1ZZYVhKTFNuQnNhVGd2Ym1NMlVVaGhkMDFNTTAxVFEzSlJURkJ0ZURCV2JqZFBXVXRaUjFaV1MxaHVjbUp6Y1ZWM1ZETm5aRkVyT1RGclEzUnBUR2xFTTBaVlpsbExhM0JPWjBwb2RXYzNVMVJQTmxaTVFYaFdaRWN4VlRsdE5WaEhlSEJYTjI1bFN6QTNaazlZY2xsVlZUWlJSMmhxUkdsd1NYbFJaalZLVjJsVUwwcHZTR2xTVEU5MU9XbE5UblEzVDJ4blozRjFabWt2TURkUWVEbFJLME41TUVraUxDSnRZV01pT2lKallqSm1PR1U0WlRNME5qWmlOVFJtWm1VelptVTFNalUyT0RJM1ptVXhNREU0WXpnNFlqQmtNbUkyWkdZNFlUZzVZek5tTTJRNFpUSm1aV0ZrT1dFNUlpd2lkR0ZuSWpvaUluMD0=',1778125319),('K8RizsTV1lNNMKtEocIc7NMMUlakeNX9pe2it13U',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','ZXlKcGRpSTZJalJLVW10SWMyNXJabU0xY0daNE9XRkdPVnBvWTBFOVBTSXNJblpoYkhWbElqb2lVakJEWmxRMGVtWm9lVmRNZGpOc1EzcEpXa1ZTYkVnMWJGTk5SR05KT1ROWk5XeDBiVGQ1YWpOalNsRnBjV1JCUlRFNUsyUmtZMDlCUVhwRVVVbDBTM1UyUWk5WE5qQmlVRGcyY0VGbVlVSktlamRRV2xvMk0xSjNPRGxyV20xTVRrMW9LMnBaUlhodGJtNUdiVzlCUnpGUGQySlNlRGxNVFVZeE16TlFXWGRyV1ZGRlUzUmhjWFEzVW5WUWNXNVpWSFZFTXpoVGFsbGxZbGsyYmsxb2VHZExNbU5JYVhGU05uWm1VWEE1V210TmFFWlhSVVZtYVRkT2NsWm1iREUyYUZvclJuRTNiRnBtVnl0dFpWQTVOMjV5TjFGNlluUnJUblJRYVVORVFuRTFiSFpVVkU1Tk0wWnNlbUZ0Um1aWU4yTjNkRU5GTjJVd1VWVmxLM1ZGZVd3MEswbGtVMjF2WkVNeldpOUZaSEF4Y2twWk5uVnVNMmR6T1dabmJtbFpiVFpMWkZsNVZraHpaVzg5SWl3aWJXRmpJam9pTmpneU1UZzNOams1TmpabE1EVmxNekE1WldaalkyVTFObUU0WVRRd056YzBaalk1TnpVMFlqUmpPR1ZqTVRVeU56TXlPVEV4TUdVeU5UQmxObUU0TkNJc0luUmhaeUk2SWlKOQ==',1778468683),('RKLRFqpXg5GD7azFRl2NQ4yrnrFZx0Z8MYy8nbYt',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','ZXlKcGRpSTZJbEppVTBNMmFTdHNSM0JqYm13NVIweDJLMWgyTmxFOVBTSXNJblpoYkhWbElqb2lLMG92VERaNFlVMVRabkUyWkcxeGJtaFFja3gxVTFKMFptaDJVR05OV2tOdU1rNDJaMmxoZEdoV1RWRnVlREJ2Y1dwamR6SnlRaTgxUVdSSmMyNTNiWFIzUzIxc1YxSk9SSEU0Tml0MGVUZFplQzlMY1c1MVRWUm1ZVGR1YmxsbVJpczBUR3RYY2tkUFVHOTVOVkZHZDBSeU9XNDBWWGg0UVZKeWExYzNjMVpCV2pOSFdVVnZhME5TYVdneGJEbGlaRmRIUWxNeFFVOUtWakl4WldaYVZ6WjFhMHhTUjFKeVpESmlNM0p6YlhSTk0zRXZZM1pJVUdoT1dGazNWSFZKTjBORVlsVTBOMVoxUmxKb1YyOVlUa2R5VDBkQ1FtNXBVMkYzT1ZKWGJEVlhNaXRsZW1OSE9XcDFXbE5VUXpGVE9GRnViMVYzZW1ZdmRtazBkbXBWWWpoNU9WaE5hbVppTm1WVmFtWTRZVUpJYzFORWRrbHFRM1Y2VFM5c1pVaHlNMUJPTWpkSk9YcGhUekptTld0cWN6RlhSR0ZYU2pKUFNHWnVlV0pPVldkWU5qSndhWGw1UzNrMVMzSnFMM1F6YzJGQlVWZFlVSEphUlRWbVJFa3hRVms0TjNWSFJpdFZTR0ZXTTJObE9ESnZLMjF0T1daM2JVcDJVV0paVWpWcmMzTTRXVUZOVmxZd2FIbDBjRFpxWWpoR1UwMHJSbGxQUldWUFkzWXpOVGxDT1VsbldTOW1lREJqYkc1eVYycHJWSGREUlRoVk1GUkxUVVI1T0ZZd1QyeDBkbE56V2l0dlJIbFZaek5FV1dnMkwxTlRWbFp2TW5jMll6QlNRV1puWWpKWVFVMXZlSEYwTTBFMVVGbGpZbVpzUjBWaWVHRkxXWHB4ZGtOTVZVNVhkM1EzZERORVpuUk5WbGhYVG5WTmJHUktiWHBUT1hWeGNuTlpZV2xNZVZsemEwTXpZbTQ1Wm1oV1YyUmFRVGd5WjA1amRGZGFaeXQ2ZW1OVGFXUjNWVzR6YzNFM01qbHJURWR6V1VJcmRYa3ZTVFJHV2tsMWJUWm5aMHcxY0dacVpYWmlUalUyVUN0c2VHNUJPVXhzVVVOb04yWmhUazQxYTA5UFRuTTFUa1JFVEVVeWFrOHpZbXRJZUZkNGREVlFTMlJ3WjBFOVBTSXNJbTFoWXlJNklqZG1aVEU0WmpSak9XTm1PRE15WkRKaE16bGxZbVZpWTJWbFpUQXhOak0zTkdKaU1USXhaR0pqWlRFd01tSXlZMkUwT1dFNFkyUXpOR0ppTURnNE5qa2lMQ0owWVdjaU9pSWlmUT09',1778127405),('stCHGtGZwA1u9SrMow7OzAWIGznsg7BYMuMLh3v8',NULL,'127.0.0.1','curl/8.7.1','ZXlKcGRpSTZJblE0UjNkTlEwWkVWMlpVUldkUlV6TjRLM2RHWmxFOVBTSXNJblpoYkhWbElqb2lOMUJSTTJkRlJIUmthakJDWjJkek4wd3JjRkF6V2l0blFsUXlOVFpTUkRsbE1uZFVWamc0T1ROa2QwSTNZMlUwVDBwMmFtTkdhVU0zUm1oeWRUWndhVEJ3UVZWUFNDODFiamdyY2xwWEwwZFlLemxYZGprd1IwZHdRak5PUVVsVlJrTllXVVZzWTB4T1RYVnZTRXhwUjBsNGMyazBWMXBUTlVOUVZGcERLMjB4Ym5NdmNFeEtLMkZMYVhRcmJYVjBTbG9yTHpaU1lrUTVPRmxhUW5OVGEwOHpjbWxsUVhSRFptRlJhVWx0UTNGWFJYUTNhM0V4Y1Vwb1drSk1NVlZ5T1ZCVU4ydEhiVGhxS3pCS1NGaE5NR2RWYkVaalkyVm9SMWhvVjFsTFVXWm9ZMGRQWlZSME5IUk5UMUpRZGt3ck5VMTBWMDR2TWpKTEswWjFNbVZYZVhoVGJ6TldNRGRHZVZCalVHOW9iR0ZtZUdSTVZtMUNURFZSY0VoYWVIbG1OalJ2YVhjdk1qa3lUeTlsTkdwMGFFVm1WMFFyWlZCblFteFlVVWQyTVVNaUxDSnRZV01pT2lJM05tVTNOR0poWWpJM1lXWTJZV00xTnpNeU9EZzVNVGhtTlRaaVlUQTVZekU0WVRVM1pEQTRNelV5TlRNMk9XRm1NV0U0TkRJelkyVm1NV1kwWldSaUlpd2lkR0ZuSWpvaUluMD0=',1778127887),('UAOan5WbhirXJsiteWukhWCCMiU40MqhWClZ12tr',NULL,'127.0.0.1','curl/8.7.1','ZXlKcGRpSTZJbXBvT1RKRmJFbHdVemhvV2tsVVNHaEhRelowTlVFOVBTSXNJblpoYkhWbElqb2lhazlPV2taNlkybGljamsxTmxwSWVIaGxSVWg0V1hwV1JqRmlhVkZ0VGs1dGFIUTVTRVJ3VnpabGRtNXZXVTFEV2tsUGEyOUlja0puZW5ObllWcFhVblZvUkZZM01XTnZWblEyUVROcVFtUjFNbUpZVW05V1lVTnZRbFJsYWxwRVFqUk1XRk5LWjBvdlExWkxaVFZ0ZG14WVFtZDNLM0UyVjI1eE5XNU5ibWhNZERWWVZYcEplV3hTTjBwa1JUVnNkbVkxTURWWFZsUjJWSFZCYm5BNU5FZzBZVEJxV0ZKamJtaEhXVFF3WTFwT05tUmxPR0prWjFkNlFucElkR2RqTjJ0c1VHTlJURTFFYjJwc1FYWldVMlJ0WmtkTFVXVXlZVzUxWnpsc1REUXJWbXB0UTFOSlFXMUROeXRoVUhKMk5YQnFaazF3TW5jd05VRmxTekJFVFV0TGRTOVpXVUpuVURWWVEyZEhXbm96YjFVNVQwRkVWemhIT1VGTVJHNUtTM0YzY1U5NlRXaE1TV3hKVFhoU1NIUlNOSGxUYTFRNVJGVldOV3h5UjFFaUxDSnRZV01pT2lJek5qWmpOemRsWlRCaE5ESTFOV1F6WVRKaE5tSXpZVGsxWmpVM1pEQmlOR1JoWW1SbE1EVm1ZV0pqTWpBMVlUaG1NalUwWkRjME1qQXlZek15WWpBeElpd2lkR0ZuSWpvaUluMD0=',1778126799),('xvVz2AZgShcSFJLVvcepJsvC3XBzZFkePL36V0rv',NULL,'127.0.0.1','curl/8.7.1','ZXlKcGRpSTZJbHByUlhVNU5WUkliV0ZMY1VaSmQyUkhjR1pDT0ZFOVBTSXNJblpoYkhWbElqb2laaTlVTXpsd05tbENVbXRzTnpaV2VHcExXa3BVYTFKRGF6UlJLMlJSZWpNelEwUkZWMmhOVFhkSVMwbHZPRWQxTmtWVlZWWTBUVmx4VDFGT2QwOVVZVGxHUWpWWE5ETnFkbEJsU1U5TlZuSkRTR0pWYUc1NFRHdDZjRnBzWkVWaFUySmlWRlpwVEhnMVJHb3hORzlFZFhaSlYxcHBibHBJVkdObloxSnBjMGgwWTJOME5XTm9iMVZLTlhWcWJuQlFPV3MxWW1zMlJXMUVPSFJFYjNGNWRYRkNlVXRZVVhWRFRIRk1RMGQwVWs5RlkyMVlORU5EY2xoU1RVTkxTWG8zTUZSTWQyeExTVVUyWm05NU1WSnFOSEJpYW5SS1RsbHdWaXMzSzA4MWFuZGxWVzVpYW14Q1duRldLMVZ4Vm1KRVVWSnRaV2ROTTBwV1NWTTNWMmhKV21KeFRsbEpVMVJNVGxweFNtUXJUVkpXVlRNeVFYWXhNMGhQTVVKR1ZscEJlbVEzWTJWU1NHcHZabUp6WjBrelFsbGFka2xCVFUwNFp6SkZjek15VlVnaUxDSnRZV01pT2lJd05qTmpOV1l6TnpJMVlXSmlNMk13WXpZeFlUTmtOVFkyTVdNNVl6UTNPRGt6TWprM1lqUTBNbVZqWWpJMk5URm1abU0yTW1FM1l6ZGpPVEZpWkRVeUlpd2lkR0ZuSWpvaUluMD0=',1778128435),('yhyrJKEb0ZS5rPNd6KPM6dQxpyKjHWBeW4Qb3g5n',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','ZXlKcGRpSTZJamx1Wml0VGVrRkthamxXTkZWS01FRkVUMmx0YlVFOVBTSXNJblpoYkhWbElqb2laMDlDTWxOaFVuTlBXRmt6Tlc5amFEVjVWMjlWWVROVVRrODVlRXB6UTJOemMwVk9PVEZQYXpVMGVWWm5iaXRoVG05d1JIQnJVVzVzVTNBdmRqSTJWbGRWUlRsT01WZElTRlk0V1VSdUwxSXZkVGd4VEhvcmEySjBUVlUxUzBsUGNHOXlVMkp2Y0Vac016VXZTalV2UjJ0T09VeHBaRTgyVTJkRFVYWm9XVTlxUjNCWmFGZDNNazB6Y1ZkNUsxWkNOVVJrYkVjd1NIVllTRTlaU0haaE1XRjBXVzR4VDI1UE5HRmlaME5IUVZSRGVtUjRja05UYldkNWNsTkdSMk5FVFVSVVpXazVXU3MzVWpNdkx6YzFaWGRNTjFZMFkybGpLMHhKVVV4bVF5OXlVMk5NVUd0bVdrWmxRV1pLYlZGNWExVXdObUZLWnpCUlNHaG1UVVpSZFc5UFlUVjFiRUo2WldkeVNUUkVWM1U0ZERkamNVOVRTMDlCYXpSdUswSm9UMDlQVFdORFZtWmtUVE0xVjBGemNFNU1VakZzUVRWVFZDOXZVREZDYVNzaUxDSnRZV01pT2lJek4yVmlPR0ptT1dVMFptVXhaak5sT0RZNVlUaGlObUkzTVRaa1lqRTBZalJtWXpFMlpETmpOVGN6WVRNME1qTmxZemszWkdFNFpqRmpNRE5tTW1Waklpd2lkR0ZuSWpvaUluMD0=',1778469124),('YOkNYwS4UAQVveyWnjigaCCivj6Fv3pRqjZt8oOF',NULL,'127.0.0.1','curl/8.7.1','ZXlKcGRpSTZJbkUyTWpOdlFuaHdOMXBIVURocFMzaDFWbkEzTjJjOVBTSXNJblpoYkhWbElqb2lja3B1Y3pGV04wSndNekZVVG5FclRIWlRSQ3RYYUhwd1VGaFFSVVE0VW5vMFFVdzJZa1p5ZFhSRU5EUTBOMU5DTUd0NWN6SXJjM0k1Y0ZweFZGUktkWFZyVEVwSVF6QjJjRE15YnpKQ1JuSm9NVzgzTlVFeUsyZHZTVXRNVWpKRWNXRjJibmhYYlRJdlluUkpOazlRVDNNNVRtbG5Ta1YyWjA5Uk16ZHBjRWRDUkc1VlExWkNkMjVqV0hwS2FqZFBhRGRwWm5aQ1UzYzVVR1JGTjBrMmRVVnpkWFp5TUVoTlN6RnhNV0l5VURaVVFqZFNXaTltWkVaRlkwVkZhbU5rUkVoRGJucDBSbWh2WldacFNIRkZWbGRYVDI4NWVuQlNaREF2Y0U0dlFVSTRkblJSU0ZaSWNsazRZemxuUWxkdmNHeGplR3M1Vkd4YU9WSk9SV2x5ZGxGeVpua3lVelZQVUVwdE0yYzJabk5KTmsweFZscHhOV0pFTURCMGRYUkVaVTUxWmtKWVNDc3JPRUYzUVhGcmRGZ3lZbWxUVWt4TE1GQndLMVJxTjBraUxDSnRZV01pT2lJeVptWTNOalZpWWpCak1qQTVPVFUwT1dVeE1tSXpObVUwTURaalpHSXpZalpoTWpGaVlqUTRZVGczWmpVMllqTm1aVEEyT0dNeE5HSmlZV1kwTXpjM0lpd2lkR0ZuSWpvaUluMD0=',1778125056),('ZTBjeXhKkQmGvApBZcfqieY0pFMibzAsdybcOkW1',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','ZXlKcGRpSTZJalZ6WkVWSFZUVmlZVFJZYTNORFJqSkZkVVk0TDFFOVBTSXNJblpoYkhWbElqb2lUakJwVTB4RE1UZFZPRU5ITkhaemVqQllZM2xMT1RSTlNrVjFOVmQwYm0xVFZWRndSVEpvYkVzemJVODBRa3gyYVc1cmFtRkZTRkJGV1dFcmVWYzFhamRtYW1SR1NUbFBVbkJIT1hCU05GZHhNVkJOYzBndlUxSkpSWEF6T0RaWmRVeFBkVkp5TUZWYWRGbG9aMHRhTlRWNFNWSlpORGhQUkhBMlNEWnRTblZsYXpsSmFUbFRWVWRLWjJnNFVrZFZUV2hvUjFvNE1WZ3haMGhsUlhBeVlYbGpaRGR4ZEhGeFJIQmxNVFJNYldScFZYRXlOVmRvUnpCWFRXOWlWVEpaT0M5TGFHWmhkM0l2VDNnME1VMURVV1k1ZDFwUFp6RXdNMVpTWm1ObWVHMHhkMWd4TDJrMFQxTkxWWEo1THpaSE5WSmlOVGxaVmxONmFVd3JRMU5wVG1oSU9EZENTRUkzVFVGSE1IaFZlVFkwUnpKeVVqWnNTM2xvWkZCeGNIUm5lV2RWYURGSFJuZGFTV3B0UjFJNVYwdEpSelJpTWtSVVRUVm1VbEpzUTBaNk5WRjBTRk0zVXpCMWMyRnVZWE5RUjBoV1EyVktaVzgyWWtSa1dsSllXVWMwWjJ4c2NHTktaalZEYUU5SWNVODVZVEphYXpWM1pYcERNamwxUjJVME1IcDZUa1JJYzNoMk9FUTVVMlpUVkVSMldTOHdiVlZNZFhsTWQxWm5RWEl4TkhOaWFIWnpSU3RvUlQwaUxDSnRZV01pT2lJeE9UQmxNVFZqWmpRMU1tWmxaRGMzWWpSbE1qWm1NamN6TW1ZM05UZzFZMlEyWVRFeE1UbGxPVE0xTTJSbVpEQTRaREF5T0RkbE9EazJPVGcxT0RabUlpd2lkR0ZuSWpvaUluMD0=',1778137455);
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
INSERT INTO `users` VALUES (1,NULL,'Admin Pusat','admin@ham.go.id',NULL,'$2y$12$onIGMxro/UzDOhRP1Ji7K.q5GXrMKAyNwF31nKkaC2lqi5ZN2jQya',NULL,'2026-04-12 22:17:11','2026-04-12 22:17:11'),(2,1,'Staff ACEH','aceh@ham.go.id',NULL,'$2y$12$o0jAg2SE90uPJa3.Nj8LF.j7mrz1t/GbuNylcPW5.VT3cwXOmKYlu',NULL,'2026-04-12 22:17:11','2026-04-12 22:17:11'),(3,2,'Staff SUMUT','sumut@ham.go.id',NULL,'$2y$12$tcvxDeHG4ODBlOvAN8hEJ.lQuCcZ2AhT65gcqpExFfOi86jsY6M82',NULL,'2026-04-12 22:17:11','2026-04-12 22:17:11'),(4,8,'Staff JABAR','jabar@ham.go.id',NULL,'$2y$12$IQ61AqLVNmEXg5iDKUnF3.Hi.oWbmLr2L8.CGlEp6ByDlhwXhb1My',NULL,'2026-04-12 22:17:11','2026-04-12 22:17:11'),(5,10,'Staff DKI','dki@ham.go.id',NULL,'$2y$12$gInuneGDL0XGuDU5c0eM8.yiGI7Am9vlfXP21H97rcj8XOYaT.H9y',NULL,'2026-04-12 22:17:12','2026-04-12 22:17:12'),(6,11,'Staff JATENG','jateng@ham.go.id',NULL,'$2y$12$Z0phE6CplEOleQVpPAqog.fDzQ1SH0iSvURCRYBd9zVMpFefmOyo.',NULL,'2026-04-12 22:17:12','2026-04-12 22:17:12'),(7,12,'Staff JATIM','jatim@ham.go.id',NULL,'$2y$12$x1DEsUcj82T5Lt.ypQdB4eFOcFunB0yAYwLnO6c4UJkYN43jhFuaO',NULL,'2026-04-12 22:17:12','2026-04-12 22:17:12');
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

-- Dump completed on 2026-05-11 12:58:32
