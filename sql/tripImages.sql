/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50542
Source Host           : localhost:3306
Source Database       : tabiat

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2016-08-01 16:15:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tripimages
-- ----------------------------
DROP TABLE IF EXISTS `tripimages`;
CREATE TABLE `tripimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) NOT NULL,
  `image` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
