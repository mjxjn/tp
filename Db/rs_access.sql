/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : reshop

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-04-08 15:15:38
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `rs_access`
-- ----------------------------
DROP TABLE IF EXISTS `rs_access`;
CREATE TABLE `rs_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rs_access
-- ----------------------------
INSERT INTO rs_access VALUES ('8', '1', '1', '0', null);
INSERT INTO rs_access VALUES ('8', '7', '2', '1', null);
INSERT INTO rs_access VALUES ('8', '8', '3', '7', null);
INSERT INTO rs_access VALUES ('8', '9', '3', '7', null);
INSERT INTO rs_access VALUES ('8', '10', '3', '7', null);
INSERT INTO rs_access VALUES ('11', '26', '3', '24', null);
INSERT INTO rs_access VALUES ('8', '13', '3', '7', null);
INSERT INTO rs_access VALUES ('8', '14', '3', '7', null);
INSERT INTO rs_access VALUES ('8', '15', '3', '7', null);
INSERT INTO rs_access VALUES ('8', '16', '3', '7', null);
INSERT INTO rs_access VALUES ('8', '17', '3', '7', null);
INSERT INTO rs_access VALUES ('8', '18', '2', '1', null);
INSERT INTO rs_access VALUES ('11', '25', '3', '24', null);
INSERT INTO rs_access VALUES ('10', '39', '3', '38', null);
INSERT INTO rs_access VALUES ('10', '54', '3', '52', null);
INSERT INTO rs_access VALUES ('11', '37', '3', '24', null);
INSERT INTO rs_access VALUES ('11', '34', '3', '24', null);
INSERT INTO rs_access VALUES ('11', '23', '3', '18', '');
INSERT INTO rs_access VALUES ('11', '22', '3', '18', '');
INSERT INTO rs_access VALUES ('11', '21', '3', '18', '');
INSERT INTO rs_access VALUES ('11', '20', '3', '18', '');
INSERT INTO rs_access VALUES ('11', '19', '3', '18', '');
INSERT INTO rs_access VALUES ('9', '18', '2', '1', null);
INSERT INTO rs_access VALUES ('9', '11', '3', '7', null);
INSERT INTO rs_access VALUES ('9', '23', '3', '18', '');
INSERT INTO rs_access VALUES ('9', '22', '3', '18', '');
INSERT INTO rs_access VALUES ('9', '21', '3', '18', '');
INSERT INTO rs_access VALUES ('9', '20', '3', '18', '');
INSERT INTO rs_access VALUES ('11', '18', '2', '1', '');
INSERT INTO rs_access VALUES ('9', '19', '3', '18', '');
INSERT INTO rs_access VALUES ('10', '23', '3', '18', '');
INSERT INTO rs_access VALUES ('10', '22', '3', '18', '');
INSERT INTO rs_access VALUES ('10', '21', '3', '18', '');
INSERT INTO rs_access VALUES ('10', '20', '3', '18', '');
INSERT INTO rs_access VALUES ('10', '18', '2', '1', '');
INSERT INTO rs_access VALUES ('10', '19', '3', '18', '');
INSERT INTO rs_access VALUES ('11', '24', '2', '1', null);
INSERT INTO rs_access VALUES ('8', '22', '3', '18', null);
INSERT INTO rs_access VALUES ('10', '53', '3', '52', null);
INSERT INTO rs_access VALUES ('11', '35', '3', '24', null);
INSERT INTO rs_access VALUES ('10', '41', '3', '38', null);
INSERT INTO rs_access VALUES ('10', '42', '3', '38', null);
INSERT INTO rs_access VALUES ('11', '33', '3', '24', null);
INSERT INTO rs_access VALUES ('10', '38', '2', '1', null);
INSERT INTO rs_access VALUES ('11', '32', '3', '24', null);
INSERT INTO rs_access VALUES ('10', '40', '3', '38', null);
INSERT INTO rs_access VALUES ('11', '36', '3', '24', null);
INSERT INTO rs_access VALUES ('11', '30', '3', '24', null);
INSERT INTO rs_access VALUES ('10', '43', '3', '38', null);
INSERT INTO rs_access VALUES ('10', '44', '3', '38', null);
INSERT INTO rs_access VALUES ('10', '45', '3', '38', null);
INSERT INTO rs_access VALUES ('10', '46', '3', '38', null);
INSERT INTO rs_access VALUES ('10', '47', '3', '38', null);
INSERT INTO rs_access VALUES ('10', '48', '3', '38', null);
INSERT INTO rs_access VALUES ('10', '49', '3', '38', null);
INSERT INTO rs_access VALUES ('10', '50', '3', '38', null);
INSERT INTO rs_access VALUES ('10', '51', '3', '38', null);
INSERT INTO rs_access VALUES ('10', '52', '2', '1', null);
INSERT INTO rs_access VALUES ('11', '31', '3', '24', null);
INSERT INTO rs_access VALUES ('9', '12', '3', '7', null);
INSERT INTO rs_access VALUES ('11', '27', '3', '24', null);
INSERT INTO rs_access VALUES ('11', '28', '3', '24', null);
INSERT INTO rs_access VALUES ('11', '29', '3', '24', null);
INSERT INTO rs_access VALUES ('8', '19', '3', '18', null);
INSERT INTO rs_access VALUES ('8', '20', '3', '18', null);
INSERT INTO rs_access VALUES ('8', '21', '3', '18', null);
INSERT INTO rs_access VALUES ('8', '23', '3', '18', null);
