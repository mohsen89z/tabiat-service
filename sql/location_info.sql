/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50542
Source Host           : localhost:3306
Source Database       : tabiat

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2016-06-06 11:07:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for location_info
-- ----------------------------
DROP TABLE IF EXISTS `location_info`;
CREATE TABLE `location_info` (
  `id` int(11) NOT NULL,
  `user_info_id` int(11) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `district` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `web_site` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
