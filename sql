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