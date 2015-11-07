/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50523
Source Host           : localhost:3306
Source Database       : prize

Target Server Type    : MYSQL
Target Server Version : 50523
File Encoding         : 65001

Date: 2015-11-07 17:48:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_prize
-- ----------------------------
DROP TABLE IF EXISTS `tb_prize`;
CREATE TABLE `tb_prize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` char(4) DEFAULT '0' COMMENT '0:未中奖，1是中奖',
  `phonenumber` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_phonenumber` (`status`,`phonenumber`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_prize
-- ----------------------------
INSERT INTO `tb_prize` VALUES ('1', '奖', '0', '');
INSERT INTO `tb_prize` VALUES ('3', '奖', '0', '');
INSERT INTO `tb_prize` VALUES ('4', '奖', '0', '');
INSERT INTO `tb_prize` VALUES ('5', '奖', '0', '');
INSERT INTO `tb_prize` VALUES ('6', '奖', '0', '');
INSERT INTO `tb_prize` VALUES ('7', '奖', '0', '');
INSERT INTO `tb_prize` VALUES ('8', '奖', '0', '');
INSERT INTO `tb_prize` VALUES ('9', '奖', '0', '');
INSERT INTO `tb_prize` VALUES ('10', '奖', '0', '');
INSERT INTO `tb_prize` VALUES ('11', '奖', '0', '');

-- ----------------------------
-- Table structure for tb_prizeswitch
-- ----------------------------
DROP TABLE IF EXISTS `tb_prizeswitch`;
CREATE TABLE `tb_prizeswitch` (
  `switch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_prizeswitch
-- ----------------------------
INSERT INTO `tb_prizeswitch` VALUES ('1');
