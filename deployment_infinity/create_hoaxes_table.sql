-- ============================================
-- Script untuk membuat tabel HOAXES
-- Jalankan di phpMyAdmin InfinityFree
-- ============================================

CREATE TABLE IF NOT EXISTS `hoaxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  KEY `hoaxes_is_published_index` (`is_published`),
  KEY `hoaxes_published_at_index` (`published_at`),
  KEY `hoaxes_user_id_foreign` (`user_id`),
  CONSTRAINT `hoaxes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
