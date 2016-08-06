/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50542
Source Host           : localhost:3306
Source Database       : tabiat

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2016-06-06 11:07:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for transaction
-- ----------------------------
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `tranction_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
