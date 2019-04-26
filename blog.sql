/*
 Navicat Premium Data Transfer

 Source Server         : laravel16.zent
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : blog

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 25/04/2019 20:18:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `parent_id` tinyint(4) NULL DEFAULT NULL COMMENT 'chứa id category parent',
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `categories_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (3, 'HOME', 0, 'home', NULL, '2019-03-17 12:05:15', '2019-03-17 12:11:40');
INSERT INTO `categories` VALUES (4, 'FEATURE', 0, 'feature', NULL, '2019-03-17 12:12:01', '2019-03-17 12:12:01');
INSERT INTO `categories` VALUES (5, 'BLOG', 0, 'blog', NULL, '2019-03-17 12:12:11', '2019-03-17 12:12:11');
INSERT INTO `categories` VALUES (6, 'ABOUT US', 0, 'about-us', NULL, '2019-03-17 12:12:26', '2019-03-17 12:12:26');
INSERT INTO `categories` VALUES (7, 'CONTRACT', 0, 'contract', NULL, '2019-03-17 12:12:37', '2019-03-17 12:12:37');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (7, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (8, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (9, '2019_03_04_134207_create_posts_table', 1);
INSERT INTO `migrations` VALUES (11, '2019_03_04_134334_create_tags_table', 1);
INSERT INTO `migrations` VALUES (13, '2019_03_15_123751_add_user_name_to_users_table', 2);
INSERT INTO `migrations` VALUES (14, '2019_03_04_134320_create_categories_table', 3);
INSERT INTO `migrations` VALUES (15, '2019_03_04_134346_create_post_tags_table', 4);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('phong147x@gmail.com', '$2y$10$G9qL6Fa.QDijiyTmtAjQv.rcfdPc3U0u070prXNuL/YzLO2bd.Ycm', '2019-03-15 12:49:49');

-- ----------------------------
-- Table structure for post_tags
-- ----------------------------
DROP TABLE IF EXISTS `post_tags`;
CREATE TABLE `post_tags`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `post_tags_post_id_foreign`(`post_id`) USING BTREE,
  INDEX `post_tags_tag_id_foreign`(`tag_id`) USING BTREE,
  CONSTRAINT `post_tags_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `post_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `posts_slug_unique`(`slug`) USING BTREE,
  INDEX `posts_title_index`(`title`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES (24, 'aaa222', '94Xm_image-slider-5.jpg', 'aaaa222', 'aaa222', 'aaa222', 4, 7, 0, '2019-03-17 08:08:31', '2019-03-22 04:27:38');
INSERT INTO `posts` VALUES (25, 'bbb', 'Cx0I_img-gallery-1.jpg', 'bbb', 'bbb', 'bbb', 4, 5, 0, '2019-03-17 08:08:44', '2019-03-22 11:10:29');
INSERT INTO `posts` VALUES (26, 'ccc', '0cgx_img-post-7.jpg', 'ccc', 'ccc', 'ccc', 4, 3, 0, '2019-03-17 08:09:19', '2019-03-22 11:11:09');
INSERT INTO `posts` VALUES (27, 'dsaasd', 'VYov_image-slider-5.jpg', 'sdas', 'gdgsgs', 'dsaasd', 4, 7, 0, '2019-03-22 02:39:32', '2019-03-22 02:39:32');
INSERT INTO `posts` VALUES (29, 'ffff', 'sE9T_img-author.jpg', 'fff', 'ffff', 'ffff', 4, 4, 0, '2019-03-22 02:59:06', '2019-03-22 02:59:06');
INSERT INTO `posts` VALUES (31, 'aaaa', 'pL9f_img-author.jpg', 'aaaa', 'aaaa', 'aaaa', 4, 7, 0, '2019-03-22 04:15:13', '2019-03-22 04:15:13');
INSERT INTO `posts` VALUES (32, 'aaa', 'RxBg_about-me.jpg', 'aaa', 'aaaa', 'aa', 4, 7, 0, '2019-03-22 04:18:39', '2019-03-22 04:18:39');
INSERT INTO `posts` VALUES (33, 'fjsaifjiajsfas', '6Sj4_img-author.jpg', 'aaa', 'aaa', 'fjsaifjiajsfas', 5, 3, 0, '2019-03-22 12:37:46', '2019-03-22 12:38:46');

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tags_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES (2, 'cc', 'ccc', '2019-03-17 06:28:08', '2019-03-17 06:28:08');
INSERT INTO `tags` VALUES (3, 'ddd', 'ddd', '2019-03-17 06:28:42', '2019-03-17 06:28:42');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT 0,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  UNIQUE INDEX `users_user_name_unique`(`user_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (4, 'Nguyễn Hữu Phong', 'phong147x@gmail.com', 0, '$2y$10$1mBXG8sWdyo4zIORqHgZDuFz2Sbsb3UYYGMG7bcivx7nFbXEAJCNy', '5L8UNWkeHJMyNJKIAfSFqnxuyMRxsPtDddvBM8FNzkvGippysKwR4MVIgBtw', '2019-03-15 12:48:08', '2019-03-22 12:08:56', 'nhphong');
INSERT INTO `users` VALUES (5, 'admin', 'admin@gmail.com', 1, '$2y$10$wBrK8REOYPPmFsFnKFwRbufozAmgFny21C.DpKXDJFmqdWL8G/BXK', 'jgDCNeAoq9eDp6vzKbesahurcXYa5BhMqESelRWFr5oa5Q8Iu0bGX45eNEUD', '2019-03-16 02:34:47', '2019-03-16 02:34:47', 'admin');

SET FOREIGN_KEY_CHECKS = 1;
