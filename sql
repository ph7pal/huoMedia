DROP TABLE IF EXISTS `pre_attachments`;
CREATE TABLE `pre_attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `logid` int(11) unsigned NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `fileDesc` varchar(255) NOT NULL,
  `classify` varchar(255) NOT NULL,
  `width` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `covered` tinyint(1) NOT NULL,
  `hits` int(11) unsigned NOT NULL,
  `cTime` int(11) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `favor` int(11) unsigned NOT NULL,
  `remote` varchar(255) NOT NULL,
  `comments` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `logid` (`logid`)
) ENGINE=MyISAM AUTO_INCREMENT=1215 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_comments
-- ----------------------------
DROP TABLE IF EXISTS `pre_comments`;
CREATE TABLE `pre_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `touid` int(11) unsigned NOT NULL,
  `logid` int(11) unsigned NOT NULL,
  `commentid` int(11) unsigned NOT NULL,
  `tocommentid` int(11) unsigned NOT NULL,
  `content` varchar(255) NOT NULL,
  `platform` char(16) NOT NULL,
  `classify` char(16) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `cTime` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `logid` (`logid`)
) ENGINE=MyISAM AUTO_INCREMENT=161570 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_feedback
-- ----------------------------
DROP TABLE IF EXISTS `pre_feedback`;
CREATE TABLE `pre_feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(15000) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cTime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `classify` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `appversion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `os` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `platform` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for pre_posts
-- ----------------------------
DROP TABLE IF EXISTS `pre_posts`;
CREATE TABLE `pre_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '作者ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '正文',
  `faceimg` int(10) NOT NULL COMMENT '封面图',
  `classify` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分类',
  `lat` varchar(50) NOT NULL COMMENT '纬度',
  `long` varchar(50) NOT NULL COMMENT '经度',
  `mapZoom` tinyint(3) NOT NULL COMMENT '地图缩放级别',
  `comments` int(10) NOT NULL COMMENT '评论数',
  `favors` int(11) unsigned NOT NULL COMMENT '点赞数',
  `favorite` int(10) unsigned NOT NULL COMMENT '收藏数',
  `top` tinyint(1) NOT NULL COMMENT '是否置顶',
  `hits` int(11) NOT NULL COMMENT '阅读数',
  `tagids` varchar(255) NOT NULL COMMENT '标签组',
  `status` tinyint(1) NOT NULL,
  `cTime` int(11) NOT NULL COMMENT '创建世界',
  `updateTime` int(11) NOT NULL COMMENT '最近更新时间',
  PRIMARY KEY (`id`),
  KEY `hits` (`hits`),
  KEY `classify` (`classify`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=151832 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_users
-- ----------------------------
DROP TABLE IF EXISTS `pre_users`;
CREATE TABLE `pre_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `truename` varchar(16) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `contact` varchar(255) NOT NULL COMMENT '联系方式',
  `avatar` varchar(255) NOT NULL COMMENT '用户头像',
  `content` text NOT NULL COMMENT '个人简介',
  `hits` int(10) NOT NULL COMMENT '点击次数',
  `sex` tinyint(1) NOT NULL COMMENT '性别',
  `isAdmin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否管理员',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `email` (`contact`)
) ENGINE=MyISAM AUTO_INCREMENT=40978 DEFAULT CHARSET=utf8;