/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50542
Source Host           : localhost:3306
Source Database       : tabiat

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2016-06-23 21:27:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for report
-- ----------------------------
DROP TABLE IF EXISTS `report`;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `query` text COLLATE utf8_persian_ci,
  `type` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ----------------------------
-- Records of report
-- ----------------------------
INSERT INTO `report` VALUES ('1', 'سفر ها به تفکیک سال', 'select substring(t.start_date,7,4) as param, count(1) as cnt from trip t group by 1', 'line');
INSERT INTO `report` VALUES ('2', 'سفر ها به تفکیک سال و ماه', 'select substring(t.start_date,4,7) as param, count(1) as cnt from trip t group by 1', 'column');
INSERT INTO `report` VALUES ('3', 'سفر ها به تفکیک ماه', 'select substring(t.start_date,4,2) as param, count(1) as cnt from trip t group by 1', 'line');
INSERT INTO `report` VALUES ('4', 'سفر ها به تفکیک استان ها', 'select c.name as param, count(1) as cnt from trip t, constant c where t.province_id = c.id group by province_id;', 'column');
