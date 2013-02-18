SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `org_catorganization`;
CREATE TABLE `org_catorganization` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `registration_date` date NOT NULL,
  `address` text NOT NULL,
  `address_id` int(11) default NULL,
  `city_id` int(11) default NULL,
  `region_id` int(11) default NULL,
  `chief_fio` varchar(255) default NULL,
  `registration_num` varchar(128) default NULL,
  `phone` varchar(255) default NULL,
  `website` varchar(128) default NULL,
  `email` varchar(128) default NULL,
  `organization_id` int(11) default NULL,
  `is_legal` tinyint(1) default NULL,
  `action_area` int(11) default NULL,
  `directions_more` varchar(128) default NULL,
  `logo` varchar(128) default NULL,
  `is_branch` tinyint(1) default NULL,
  `branch_master` text,
  `is_verified` tinyint(1) default NULL,
  `word_name` text,
  `word_registration_date` text,
  `word_address` text,
  `word_city` text,
  `word_region` text,
  `word_contact` text,
  `word_contact_position` text,
  `word_is_legal` tinyint(1) default NULL,
  `word_is_branch` tinyint(1) default NULL,
  `word_branch_master` text,
  `word_registration_num` text,
  `word_description` text,
  `word_phone` text,
  PRIMARY KEY  (`id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
