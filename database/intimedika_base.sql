/*
 Navicat Premium Data Transfer

 Source Server         : development
 Source Server Type    : MySQL
 Source Server Version : 50649 (5.6.49-log)
 Source Host           : localhost:3306
 Source Schema         : intimedika_base_production

 Target Server Type    : MySQL
 Target Server Version : 50649 (5.6.49-log)
 File Encoding         : 65001

 Date: 08/05/2023 10:38:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for active_notification_unread
-- ----------------------------
DROP TABLE IF EXISTS `active_notification_unread`;
CREATE TABLE `active_notification_unread`  (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of active_notification_unread
-- ----------------------------
INSERT INTO `active_notification_unread` VALUES (1, 0, '2022-12-26 07:46:45', '2022-12-26 07:46:45');

-- ----------------------------
-- Table structure for active_update_simrs
-- ----------------------------
DROP TABLE IF EXISTS `active_update_simrs`;
CREATE TABLE `active_update_simrs`  (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of active_update_simrs
-- ----------------------------
INSERT INTO `active_update_simrs` VALUES (1, 1, '2022-12-28 15:08:47', '2022-12-28 15:08:47');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for kop_surat
-- ----------------------------
DROP TABLE IF EXISTS `kop_surat`;
CREATE TABLE `kop_surat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_image` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kop_surat
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (4, '2022_08_31_132301_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2022_09_12_101504_create_notification_unread_table', 1);

-- ----------------------------
-- Table structure for notification_unread
-- ----------------------------
DROP TABLE IF EXISTS `notification_unread`;
CREATE TABLE `notification_unread`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of notification_unread
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
INSERT INTO `personal_access_tokens` VALUES (1, 'App\\User', 1, 'andikautama034@gmail.com', 'e4be60b9f1a58ceb7abdf8112aa4bc06a709eabdc59e5a94a5015d655d9d9d8b', '[\"*\"]', '2023-03-21 09:55:06', '2022-10-17 09:52:24', '2023-03-21 09:55:06');
INSERT INTO `personal_access_tokens` VALUES (2, 'App\\User', 2, 'kutamz@gmail.com', '3a6aa94fa33e095a1cc53503fcadc52b7ecb6b774d0cab809a4ec3694ebd15ed', '[\"*\"]', '2023-04-04 09:54:56', '2022-12-08 10:22:48', '2023-04-04 09:54:56');

-- ----------------------------
-- Table structure for rename_link
-- ----------------------------
DROP TABLE IF EXISTS `rename_link`;
CREATE TABLE `rename_link`  (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `link_simrs_dicom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `link_simrs_expertise` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of rename_link
-- ----------------------------
INSERT INTO `rename_link` VALUES (1, 'intiwid', 'intiwid-base', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'andika utama', 'andika', 'andikautama034@gmail.com', NULL, '$2y$10$hYyszbnB.Dy.ZGuCKrS.uOB3t2ZsS4YIk18ejQTsZUtdl6ENfaaty', NULL, '2022-10-17 09:52:20', '2022-10-17 09:52:20');
INSERT INTO `users` VALUES (2, 'andika utama', 'kutamz', 'kutamz@gmail.com', NULL, '$2y$10$erZfBA9nbIZbQx7G3Jksh.Ex3Edbv.yhVwY3xejE0ooeRRSSGrVai', NULL, '2022-12-08 10:22:33', '2022-12-08 10:22:33');

-- ----------------------------
-- Table structure for xray_admin
-- ----------------------------
DROP TABLE IF EXISTS `xray_admin`;
CREATE TABLE `xray_admin`  (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ad_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_admin
-- ----------------------------

-- ----------------------------
-- Table structure for xray_chat_message
-- ----------------------------
DROP TABLE IF EXISTS `xray_chat_message`;
CREATE TABLE `xray_chat_message`  (
  `chat_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_username` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `from_username` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `chat_message` longtext CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`chat_message_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_chat_message
-- ----------------------------

-- ----------------------------
-- Table structure for xray_complaint
-- ----------------------------
DROP TABLE IF EXISTS `xray_complaint`;
CREATE TABLE `xray_complaint`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_date` date NULL DEFAULT NULL,
  `complaint_time` time NULL DEFAULT NULL,
  `person_call` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `problem` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `solve_date` date NULL DEFAULT NULL,
  `solve_time` time NULL DEFAULT NULL,
  `explanation` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `solve_date_to` date NULL DEFAULT NULL,
  `solve_time_to` time NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_complaint
-- ----------------------------

-- ----------------------------
-- Table structure for xray_contract
-- ----------------------------
DROP TABLE IF EXISTS `xray_contract`;
CREATE TABLE `xray_contract`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_contract` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contract_date` datetime NULL DEFAULT NULL,
  `contract_duedate` datetime NULL DEFAULT NULL,
  `contract_update` datetime NULL DEFAULT NULL,
  `contract_sign_by` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_contract
-- ----------------------------

-- ----------------------------
-- Table structure for xray_department
-- ----------------------------
DROP TABLE IF EXISTS `xray_department`;
CREATE TABLE `xray_department`  (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `dep_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `name_dep` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk`, `dep_id`) USING BTREE,
  INDEX `dep_id`(`dep_id`) USING BTREE,
  INDEX `name_dep`(`name_dep`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_department
-- ----------------------------

-- ----------------------------
-- Table structure for xray_dokter
-- ----------------------------
DROP TABLE IF EXISTS `xray_dokter`;
CREATE TABLE `xray_dokter`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dokterid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `named` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lastnamed` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sexd` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `telp` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `idtele` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `dokterid`(`dokterid`) USING BTREE,
  INDEX `named`(`named`) USING BTREE,
  INDEX `lastnamed`(`lastnamed`) USING BTREE,
  INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_dokter
-- ----------------------------

-- ----------------------------
-- Table structure for xray_dokter_radiology
-- ----------------------------
DROP TABLE IF EXISTS `xray_dokter_radiology`;
CREATE TABLE `xray_dokter_radiology`  (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `dokradid` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dokrad_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokrad_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nip` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokrad_sex` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokrad_tlp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokrad_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokrad_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `otp` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `idtele` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk`, `username`) USING BTREE,
  INDEX `dokradid`(`dokradid`) USING BTREE,
  INDEX `dokrad_name`(`dokrad_name`) USING BTREE,
  INDEX `dokrad_lastname`(`dokrad_lastname`) USING BTREE,
  INDEX `nip`(`nip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_dokter_radiology
-- ----------------------------

-- ----------------------------
-- Table structure for xray_hostname_publik
-- ----------------------------
DROP TABLE IF EXISTS `xray_hostname_publik`;
CREATE TABLE `xray_hostname_publik`  (
  `pk` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip_publik` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_hostname_publik
-- ----------------------------

-- ----------------------------
-- Table structure for xray_login
-- ----------------------------
DROP TABLE IF EXISTS `xray_login`;
CREATE TABLE `xray_login`  (
  `id_table` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` datetime NULL DEFAULT NULL,
  `password_contract` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_table`, `username`) USING BTREE,
  INDEX `username`(`username`) USING BTREE,
  INDEX `password`(`password`) USING BTREE,
  INDEX `level`(`level`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_login
-- ----------------------------

-- ----------------------------
-- Table structure for xray_maintenance
-- ----------------------------
DROP TABLE IF EXISTS `xray_maintenance`;
CREATE TABLE `xray_maintenance`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `maintenance_date` datetime NULL DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `do_maintenance_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_maintenance
-- ----------------------------

-- ----------------------------
-- Table structure for xray_modalitas
-- ----------------------------
DROP TABLE IF EXISTS `xray_modalitas`;
CREATE TABLE `xray_modalitas`  (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `id_modality` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `xray_type_code` varchar(101) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pk`, `id_modality`) USING BTREE,
  UNIQUE INDEX `xray_type_code`(`xray_type_code`) USING BTREE,
  INDEX `id_modality`(`id_modality`) USING BTREE,
  INDEX `xray_type_code_normal`(`xray_type_code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_modalitas
-- ----------------------------

-- ----------------------------
-- Table structure for xray_order
-- ----------------------------
DROP TABLE IF EXISTS `xray_order`;
CREATE TABLE `xray_order`  (
  `pk` bigint(255) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `acc` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `patientid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `mrn` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sex` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `birth_date` date NULL DEFAULT NULL,
  `weight` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dep_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name_dep` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_modality` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `xray_type_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_prosedur` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `prosedur` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `harga_prosedur` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokterid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `named` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lastnamed` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `radiographer_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `radiographer_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `radiographer_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokradid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokrad_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokrad_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime NULL DEFAULT NULL,
  `schedule_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `schedule_time` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contrast` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `priority` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pat_state` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contrast_allergies` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `spc_needs` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_payment` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `payment` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fromorder` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `examed_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  UNIQUE INDEX `uid`(`uid`) USING BTREE,
  INDEX `uid_normal`(`uid`) USING BTREE,
  INDEX `acc`(`acc`) USING BTREE,
  INDEX `patientid`(`patientid`) USING BTREE,
  INDEX `mrn`(`mrn`) USING BTREE,
  INDEX `name`(`name`) USING BTREE,
  INDEX `address`(`address`) USING BTREE,
  INDEX `sex`(`sex`) USING BTREE,
  INDEX `birth_date`(`birth_date`) USING BTREE,
  INDEX `weight`(`weight`) USING BTREE,
  INDEX `dep_id`(`dep_id`) USING BTREE,
  INDEX `name_dep`(`name_dep`) USING BTREE,
  INDEX `id_modality`(`id_modality`) USING BTREE,
  INDEX `xray_type_code`(`xray_type_code`) USING BTREE,
  INDEX `id_prosedur`(`id_prosedur`) USING BTREE,
  INDEX `prosedur`(`prosedur`) USING BTREE,
  INDEX `harga_prosedur`(`harga_prosedur`) USING BTREE,
  INDEX `dokterid`(`dokterid`) USING BTREE,
  INDEX `named`(`named`) USING BTREE,
  INDEX `lastnamed`(`lastnamed`) USING BTREE,
  INDEX `email`(`email`) USING BTREE,
  INDEX `radiographer_id`(`radiographer_id`) USING BTREE,
  INDEX `radiographer_name`(`radiographer_name`) USING BTREE,
  INDEX `dokradid`(`dokradid`) USING BTREE,
  INDEX `dokrad_name`(`dokrad_name`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE,
  INDEX `schedule_date`(`schedule_date`) USING BTREE,
  INDEX `schedule_time`(`schedule_time`) USING BTREE,
  INDEX `contrast`(`contrast`) USING BTREE,
  INDEX `priority`(`priority`) USING BTREE,
  INDEX `pat_state`(`pat_state`) USING BTREE,
  INDEX `contrast_allergies`(`contrast_allergies`) USING BTREE,
  INDEX `spc_needs`(`spc_needs`) USING BTREE,
  INDEX `id_payment`(`id_payment`) USING BTREE,
  INDEX `payment`(`payment`) USING BTREE,
  INDEX `fromorder`(`fromorder`) USING BTREE,
  INDEX `examed_at`(`examed_at`) USING BTREE,
  INDEX `deleted_at`(`deleted_at`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_order
-- ----------------------------

-- ----------------------------
-- Table structure for xray_patient
-- ----------------------------
DROP TABLE IF EXISTS `xray_patient`;
CREATE TABLE `xray_patient`  (
  `pk` int(10) NOT NULL AUTO_INCREMENT,
  `patientid` int(10) NULL DEFAULT NULL,
  `mrn` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sex` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `birth_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `weight` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `note` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`, `mrn`) USING BTREE,
  UNIQUE INDEX `index_mrn`(`mrn`) USING BTREE,
  INDEX `patientid`(`patientid`) USING BTREE,
  INDEX `mrn`(`mrn`) USING BTREE,
  INDEX `name`(`name`) USING BTREE,
  INDEX `lastname`(`lastname`) USING BTREE,
  INDEX `sex`(`sex`) USING BTREE,
  INDEX `birth_date`(`birth_date`) USING BTREE,
  INDEX `weight`(`weight`) USING BTREE,
  INDEX `address`(`address`) USING BTREE,
  INDEX `phone`(`phone`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_patient
-- ----------------------------

-- ----------------------------
-- Table structure for xray_payment_insurance
-- ----------------------------
DROP TABLE IF EXISTS `xray_payment_insurance`;
CREATE TABLE `xray_payment_insurance`  (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `id_payment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`, `id_payment`) USING BTREE,
  INDEX `id_payment`(`id_payment`) USING BTREE,
  INDEX `payment`(`payment`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_payment_insurance
-- ----------------------------

-- ----------------------------
-- Table structure for xray_radiographer
-- ----------------------------
DROP TABLE IF EXISTS `xray_radiographer`;
CREATE TABLE `xray_radiographer`  (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `radiographer_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `radiographer_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `radiographer_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `radiographer_sex` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `radiographer_tlp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `radiographer_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  INDEX `radiographer_id`(`radiographer_id`) USING BTREE,
  INDEX `radiographer_name`(`radiographer_name`) USING BTREE,
  INDEX `radiographer_lastname`(`radiographer_lastname`) USING BTREE,
  INDEX `radiographer_sex`(`radiographer_sex`) USING BTREE,
  INDEX `radiographer_tlp`(`radiographer_tlp`) USING BTREE,
  INDEX `radiographer_email`(`radiographer_email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_radiographer
-- ----------------------------

-- ----------------------------
-- Table structure for xray_recyclebin
-- ----------------------------
DROP TABLE IF EXISTS `xray_recyclebin`;
CREATE TABLE `xray_recyclebin`  (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `acc` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `patientid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mrn` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sex` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `birth_date` varchar(19) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `weight` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `depid` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name_dep` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `xray_type_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `typename` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `prosedur` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokterid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `named` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lastnamed` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `radiographer_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `radiographer_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `radiographer_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokradid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokrad_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dokrad_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime NULL DEFAULT NULL,
  `schedule_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `schedule_time` time NULL DEFAULT NULL,
  `contrast` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `priority` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pat_state` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contrast_allergies` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `spc_needs` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `payment` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `arrive_date` date NULL DEFAULT NULL,
  `arrive_time` time NULL DEFAULT NULL,
  `complete_date` date NULL DEFAULT NULL,
  `complete_time` time NULL DEFAULT NULL,
  `approve_date` date NULL DEFAULT NULL,
  `approve_time` time NULL DEFAULT NULL,
  `fill` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `study_datetime` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_time` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `num_instances` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `num_series` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `series_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `src_aet` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `del` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  UNIQUE INDEX `uid`(`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_recyclebin
-- ----------------------------

-- ----------------------------
-- Table structure for xray_selected_dokter_radiology
-- ----------------------------
DROP TABLE IF EXISTS `xray_selected_dokter_radiology`;
CREATE TABLE `xray_selected_dokter_radiology`  (
  `pk` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` smallint(6) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_selected_dokter_radiology
-- ----------------------------

-- ----------------------------
-- Table structure for xray_study
-- ----------------------------
DROP TABLE IF EXISTS `xray_study`;
CREATE TABLE `xray_study`  (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `id_modality` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_study` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `study` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `harga` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  INDEX `id_modality`(`id_modality`) USING BTREE,
  INDEX `id_study`(`id_study`) USING BTREE,
  INDEX `study`(`study`) USING BTREE,
  INDEX `harga`(`harga`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_study
-- ----------------------------

-- ----------------------------
-- Table structure for xray_take_envelope
-- ----------------------------
DROP TABLE IF EXISTS `xray_take_envelope`;
CREATE TABLE `xray_take_envelope`  (
  `pk` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_taken` smallint(6) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`, `uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_take_envelope
-- ----------------------------

-- ----------------------------
-- Table structure for xray_template
-- ----------------------------
DROP TABLE IF EXISTS `xray_template`;
CREATE TABLE `xray_template`  (
  `template_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fill` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`template_id`) USING BTREE,
  INDEX `template_id`(`template_id`) USING BTREE,
  INDEX `title`(`title`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_template
-- ----------------------------

-- ----------------------------
-- Table structure for xray_upload_excel
-- ----------------------------
DROP TABLE IF EXISTS `xray_upload_excel`;
CREATE TABLE `xray_upload_excel`  (
  `id` int(19) NOT NULL,
  `tanggal_upload` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tipe_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ukuran_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_upload_excel
-- ----------------------------

-- ----------------------------
-- Table structure for xray_upload_pdf
-- ----------------------------
DROP TABLE IF EXISTS `xray_upload_pdf`;
CREATE TABLE `xray_upload_pdf`  (
  `id` int(19) NOT NULL,
  `contract_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tanggal_upload` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tipe_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ukuran_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_upload_pdf
-- ----------------------------

-- ----------------------------
-- Table structure for xray_workload
-- ----------------------------
DROP TABLE IF EXISTS `xray_workload`;
CREATE TABLE `xray_workload`  (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `accession_no` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fill` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `approved_at` datetime NULL DEFAULT NULL,
  `approve_updated_at` datetime NULL DEFAULT NULL,
  `pk_dokter_radiology` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `study_datetime_pacsio` datetime NULL DEFAULT NULL,
  `updated_time_pacsio` datetime NULL DEFAULT NULL,
  `study_desc_pacsio` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `priority_doctor` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `signature` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `signature_datetime` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE,
  INDEX `accession_no`(`accession_no`) USING BTREE,
  INDEX `status`(`status`) USING BTREE,
  INDEX `approved_at`(`approved_at`) USING BTREE,
  INDEX `approve_updated_at`(`approve_updated_at`) USING BTREE,
  INDEX `pk_dokter_radiology`(`pk_dokter_radiology`) USING BTREE,
  INDEX `study_datetime_pacsio`(`study_datetime_pacsio`) USING BTREE,
  INDEX `updated_time_pacsio`(`updated_time_pacsio`) USING BTREE,
  INDEX `study_desc_pacsio`(`study_desc_pacsio`) USING BTREE,
  INDEX `priority_doctor`(`priority_doctor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_workload
-- ----------------------------

-- ----------------------------
-- Table structure for xray_workload_bhp
-- ----------------------------
DROP TABLE IF EXISTS `xray_workload_bhp`;
CREATE TABLE `xray_workload_bhp`  (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `acc` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `film_small` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `film_medium` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `film_large` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `film_reject_small` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `film_reject_medium` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `film_reject_large` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `re_photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kv` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mas` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pk`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE,
  INDEX `acc`(`acc`) USING BTREE,
  INDEX `film_small`(`film_small`) USING BTREE,
  INDEX `film_medium`(`film_medium`) USING BTREE,
  INDEX `film_large`(`film_large`) USING BTREE,
  INDEX `film_reject_small`(`film_reject_small`) USING BTREE,
  INDEX `film_reject_medium`(`film_reject_medium`) USING BTREE,
  INDEX `film_reject_large`(`film_reject_large`) USING BTREE,
  INDEX `re_photo`(`re_photo`) USING BTREE,
  INDEX `kv`(`kv`) USING BTREE,
  INDEX `mas`(`mas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of xray_workload_bhp
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
