/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : db_detik

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 26/11/2021 13:45:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_m_transaksi_pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `t_m_transaksi_pembayaran_migrate`;
CREATE TABLE `t_m_transaksi_pembayaran_migrate`  (
  `invoice_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `references_id` int(10) NULL DEFAULT NULL,
  `item_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `amount` int(20) NULL DEFAULT NULL,
  `payment_type` enum('virtual_account','credit_card') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `customer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `merchant_id` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('pending','paid','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`invoice_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_m_transaksi_pembayaran
-- ----------------------------
INSERT INTO `t_m_transaksi_pembayaran_migrate` VALUES ('DETIK001', 78, 'Barang Bagus', 10000, 'credit_card', 'Denny Julianto', '001', 'pending');
INSERT INTO `t_m_transaksi_pembayaran_migrate` VALUES ('DETIK002', 96, 'Barang Bagus', 10000, 'credit_card', 'Denny Julianto', '001', 'pending');

SET FOREIGN_KEY_CHECKS = 1;
