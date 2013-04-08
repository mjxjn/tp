/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : reshop

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-04-08 15:15:56
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `rs_role`
-- ----------------------------
DROP TABLE IF EXISTS `rs_role`;
CREATE TABLE `rs_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `ename` varchar(5) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `ename` (`ename`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rs_role
-- ----------------------------
INSERT INTO rs_role VALUES ('8', '商品订单列表', '0', '1', null, null, '0', '0');
INSERT INTO rs_role VALUES ('9', '上传商品清单', '0', '1', null, null, '0', '0');
INSERT INTO rs_role VALUES ('10', '供货商管理', '0', '1', null, null, '0', '0');
INSERT INTO rs_role VALUES ('11', '采购单据管理', '0', '1', null, null, '0', '0');
