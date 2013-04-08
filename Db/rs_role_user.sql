/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : reshop

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-04-08 15:16:02
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `rs_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `rs_role_user`;
CREATE TABLE `rs_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rs_role_user
-- ----------------------------
INSERT INTO rs_role_user VALUES ('8', '2');
INSERT INTO rs_role_user VALUES ('9', '2');
INSERT INTO rs_role_user VALUES ('10', '2');
INSERT INTO rs_role_user VALUES ('11', '2');
