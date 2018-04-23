/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : zhengshu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-23 13:31:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `pwd` char(32) DEFAULT NULL,
  `last_log_ip` varchar(15) DEFAULT NULL,
  `last_log_time` char(10) DEFAULT NULL,
  `descript` varchar(50) DEFAULT NULL COMMENT '管理员描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '127.0.0.1', '1524448869', '超级管理员');

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `image` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banner
-- ----------------------------

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `descript` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `copyright` varchar(100) DEFAULT NULL,
  `tel` varchar(18) DEFAULT NULL,
  `fax` varchar(18) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `logo` varchar(30) DEFAULT NULL,
  `banner` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', '', '', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for myzc
-- ----------------------------
DROP TABLE IF EXISTS `myzc`;
CREATE TABLE `myzc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(6) NOT NULL,
  `address` varchar(100) DEFAULT NULL COMMENT '转出地址',
  `txid` varchar(200) DEFAULT NULL,
  `num` decimal(16,4) DEFAULT NULL,
  `createdate` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0未到账 1到账 2是拒绝',
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `address` (`address`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of myzc
-- ----------------------------
INSERT INTO `myzc` VALUES ('1', '27', 'LVLxXuzR7GtYaXAg7yBy4TvxXnSRDH6Ts8', null, '11.0000', '1524206735', '2', null);

-- ----------------------------
-- Table structure for myzr
-- ----------------------------
DROP TABLE IF EXISTS `myzr`;
CREATE TABLE `myzr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(6) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `txid` varchar(200) DEFAULT NULL,
  `num` decimal(16,4) DEFAULT NULL,
  `createdate` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `zuhe1` (`txid`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of myzr
-- ----------------------------

-- ----------------------------
-- Table structure for sys_dtfh
-- ----------------------------
DROP TABLE IF EXISTS `sys_dtfh`;
CREATE TABLE `sys_dtfh` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `minnum` int(8) DEFAULT NULL,
  `maxnum` int(8) DEFAULT NULL,
  `bl` decimal(6,4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='动态分红设置';

-- ----------------------------
-- Records of sys_dtfh
-- ----------------------------
INSERT INTO `sys_dtfh` VALUES ('1', '100', '500', '0.0012', '1');
INSERT INTO `sys_dtfh` VALUES ('2', '501', '1000', '0.0015', '1');

-- ----------------------------
-- Table structure for sys_fh_log
-- ----------------------------
DROP TABLE IF EXISTS `sys_fh_log`;
CREATE TABLE `sys_fh_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(6) NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1是静态 2是动态',
  `current` decimal(16,4) DEFAULT NULL COMMENT '当前币',
  `fh_id` tinyint(2) DEFAULT NULL COMMENT '当前满足的分红id',
  `bl` varchar(7) DEFAULT NULL,
  `num` decimal(12,4) unsigned DEFAULT NULL COMMENT '本次分红的币数',
  `createdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `uc` (`userid`,`createdate`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_fh_log
-- ----------------------------
INSERT INTO `sys_fh_log` VALUES ('1', '27', '1', '100.0000', '1', '0.0012', '0.1200', '1524451275');
INSERT INTO `sys_fh_log` VALUES ('2', '27', '1', '100.1200', '1', '0.0012', '0.1200', '1524451275');
INSERT INTO `sys_fh_log` VALUES ('3', '27', '1', '100.2400', '1', '0.0012', '0.1200', '1524451350');
INSERT INTO `sys_fh_log` VALUES ('4', '27', '1', '100.3600', '1', '0.0012', '0.1200', '1524451865');

-- ----------------------------
-- Table structure for sys_fh_verify
-- ----------------------------
DROP TABLE IF EXISTS `sys_fh_verify`;
CREATE TABLE `sys_fh_verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `count` int(11) DEFAULT NULL COMMENT '当天该分红的总人数',
  `deal_jt` int(11) DEFAULT '0' COMMENT '已生成的静态分红数',
  `deal_dt` int(11) DEFAULT '0' COMMENT '已生成的动态分红数',
  `createdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='每天分红核对';

-- ----------------------------
-- Records of sys_fh_verify
-- ----------------------------
INSERT INTO `sys_fh_verify` VALUES ('1', '1', '1', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('2', '1', '1', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('3', '1', '1', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('4', '1', '1', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('5', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('6', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('7', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('8', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('9', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('10', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('11', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('12', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('13', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('14', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('15', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('16', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('17', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('18', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('19', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('20', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('21', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('22', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('23', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('24', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('25', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('26', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('27', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('28', '1', '0', '0', '1524412800');
INSERT INTO `sys_fh_verify` VALUES ('29', '1', '0', '0', '1524412800');

-- ----------------------------
-- Table structure for sys_jtfh
-- ----------------------------
DROP TABLE IF EXISTS `sys_jtfh`;
CREATE TABLE `sys_jtfh` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `minnum` int(8) DEFAULT NULL,
  `maxnum` int(8) DEFAULT NULL,
  `bl` decimal(6,4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='静态分红设置';

-- ----------------------------
-- Records of sys_jtfh
-- ----------------------------
INSERT INTO `sys_jtfh` VALUES ('1', '100', '500', '0.0012', '1');
INSERT INTO `sys_jtfh` VALUES ('2', '501', '1000', '0.0017', '1');
INSERT INTO `sys_jtfh` VALUES ('3', '1001', '3000', '0.0022', '1');
INSERT INTO `sys_jtfh` VALUES ('4', '3001', '5000', '0.0027', '1');
INSERT INTO `sys_jtfh` VALUES ('5', '5001', '10000', '0.0031', '1');
INSERT INTO `sys_jtfh` VALUES ('6', '10001', '30000', '0.0036', '1');
INSERT INTO `sys_jtfh` VALUES ('7', '30001', '50000', '0.0040', '0');
INSERT INTO `sys_jtfh` VALUES ('8', '50001', '100000', '0.0043', '0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `pid` int(6) DEFAULT '0',
  `username` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL COMMENT '电话',
  `password` char(32) DEFAULT NULL,
  `paypassword` char(32) DEFAULT NULL,
  `realname` varchar(30) DEFAULT NULL COMMENT '姓名',
  `idcard` varchar(18) DEFAULT NULL COMMENT '身份证号',
  `createdate` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1',
  `country` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `phone` (`phone`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '0', '15890143120', '15890143120', 'e10adc3949ba59abbe56e057f20f883e', '96e79218965eb72c92a549dd5a330112', '马帅', '123', '1524118586', '1', '中国', '河南', '郑州');
INSERT INTO `user` VALUES ('2', '1', '15890143121', '15890143121', 'e10adc3949ba59abbe56e057f20f883e', '96e79218965eb72c92a549dd5a330112', '马帅1', null, '1524118712', '1', null, null, null);
INSERT INTO `user` VALUES ('3', '1', '15890143122', '15890143122', 'e10adc3949ba59abbe56e057f20f883e', '96e79218965eb72c92a549dd5a330112', '马帅1', null, '1524118863', '1', null, null, null);
INSERT INTO `user` VALUES ('4', '1', '15890143124', '15890143124', 'e10adc3949ba59abbe56e057f20f883e', '96e79218965eb72c92a549dd5a330112', '马帅1', null, '1524118984', '1', null, null, null);
INSERT INTO `user` VALUES ('25', '1', '15890143125', '15890143125', 'e10adc3949ba59abbe56e057f20f883e', '96e79218965eb72c92a549dd5a330112', '马帅', null, '1524122672', '1', null, null, null);
INSERT INTO `user` VALUES ('26', '1', '15890143126', '15890143126', 'e10adc3949ba59abbe56e057f20f883e', '96e79218965eb72c92a549dd5a330112', '马帅', null, '1524122748', '1', null, null, null);
INSERT INTO `user` VALUES ('27', '1', '15890143123', '15890143123', '96e79218965eb72c92a549dd5a330112', '96e79218965eb72c92a549dd5a330112', '马帅', null, '1524122810', '1', null, null, null);

-- ----------------------------
-- Table structure for user_coin
-- ----------------------------
DROP TABLE IF EXISTS `user_coin`;
CREATE TABLE `user_coin` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `userid` int(6) DEFAULT NULL,
  `lth` decimal(15,4) unsigned DEFAULT '0.0000',
  `lthd` decimal(15,4) unsigned DEFAULT '0.0000',
  `lthb` varchar(100) DEFAULT '',
  `lthz` decimal(15,4) unsigned DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userid` (`userid`) USING BTREE,
  KEY `lthb` (`lthb`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_coin
-- ----------------------------
INSERT INTO `user_coin` VALUES ('1', '1', '0.0000', '0.0000', '', '0.0000');
INSERT INTO `user_coin` VALUES ('2', '2', '0.0000', '0.0000', '', '0.0000');
INSERT INTO `user_coin` VALUES ('3', '3', '0.0000', '0.0000', '', '0.0000');
INSERT INTO `user_coin` VALUES ('4', '4', '0.0000', '0.0000', '', '0.0000');
INSERT INTO `user_coin` VALUES ('25', '25', '0.0000', '0.0000', '', '0.0000');
INSERT INTO `user_coin` VALUES ('26', '26', '0.0000', '0.0000', '', '0.0000');
INSERT INTO `user_coin` VALUES ('27', '27', '100.4800', '0.0000', 'LetwDKRT2T3MkufRH7SYYHvt1VhCQX1dFi', '0.0000');

-- ----------------------------
-- Table structure for user_qianbao
-- ----------------------------
DROP TABLE IF EXISTS `user_qianbao`;
CREATE TABLE `user_qianbao` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `userid` int(6) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `createdate` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_qianbao
-- ----------------------------
INSERT INTO `user_qianbao` VALUES ('1', '27', '测试', 'LVLxXuzR7GtYaXAg7yBy4TvxXnSRDH6Ts8', null, '1');

-- ----------------------------
-- Table structure for user_zone
-- ----------------------------
DROP TABLE IF EXISTS `user_zone`;
CREATE TABLE `user_zone` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `userid` int(6) NOT NULL COMMENT '会员id',
  `ownid` int(6) DEFAULT '0' COMMENT '推荐人id',
  `pid` int(6) DEFAULT '0' COMMENT '节点人上级id ',
  `zone` tinyint(2) DEFAULT '0' COMMENT '1区  2区 0是顶级会员',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='会员分布\r\n';

-- ----------------------------
-- Records of user_zone
-- ----------------------------
INSERT INTO `user_zone` VALUES ('1', '1', '0', '0', '0');
INSERT INTO `user_zone` VALUES ('2', '2', '1', '1', '2');
INSERT INTO `user_zone` VALUES ('3', '3', '1', '1', '1');
INSERT INTO `user_zone` VALUES ('4', '4', '1', '3', '1');
INSERT INTO `user_zone` VALUES ('25', '25', '1', '2', '1');
INSERT INTO `user_zone` VALUES ('26', '26', '1', '25', '1');
INSERT INTO `user_zone` VALUES ('27', '27', '1', '4', '1');
