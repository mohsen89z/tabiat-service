/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50542
Source Host           : localhost:3306
Source Database       : tabiat

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2016-06-10 00:59:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for constant
-- ----------------------------
DROP TABLE IF EXISTS `constant`;
CREATE TABLE `constant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `classifier` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ----------------------------
-- Records of constant
-- ----------------------------
INSERT INTO `constant` VALUES ('1', 'نقدی', 'transaction_type');
INSERT INTO `constant` VALUES ('2', 'از طریق کارت', 'transaction_type');
INSERT INTO `constant` VALUES ('3', 'پست الکترونیکی', 'contact_type');
INSERT INTO `constant` VALUES ('4', 'تلفن', 'contact_type');
INSERT INTO `constant` VALUES ('10', 'فعال', 'user_status');
INSERT INTO `constant` VALUES ('11', 'غیر فعال', 'user_status');
INSERT INTO `constant` VALUES ('12', 'بله', 'boolean');
INSERT INTO `constant` VALUES ('13', 'خیر', 'boolean');
INSERT INTO `constant` VALUES ('14', 'نامشخص', 'unkown');
INSERT INTO `constant` VALUES ('15', 'مرد', 'sex');
INSERT INTO `constant` VALUES ('16', 'زن', 'sex');
INSERT INTO `constant` VALUES ('17', 'مجرد', 'marriage');
INSERT INTO `constant` VALUES ('18', 'متاهل', 'marriage');
INSERT INTO `constant` VALUES ('19', 'شبکه های اجتماعی', 'introduction_type');
INSERT INTO `constant` VALUES ('20', 'تبلیغ در رسانه ها', 'introduction_type');
INSERT INTO `constant` VALUES ('21', 'معرفی دوستان', 'introduction_type');
INSERT INTO `constant` VALUES ('22', 'وب سایت', 'introduction_type');
INSERT INTO `constant` VALUES ('23', 'دیپلم', 'edu_level');
INSERT INTO `constant` VALUES ('24', 'فوق دیپلم', 'edu_level');
INSERT INTO `constant` VALUES ('25', 'لیسانس', 'edu_level');
INSERT INTO `constant` VALUES ('26', 'فوق لیسانس', 'edu_level');
INSERT INTO `constant` VALUES ('27', 'پزشکی', 'edu_level');
INSERT INTO `constant` VALUES ('28', 'متخصص پزشکی', 'edu_level');
INSERT INTO `constant` VALUES ('29', 'دکترا', 'edu_level');
INSERT INTO `constant` VALUES ('30', 'فارسی', 'lang');
INSERT INTO `constant` VALUES ('31', 'ترکی', 'lang');
INSERT INTO `constant` VALUES ('32', 'عربی', 'lang');
INSERT INTO `constant` VALUES ('33', 'انگلیسی', 'lang');
INSERT INTO `constant` VALUES ('34', 'اسپانیایی', 'lang');
INSERT INTO `constant` VALUES ('35', 'ایتالیایی', 'lang');
INSERT INTO `constant` VALUES ('36', 'O-', 'blood_type');
INSERT INTO `constant` VALUES ('37', 'O+', 'blood_type');
INSERT INTO `constant` VALUES ('38', 'A-', 'blood_type');
INSERT INTO `constant` VALUES ('39', 'A+', 'blood_type');
INSERT INTO `constant` VALUES ('40', 'B-', 'blood_type');
INSERT INTO `constant` VALUES ('41', 'B+', 'blood_type');
INSERT INTO `constant` VALUES ('42', 'AB-', 'blood_type');
INSERT INTO `constant` VALUES ('43', 'AB+', 'blood_type');
INSERT INTO `constant` VALUES ('44', 'فعال', 'trip_status');
INSERT INTO `constant` VALUES ('45', 'غیر فعال', 'trip_status');
INSERT INTO `constant` VALUES ('46', 'کنسل', 'trip_status');
INSERT INTO `constant` VALUES ('47', 'بسته', 'trip_status');
INSERT INTO `constant` VALUES ('48', 'نامشخص', 'exec_status');
INSERT INTO `constant` VALUES ('49', 'احتمال اجرا', 'exec_status');
INSERT INTO `constant` VALUES ('50', 'احتمال کنسلی', 'exec_status');
INSERT INTO `constant` VALUES ('51', 'قطعی', 'exec_status');
INSERT INTO `constant` VALUES ('52', 'محدود', 'exec_status');
INSERT INTO `constant` VALUES ('53', 'موجود', 'exec_status');
INSERT INTO `constant` VALUES ('54', 'نامشخص', 'iran_state');
INSERT INTO `constant` VALUES ('55', 'آذربایجان شرقی', 'iran_state');
INSERT INTO `constant` VALUES ('56', 'آذربایجان غربی', 'iran_state');
INSERT INTO `constant` VALUES ('57', 'اردبیل', 'iran_state');
INSERT INTO `constant` VALUES ('58', 'اصفهان', 'iran_state');
INSERT INTO `constant` VALUES ('59', 'البرز', 'iran_state');
INSERT INTO `constant` VALUES ('60', 'ایلام', 'iran_state');
INSERT INTO `constant` VALUES ('61', 'بوشهر', 'iran_state');
INSERT INTO `constant` VALUES ('62', 'تهران', 'iran_state');
INSERT INTO `constant` VALUES ('63', 'چهارمحال و بختیاری', 'iran_state');
INSERT INTO `constant` VALUES ('64', 'خراسان جنوبی', 'iran_state');
INSERT INTO `constant` VALUES ('65', 'خراسان رضوی', 'iran_state');
INSERT INTO `constant` VALUES ('66', 'خراسان شمالی', 'iran_state');
INSERT INTO `constant` VALUES ('67', 'خوزستان', 'iran_state');
INSERT INTO `constant` VALUES ('68', 'زنجان', 'iran_state');
INSERT INTO `constant` VALUES ('69', 'سمنان', 'iran_state');
INSERT INTO `constant` VALUES ('70', 'سیستان و بلوچستان', 'iran_state');
INSERT INTO `constant` VALUES ('71', 'فارس', 'iran_state');
INSERT INTO `constant` VALUES ('72', 'قزوین', 'iran_state');
INSERT INTO `constant` VALUES ('73', 'قم', 'iran_state');
INSERT INTO `constant` VALUES ('74', 'کردستان', 'iran_state');
INSERT INTO `constant` VALUES ('75', 'کرمان', 'iran_state');
INSERT INTO `constant` VALUES ('76', 'کرمانشاه', 'iran_state');
INSERT INTO `constant` VALUES ('77', 'کهکیلویه و بویراحمد', 'iran_state');
INSERT INTO `constant` VALUES ('78', 'گلستان', 'iran_state');
INSERT INTO `constant` VALUES ('79', 'گیلان', 'iran_state');
INSERT INTO `constant` VALUES ('80', 'لرستان', 'iran_state');
INSERT INTO `constant` VALUES ('81', 'مازندران', 'iran_state');
INSERT INTO `constant` VALUES ('82', 'مرکزی', 'iran_state');
INSERT INTO `constant` VALUES ('83', 'هرمزگان', 'iran_state');
INSERT INTO `constant` VALUES ('84', 'همدان', 'iran_state');
INSERT INTO `constant` VALUES ('85', 'یزد', 'iran_state');
INSERT INTO `constant` VALUES ('86', 'داخلی', 'trip_loc_type');
INSERT INTO `constant` VALUES ('87', 'خارجی', 'trip_loc_type');
INSERT INTO `constant` VALUES ('200', 'ایران', 'country');
INSERT INTO `constant` VALUES ('201', 'ارمنستان', 'country');
INSERT INTO `constant` VALUES ('202', 'عراق', 'country');
INSERT INTO `constant` VALUES ('203', 'ترکیه', 'country');
INSERT INTO `constant` VALUES ('204', 'افغانستان', 'country');
INSERT INTO `constant` VALUES ('205', 'نامشخص', 'opr_type');
INSERT INTO `constant` VALUES ('206', 'انفرادی', 'opr_type');
INSERT INTO `constant` VALUES ('207', 'گروهی', 'opr_type');
INSERT INTO `constant` VALUES ('208', 'نامشخص', 'experties_level');
INSERT INTO `constant` VALUES ('209', 'آسان', 'experties_level');
INSERT INTO `constant` VALUES ('210', 'متوسط', 'experties_level');
INSERT INTO `constant` VALUES ('211', 'سخت', 'experties_level');
INSERT INTO `constant` VALUES ('212', 'قیمت ثابت', 'price_type');
INSERT INTO `constant` VALUES ('213', 'به زودی', 'price_type');
INSERT INTO `constant` VALUES ('214', 'قیمت متغییر', 'price_type');
INSERT INTO `constant` VALUES ('215', 'رایگان', 'price_type');
INSERT INTO `constant` VALUES ('216', 'نامشخص', 'contract_type');
INSERT INTO `constant` VALUES ('217', 'خارجی', 'contract_type');
INSERT INTO `constant` VALUES ('218', 'طبیعت گردی', 'contract_type');
INSERT INTO `constant` VALUES ('219', 'فرهنگی', 'contract_type');
