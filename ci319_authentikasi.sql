/*
 Navicat Premium Data Transfer

 Source Server         : Local - MySQL
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost:3306
 Source Schema         : ci_inventori_v2

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : 65001

 Date: 08/01/2019 14:39:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbm_cabang
-- ----------------------------
DROP TABLE IF EXISTS `tbm_cabang`;
CREATE TABLE `tbm_cabang`  (
  `id_cabang` int(11) NOT NULL AUTO_INCREMENT,
  `kd_cabang` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `nama_cabang` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id_cabang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbm_departemen
-- ----------------------------
DROP TABLE IF EXISTS `tbm_departemen`;
CREATE TABLE `tbm_departemen`  (
  `id_departemen` int(11) NOT NULL,
  `kd_departemen` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `nama_departemen` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id_departemen`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbm_email
-- ----------------------------
DROP TABLE IF EXISTS `tbm_email`;
CREATE TABLE `tbm_email`  (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `sending_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `smtp_host` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `smtp_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `smtp_password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `smtp_port` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `status_aktif` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT 'Y',
  `notes_email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  PRIMARY KEY (`id_email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbm_email
-- ----------------------------
INSERT INTO `tbm_email` VALUES (1, 'INVENTORI - ASTRINDO', ' smtp.mailtrap.io', ' 047b67b78ee8cd', ' 4950e0e467f680', '2525', 'W', 'Setting Astrindo:\r\nsmtp_host => \'mail.astrindotour.co.id\',\r\nsmtp_user => \'permit@astrindotour.co.id\', \r\nsmtp_pass => \'k0hkr60sim\',\r\nsmtp_port => \'465\',\r\n\r\nsmtp_host => \'mail.astrindotour.co.id\',\r\nsmtp_user => \'permit@astrindotour.co.id\', \r\nsmtp_pass => \'k0hkr60sim\',\r\nsmtp_port => \'587\',\r\n\r\nSetting Google:\r\nsmtp_host => \'smtp.gmail.com\',\r\nsmtp_user => \'permit.astrindo@gmail.com\', \r\nsmtp_pass => \'Astri443322\',\r\nsmtp_port => \'465\',                  ');
INSERT INTO `tbm_email` VALUES (2, 'INVENTORI - ASTRINDO', 'mail.astrindotour.co.id', 'permit@astrindotour.co.id', 'k0hkr60sim', '465', 'W', NULL);
INSERT INTO `tbm_email` VALUES (3, 'INVENTORI - ASTRINDO', 'smtp.gmail.com', 'permit.astrindo@gmail.com', 'Astri443322', '465', 'Y', NULL);
INSERT INTO `tbm_email` VALUES (4, NULL, NULL, 'programmer@astrindotour.co.id', NULL, NULL, 'Y', NULL);

-- ----------------------------
-- Table structure for tbm_level
-- ----------------------------
DROP TABLE IF EXISTS `tbm_level`;
CREATE TABLE `tbm_level`  (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `kd_level` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `nama_level` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id_level`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbu_attempt
-- ----------------------------
DROP TABLE IF EXISTS `tbu_attempt`;
CREATE TABLE `tbu_attempt`  (
  `id_attempt` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `time_attempt` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `date_attempt` datetime(0) NULL DEFAULT NULL,
  `total_attempt` int(11) NULL DEFAULT 1,
  `status_attempt` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT 'OPEN',
  PRIMARY KEY (`id_attempt`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbu_attempt
-- ----------------------------
INSERT INTO `tbu_attempt` VALUES (1, 'admin', '2019-01-08 14:35:20', '2019-01-08 00:00:00', 3, 'BLOCKED');

-- ----------------------------
-- Table structure for tbu_group
-- ----------------------------
DROP TABLE IF EXISTS `tbu_group`;
CREATE TABLE `tbu_group`  (
  `id_group` int(11) NOT NULL,
  `nama_group` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `user` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT ',,,,,',
  `cabang` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT ',,,,,',
  `departemen` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT ',,,,,',
  `request` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT ',,,,,',
  PRIMARY KEY (`id_group`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin COMMENT = 'Tabel Untuk rule group hak akses, staff, spv, admin, operation dll' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbu_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `tbu_jabatan`;
CREATE TABLE `tbu_jabatan`  (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `kd_level` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `kd_departemen` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `kd_cabang` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbu_user
-- ----------------------------
DROP TABLE IF EXISTS `tbu_user`;
CREATE TABLE `tbu_user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `status_user` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'Y',
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `token_code` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `id_jabatan` int(11) NULL DEFAULT NULL,
  `id_group` int(11) NULL DEFAULT NULL,
  `hidden` int(11) NULL DEFAULT 1,
  `time_create` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `user_create` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`, `status_user`) USING BTREE,
  UNIQUE INDEX `id_user`(`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbu_user
-- ----------------------------
INSERT INTO `tbu_user` VALUES (9, 'admin', '$2y$10$MwNCh9IM3JYG46uFvK/i0Oy0QPKDuf4axm/nZAuWRbQCKqhqxkURO', 'Y', 'programmer@astrindotour.co.id', 'kcuj5KyO3zwExJ7C', 1, 1, 0, '2019-01-07 18:43:24', 0);

-- ----------------------------
-- Table structure for tbu_user_profile
-- ----------------------------
DROP TABLE IF EXISTS `tbu_user_profile`;
CREATE TABLE `tbu_user_profile`  (
  `id_user_profile` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `first_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `last_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `phone_one` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `phone_two` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id_user_profile`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
