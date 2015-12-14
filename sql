
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
  `areaid` int(10) unsigned NOT NULL,
  `remote` varchar(255) NOT NULL,
  `comments` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `logid` (`logid`)
) ENGINE=MyISAM AUTO_INCREMENT=1215 DEFAULT CHARSET=utf8;

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


DROP TABLE IF EXISTS `pre_posts`;
CREATE TABLE `pre_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `colid` int(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `hits` int(11) NOT NULL,
  `cTime` int(11) NOT NULL,
  `updateTime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `top` tinyint(1) NOT NULL,
  `favors` int(11) unsigned NOT NULL,
  `lat` varchar(50) NOT NULL,
  `long` varchar(50) NOT NULL,
  `mapZoom` tinyint(3) NOT NULL,
  `sourceurl` varchar(255) NOT NULL,
  `sourceinfo` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `classify` tinyint(1) NOT NULL DEFAULT '1',
  `comments` int(10) NOT NULL,
  `platform` char(16) NOT NULL,
  `areaid` int(10) unsigned NOT NULL,
  `redirect` varchar(255) NOT NULL,
  `nearby` varchar(255) NOT NULL,
  `faceimg` int(10) NOT NULL,
  `favorite` int(10) unsigned NOT NULL,
  `tagids` varchar(255) NOT NULL COMMENT '标签组',
  `groupid` int(10) NOT NULL COMMENT '所属团队',
  PRIMARY KEY (`id`),
  KEY `hits` (`hits`),
  KEY `colid` (`colid`),
  KEY `areaid` (`areaid`),
  KEY `classify` (`classify`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=151832 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `pre_users`;
CREATE TABLE `pre_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `truename` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `register_ip` char(15) NOT NULL,
  `last_login_ip` char(15) NOT NULL,
  `register_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `login_count` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `email_status` tinyint(1) unsigned NOT NULL,
  `reputation` smallint(8) unsigned NOT NULL,
  `badge` smallint(8) unsigned NOT NULL,
  `posts` int(10) unsigned NOT NULL,
  `answers` int(10) unsigned NOT NULL,
  `tips` int(10) unsigned NOT NULL,
  `favors` int(10) unsigned NOT NULL,
  `fans` int(10) unsigned NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  `hits` int(10) NOT NULL,
  `extra` text NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '-1',
  `classify` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户分类',
  `areaid` int(10) NOT NULL COMMENT '所在地区',
  `avatar` varchar(255) NOT NULL COMMENT '用户头像',
  `creditStatus` tinyint(1) NOT NULL COMMENT '认证状态',
  `tagids` varchar(255) NOT NULL COMMENT '标签组',
  `content` varchar(255) NOT NULL COMMENT '个人简介',
  PRIMARY KEY (`id`),
  KEY `name` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=40978 DEFAULT CHARSET=utf8;