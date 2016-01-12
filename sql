ALTER table pre_comments add username varchar(255) not null comment '用户名';
ALTER table pre_comments add email varchar(255) not null comment '邮箱';

DROP TABLE IF EXISTS `pre_favorites`;
CREATE TABLE `pre_favorites` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `logid` int(11) unsigned NOT NULL,
  `classify` char(32) NOT NULL,
  `ip` char(16) NOT NULL,
  `ipInfo` char(255) NOT NULL,
  `cTime` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER table pre_comments add ip varchar(16) not null comment 'IP';
ALTER table pre_comments add ipInfo varchar(255) not null comment 'IP信息';

DROP TABLE IF EXISTS `pre_feedback`;
CREATE TABLE `pre_feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '意见反馈ID',
  `uid` int(10) unsigned NOT NULL COMMENT '作者ID',
  `contact` varchar(255) NOT NULL COMMENT '联系方式',
  `appinfo` varchar(255) NOT NULL COMMENT '软件信息',
  `sysinfo` varchar(255) NOT NULL COMMENT '系统信息',
  `content` varchar(255) NOT NULL COMMENT '意见内容',
  `type` varchar(8) NOT NULL COMMENT '软件类型',
  `ip` varchar(25) NOT NULL COMMENT 'IP',
  `cTime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `status` tinyint(3) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;