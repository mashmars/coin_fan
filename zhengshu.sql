/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : zhengshu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-27 10:04:30
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
  `price` decimal(16,4) DEFAULT '1.0000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dd_user
-- ----------------------------
DROP TABLE IF EXISTS `dd_user`;
CREATE TABLE `dd_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `headimg` varchar(256) NOT NULL,
  `true_name` varchar(20) NOT NULL DEFAULT '',
  `cardno` varchar(20) NOT NULL,
  `login_name` varchar(255) DEFAULT '20',
  `login_pass` varchar(32) DEFAULT NULL,
  `birth` varchar(20) NOT NULL,
  `sub_time` int(11) NOT NULL,
  `subscribe` tinyint(4) NOT NULL,
  `default_addr` int(11) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `parent1` int(11) NOT NULL,
  `parent2` int(11) NOT NULL,
  `parent3` int(11) NOT NULL,
  `agent1` int(11) NOT NULL,
  `agent2` int(11) NOT NULL,
  `agent3` int(11) NOT NULL,
  `money` float(10,2) NOT NULL DEFAULT '0.00',
  `points` int(11) NOT NULL DEFAULT '0',
  `expense` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '累计佣金',
  `sales` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '销售额',
  `receive_total` float(10,2) NOT NULL DEFAULT '0.00',
  `assign_total` float(10,2) NOT NULL DEFAULT '0.00',
  `withdraw_total` float(10,2) NOT NULL DEFAULT '0.00',
  `dist` tinyint(4) NOT NULL COMMENT '是否有分销权限',
  `reward_streight` float(10,2) DEFAULT '0.00' COMMENT '直推奖',
  `reward_lazy` float(10,2) DEFAULT '0.00' COMMENT '懒人奖',
  `reward_static` float(10,2) DEFAULT '0.00' COMMENT '静态奖',
  `reward_yeji` float(10,2) DEFAULT '0.00' COMMENT '小区业绩奖',
  `coin_num` int(10) DEFAULT '0' COMMENT '币',
  `tuijian_str` text COMMENT '推荐图',
  `yeji_1` float(10,2) DEFAULT '0.00' COMMENT '一区业绩',
  `yeji_2` float(10,2) DEFAULT '0.00' COMMENT '二区业绩',
  `tuijian_level` int(11) DEFAULT '1' COMMENT '推荐网体深度',
  `pos` tinyint(1) DEFAULT '0' COMMENT '位置：0=左区，1=右区',
  `money_addr` varchar(200) NOT NULL DEFAULT '' COMMENT '钱包地址',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态：0=未激活，1=已经激活',
  `reg_user` int(11) NOT NULL DEFAULT '0' COMMENT '注册人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2575 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for mycz
-- ----------------------------
DROP TABLE IF EXISTS `mycz`;
CREATE TABLE `mycz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `num` decimal(16,4) DEFAULT NULL,
  `createdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mytransfer
-- ----------------------------
DROP TABLE IF EXISTS `mytransfer`;
CREATE TABLE `mytransfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `peerid` int(11) DEFAULT NULL COMMENT '对方userid',
  `num` decimal(10,4) DEFAULT NULL,
  `createdate` int(11) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='每天分红核对';

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
) ENGINE=InnoDB AUTO_INCREMENT=2577 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2425 DEFAULT CHARSET=utf8;

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
  KEY `pid` (`pid`),
  KEY `ownid` (`ownid`)
) ENGINE=InnoDB AUTO_INCREMENT=2425 DEFAULT CHARSET=utf8 COMMENT='会员分布\r\n';
