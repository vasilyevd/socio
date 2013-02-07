
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `org_achievement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_achievement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `organization_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `org_achievement_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `organization_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `org_album_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_album_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_album_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`album_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `org_album_image_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `org_album` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_album_image_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `org_image` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_annfile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_annfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `announcement_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `massmedia_id` (`announcement_id`),
  CONSTRAINT `org_annfile_ibfk_1` FOREIGN KEY (`announcement_id`) REFERENCES `org_announcement` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `publication_time` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `org_announcement_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_catorganization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_catorganization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `registration_date` date NOT NULL,
  `address` text NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `chief_fio` varchar(128) DEFAULT NULL,
  `registration_num` varchar(128) DEFAULT NULL,
  `phone` varchar(128) DEFAULT NULL,
  `website` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `is_legal` tinyint(1) DEFAULT NULL,
  `action_area` int(11) DEFAULT NULL,
  `directions_more` varchar(128) DEFAULT NULL,
  `logo` varchar(128) DEFAULT NULL,
  `is_branch` tinyint(1) DEFAULT NULL,
  `branch_master` varchar(128) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT NULL,
  `word_name` text,
  `word_registration_date` text,
  `word_address` text,
  `word_city` text,
  `word_region` text,
  `word_contact` text,
  `word_contact_position` text,
  `word_is_legal` tinyint(1) DEFAULT NULL,
  `word_is_branch` tinyint(1) DEFAULT NULL,
  `word_branch_master` text,
  `word_registration_num` text,
  `word_description` text,
  `word_phone` text,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `org_catorganization_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_catorganization_direction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_catorganization_direction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catorganization_id` int(11) NOT NULL,
  `direction_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`catorganization_id`),
  KEY `image_id` (`direction_id`),
  CONSTRAINT `org_catorganization_direction_ibfk_1` FOREIGN KEY (`catorganization_id`) REFERENCES `org_catorganization` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_catorganization_direction_ibfk_2` FOREIGN KEY (`direction_id`) REFERENCES `org_direction` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text NOT NULL,
  `organization_id` int(11) NOT NULL,
  `min_date` date NOT NULL,
  `max_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `org_company_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_cooperation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_cooperation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(128) NOT NULL,
  `link_organization_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `create_time` datetime NOT NULL,
  `organization_id` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `logo` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `contact_name` varchar(128) DEFAULT NULL,
  `website` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  KEY `organization_id_2` (`organization_id`),
  KEY `link_organization_id` (`link_organization_id`),
  CONSTRAINT `org_cooperation_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_cooperation_ibfk_2` FOREIGN KEY (`link_organization_id`) REFERENCES `org_organization` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_direction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_direction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_docauthor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_docauthor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_doctype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_doctype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `doc_date` date NOT NULL,
  `geography` int(11) NOT NULL,
  `registration_num` varchar(128) DEFAULT NULL,
  `docauthor_id` int(11) DEFAULT NULL,
  `doctype_id` int(11) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `docauthor_id` (`docauthor_id`),
  KEY `doctype_id` (`doctype_id`),
  CONSTRAINT `org_document_ibfk_1` FOREIGN KEY (`docauthor_id`) REFERENCES `org_docauthor` (`id`) ON DELETE SET NULL,
  CONSTRAINT `org_document_ibfk_2` FOREIGN KEY (`doctype_id`) REFERENCES `org_doctype` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_donor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_donor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `country` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `source` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_donorship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_donorship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donor_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `create_time` datetime NOT NULL,
  `organization_id` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `delivery_year` int(11) NOT NULL,
  `funds` int(11) NOT NULL,
  `funds_specific` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  KEY `organization_id_2` (`organization_id`),
  KEY `donor_id` (`donor_id`),
  CONSTRAINT `org_donorship_ibfk_2` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_donorship_ibfk_5` FOREIGN KEY (`donor_id`) REFERENCES `org_donor` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `category` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `type_other` varchar(128) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `address_other` varchar(128) DEFAULT NULL,
  `address_description` text,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `invite_closed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `org_event_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_event_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `org_evtype` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_evtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_evtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `category` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_govorganization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_govorganization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type_group` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `action_area` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `foundation_year` int(11) DEFAULT NULL,
  `staff_size` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `goal` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `website` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_num` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `logobg` varchar(128) DEFAULT NULL,
  `logobgset` varchar(128) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `org_govorganization_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `org_orgtype` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_govprofile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_govprofile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `org_govprofile_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_govorganization` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_govprofile_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `org_govorganization` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(128) NOT NULL,
  `create_time` datetime NOT NULL,
  `organization_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `org_image_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `type` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_massmedia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_massmedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `direction` tinyint(1) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `organization_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  KEY `organization_id_2` (`organization_id`),
  KEY `mmcompany_id` (`company_id`),
  CONSTRAINT `org_massmedia_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_massmedia_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `org_company` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_massmedia_mmtag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_massmedia_mmtag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `massmedia_id` int(11) NOT NULL,
  `mmtag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`massmedia_id`),
  KEY `image_id` (`mmtag_id`),
  CONSTRAINT `org_massmedia_mmtag_ibfk_1` FOREIGN KEY (`massmedia_id`) REFERENCES `org_massmedia` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_massmedia_mmtag_ibfk_2` FOREIGN KEY (`mmtag_id`) REFERENCES `org_mmtag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_mmfile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_mmfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `type` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `preview` tinyint(1) NOT NULL,
  `massmedia_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `massmedia_id` (`massmedia_id`),
  CONSTRAINT `org_mmfile_ibfk_1` FOREIGN KEY (`massmedia_id`) REFERENCES `org_massmedia` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_mmlink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_mmlink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `type` int(11) NOT NULL,
  `massmedia_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `massmedia_id` (`massmedia_id`),
  CONSTRAINT `org_mmlink_ibfk_1` FOREIGN KEY (`massmedia_id`) REFERENCES `org_massmedia` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_mmtag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_mmtag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type_group` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `action_area` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `foundation_year` int(11) DEFAULT NULL,
  `staff_size` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `goal` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `website` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_num` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `logobg` varchar(128) DEFAULT NULL,
  `logobgset` varchar(128) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `org_organization_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `org_orgtype` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_organization_direction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_organization_direction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `direction_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`organization_id`),
  KEY `image_id` (`direction_id`),
  CONSTRAINT `org_organization_direction_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_organization_direction_ibfk_2` FOREIGN KEY (`direction_id`) REFERENCES `org_direction` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_organization_problem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_organization_problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`organization_id`),
  KEY `image_id` (`problem_id`),
  CONSTRAINT `org_organization_problem_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_organization_problem_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `org_problem` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_orgtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_orgtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_partfile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_partfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `partnership_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `massmedia_id` (`partnership_id`),
  CONSTRAINT `org_partfile_ibfk_1` FOREIGN KEY (`partnership_id`) REFERENCES `org_partnership` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_partnership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_partnership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(128) NOT NULL,
  `link_organization_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `create_time` datetime NOT NULL,
  `organization_id` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `logo` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `contact_name` varchar(128) DEFAULT NULL,
  `website` varchar(128) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL,
  `verification_description` text,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  KEY `organization_id_2` (`organization_id`),
  KEY `link_organization_id` (`link_organization_id`),
  CONSTRAINT `org_partnership_ibfk_1` FOREIGN KEY (`link_organization_id`) REFERENCES `org_organization` (`id`) ON DELETE SET NULL,
  CONSTRAINT `org_partnership_ibfk_2` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_problem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(128) NOT NULL,
  `link_organization_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `create_time` datetime NOT NULL,
  `organization_id` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `logo` varchar(128) DEFAULT NULL,
  `delivery_year` int(11) NOT NULL,
  `funds` int(11) NOT NULL,
  `funds_specific` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  KEY `organization_id_2` (`organization_id`),
  KEY `link_organization_id` (`link_organization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `org_verification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `documents` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone_num` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `org_verification_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

