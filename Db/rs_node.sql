/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : reshop

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-04-08 15:15:51
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `rs_node`
-- ----------------------------
DROP TABLE IF EXISTS `rs_node`;
CREATE TABLE `rs_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rs_node
-- ----------------------------
INSERT INTO rs_node VALUES ('1', 'Supply', '供货管理', '1', null, '1', '0', '1');
INSERT INTO rs_node VALUES ('2', 'Admin', '管理员管理', '1', null, '1', '1', '2');
INSERT INTO rs_node VALUES ('3', 'adminList', '管理员列表', '1', null, '1', '2', '3');
INSERT INTO rs_node VALUES ('4', 'addAdmin', '添加管理员', '1', null, '1', '2', '3');
INSERT INTO rs_node VALUES ('5', 'AjaxAdminInfo', '获取管理员详细信息', '1', null, '1', '2', '3');
INSERT INTO rs_node VALUES ('6', 'adminDel', '删除管理员', '1', null, '1', '2', '3');
INSERT INTO rs_node VALUES ('7', 'Goods', '订货单管理', '1', null, '1', '1', '2');
INSERT INTO rs_node VALUES ('8', 'index', '订货单首页', '1', null, '1', '7', '3');
INSERT INTO rs_node VALUES ('9', 'main', '订货单主页', '1', null, '1', '7', '3');
INSERT INTO rs_node VALUES ('10', 'orderList', '订货单列表', '1', null, '1', '7', '3');
INSERT INTO rs_node VALUES ('11', 'upGoodsList', '上传订货单', '1', null, '1', '7', '3');
INSERT INTO rs_node VALUES ('12', 'csvUpload', '导入订货单数据', '1', null, '1', '7', '3');
INSERT INTO rs_node VALUES ('13', 'goodsList', '订货单商品列表', '1', null, '1', '7', '3');
INSERT INTO rs_node VALUES ('14', 'search', '订货单商品搜索', '1', null, '1', '7', '3');
INSERT INTO rs_node VALUES ('15', 'goodsDel', '订货单删除', '1', null, '1', '7', '3');
INSERT INTO rs_node VALUES ('16', 'allDel', '订货单批量删除', '1', null, '1', '7', '3');
INSERT INTO rs_node VALUES ('17', 'allGoodsDel', '订货单商品批量删除', '1', null, '1', '7', '3');
INSERT INTO rs_node VALUES ('18', 'Index', '系统管理', '1', null, '1', '1', '2');
INSERT INTO rs_node VALUES ('19', 'header', '系统头部信息', '1', null, '1', '18', '3');
INSERT INTO rs_node VALUES ('20', 'system_left', '系统左侧信息', '1', null, '1', '18', '3');
INSERT INTO rs_node VALUES ('21', 'left', '系统左侧', '1', null, '1', '18', '3');
INSERT INTO rs_node VALUES ('22', 'index', '系统首页', '1', null, '1', '18', '3');
INSERT INTO rs_node VALUES ('23', 'main', '系统主页', '1', null, '1', '18', '3');
INSERT INTO rs_node VALUES ('24', 'Purchase', '采购管理', '1', null, '1', '1', '2');
INSERT INTO rs_node VALUES ('25', 'index', '采购首页', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('26', 'main', '采购主页', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('27', 'creatPurchase', '生成采购单', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('28', 'purchase', '采购单列表', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('29', 'findSupplier', '按供货商查询', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('30', 'purchaseDel', '采购单删除', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('31', 'allAct', '批量删除采购单', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('32', 'allListDel', '批量删除采购单商品', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('33', 'purchaseList', '采购单详细列表', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('34', 'upPurchase', '上传采购单', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('35', 'csvUpload', '导入采购单', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('36', 'excelPurchase', '导出采购单', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('37', 'allExcelPurchase', '批量导出采购单', '1', null, '1', '24', '3');
INSERT INTO rs_node VALUES ('38', 'Supplier', '供货商管理', '1', null, '1', '1', '2');
INSERT INTO rs_node VALUES ('39', 'index', '供货商首页', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('40', 'main', '供货商主页', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('41', 'supplier', '供货商列表', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('42', 'upSupplier', '上传供货商', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('43', 'csvUpload', '导入供货商', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('44', 'addsupplier', '添加供货商', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('45', 'AjaxGetSupplierInfo', '获得供货商信息', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('46', 'AjaxGetSupplierGoods', '获得供货商商品列表', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('47', 'supplierGoods', '供货商商品列表', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('48', 'supplierDel', '删除供货商', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('49', 'allDel', '批量删除供货商', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('50', 'saveSupplierGoods', '修改供货商商品信息', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('51', 'getSupplierList', '搜索供货商', '1', null, '1', '38', '3');
INSERT INTO rs_node VALUES ('52', 'SupplierGoods', '供货商商品管理', '1', null, '1', '1', '2');
INSERT INTO rs_node VALUES ('53', 'supplierGoodsDel', '删除供货商商品', '1', null, '1', '52', '3');
INSERT INTO rs_node VALUES ('54', 'allDel', '批量删除供货商商品', '1', null, '1', '52', '3');
