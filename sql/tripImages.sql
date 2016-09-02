/*
Navicat MySQL Data Transfer

Source Server         : Tabiat
Source Server Version : 50550
Source Host           : 91.109.17.87:3306
Source Database       : tabiat

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2016-08-22 11:43:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tripimages
-- ----------------------------
DROP TABLE IF EXISTS `tripimages`;
CREATE TABLE `tripimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) NOT NULL,
  `image` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
