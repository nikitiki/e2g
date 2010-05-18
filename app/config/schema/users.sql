SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- --------------------------------------------------------
--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` tinyint(4) NOT NULL auto_increment,
  `twitter_id` int(11) NOT NULL,
  `screen_name` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `oauth_key` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `oauth_secret` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `img` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  `location` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `name` varchar(120) character set utf8 collate utf8_unicode_ci NOT NULL,
  `description` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `twitter_id` (`twitter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
