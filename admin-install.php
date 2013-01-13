<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

$sql = array();
$sql[] = "CREATE TABLE IF NOT EXISTS `' . $CI->db->dbprefix . '_donatello_category` (
  `category_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id_parent` bigint(20) NOT NULL DEFAULT '0',
  `category_name` varchar(255) DEFAULT '',
  `category_slug` varchar(255) DEFAULT '',
  PRIMARY KEY (`category_id`),
  KEY `category_slug` (`category_slug`),
  KEY `category_id_parent` (`category_id_parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
$sql[] = "CREATE TABLE IF NOT EXISTS `' . $CI->db->dbprefix . '_donatello_cat2obj` (
  `cat2obj_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `photo_id` bigint(20) NOT NULL DEFAULT '0',
  `category_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat2obj_id`),
  KEY `category_id` (`category_id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;"
$sql[] = "CREATE TABLE IF NOT EXISTS `' . $CI->db->dbprefix . 'donatello_photo` (
  `photo_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `photo_id_author` bigint(20) NOT NULL DEFAULT '1',
  `photo_description` longtext,
  `photo_hash` varchar(64),
  `photo_extension` varchar(5),
  `photo_date_upload` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`photo_id`),
  KEY `photo_date_upload` (`photo_date_upload`),
  KEY `photo_id_author` (`photo_id_author`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;"
$sql[] = "CREATE TABLE IF NOT EXISTS `' . $CI->db->dbprefix . '_donatello_tags` (
  `tag_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag_photo_id` bigint(20) NOT NULL DEFAULT '0',
  `tag_value` longtext,
  `tag_slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tag_id`),
  KEY `tag_photo_id` (`tag_photo_id`),
  KEY `tag_value` (`tag_value`(256))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
