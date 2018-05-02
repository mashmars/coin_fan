/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : zhengshu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-05-02 14:02:27
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for admin_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_group`;
CREATE TABLE `admin_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for admin_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_group_access`;
CREATE TABLE `admin_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for admin_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_rule`;
CREATE TABLE `admin_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(6) DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `controller` varchar(100) DEFAULT NULL COMMENT '控制器',
  `action` varchar(100) DEFAULT NULL COMMENT '方法',
  `cengji` char(1) DEFAULT '1' COMMENT '菜单层级',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

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
  `price` decimal(16,4) NOT NULL DEFAULT '1.0000',
  `zc_fee` varchar(5) DEFAULT '0' COMMENT '转出手续费',
  `zz_fee` varchar(5) DEFAULT '0' COMMENT '转账手续费',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mytransfer
-- ----------------------------
DROP TABLE IF EXISTS `mytransfer`;
CREATE TABLE `mytransfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `peerid` int(11) DEFAULT NULL COMMENT '对方userid',
  `mum` decimal(16,4) DEFAULT NULL,
  `num` decimal(16,4) DEFAULT NULL,
  `fee` decimal(10,4) DEFAULT NULL,
  `createdate` int(11) DEFAULT NULL,
  `realname` varchar(30) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for myzc
-- ----------------------------
DROP TABLE IF EXISTS `myzc`;
CREATE TABLE `myzc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(6) NOT NULL,
  `address` varchar(100) DEFAULT NULL COMMENT '转出地址',
  `txid` varchar(200) DEFAULT NULL,
  `mum` decimal(16,4) DEFAULT NULL COMMENT '总数量',
  `fee` decimal(10,4) DEFAULT '0.0000' COMMENT '手续费',
  `num` decimal(16,4) DEFAULT '0.0000' COMMENT '真实数量',
  `createdate` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0未到账 1到账 2是拒绝',
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `address` (`address`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='动态分红设置';

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
) ENGINE=InnoDB AUTO_INCREMENT=1677 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='静态分红设置';

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
  `finance_status` tinyint(2) DEFAULT '1' COMMENT '财务状态 提币和转账 1可以 0不可以',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `phone` (`phone`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2825 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2673 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2673 DEFAULT CHARSET=utf8 COMMENT='会员分布\r\n';
