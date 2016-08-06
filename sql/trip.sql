/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50542
Source Host           : localhost:3306
Source Database       : tabiat

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2016-06-06 11:06:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for trip
-- ----------------------------
DROP TABLE IF EXISTS `trip`;
CREATE TABLE `trip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `opr_stat` int(11) DEFAULT NULL,
  `trip_type` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `description` blob,
  `adminstartor_cmt` blob,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `departure_place` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `departure_time` varchar(255) DEFAULT NULL,
  `attractions` blob,
  `opr_type` int(11) DEFAULT NULL,
  `experties_level` int(11) DEFAULT NULL,
  `requiremnt_course` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `requirment_stuff` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `pric_type` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `wage` int(11) DEFAULT NULL,
  `price_decs` varchar(1000) COLLATE utf8_persian_ci DEFAULT NULL,
  `contract_type` int(11) DEFAULT NULL,
  `contract_genral` int(11) DEFAULT NULL,
  `start_order` varchar(255) DEFAULT NULL,
  `end_order` varchar(255) DEFAULT NULL,
  `invis_cmt` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
