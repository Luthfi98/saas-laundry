-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table laundry-saas.activities
CREATE TABLE IF NOT EXISTS `activities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activities_user_id_foreign` (`user_id`),
  CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `activities_chk_1` CHECK (json_valid(`data`))
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.activities: ~25 rows (approximately)
DELETE FROM `activities`;
INSERT INTO `activities` (`id`, `user_id`, `ip`, `url`, `description`, `data`, `type`, `created_at`, `updated_at`) VALUES
	(173, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Subscription', '{"_token":"GpTO52Tg79jcMEsl79PjCc6UyjQeGhkjWQCusHF1","parent":"1","name":"Subscription","module":"module-subscription","path":"#","icon":"fa fa-database","type":"cms","permissions":["show","read","create","update","delete","detail"]}', 'Create', '2025-04-11 01:38:21', '2025-04-11 01:38:21'),
	(174, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/24', 'Update Menu Subscription', '{"_token":"GpTO52Tg79jcMEsl79PjCc6UyjQeGhkjWQCusHF1","_method":"PUT","parent":"1","name":"Subscription","module":"module-subscription","path":"dashboard.index","icon":"fa fa-database","type":"cms","permissions":["show","read","create","update","delete","detail"]}', 'Edit', '2025-04-11 01:38:44', '2025-04-11 01:38:44'),
	(175, 1, '127.0.0.1', 'http://saas-laundry.test/login.do', 'Login With luthfi.ihdalhusnayain98@gmail.com & password', '{"_token":"emUnMYctneYzGxVYJMrGSqTQF2nA10L4exzcOvFA","email":"luthfi.ihdalhusnayain98@gmail.com"}', 'Login', '2025-04-11 06:06:16', '2025-04-11 06:06:16'),
	(176, 1, '127.0.0.1', 'http://saas-laundry.test/cms/subscriptions', 'Create Subscription Package 1', '{"_token":"emUnMYctneYzGxVYJMrGSqTQF2nA10L4exzcOvFA","name":"Package 1","price":"100","branch_limit":"1","user_limit":"5","features":"{}","duration_in_days":"30","status":"active"}', 'Create', '2025-04-11 06:16:20', '2025-04-11 06:16:20'),
	(177, 1, '127.0.0.1', 'http://saas-laundry.test/cms/subscriptions/1', 'Edit Subscription Package 1', '{"_token":"emUnMYctneYzGxVYJMrGSqTQF2nA10L4exzcOvFA","_method":"PUT","name":"Package 1","price":"1500000","branch_limit":"1","user_limit":"5","features":"{}","duration_in_days":"30","status":"active"}', 'Edit', '2025-04-11 06:29:00', '2025-04-11 06:29:00'),
	(178, 1, '127.0.0.1', 'http://saas-laundry.test/cms/subscriptions/1', 'Edit Subscription Package 1', '{"_token":"emUnMYctneYzGxVYJMrGSqTQF2nA10L4exzcOvFA","_method":"PUT","name":"Package 1","price":"1500000.00","branch_limit":"1","user_limit":"5","features":"- Cabang : 1\\r\\n- User : 5","duration_in_days":"30","status":"active"}', 'Edit', '2025-04-11 06:29:34', '2025-04-11 06:29:34'),
	(179, 1, '127.0.0.1', 'http://saas-laundry.test/cms/subscriptions/1', 'Edit Subscription Package 1', '{"_token":"emUnMYctneYzGxVYJMrGSqTQF2nA10L4exzcOvFA","_method":"PUT","name":"Package 1","price":"1500000.00","branch_limit":"1","user_limit":"5","features":"- Cabang : 1\\r\\n- User : 5","duration_in_days":"30"}', 'Edit', '2025-04-11 06:40:21', '2025-04-11 06:40:21'),
	(180, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Data Master', '{"_token":"emUnMYctneYzGxVYJMrGSqTQF2nA10L4exzcOvFA","parent":null,"name":"Data Master","module":"module-data-master","path":"#","icon":"#","type":"cms","is_label":"on","permissions":["show"]}', 'Create', '2025-04-11 06:41:37', '2025-04-11 06:41:37'),
	(181, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Tenant', '{"_token":"emUnMYctneYzGxVYJMrGSqTQF2nA10L4exzcOvFA","parent":"25","name":"Tenant","module":"module-tenant","path":"#","icon":"fa fa-building-o","type":"cms","permissions":["show","read","create","update","delete","detail"]}', 'Create', '2025-04-11 06:44:56', '2025-04-11 06:44:56'),
	(182, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/26', 'Update Menu Tenant', '{"_token":"emUnMYctneYzGxVYJMrGSqTQF2nA10L4exzcOvFA","_method":"PUT","parent":"25","name":"Tenant","module":"module-tenant","path":"dashboard.index","icon":"fa fa-building-o","type":"cms","permissions":["show","read","create","update","delete","detail"]}', 'Edit', '2025-04-11 06:45:13', '2025-04-11 06:45:13'),
	(183, 1, '127.0.0.1', 'http://saas-laundry.test/cms/tenants', 'Create Tenant Kulit Jeruk', '{"_token":"emUnMYctneYzGxVYJMrGSqTQF2nA10L4exzcOvFA","name":"Kulit Jeruk","email":"kj@gmail.com","phone":"9021382193","address":"Adresss Main","status":"active","logo":{},"files":{"logo":{"original_name":"Hari Air Sedunia 2025.png"}}}', 'Create', '2025-04-11 06:54:20', '2025-04-11 06:54:20'),
	(184, 1, '127.0.0.1', 'http://saas-laundry.test/cms/tenants', 'Create Tenant Biji Jeruk', '{"_token":"emUnMYctneYzGxVYJMrGSqTQF2nA10L4exzcOvFA","name":"Biji Jeruk","email":"bj@gmail.com","phone":"281938724","address":"shdjfdjdshf","status":"active","logo":{},"files":{"logo":{"original_name":"Hari Air Sedunia 2025.png"}}}', 'Create', '2025-04-11 06:57:29', '2025-04-11 06:57:29'),
	(185, 1, '127.0.0.1', 'http://saas-laundry.test/login.do', 'Login With luthfi.ihdalhusnayain98@gmail.com & password', '{"_token":"Gf3VCCYczxy5wYUVjcwgx5CJvHKL8TArhrKgMz6L","email":"luthfi.ihdalhusnayain98@gmail.com"}', 'Login', '2025-04-14 00:54:09', '2025-04-14 00:54:09'),
	(186, 1, '127.0.0.1', 'http://saas-laundry.test/login.do', 'Login With luthfi.ihdalhusnayain98@gmail.com & password', '{"_token":"ZSKWLJcPr82zlkhtQ04zeJBgUflV4wJYqDLulHpX","email":"luthfi.ihdalhusnayain98@gmail.com"}', 'Login', '2025-04-14 00:54:36', '2025-04-14 00:54:36'),
	(187, 1, '127.0.0.1', 'http://saas-laundry.test/cms/tenants/1', 'Edit Tenant Kulit Jeruk', '{"_token":"ZSKWLJcPr82zlkhtQ04zeJBgUflV4wJYqDLulHpX","_method":"PUT","name":"Kulit Jeruk","email":"kj@gmail.com","phone":"9021382193","address":"Adresss Main","status":"active","logo":{},"files":{"logo":{"original_name":"Hari Air Sedunia 2025.png"}}}', 'Edit', '2025-04-14 00:59:43', '2025-04-14 00:59:43'),
	(188, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/26', 'Update Menu Tenant', '{"_token":"ZSKWLJcPr82zlkhtQ04zeJBgUflV4wJYqDLulHpX","_method":"PUT","parent":"25","name":"Tenant","module":"module-tenant","path":"tenants.index","icon":"fa fa-building-o","type":"cms","permissions":["show","read","create","update","delete","detail"]}', 'Edit', '2025-04-14 01:00:26', '2025-04-14 01:00:26'),
	(189, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/24', 'Update Menu Subscription', '{"_token":"ZSKWLJcPr82zlkhtQ04zeJBgUflV4wJYqDLulHpX","_method":"PUT","parent":"1","name":"Subscription","module":"module-subscription","path":"subscriptions.index","icon":"fa fa-database","type":"cms","permissions":["show","read","create","update","delete","detail"]}', 'Edit', '2025-04-14 01:00:53', '2025-04-14 01:00:53'),
	(190, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Branch', '{"_token":"ZSKWLJcPr82zlkhtQ04zeJBgUflV4wJYqDLulHpX","parent":"25","name":"Branch","module":"module-branch","path":"dashboard.index","icon":"fas fa-code-branch","type":"cms","permissions":["show","read","create","update","delete","detail"]}', 'Create', '2025-04-14 01:08:51', '2025-04-14 01:08:51'),
	(191, 1, '127.0.0.1', 'http://saas-laundry.test/login.do', 'Login With luthfi.ihdalhusnayain98@gmail.com & password', '{"_token":"cw5SkCgKVLF31k5ZGo4NNGVpa8KlFtjsqud6316G","email":"luthfi.ihdalhusnayain98@gmail.com"}', 'Login', '2025-04-15 01:06:40', '2025-04-15 01:06:40'),
	(192, 1, '127.0.0.1', 'http://saas-laundry.test/login.do', 'Login With luthfi.ihdalhusnayain98@gmail.com & password', '{"_token":"cw5SkCgKVLF31k5ZGo4NNGVpa8KlFtjsqud6316G","email":"luthfi.ihdalhusnayain98@gmail.com"}', 'Login', '2025-04-15 01:43:58', '2025-04-15 01:43:58'),
	(193, 1, '127.0.0.1', 'http://saas-laundry.test/cms/tenants/1', 'Edit Tenant Kulit Jeruk', '{"_token":"cw5SkCgKVLF31k5ZGo4NNGVpa8KlFtjsqud6316G","_method":"PUT","name":"Kulit Jeruk","email":"kj@gmail.com","phone":"9021382193","address":"Adresss Main","status":"active","logo":{},"files":{"logo":{"original_name":"pngtree-blue-washing-machine-for-laundry-logo-png-image_6114594.png"}}}', 'Edit', '2025-04-15 01:48:49', '2025-04-15 01:48:49'),
	(194, 1, '127.0.0.1', 'http://saas-laundry.test/login.do', 'Login With luthfi.ihdalhusnayain98@gmail.com & password', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","email":"luthfi.ihdalhusnayain98@gmail.com"}', 'Login', '2025-04-17 00:58:17', '2025-04-17 00:58:17'),
	(195, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Master Data', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"25","name":"Master Data","module":"module-master-data","path":"#","icon":"#","type":"landing","is_label":"on","permissions":["show"]}', 'Create', '2025-04-17 01:02:46', '2025-04-17 01:02:46'),
	(196, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/28', 'Update Menu Master Data', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","_method":"PUT","parent":null,"name":"Master Data","module":"module-master-data","path":"#","icon":"#","type":"landing","is_label":"on","permissions":["show"]}', 'Edit', '2025-04-17 01:03:10', '2025-04-17 01:03:10'),
	(197, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Branch', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"28","name":"Branch","module":"module-branch-tenant","path":"dashboard.index","icon":"fas fa-code-branch","type":"landing","permissions":["show","read","create","update","delete","detail"]}', 'Create', '2025-04-17 01:05:47', '2025-04-17 01:05:47'),
	(198, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Dashboard', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":null,"name":"Dashboard","module":"module-dashboard-tenant","path":"tenant.dashboard","icon":"fa fa-dashboard","type":"landing","permissions":["show"]}', 'Create', '2025-04-17 01:10:52', '2025-04-17 01:10:52'),
	(199, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/31', 'Update Menu Dashboard', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","_method":"PUT","parent":null,"name":"Dashboard","module":"module-dashboard-tenant","path":"dashboard.index","icon":"fa fa-dashboard","type":"landing","permissions":["show"]}', 'Edit', '2025-04-17 01:12:02', '2025-04-17 01:12:02'),
	(200, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Setup', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":null,"name":"Setup","module":"module-setup-tenant","path":"#","icon":"fa fa-wrench","type":"landing","permissions":["show"]}', 'Create', '2025-04-17 01:13:02', '2025-04-17 01:13:02'),
	(201, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Business Profile', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"32","name":"Business Profile","module":"module-business-profile-tenant","path":"dashboard.index","icon":"#","type":"landing","permissions":["show","read","update"]}', 'Create', '2025-04-17 01:23:41', '2025-04-17 01:23:41'),
	(202, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu User Account', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"32","name":"User Account","module":"module-user-account-tenant","path":"dashboard.index","icon":"#","type":"landing","permissions":["show","read","create","update","delete","detail"]}', 'Create', '2025-04-17 01:24:34', '2025-04-17 01:24:34'),
	(203, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Tax & Discount', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"32","name":"Tax & Discount","module":"module-tax-discount-tenant","path":"dashboard.index","icon":"#","type":"landing","permissions":["show","read","create","update","delete"]}', 'Create', '2025-04-17 01:26:05', '2025-04-17 01:26:05'),
	(204, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/30', 'Update Menu Branches', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","_method":"PUT","parent":"28","name":"Branches","module":"module-branch-tenant","path":"#","icon":"fas fa-code-branch","type":"landing","permissions":["show"]}', 'Edit', '2025-04-17 01:27:30', '2025-04-17 01:27:30'),
	(205, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Branch List', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"30","name":"Branch List","module":"module-branch-list-tenant","path":"dashboard.index","icon":"#","type":"landing","permissions":["show","read","create","update","delete","detail"]}', 'Create', '2025-04-17 01:28:15', '2025-04-17 01:28:15'),
	(206, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Branch Performance', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"30","name":"Branch Performance","module":"module-branch-performance-tenant","path":"dashboard.index","icon":"#","type":"landing","permissions":["show","read","export"]}', 'Create', '2025-04-17 01:29:15', '2025-04-17 01:29:15'),
	(207, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Laundry Service', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"28","name":"Laundry Service","module":"module-laundry-service-tenant","path":"#","icon":"fa fa-wrench","type":"landing","permissions":["show"]}', 'Create', '2025-04-17 01:33:04', '2025-04-17 01:33:04'),
	(208, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Service List', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"38","name":"Service List","module":"module-service-list-tenant","path":"dashboard.index","icon":"#","type":"landing","permissions":["show","read","create","update","delete"]}', 'Create', '2025-04-17 01:33:50', '2025-04-17 01:33:50'),
	(209, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/sorting', 'Change Sorting', '{"data":[{"id":"31"},{"id":"25","children":[{"id":"26"},{"id":"27"}]},{"id":"28","children":[{"id":"30","children":[{"id":"36"},{"id":"37"}]},{"id":"38","children":[{"id":"39"}]}]},{"id":"32","children":[{"id":"33"},{"id":"34"},{"id":"35"}]},{"id":"9"},{"id":"1","children":[{"id":"24"},{"id":"2","children":[{"id":"8"},{"id":"3"},{"id":"6"},{"id":"4"},{"id":"5"},{"id":"7"}]}]}],"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo"}', 'Edit', '2025-04-17 01:34:22', '2025-04-17 01:34:22'),
	(210, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/sorting', 'Change Sorting', '{"data":[{"id":"31"},{"id":"28","children":[{"id":"30","children":[{"id":"36"},{"id":"37"}]},{"id":"38","children":[{"id":"39"}]}]},{"id":"25","children":[{"id":"26"},{"id":"27"}]},{"id":"32","children":[{"id":"33"},{"id":"34"},{"id":"35"}]},{"id":"9"},{"id":"1","children":[{"id":"24"},{"id":"2","children":[{"id":"8"},{"id":"3"},{"id":"6"},{"id":"4"},{"id":"5"},{"id":"7"}]}]}],"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo"}', 'Edit', '2025-04-17 01:34:34', '2025-04-17 01:34:34'),
	(211, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/sorting', 'Change Sorting', '{"data":[{"id":"31"},{"id":"28","children":[{"id":"30","children":[{"id":"36"},{"id":"37"}]},{"id":"38","children":[{"id":"39"}]}]},{"id":"32","children":[{"id":"33"},{"id":"34"},{"id":"35"}]},{"id":"25","children":[{"id":"26"},{"id":"27"}]},{"id":"9"},{"id":"1","children":[{"id":"24"},{"id":"2","children":[{"id":"8"},{"id":"3"},{"id":"6"},{"id":"4"},{"id":"5"},{"id":"7"}]}]}],"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo"}', 'Edit', '2025-04-17 01:34:36', '2025-04-17 01:34:36'),
	(212, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/36', 'Update Menu Branch List', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","_method":"PUT","parent":"30","name":"Branch List","module":"module-branch-list-tenant","path":"tenant.branch.index","icon":"#","type":"landing","permissions":["show","read","create","update","delete","detail"]}', 'Edit', '2025-04-17 04:10:24', '2025-04-17 04:10:24'),
	(213, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus/39', 'Update Menu Service List', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","_method":"PUT","parent":"38","name":"Service List","module":"module-service-list-tenant","path":"tenant.services.index","icon":"#","type":"landing","permissions":["show","read","create","update","delete"]}', 'Edit', '2025-04-17 04:25:18', '2025-04-17 04:25:18'),
	(214, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Service Categories', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"38","name":"Service Categories","module":"module-service-categories-tenant","path":"tenant.service-categories.index","icon":"#","type":"landing","permissions":["show","read","create","update","delete","detail"]}', 'Create', '2025-04-17 04:51:31', '2025-04-17 04:51:31'),
	(215, 1, '127.0.0.1', 'http://saas-laundry.test/67f8bc9c12d40/services', 'Create Service Baju Kiloan', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","branch_id":"1","service_category_id":"1","code":"CG001","name":"Baju Kiloan","price":"8000","unit":"Kg","is_active":"1","tenant":{"id":1,"code":"67f8bc9c12d40","name":"Kulit Jeruk","email":"kj@gmail.com","phone":"9021382193","address":"Adresss Main","logo":"uploads\\/tenant\\/1744681729_logo_pngtree-blue-washing-machine-for-laundry-logo-png-image_6114594.png","status":"active","created_at":"2025-04-11T06:54:20.000000Z","updated_at":"2025-04-15T01:48:49.000000Z","deleted_at":null}}', 'Create', '2025-04-17 06:15:57', '2025-04-17 06:15:57'),
	(216, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Subscription history', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"1","name":"Subscription history","module":"module-subscription-history","path":"subscription-histories.index","icon":"fa fa-list","type":"cms","permissions":["show","read","create","update","delete","detail"]}', 'Create', '2025-04-17 06:29:25', '2025-04-17 06:29:25'),
	(217, 1, '127.0.0.1', 'http://saas-laundry.test/cms/subscription-histories', 'Create Subscription History SUB-6800A3BE0EE86', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","tenant_id":"1","subscription_id":"1","code":"SUB-6800A3BE0EE86","price":"1500000.00","start_date":"2025-04-17","end_date":"2025-04-17","status":"pending","payment_method":"Virtual Account","notes":null}', 'Create', '2025-04-17 06:47:21', '2025-04-17 06:47:21'),
	(218, 1, '127.0.0.1', 'http://saas-laundry.test/cms/subscription-histories/1', 'Edit Subscription History SUB-6800A3BE0EE86', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","_method":"PUT","tenant_id":"1","subscription_id":"1","code":"SUB-6800A3BE0EE86","price":"1500000.00","start_date":"2025-04-17","end_date":"2025-04-17","status":"active","payment_method":"Virtual Account","notes":null}', 'Edit', '2025-04-17 06:49:22', '2025-04-17 06:49:22'),
	(219, 1, '127.0.0.1', 'http://saas-laundry.test/cms/subscription-histories/1', 'Edit Subscription History SUB-6800A3BE0EE86', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","_method":"PUT","tenant_id":"1","subscription_id":"1","code":"SUB-6800A3BE0EE86","price":"1500000.00","start_date":"2025-04-17","end_date":"2025-04-17","status":"active","payment_method":"Virtual Account","notes":"Confirmed"}', 'Edit', '2025-04-17 06:51:26', '2025-04-17 06:51:26'),
	(220, 1, '127.0.0.1', 'http://saas-laundry.test/cms/subscription-histories/1', 'Edit Subscription History SUB-6800A3BE0EE86', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","_method":"PUT","tenant_id":"1","subscription_id":"1","code":"SUB-6800A3BE0EE86","price":"1500000.00","start_date":"2025-04-17","end_date":"2025-04-17","status":"active","payment_method":"Virtual Account","notes":"Confirmed"}', 'Edit', '2025-04-17 06:56:45', '2025-04-17 06:56:45'),
	(221, 1, '127.0.0.1', 'http://saas-laundry.test/cms/menus', 'Create Menu Customer', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","parent":"28","name":"Customer","module":"module-customer-tenant","path":"tenant.customer.index","icon":"fa fa-users","type":"landing","permissions":["show","read","create","update","delete","detail"]}', 'Create', '2025-04-17 07:12:33', '2025-04-17 07:12:33'),
	(222, 1, '127.0.0.1', 'http://saas-laundry.test/67f8bc9c12d40/customer', 'Create Customer Anonymous', '{"_token":"rUy6wyoeGLCeVeowxFkc7t2Yq7Pnb7KPuWMDn5fo","name":"Anonymous","phone":"000000000","address":"-","tenant":{"id":1,"code":"67f8bc9c12d40","name":"Kulit Jeruk","email":"kj@gmail.com","phone":"9021382193","address":"Adresss Main","logo":"uploads\\/tenant\\/1744681729_logo_pngtree-blue-washing-machine-for-laundry-logo-png-image_6114594.png","status":"active","created_at":"2025-04-11T06:54:20.000000Z","updated_at":"2025-04-15T01:48:49.000000Z","deleted_at":null}}', 'Create', '2025-04-17 07:26:59', '2025-04-17 07:26:59');

-- Dumping structure for table laundry-saas.branches
CREATE TABLE IF NOT EXISTS `branches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branches_tenant_id_foreign` (`tenant_id`),
  CONSTRAINT `branches_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.branches: ~0 rows (approximately)
DELETE FROM `branches`;
INSERT INTO `branches` (`id`, `tenant_id`, `code`, `name`, `phone`, `address`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'BR-680075D3E72C7', 'Kulit Jeruk Bali', '2983478327483278', 'Jl. Marunda Baru 6', 1, '2025-04-17 03:30:27', '2025-04-17 04:02:38', NULL);

-- Dumping structure for table laundry-saas.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `branch_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_tenant_id_foreign` (`tenant_id`),
  KEY `customers_branch_id_foreign` (`branch_id`),
  CONSTRAINT `customers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `customers_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.customers: ~0 rows (approximately)
DELETE FROM `customers`;
INSERT INTO `customers` (`id`, `tenant_id`, `branch_id`, `name`, `phone`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, NULL, 'Anonymous', '000000000', '-', '2025-04-17 07:26:59', '2025-04-17 07:26:59', NULL);

-- Dumping structure for table laundry-saas.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table laundry-saas.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned DEFAULT NULL,
  `module` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort` tinyint NOT NULL DEFAULT '0',
  `type` enum('cms','landing') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cms',
  `is_label` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.menus: ~17 rows (approximately)
DELETE FROM `menus`;
INSERT INTO `menus` (`id`, `parent_id`, `module`, `name`, `path`, `icon`, `sort`, `type`, `is_label`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, NULL, 'module-setting', 'Setting', '#', '#', 6, 'cms', 1, '2023-10-25 01:39:31', '2025-04-17 01:34:22', NULL),
	(2, 1, 'module-setup-website', 'Setup Website', '#', 'fa fa-globe', 2, 'cms', 0, '2023-10-25 07:26:25', '2025-04-17 01:34:22', NULL),
	(3, 2, 'module-menu', 'Menu', 'menus.index', 'fa fa-list', 2, 'cms', 0, '2023-10-25 07:27:03', '2025-02-12 09:36:06', NULL),
	(4, 2, 'module-user', 'User', 'users.index', 'fa fa-users', 4, 'cms', 0, '2023-10-25 07:27:43', '2025-02-12 09:36:06', NULL),
	(5, 2, 'module-role', 'Role', 'roles.index', 'fa fa-user-tie', 5, 'cms', 0, '2023-10-25 07:28:11', '2025-02-12 09:36:06', NULL),
	(6, 2, 'module-sorting-menu', 'Sorting Menu', 'menus.sorting', 'fa fa-sort', 3, 'cms', 0, '2023-10-26 03:14:29', '2025-02-12 09:36:06', NULL),
	(7, 2, 'module-website', 'Website', 'website.index', 'fa fa-globe', 6, 'cms', 0, '2023-10-26 03:16:09', '2025-02-12 09:36:06', NULL),
	(8, 2, 'module-permission', 'Permission', 'permissions.index', '#', 1, 'cms', 0, '2025-01-23 03:18:04', '2025-02-12 09:36:06', NULL),
	(9, NULL, 'module-dashboard', 'Dashboard', 'dashboard.index', 'fa fa-home', 5, 'cms', 0, '2025-02-06 04:32:29', '2025-04-17 01:34:22', NULL),
	(10, 1, 'module-activity-user', 'Activity User', 'report-activity-user', 'fa fa-list', 1, 'cms', 0, '2025-02-12 01:20:19', '2025-02-13 06:25:47', '2025-02-13 06:25:47'),
	(24, 1, 'module-subscription', 'Subscription', 'subscriptions.index', 'fa fa-database', 1, 'cms', 0, '2025-04-11 01:38:21', '2025-04-17 01:34:22', NULL),
	(25, NULL, 'module-data-master', 'Data Master', '#', '#', 4, 'cms', 1, '2025-04-11 06:41:37', '2025-04-17 01:34:36', NULL),
	(26, 25, 'module-tenant', 'Tenant', 'tenants.index', 'fa fa-building-o', 1, 'cms', 0, '2025-04-11 06:44:56', '2025-04-17 01:34:22', NULL),
	(27, 25, 'module-branch', 'Branch', 'dashboard.index', 'fas fa-code-branch', 2, 'cms', 0, '2025-04-14 01:08:51', '2025-04-17 01:34:22', NULL),
	(28, NULL, 'module-master-data', 'Master Data', '#', '#', 2, 'landing', 1, '2025-04-17 01:02:46', '2025-04-17 01:34:34', NULL),
	(29, 28, 'module-branch', 'Branch', 'dashboard.index', 'fas fa-code-branch', 0, 'landing', 0, '2025-04-17 01:05:10', '2025-04-17 01:05:10', '2025-04-17 01:06:43'),
	(30, 28, 'module-branch-tenant', 'Branches', '#', 'fas fa-code-branch', 1, 'landing', 0, '2025-04-17 01:05:47', '2025-04-17 01:34:22', NULL),
	(31, NULL, 'module-dashboard-tenant', 'Dashboard', 'dashboard.index', 'fa fa-dashboard', 1, 'landing', 0, '2025-04-17 01:10:52', '2025-04-17 01:34:22', NULL),
	(32, NULL, 'module-setup-tenant', 'Setup', '#', 'fa fa-wrench', 3, 'landing', 0, '2025-04-17 01:13:02', '2025-04-17 01:34:36', NULL),
	(33, 32, 'module-business-profile-tenant', 'Business Profile', 'dashboard.index', '#', 1, 'landing', 0, '2025-04-17 01:23:41', '2025-04-17 01:34:22', NULL),
	(34, 32, 'module-user-account-tenant', 'User Account', 'dashboard.index', '#', 2, 'landing', 0, '2025-04-17 01:24:34', '2025-04-17 01:34:22', NULL),
	(35, 32, 'module-tax-discount-tenant', 'Tax & Discount', 'dashboard.index', '#', 3, 'landing', 0, '2025-04-17 01:26:05', '2025-04-17 01:34:22', NULL),
	(36, 30, 'module-branch-list-tenant', 'Branch List', 'tenant.branch.index', '#', 1, 'landing', 0, '2025-04-17 01:28:15', '2025-04-17 04:10:24', NULL),
	(37, 30, 'module-branch-performance-tenant', 'Branch Performance', 'dashboard.index', '#', 2, 'landing', 0, '2025-04-17 01:29:15', '2025-04-17 01:34:22', NULL),
	(38, 28, 'module-laundry-service-tenant', 'Laundry Service', '#', 'fa fa-wrench', 2, 'landing', 0, '2025-04-17 01:33:04', '2025-04-17 01:34:22', NULL),
	(39, 38, 'module-service-list-tenant', 'Service List', 'tenant.services.index', '#', 1, 'landing', 0, '2025-04-17 01:33:50', '2025-04-17 04:25:18', NULL),
	(40, 38, 'module-service-categories-tenant', 'Service Categories', 'tenant.service-categories.index', '#', 0, 'landing', 0, '2025-04-17 04:51:31', '2025-04-17 04:51:31', NULL),
	(41, 1, 'module-subscription-history', 'Subscription history', 'subscription-histories.index', 'fa fa-list', 0, 'cms', 0, '2025-04-17 06:29:25', '2025-04-17 06:29:25', NULL),
	(42, 28, 'module-customer-tenant', 'Customer', 'tenant.customer.index', 'fa fa-users', 0, 'landing', 0, '2025-04-17 07:12:33', '2025-04-17 07:12:33', NULL);

-- Dumping structure for table laundry-saas.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.migrations: ~12 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_08_17_082436_create_menus_table', 1),
	(6, '2023_08_17_134224_create_roles_table', 1),
	(7, '2023_08_17_134257_create_user_roles_table', 1),
	(8, '2023_08_20_071051_create_permissions_table', 1),
	(9, '2023_08_20_102818_create_role_permissions_table', 1),
	(10, '2023_08_22_012102_add_column_default_role_users', 1),
	(11, '2023_09_21_094940_create_activities_table', 1),
	(12, '2023_09_27_141142_add_version_theme_user', 1),
	(21, '2025_04_11_084250_create_subscriptions_table', 2),
	(22, '2025_04_11_084451_create_tenants_table', 2),
	(23, '2025_04_14_081047_create_branches_table', 3),
	(24, '2025_04_14_081110_create_subscription_histories_table', 4),
	(25, '2025_04_14_081216_create_customers_table', 4),
	(26, '2025_04_14_081316_create_service_categories_table', 4),
	(28, '2025_04_14_081321_create_services_table', 5),
	(29, '2025_04_17_142904_create_transactions_table', 6),
	(30, '2025_04_17_142910_create_transaction_details_table', 6),
	(31, '2025_04_17_150552_add_column_user', 7);

-- Dumping structure for table laundry-saas.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table laundry-saas.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `prefix` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  KEY `permissions_menu_id_foreign` (`menu_id`),
  CONSTRAINT `permissions_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.permissions: ~58 rows (approximately)
DELETE FROM `permissions`;
INSERT INTO `permissions` (`id`, `menu_id`, `prefix`, `name`, `created_at`, `updated_at`) VALUES
	(1, 1, 'setting', 'module-setting-show', NULL, NULL),
	(2, 2, 'setup-website', 'module-setup-website-show', NULL, NULL),
	(3, 3, 'menu', 'module-menu-show', NULL, NULL),
	(4, 3, 'menu', 'module-menu-read', NULL, NULL),
	(5, 3, 'menu', 'module-menu-create', NULL, NULL),
	(6, 3, 'menu', 'module-menu-update', NULL, NULL),
	(7, 3, 'menu', 'module-menu-delete', NULL, NULL),
	(8, 4, 'user', 'module-user-show', NULL, NULL),
	(9, 4, 'user', 'module-user-read', NULL, NULL),
	(10, 4, 'user', 'module-user-create', NULL, NULL),
	(11, 4, 'user', 'module-user-update', NULL, NULL),
	(12, 4, 'user', 'module-user-delete', NULL, NULL),
	(13, 5, 'role', 'module-role-show', NULL, NULL),
	(14, 5, 'role', 'module-role-read', NULL, NULL),
	(15, 5, 'role', 'module-role-create', NULL, NULL),
	(16, 5, 'role', 'module-role-update', NULL, NULL),
	(17, 5, 'role', 'module-role-delete', NULL, NULL),
	(18, 5, 'role', 'module-role-access', NULL, NULL),
	(19, 6, 'sorting-menu', 'module-sorting-menu-show', NULL, NULL),
	(20, 6, 'sorting-menu', 'module-sorting-menu-read', NULL, NULL),
	(21, 6, 'sorting-menu', 'module-sorting-menu-update', NULL, NULL),
	(22, 7, 'website', 'module-website-show', NULL, NULL),
	(23, 7, 'website', 'module-website-read', NULL, NULL),
	(24, 7, 'website', 'module-website-update', NULL, NULL),
	(25, 8, 'permission', 'module-permission-show', NULL, NULL),
	(26, 8, 'permission', 'module-permission-read', NULL, NULL),
	(27, 8, 'permission', 'module-permission-create', NULL, NULL),
	(28, 8, 'permission', 'module-permission-update', NULL, NULL),
	(29, 8, 'permission', 'module-permission-delete', NULL, NULL),
	(30, 9, 'dashboard', 'module-dashboard-show', NULL, NULL),
	(31, 10, 'activity-user', 'module-activity-user-show', NULL, NULL),
	(32, 10, 'activity-user', 'module-activity-user-read', NULL, NULL),
	(115, 24, 'subscription', 'module-subscription-show', NULL, NULL),
	(116, 24, 'subscription', 'module-subscription-read', NULL, NULL),
	(117, 24, 'subscription', 'module-subscription-create', NULL, NULL),
	(118, 24, 'subscription', 'module-subscription-update', NULL, NULL),
	(119, 24, 'subscription', 'module-subscription-delete', NULL, NULL),
	(120, 24, 'subscription', 'module-subscription-detail', NULL, NULL),
	(121, 25, 'data-master', 'module-data-master-show', NULL, NULL),
	(122, 26, 'tenant', 'module-tenant-show', NULL, NULL),
	(123, 26, 'tenant', 'module-tenant-read', NULL, NULL),
	(124, 26, 'tenant', 'module-tenant-create', NULL, NULL),
	(125, 26, 'tenant', 'module-tenant-update', NULL, NULL),
	(126, 26, 'tenant', 'module-tenant-delete', NULL, NULL),
	(127, 26, 'tenant', 'module-tenant-detail', NULL, NULL),
	(128, 27, 'branch', 'module-branch-show', NULL, NULL),
	(129, 27, 'branch', 'module-branch-read', NULL, NULL),
	(130, 27, 'branch', 'module-branch-create', NULL, NULL),
	(131, 27, 'branch', 'module-branch-update', NULL, NULL),
	(132, 27, 'branch', 'module-branch-delete', NULL, NULL),
	(133, 27, 'branch', 'module-branch-detail', NULL, NULL),
	(134, 28, 'master-data', 'module-master-data-show', NULL, NULL),
	(141, 30, 'branch', 'module-branch-tenant-show', NULL, NULL),
	(147, 31, 'dashboard', 'module-dashboard-tenant-show', NULL, NULL),
	(148, 32, 'setup', 'module-setup-tenant-show', NULL, NULL),
	(149, 33, 'business-profile', 'module-business-profile-tenant-show', NULL, NULL),
	(150, 33, 'business-profile', 'module-business-profile-tenant-read', NULL, NULL),
	(151, 33, 'business-profile', 'module-business-profile-tenant-update', NULL, NULL),
	(152, 34, 'user-account', 'module-user-account-tenant-show', NULL, NULL),
	(153, 34, 'user-account', 'module-user-account-tenant-read', NULL, NULL),
	(154, 34, 'user-account', 'module-user-account-tenant-create', NULL, NULL),
	(155, 34, 'user-account', 'module-user-account-tenant-update', NULL, NULL),
	(156, 34, 'user-account', 'module-user-account-tenant-delete', NULL, NULL),
	(157, 34, 'user-account', 'module-user-account-tenant-detail', NULL, NULL),
	(158, 35, 'tax-discount', 'module-tax-discount-tenant-show', NULL, NULL),
	(159, 35, 'tax-discount', 'module-tax-discount-tenant-read', NULL, NULL),
	(160, 35, 'tax-discount', 'module-tax-discount-tenant-create', NULL, NULL),
	(161, 35, 'tax-discount', 'module-tax-discount-tenant-update', NULL, NULL),
	(162, 35, 'tax-discount', 'module-tax-discount-tenant-delete', NULL, NULL),
	(163, 36, 'branch-list', 'module-branch-list-tenant-show', NULL, NULL),
	(164, 36, 'branch-list', 'module-branch-list-tenant-read', NULL, NULL),
	(165, 36, 'branch-list', 'module-branch-list-tenant-create', NULL, NULL),
	(166, 36, 'branch-list', 'module-branch-list-tenant-update', NULL, NULL),
	(167, 36, 'branch-list', 'module-branch-list-tenant-delete', NULL, NULL),
	(168, 36, 'branch-list', 'module-branch-list-tenant-detail', NULL, NULL),
	(169, 37, 'branch-performance', 'module-branch-performance-tenant-show', NULL, NULL),
	(170, 37, 'branch-performance', 'module-branch-performance-tenant-read', NULL, NULL),
	(171, 37, 'branch-performance', 'module-branch-performance-tenant-export', NULL, NULL),
	(172, 38, 'laundry-service', 'module-laundry-service-tenant-show', NULL, NULL),
	(173, 39, 'service-list', 'module-service-list-tenant-show', NULL, NULL),
	(174, 39, 'service-list', 'module-service-list-tenant-read', NULL, NULL),
	(175, 39, 'service-list', 'module-service-list-tenant-create', NULL, NULL),
	(176, 39, 'service-list', 'module-service-list-tenant-update', NULL, NULL),
	(177, 39, 'service-list', 'module-service-list-tenant-delete', NULL, NULL),
	(178, 40, 'service-categories', 'module-service-categories-tenant-show', NULL, NULL),
	(179, 40, 'service-categories', 'module-service-categories-tenant-read', NULL, NULL),
	(180, 40, 'service-categories', 'module-service-categories-tenant-create', NULL, NULL),
	(181, 40, 'service-categories', 'module-service-categories-tenant-update', NULL, NULL),
	(182, 40, 'service-categories', 'module-service-categories-tenant-delete', NULL, NULL),
	(183, 40, 'service-categories', 'module-service-categories-tenant-detail', NULL, NULL),
	(184, 41, 'subscription-history', 'module-subscription-history-show', NULL, NULL),
	(185, 41, 'subscription-history', 'module-subscription-history-read', NULL, NULL),
	(186, 41, 'subscription-history', 'module-subscription-history-create', NULL, NULL),
	(187, 41, 'subscription-history', 'module-subscription-history-update', NULL, NULL),
	(188, 41, 'subscription-history', 'module-subscription-history-delete', NULL, NULL),
	(189, 41, 'subscription-history', 'module-subscription-history-detail', NULL, NULL),
	(190, 42, 'customer', 'module-customer-tenant-show', NULL, NULL),
	(191, 42, 'customer', 'module-customer-tenant-read', NULL, NULL),
	(192, 42, 'customer', 'module-customer-tenant-create', NULL, NULL),
	(193, 42, 'customer', 'module-customer-tenant-update', NULL, NULL),
	(194, 42, 'customer', 'module-customer-tenant-delete', NULL, NULL),
	(195, 42, 'customer', 'module-customer-tenant-detail', NULL, NULL);

-- Dumping structure for table laundry-saas.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table laundry-saas.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.roles: ~4 rows (approximately)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Administrator', 'Role for full access', 'Active', NULL, NULL, NULL),
	(2, 'Super Admin', 'Super Admin', 'Active', '2023-10-26 03:22:01', '2025-02-17 02:54:39', NULL),
	(3, 'Supervisor', 'Supervisor', 'Active', '2025-02-17 02:54:48', '2025-02-17 02:54:48', NULL),
	(4, 'Staff', 'Staff', 'Active', '2025-02-17 03:05:31', '2025-02-17 03:05:31', NULL);

-- Dumping structure for table laundry-saas.role_permissions
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_permissions_role_id_foreign` (`role_id`),
  KEY `role_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.role_permissions: ~0 rows (approximately)
DELETE FROM `role_permissions`;

-- Dumping structure for table laundry-saas.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `branch_id` bigint unsigned NOT NULL,
  `service_category_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_tenant_id_foreign` (`tenant_id`),
  KEY `services_branch_id_foreign` (`branch_id`),
  KEY `services_service_category_id_foreign` (`service_category_id`),
  CONSTRAINT `services_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `services_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`),
  CONSTRAINT `services_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.services: ~1 rows (approximately)
DELETE FROM `services`;
INSERT INTO `services` (`id`, `tenant_id`, `branch_id`, `service_category_id`, `code`, `name`, `price`, `unit`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 1, 'CG001', 'Baju Kiloan', 8000.00, 'Kg', 1, '2025-04-17 06:15:56', '2025-04-17 06:15:56', NULL);

-- Dumping structure for table laundry-saas.service_categories
CREATE TABLE IF NOT EXISTS `service_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `branch_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_categories_tenant_id_foreign` (`tenant_id`),
  KEY `service_categories_branch_id_foreign` (`branch_id`),
  CONSTRAINT `service_categories_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `service_categories_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.service_categories: ~1 rows (approximately)
DELETE FROM `service_categories`;
INSERT INTO `service_categories` (`id`, `tenant_id`, `branch_id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Cuci & Gosok', 1, '2025-04-17 06:02:40', '2025-04-17 06:04:18');

-- Dumping structure for table laundry-saas.subscriptions
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `branch_limit` int NOT NULL,
  `user_limit` int NOT NULL,
  `features` text COLLATE utf8mb4_unicode_ci,
  `duration_in_days` int NOT NULL DEFAULT '30',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscriptions_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.subscriptions: ~0 rows (approximately)
DELETE FROM `subscriptions`;
INSERT INTO `subscriptions` (`id`, `code`, `name`, `price`, `branch_limit`, `user_limit`, `features`, `duration_in_days`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '67f8b3b4a3ae6', 'Package 1', 1500000.00, 1, 5, '- Cabang : 1\r\n- User : 5', 30, 'inactive', '2025-04-11 06:16:20', '2025-04-11 06:40:21', NULL);

-- Dumping structure for table laundry-saas.subscription_histories
CREATE TABLE IF NOT EXISTS `subscription_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `subscription_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('active','expired','cancelled','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscription_histories_tenant_id_foreign` (`tenant_id`),
  KEY `subscription_histories_subscription_id_foreign` (`subscription_id`),
  CONSTRAINT `subscription_histories_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`),
  CONSTRAINT `subscription_histories_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.subscription_histories: ~0 rows (approximately)
DELETE FROM `subscription_histories`;
INSERT INTO `subscription_histories` (`id`, `tenant_id`, `subscription_id`, `code`, `start_date`, `end_date`, `price`, `status`, `payment_method`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 'SUB-6800A3BE0EE86', '2025-04-17', '2025-05-17', 1500000.00, 'active', 'Virtual Account', 'Confirmed', '2025-04-17 06:47:21', '2025-04-17 06:56:45', NULL);

-- Dumping structure for table laundry-saas.tenants
CREATE TABLE IF NOT EXISTS `tenants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tenants_code_unique` (`code`),
  UNIQUE KEY `tenants_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.tenants: ~2 rows (approximately)
DELETE FROM `tenants`;
INSERT INTO `tenants` (`id`, `code`, `name`, `email`, `phone`, `address`, `logo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '67f8bc9c12d40', 'Kulit Jeruk', 'kj@gmail.com', '9021382193', 'Adresss Main', 'uploads/tenant/1744681729_logo_pngtree-blue-washing-machine-for-laundry-logo-png-image_6114594.png', 'active', '2025-04-11 06:54:20', '2025-04-15 01:48:49', NULL),
	(2, '67f8bd5970593', 'Biji Jeruk', 'bj@gmail.com', '281938724', 'shdjfdjdshf', 'uploads/tenant/1744354649_logo_Hari Air Sedunia 2025.png', 'active', '2025-04-11 06:57:29', '2025-04-11 06:57:29', NULL);

-- Dumping structure for table laundry-saas.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `branch_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `pickup_date` date DEFAULT NULL,
  `status` enum('pending','process','done','picked_up') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL,
  `paid` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_invoice_number_unique` (`invoice_number`),
  KEY `transactions_tenant_id_foreign` (`tenant_id`),
  KEY `transactions_branch_id_foreign` (`branch_id`),
  KEY `transactions_customer_id_foreign` (`customer_id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `transactions_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `transactions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `transactions_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`),
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.transactions: ~0 rows (approximately)
DELETE FROM `transactions`;

-- Dumping structure for table laundry-saas.transaction_details
CREATE TABLE IF NOT EXISTS `transaction_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint unsigned NOT NULL,
  `service_id` bigint unsigned NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_details_transaction_id_foreign` (`transaction_id`),
  KEY `transaction_details_service_id_foreign` (`service_id`),
  CONSTRAINT `transaction_details_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.transaction_details: ~0 rows (approximately)
DELETE FROM `transaction_details`;

-- Dumping structure for table laundry-saas.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_role` bigint unsigned DEFAULT NULL,
  `theme_version` enum('light','dark') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'light',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tenant_id` bigint unsigned DEFAULT NULL,
  `branch_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  KEY `users_default_role_foreign` (`default_role`),
  KEY `users_tenant_id_foreign` (`tenant_id`),
  KEY `users_branch_id_foreign` (`branch_id`),
  CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `users_default_role_foreign` FOREIGN KEY (`default_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.users: ~0 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `phone`, `email_verified_at`, `password`, `status`, `image`, `remember_token`, `default_role`, `theme_version`, `created_at`, `updated_at`, `deleted_at`, `tenant_id`, `branch_id`) VALUES
	(1, 'Luthfi Ihdalhusnayain', 'luthfiihdal98', 'luthfi.ihdalhusnayain98@gmail.com', '0895322316585', NULL, '$2y$10$pgo/fd9zQIzaJXw6r56Zv.Vb72N3oAn070WLfpAibR3ssdtYsP0EC', 'Active', 'uploads/profile/1739432049_hgn-2025.jpg', NULL, 1, 'dark', '2023-10-25 03:11:48', '2025-04-11 07:04:22', NULL, NULL, NULL);

-- Dumping structure for table laundry-saas.user_roles
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `status` enum('Active','InActive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_roles_user_id_foreign` (`user_id`),
  KEY `user_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laundry-saas.user_roles: ~0 rows (approximately)
DELETE FROM `user_roles`;
INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 1, 1, 'Active', '2025-02-12 09:48:39', '2025-02-12 09:48:39', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
