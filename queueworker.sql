/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : share_down

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2014-09-03 08:53:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `depots`
-- ----------------------------
DROP TABLE IF EXISTS `depots`;
CREATE TABLE `depots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `count_number` int(11) NOT NULL DEFAULT '0' COMMENT '下载次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of depots
-- ----------------------------

-- ----------------------------
-- Table structure for `logs`
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `depot_id` int(11) NOT NULL DEFAULT '0',
  `created` int(11) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of logs
-- ----------------------------
INSERT INTO `logs` VALUES ('1', '3', '0', '1409672665', 'http://down.nipic.com/download?id=9161809#showMore');
INSERT INTO `logs` VALUES ('2', '3', '0', '1409672736', 'http://down.nipic.com/download?id=9161809#showMore');
INSERT INTO `logs` VALUES ('3', '3', '0', '1409672799', 'http://down.nipic.com/download?id=9161809#showMore');
INSERT INTO `logs` VALUES ('4', '3', '0', '1409672879', 'http://down.nipic.com/download?id=9161809#showMore');
INSERT INTO `logs` VALUES ('5', '3', '0', '1409673071', 'http://www.nipic.com/show/10845476.html');
INSERT INTO `logs` VALUES ('6', '3', '0', '1409673533', 'http://www.nipic.com/show/10845476.html');
INSERT INTO `logs` VALUES ('7', '3', '0', '1409673537', 'http://www.nipic.com/show/10845476.html');
INSERT INTO `logs` VALUES ('8', '3', '0', '1409673585', 'http://www.nipic.com/show/10845476.html');
INSERT INTO `logs` VALUES ('9', '3', '0', '1409673621', 'http://down.nipic.com/download?id=9161809#showMore');
INSERT INTO `logs` VALUES ('10', '3', '0', '1409673633', 'http://down.nipic.com/download?id=9161809#showMore');
INSERT INTO `logs` VALUES ('11', '3', '0', '1409673674', 'http://down.nipic.com/download?id=9161809#showMore');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `role` set('user','admin') NOT NULL DEFAULT 'user',
  `created` int(11) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT '0',
  `qq` int(11) NOT NULL DEFAULT '0',
  `tel` varchar(255) NOT NULL DEFAULT '',
  `active` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户状态 0 为正常',
  `expired` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '下载有效次数',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('3', 'test2@qq.com', 'test2@qq.com', '123456', 'user', '1386429404', '1386429404', '0', '', '0', '2014-09-10 08:45:18', '0');
INSERT INTO `users` VALUES ('11', '1203778432@qq.com', '123456', '123456', 'user', '1402668891', '1402668891', '12314123', '123', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `users` VALUES ('12', 'test9001@qq.com', '林', '123456', 'admin', '1409491479', '0', '123456', '123456', '0', '0000-00-00 00:00:00', '0');
INSERT INTO `users` VALUES ('13', 'admin@qq.com', '林宁', '123456', 'admin', '1409491841', '0', '120377843', '243143124', '0', '2014-09-28 00:00:00', '10');

-- ----------------------------
-- Table structure for `vips`
-- ----------------------------
DROP TABLE IF EXISTS `vips`;
CREATE TABLE `vips` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `endtime` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `today` date NOT NULL COMMENT '统计时间',
  `number` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vips
-- ----------------------------
INSERT INTO `vips` VALUES ('2', 'huaerzb', 'qwe111', '0', '1409495707', '2014-09-03', '2');
