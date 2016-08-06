/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50542
Source Host           : localhost:3306
Source Database       : tabiat

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2016-06-06 11:07:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `black_list` char(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `sexuality` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `surename` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `national_code` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `national_id` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `married` int(11) DEFAULT NULL,
  `marriage_date` varchar(255) DEFAULT NULL,
  `introduction` int(11) DEFAULT NULL,
  `refrence` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `blood_type` int(11) DEFAULT NULL,
  `illness` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `nativ_lnag` int(11) DEFAULT NULL,
  `first_lang` int(11) DEFAULT NULL,
  `sec_lang` int(11) DEFAULT NULL,
  `edu_level` int(11) DEFAULT NULL,
  `edu_field` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `job_loc` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `job_desc` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `creation-date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
