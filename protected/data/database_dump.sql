-- MySQL dump 10.13  Distrib 5.5.28, for Linux (x86_64)
--
-- Host: localhost    Database: socio
-- ------------------------------------------------------
-- Server version	5.5.28-log

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

--
-- Table structure for table `org_album`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_album`
--

LOCK TABLES `org_album` WRITE;
/*!40000 ALTER TABLE `org_album` DISABLE KEYS */;
INSERT INTO `org_album` VALUES (1,'Кошки',1),(3,'Альбом другой орг',6),(4,'Альбом Котов',1);
/*!40000 ALTER TABLE `org_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_album_image`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_album_image`
--

LOCK TABLES `org_album_image` WRITE;
/*!40000 ALTER TABLE `org_album_image` DISABLE KEYS */;
INSERT INTO `org_album_image` VALUES (12,4,8,'Другой кот'),(39,4,11,'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod\r\ntempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,\r\nno sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n'),(44,1,11,'sdfsdfs dfsdfsd'),(45,1,12,'sdfsdfsdf sdfsd'),(46,1,4,'sdfsd sdf');
/*!40000 ALTER TABLE `org_album_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_announcement`
--

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
  `files` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `org_announcement_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_announcement`
--

LOCK TABLES `org_announcement` WRITE;
/*!40000 ALTER TABLE `org_announcement` DISABLE KEYS */;
INSERT INTO `org_announcement` VALUES (1,'Первая новость','<p><strike>Lorem ipsum dolor</strike> sit amet, consetetur sadipsci<span style=\"background-color:rgb(146,205,220);\">ng elitr, sed diam nonumy eirmod\ntempor invidunt ut <i>labore et dolore</i> magna aliquyam e</span>rat, sed diam voluptua. At\nvero eos et accusam et justo <i>duo dolores et ea rebum. </i>Stet clita kasd gubergren,\nno sea takimata sanctus es<br /><br />\n\nsdf dsfsdf sdfsdffsdfsdfsdfsdf\n</p><p><img style=\"width:217.036px;height:207px;float:left;margin:0px 10px 10px 0px;\" alt=\"\" src=\"/socio-org/uploads/announcement/files/50966002c2a3a.jpg\" /></p>\n\n<p>The domestic cat[1][2] (Felis catus[2] or Felis silvestris catus[4]) is a small, usually <b>furry, domesticated</b>, carnivorous mammal. It is often called the housecat when kept as an indoor pet,[6] or simply the cat when there is no need to distinguish it from other felids and felines. Cats are valued by humans for companionship and ability to hunt vermin and household pests.</p>\n\n<p> C<img style=\"width:209.684px;height:166px;float:right;margin:0px 0px 10px 10px;\" alt=\"\" src=\"http://localhost/socio-org/uploads/announcement/files/5096603e3a9d5.jpg\" />ats are similar in anatomy to the other felids, with strong, flexible bodies, quick reflexes, sharp retractable claws, and teeth adapted to killing small prey. Cat senses fit a crepuscular and predatory ecological niche. Cats can hear sounds too faint or too high in frequency for human ears, such as those made by mice and other small game. They can see in near darkness. Like most mammals, cats have poorer color vision and a better sense of smell than humans.<br /></p>\n\n<p><br />\n\nDespite being solitary hunters, cats are a social species, and cat communication includes the use of a variety of vocalizations (meowing, purring, trilling, hissing, growling and grunting) as well as pheromones and types of cat-specific body language.[7] </p><p><img style=\"width:313.333px;height:235px;\" src=\"http://localhost/socio-org/uploads/image/file/509bb626ea826.jpg\" alt=\"509bb626ea826.jpg\" /></p><p><br /></p>\n','2012-11-03 03:13:17','2012-11-03 19:19:23',1,1,1,'50966002c2a3a.jpg,5096603e3a9d5.jpg,50966081e08b8.jpg,509661285fda4.js,509665b6c8d91.htm',1),(2,'Без файлов','На основании данных, полученных современной филогенетикой, домашняя кошка является одним из пяти.','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(3,'Ещё Новость','На основании данных, полученных современной филогенетикой, домашняя кошка является одним из пяти[22] подвидов дикой кошки Felis silvestris, и её правильное международное научное название — Felis silvestris catus[5][23]. ','2012-11-04 15:20:51','2012-11-04 15:20:44',1,1,1,'50966bb36a767.js,50966e27e36b7.jpeg',1),(4,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(6,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(7,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(8,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(10,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(11,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(12,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(13,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(14,'НОвая новость!','sdfsdf','2012-11-05 12:00:33','2012-11-05 12:00:30',1,1,1,'',1),(15,'sdfsdf !','sdfsdf','2012-11-05 12:01:32','2012-11-05 12:01:30',1,6,1,'',1);
/*!40000 ALTER TABLE `org_announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_event`
--

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
  CONSTRAINT `org_event_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `org_event_type` (`id`) ON DELETE SET NULL,
  CONSTRAINT `org_event_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_event`
--

LOCK TABLES `org_event` WRITE;
/*!40000 ALTER TABLE `org_event` DISABLE KEYS */;
INSERT INTO `org_event` VALUES (1,1,1,'Мероприятие с обычным типом',1,5,'','2012-11-19 10:35:57','2012-11-19 10:35:43','2012-11-19 10:35:43',1,NULL,'','','<p>Некоторые специалисты считают, что кошачье поведение находится в состоянии перехода от независимости к взаимозависимости. Действительно, каждый из нас не раз наблюдал, как кошка радостно встречает вечером отсутствовавших хозяев, всячески жемонстрируя, что она соскучилась и не прочь получить изрядный кус вашего внимания. На самом деле личность кошки и ее последующее социальное поведение во многом определяются ее ранним опытом, а также зависит от плотности популяции и количества пищи. <br /></p>',1,0),(2,1,1,'Мероприятие с кастомным типом',2,2,'Мой кастом тип','2012-11-19 10:41:51','2012-11-19 10:00:00','2012-11-19 10:00:00',23,NULL,'','','Lorem <strike>ipsum dolor sit amet, consetetur</strike> sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',2,0);
/*!40000 ALTER TABLE `org_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_event_type`
--

DROP TABLE IF EXISTS `org_event_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_event_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `category` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_event_type`
--

LOCK TABLES `org_event_type` WRITE;
/*!40000 ALTER TABLE `org_event_type` DISABLE KEYS */;
INSERT INTO `org_event_type` VALUES (1,'Другой...',1,999),(2,'Другой...',2,999),(3,'Другой...',3,999),(4,'Какой-то тип',1,1),(5,'Ещё тип',1,2);
/*!40000 ALTER TABLE `org_event_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_image`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_image`
--

LOCK TABLES `org_image` WRITE;
/*!40000 ALTER TABLE `org_image` DISABLE KEYS */;
INSERT INTO `org_image` VALUES (1,'5098faf1854e9.jpg','2012-11-06 13:56:33',1),(2,'5098fb961c218.jpg','2012-11-06 13:59:18',1),(3,'50990331c1fe6.jpg','2012-11-06 14:31:45',1),(4,'509bb57b291c9.gif','2012-11-06 14:36:28',1),(5,'509bb58a2019c.jpg','2012-11-06 15:20:18',1),(6,'509bb59b35fcc.jpg','2012-11-06 15:20:28',1),(7,'509bb5aac0df5.jpg','2012-11-06 15:21:31',1),(8,'509bb5f4795e9.jpg','2012-11-06 15:23:38',1),(9,'509bb606b10db.jpg','2012-11-06 15:24:40',1),(10,'509bb61b5cf12.jpg','2012-11-06 15:24:51',1),(11,'509bb626ea826.jpg','2012-11-06 15:25:03',1),(12,'50a10241b6e3d.jpg','2012-11-12 16:05:53',1),(13,'50a2064d04355.jpg','2012-11-13 10:35:25',1),(14,'50a207d911908.jpg','2012-11-13 10:42:01',1);
/*!40000 ALTER TABLE `org_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_lookup`
--

DROP TABLE IF EXISTS `org_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_lookup`
--

LOCK TABLES `org_lookup` WRITE;
/*!40000 ALTER TABLE `org_lookup` DISABLE KEYS */;
INSERT INTO `org_lookup` VALUES (6,'Неформальная',1,'OrganizationType',1),(7,'Коммерческая',2,'OrganizationType',2),(8,'Некоммерческая',3,'OrganizationType',3),(9,'Государство',1,'OrganizationActionArea',1),(10,'Область',2,'OrganizationActionArea',2),(11,'Район',3,'OrganizationActionArea',3),(12,'Город',4,'OrganizationActionArea',4),(13,'Активна',1,'OrganizationStatus',1),(14,'Неактивна',2,'OrganizationStatus',2),(15,'Модерируется',3,'OrganizationStatus',3),(18,'Foo',1,'OrganizationDirection',1),(19,'Bar',2,'OrganizationDirection',2),(20,'Baz',3,'OrganizationDirection',3),(21,'Some',1,'ProblemGroup',1),(22,'Anoter',2,'ProblemGroup',2),(23,'Onemore',3,'ProblemGroup',3),(24,'Активен',1,'AnnouncementStatus',1),(25,'Неактивен',2,'AnnouncementStatus',2),(26,'Общие',1,'AnnouncementCategory',1),(27,'Гранты',2,'AnnouncementCategory',2),(28,'Ещё что-то',3,'AnnouncementCategory',3),(29,'Активен',1,'EventStatus',1),(30,'Неактивен',2,'EventStatus',2),(31,'Организационные',1,'EventCategory',1),(32,'Внутренние',2,'EventCategory',2),(33,'Публичные',3,'EventCategory',3);
/*!40000 ALTER TABLE `org_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_organization`
--

DROP TABLE IF EXISTS `org_organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `action_area` int(11) NOT NULL,
  `direction` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `problem` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
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
  `author_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_organization`
--

LOCK TABLES `org_organization` WRITE;
/*!40000 ALTER TABLE `org_organization` DISABLE KEYS */;
INSERT INTO `org_organization` VALUES (1,'Лаберж ОС',2,4,'1,2,3','1,2,5',12,6,2010,560,'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod\r\ntempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,\r\nno sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n','Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor amet.\r\nStet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor amet.\r\nStet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor amet.\r\nStet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor amet.\r\nStet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor amet.\r\n','http://github.com','097-79-13-702','example@example.com','508fa2ed475ca.jpg',1,'2012-11-03 06:15:21',1,1),(6,'Корв ВС',1,2,'','',NULL,NULL,NULL,NULL,'','','','','','508fa2fe77003.png',2,'2012-11-03 07:19:16',1,0),(7,'sdfsdf',2,2,'','',NULL,NULL,NULL,NULL,'','','','','','placeholder.jpg',3,'2012-11-03 07:21:20',3,0),(8,'sdfsdf',2,1,'','',NULL,NULL,NULL,NULL,'','','','','','placeholder.jpg',4,'2012-11-03 06:17:19',3,0),(9,'names',3,2,'','',NULL,NULL,NULL,NULL,'','','','','','placeholder.jpg',5,'2012-11-03 18:11:06',3,0),(10,'new one',1,2,'','',NULL,NULL,NULL,NULL,'','','','','','placeholder.jpg',6,'2012-11-03 19:17:55',3,0);
/*!40000 ALTER TABLE `org_organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_problem`
--

DROP TABLE IF EXISTS `org_problem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_problem`
--

LOCK TABLES `org_problem` WRITE;
/*!40000 ALTER TABLE `org_problem` DISABLE KEYS */;
INSERT INTO `org_problem` VALUES (1,1,'Item for grop one'),(2,1,'Anoter for one'),(3,2,'Item for second'),(4,1,'And more'),(5,2,'And more 2'),(6,3,'And more 3');
/*!40000 ALTER TABLE `org_problem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_verification`
--

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

--
-- Dumping data for table `org_verification`
--

LOCK TABLES `org_verification` WRITE;
/*!40000 ALTER TABLE `org_verification` DISABLE KEYS */;
/*!40000 ALTER TABLE `org_verification` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-20 13:59:53
