/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : zhengshu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-22 21:49:37
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
INSERT INTO `admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '127.0.0.1', '1524354007', '超级管理员');

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
-- Table structure for field_control
-- ----------------------------
DROP TABLE IF EXISTS `field_control`;
CREATE TABLE `field_control` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT '字段',
  `fieldname` varchar(10) DEFAULT NULL COMMENT '字段名称',
  `descript` varchar(30) DEFAULT NULL COMMENT '字段描述',
  `is_show` char(1) DEFAULT '1' COMMENT '是否显示',
  `owner` varchar(20) DEFAULT NULL COMMENT '所属表',
  `sort` int(2) DEFAULT '50' COMMENT '排序显示顺序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of field_control
-- ----------------------------
INSERT INTO `field_control` VALUES ('1', 'realname', '姓名', '1', 'users', '10');
INSERT INTO `field_control` VALUES ('2', 'sex', '性别', '1', 'users', '20');
INSERT INTO `field_control` VALUES ('3', 'csrq', '出生日期', '0', 'users', '30');
INSERT INTO `field_control` VALUES ('4', 'zw', '职务', '0', 'users', '40');
INSERT INTO `field_control` VALUES ('5', 'phone', '电话', '0', 'users', '50');
INSERT INTO `field_control` VALUES ('6', 'xl', '学历', '0', 'users', '60');
INSERT INTO `field_control` VALUES ('7', 'idcard', '身份证号', '1', 'users', '70');
INSERT INTO `field_control` VALUES ('8', 'txdz', '通讯地址', '0', 'users', '80');
INSERT INTO `field_control` VALUES ('9', 'zsmc', '证书类型', '1', 'users_zhengshu', '10');
INSERT INTO `field_control` VALUES ('10', 'zsbh', '证书编号', '1', 'users_zhengshu', '20');
INSERT INTO `field_control` VALUES ('11', 'jibie', '级别', '1', 'users_zhengshu', '30');
INSERT INTO `field_control` VALUES ('12', 'zhcj', '综合成绩', '1', 'users_zhengshu', '40');
INSERT INTO `field_control` VALUES ('13', 'fzrq', '发证日期', '1', 'users_zhengshu', '70');
INSERT INTO `field_control` VALUES ('14', 'llzscj', '理论知识成绩', '1', 'users_zhengshu', '50');
INSERT INTO `field_control` VALUES ('15', 'czjncj', '操作技能成绩', '1', 'users_zhengshu', '60');
INSERT INTO `field_control` VALUES ('16', 'zczbh', '注册证编号', '1', 'users_reg', '10');
INSERT INTO `field_control` VALUES ('17', 'qfrq', '签发日期', '1', 'users_reg', '20');
INSERT INTO `field_control` VALUES ('18', 'zcyxq', '注册有效期', '1', 'users_reg', '30');
INSERT INTO `field_control` VALUES ('19', 'gzdw1', '工作单位1', '0', 'users_reg', '40');
INSERT INTO `field_control` VALUES ('20', 'gzdw2', '工作单位2', '0', 'users_reg', '50');
INSERT INTO `field_control` VALUES ('21', 'gzdw3', '工作单位3', '0', 'users_reg', '60');
INSERT INTO `field_control` VALUES ('22', 'gzdw4', '工作单位4', '0', 'users_reg', '70');
INSERT INTO `field_control` VALUES ('23', 'gzdw5', '工作单位5', '0', 'users_reg', '80');
INSERT INTO `field_control` VALUES ('24', 'gzdw6', '工作单位6', '0', 'users_reg', '90');
INSERT INTO `field_control` VALUES ('25', 'gzdw7', '工作单位7', '0', 'users_reg', '100');
INSERT INTO `field_control` VALUES ('26', 'gzdw8', '工作单位8', '0', 'users_reg', '110');
INSERT INTO `field_control` VALUES ('27', 'gzdw9', '工作单位9', '0', 'users_reg', '120');
INSERT INTO `field_control` VALUES ('28', 'gzdw10', '工作单位10', '0', 'users_reg', '130');
INSERT INTO `field_control` VALUES ('29', 'id', '序号', '0', 'users', '0');
INSERT INTO `field_control` VALUES ('30', 'id', '序号', '0', 'users_zhengshu', '0');
INSERT INTO `field_control` VALUES ('31', 'pxjg', '培训机构', '0', 'users_zhengshu', '80');
INSERT INTO `field_control` VALUES ('32', 'fzjg', '发证机构', '1', 'users_zhengshu', '90');

-- ----------------------------
-- Table structure for job
-- ----------------------------
DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `phone` varchar(18) DEFAULT NULL,
  `gangwei` varchar(100) DEFAULT NULL,
  `createdate` char(10) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of job
-- ----------------------------
INSERT INTO `job` VALUES ('1', 'mash', '1589014', 'php', '1507347266', '1');

-- ----------------------------
-- Table structure for myzc
-- ----------------------------
DROP TABLE IF EXISTS `myzc`;
CREATE TABLE `myzc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL COMMENT '转出地址',
  `txid` varchar(200) DEFAULT NULL,
  `num` decimal(16,4) DEFAULT NULL,
  `createdate` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0未到账 1到账',
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of myzc
-- ----------------------------
INSERT INTO `myzc` VALUES ('1', '27', 'LVLxXuzR7GtYaXAg7yBy4TvxXnSRDH6Ts8', null, '11.0000', '1524206735', '0', null);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of myzr
-- ----------------------------

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `createdate` char(10) DEFAULT NULL,
  `is_show` char(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
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
) ENGINE=InnoDb AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='动态分红设置';

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDb DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_fh_log
-- ----------------------------

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
) ENGINE=InnoDb DEFAULT CHARSET=utf8 COMMENT='每天分红核对';

-- ----------------------------
-- Records of sys_fh_verify
-- ----------------------------

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
) ENGINE=InnoDb AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='静态分红设置';

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
  UNIQUE KEY `userid` (`userid`) USING BTREE
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
INSERT INTO `user_coin` VALUES ('27', '27', '89.0000', '11.0000', 'LetwDKRT2T3MkufRH7SYYHvt1VhCQX1dFi', '0.0000');

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
  PRIMARY KEY (`id`)
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
