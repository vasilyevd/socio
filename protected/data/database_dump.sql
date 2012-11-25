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
INSERT INTO `org_announcement` VALUES (1,'Первая новость','<p></p><p><strike>Lorem ipsum dolor</strike> sit amet, consetetur sadipsci<span style=\"background-color:rgb(146,205,220);\">ng elitr, sed diam nonumy eirmod\ntempor invidunt ut <i>labore et dolore</i> magna aliquyam e</span>rat, sed diam voluptua. At\nvero eos et accusam et justo <i>duo dolores et ea rebum. </i>Stet clita kasd gubergren,\nno sea takimata sanctus es<br /><br />\n\nsdf dsfsdf sdfsdffsdfsdfsdfsdf\n</p><p></p>\n\n<p><img style=\"width:237.379px;height:225px;float:left;margin:0px 10px 10px 0px;\" alt=\"\" src=\"/socio/uploads/image/file/50a10241b6e3d.jpg\" />The domestic cat[1][2] (Felis catus[2] or Felis silvestris catus[4]) is a small, usually <b>furry, domesticated</b>, carnivorous mammal. It is often called the housecat when kept as an indoor pet,[6] or simply the cat when there is no need to distinguish it from other felids and felines. Cats are valued by humans for companionship and ability to hunt vermin and household pests.</p>\n\n<p> Cats are similar in anatomy to the other felids, with strong, flexible bodies, quick reflexes, sharp retractable claws, and teeth adapted to killing small prey. Cat senses fit a crepuscular and predatory ecological niche. Cats can hear sounds too faint or too high in frequency for human ears, such as those made by mice and other small game. They can see in near darkness. Like most mammals, cats have poorer color vision and a better sense of smell than humans.<br /></p>\n\n<p><br />\n\nDespite being solitary hunters, cats are a social species, and cat communication includes the use of a variety of vocalizations (meowing, purring, trilling, hissing, growling and grunting) as well as pheromones and types of cat-specific body language.[7] </p><p><img style=\"width:313.333px;height:235px;\" src=\"http://localhost/socio-org/uploads/image/file/509bb626ea826.jpg\" alt=\"509bb626ea826.jpg\" /></p><p><br /></p>\n','2012-11-03 03:13:17','2012-11-03 19:19:23',1,1,1,'509661285fda4.js,509665b6c8d91.htm',1),(2,'Без файлов','На основании данных, полученных современной филогенетикой, домашняя кошка является одним из пяти.','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(3,'Ещё Новость','На основании данных, полученных современной филогенетикой, домашняя кошка является одним из пяти[22] подвидов дикой кошки Felis silvestris, и её правильное международное научное название — Felis silvestris catus[5][23]. ','2012-11-04 15:20:51','2012-11-04 15:20:44',1,1,1,'50966bb36a767.js',1),(4,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(6,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(7,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(8,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(10,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(11,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(12,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(13,'Без файлов','sdfsdfsdf','2012-11-03 18:06:19','2012-11-03 18:06:10',1,1,1,'',1),(14,'НОвая новость!','sdfsdf','2012-11-05 12:00:33','2012-11-05 12:00:30',1,1,1,'',1),(15,'sdfsdf !','sdfsdf','2012-11-05 12:01:32','2012-11-05 12:01:30',1,6,1,'',1);
/*!40000 ALTER TABLE `org_announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_direction`
--

DROP TABLE IF EXISTS `org_direction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_direction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_direction`
--

LOCK TABLES `org_direction` WRITE;
/*!40000 ALTER TABLE `org_direction` DISABLE KEYS */;
INSERT INTO `org_direction` VALUES (1,'Религия'),(2,'Благотворительность'),(3,'Политика'),(4,'Здоровье'),(5,'Спорт'),(6,'Аналитика'),(7,'Право'),(8,'Культура'),(9,'Молодежь'),(10,'Экология'),(11,'Волонтерство'),(12,'Донорство'),(13,'Образование'),(14,'Развитие общества'),(15,'СМИ'),(16,'Евроинтеграция');
/*!40000 ALTER TABLE `org_direction` ENABLE KEYS */;
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
  CONSTRAINT `org_event_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `org_evtype` (`id`) ON DELETE SET NULL,
  CONSTRAINT `org_event_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_event`
--

LOCK TABLES `org_event` WRITE;
/*!40000 ALTER TABLE `org_event` DISABLE KEYS */;
INSERT INTO `org_event` VALUES (1,1,1,'Мероприятие с обычным типом',1,4,'','2012-11-19 10:35:57','2012-11-19 10:35:43','2012-11-19 10:35:43',1,NULL,'','','<p>Некоторые специалисты считают, что кошачье поведение находится в состоянии перехода от независимости к взаимозависимости. Действительно, каждый из нас не раз наблюдал, как кошка радостно встречает вечером отсутствовавших хозяев, всячески жемонстрируя, что она соскучилась и не прочь получить изрядный кус вашего внимания. На самом деле личность кошки и ее последующее социальное поведение во многом определяются ее ранним опытом, а также зависит от плотности популяции и количества пищи. <br /></p>',1,0),(2,1,1,'Мероприятие с кастомным типом',2,2,'Мой кастом тип','2012-11-19 10:41:51','2012-11-19 10:00:00','2012-11-19 10:00:00',23,NULL,'','','Lorem <strike>ipsum dolor sit amet, consetetur</strike> sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',2,0),(3,1,1,'Новое мероприятие',1,4,'','2012-11-22 11:41:03','2012-11-22 11:40:56','2012-11-22 11:40:56',43,NULL,'','','<p> sdf sdfsdfsdf<br /></p>',1,0);
/*!40000 ALTER TABLE `org_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_evtype`
--

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

--
-- Dumping data for table `org_evtype`
--

LOCK TABLES `org_evtype` WRITE;
/*!40000 ALTER TABLE `org_evtype` DISABLE KEYS */;
INSERT INTO `org_evtype` VALUES (1,'Другой...',1,999),(2,'Другой...',2,999),(3,'Другой...',3,999),(4,'Какой-то тип',1,1),(5,'Ещё тип',1,2);
/*!40000 ALTER TABLE `org_evtype` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_lookup`
--

LOCK TABLES `org_lookup` WRITE;
/*!40000 ALTER TABLE `org_lookup` DISABLE KEYS */;
INSERT INTO `org_lookup` VALUES (6,'Объединения граждан',1,'OrgtypeGroup',1),(7,'Неформальные объединения',2,'OrgtypeGroup',2),(9,'Государство',1,'OrganizationActionArea',1),(10,'Область',2,'OrganizationActionArea',2),(11,'Район',3,'OrganizationActionArea',3),(12,'Город',4,'OrganizationActionArea',4),(13,'Активна',1,'OrganizationStatus',1),(14,'Неактивна',2,'OrganizationStatus',2),(15,'Модерируется',3,'OrganizationStatus',3),(21,'Право',1,'ProblemGroup',1),(22,'Образование',2,'ProblemGroup',2),(23,'Соц. проблемы',3,'ProblemGroup',3),(24,'Активен',1,'AnnouncementStatus',1),(25,'Неактивен',2,'AnnouncementStatus',2),(26,'Общие',1,'AnnouncementCategory',1),(27,'Гранты',2,'AnnouncementCategory',2),(28,'Ещё что-то',3,'AnnouncementCategory',3),(29,'Активен',1,'EventStatus',1),(30,'Неактивен',2,'EventStatus',2),(31,'Организационные',1,'EvtypeCategory',1),(32,'Внутренние',2,'EvtypeCategory',2),(33,'Публичные',3,'EvtypeCategory',3),(34,'Общество',4,'ProblemGroup',4),(35,'Здоровье',5,'ProblemGroup',5),(36,'Культура',6,'ProblemGroup',6),(37,'Глобальные проблемы',7,'ProblemGroup',7),(38,'Инвалидность',8,'ProblemGroup',8),(39,'СМИ',9,'ProblemGroup',9);
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
  `author_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `org_organization_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `org_orgtype` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_organization`
--

LOCK TABLES `org_organization` WRITE;
/*!40000 ALTER TABLE `org_organization` DISABLE KEYS */;
INSERT INTO `org_organization` VALUES (1,'Лаберж ОС',1,2,4,12,6,2010,560,'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod\r\ntempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,\r\nno sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n','Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor amet.\r\nStet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor amet.\r\nStet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor amet.\r\nStet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor amet.\r\nStet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor amet.\r\n','http://github.com','097-79-13-702','example@example.com','508fa2ed475ca.jpg',1,'2012-11-03 06:15:21',1,1),(6,'Корв ВС',1,1,2,NULL,NULL,NULL,NULL,'','','','','','508fa2fe77003.png',2,'2012-11-03 07:19:16',1,0),(7,'sdfsdf 2222',1,1,2,NULL,NULL,NULL,NULL,'','','','','','placeholder.jpg',3,'2012-11-03 07:21:20',3,0),(8,'sdfsdf',1,1,1,NULL,NULL,NULL,NULL,'','','','','','placeholder.jpg',4,'2012-11-03 06:17:19',3,0),(9,'names',1,1,2,NULL,NULL,NULL,NULL,'','','','','','placeholder.jpg',5,'2012-11-03 18:11:06',3,0),(10,'new one',1,1,2,NULL,NULL,NULL,NULL,'','','','','','placeholder.jpg',6,'2012-11-03 19:17:55',3,0),(11,'test 1',1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'placeholder.jpg',1,'2012-11-22 15:42:24',3,0);
/*!40000 ALTER TABLE `org_organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_organization_direction`
--

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
  CONSTRAINT `org_organization_direction_ibfk_2` FOREIGN KEY (`direction_id`) REFERENCES `org_direction` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_organization_direction_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_organization_direction`
--

LOCK TABLES `org_organization_direction` WRITE;
/*!40000 ALTER TABLE `org_organization_direction` DISABLE KEYS */;
INSERT INTO `org_organization_direction` VALUES (33,1,10),(34,1,12),(35,1,13),(50,6,2),(51,6,3),(52,6,10),(53,6,11),(57,7,9),(58,7,10),(59,7,11),(60,8,1),(61,8,10);
/*!40000 ALTER TABLE `org_organization_direction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_organization_problem`
--

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
  CONSTRAINT `org_organization_problem_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `org_problem` (`id`) ON DELETE CASCADE,
  CONSTRAINT `org_organization_problem_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `org_organization` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_organization_problem`
--

LOCK TABLES `org_organization_problem` WRITE;
/*!40000 ALTER TABLE `org_organization_problem` DISABLE KEYS */;
INSERT INTO `org_organization_problem` VALUES (41,1,33),(42,1,41),(43,1,42),(44,1,43),(45,1,45),(46,6,33),(47,6,34),(48,6,35),(52,7,33),(53,7,35),(54,7,37),(55,8,33),(56,8,40),(57,8,41);
/*!40000 ALTER TABLE `org_organization_problem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_orgtype`
--

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

--
-- Dumping data for table `org_orgtype`
--

LOCK TABLES `org_orgtype` WRITE;
/*!40000 ALTER TABLE `org_orgtype` DISABLE KEYS */;
INSERT INTO `org_orgtype` VALUES (1,1,'Общественные организации'),(2,1,'Благотворительные фонды'),(3,1,'Партии'),(4,1,'Общественные фонды'),(5,1,'Общественные центры'),(6,1,'Общественные комитеты'),(7,1,'Клубы\r'),(8,2,'Инициативная группа\r'),(9,2,'Движение\r'),(10,2,'Неформальные объединения\r');
/*!40000 ALTER TABLE `org_orgtype` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_problem`
--

LOCK TABLES `org_problem` WRITE;
/*!40000 ALTER TABLE `org_problem` DISABLE KEYS */;
INSERT INTO `org_problem` VALUES (33,1,'Права человека'),(34,1,'Права нац. меньшинств'),(35,1,'Секс меньшинства'),(36,1,'Права заключенных'),(37,1,'Воины интернационалисты'),(38,1,'Права ликвидаторов ЧАС'),(40,2,'Доступность образования'),(41,2,'Качество образования'),(42,2,'Инклюзив'),(43,2,'Студенты'),(44,3,'Ветераны и пенсионеры'),(45,3,'Мать и ребенок'),(46,3,'Дети и детство'),(47,3,'Старость'),(48,3,'Сироты'),(49,3,'Многодетные семьи'),(50,3,'Малоимущие'),(51,4,'Свобода вероисповедания'),(52,4,'Свобода самовыражения'),(53,4,'Коррупция власти'),(54,4,'Проблемы молодежи'),(55,4,'Экономическое развитие'),(56,4,'Политика и власть'),(57,4,'Толерантность общества'),(58,4,'Выбор и демократия'),(59,4,'Гласность и свобода слова'),(60,4,'Суды и исполнение'),(61,5,'Борьба со СПИДом'),(62,5,'Борьба с раком'),(63,5,'Хоспис'),(64,5,'Наркомания'),(65,5,'Качество здравоохранения'),(66,6,'Культурное наследие'),(67,6,'Культура общества'),(68,6,'Творчество'),(69,7,'Экологические проблемы'),(70,7,'Охрана природы'),(71,7,'Охрана животных'),(72,7,'Расовая дискриминация'),(73,7,'Насилие в обществе'),(74,7,'Гендерство'),(75,7,'Терроризм'),(76,7,'Проблемы беженцев'),(77,7,'Нищета и голод'),(78,8,'Права инвалидов'),(79,8,'Реабилитация инвалидов'),(80,8,'Спорт и оздоробление инвалидов'),(81,8,'Безбарьерная среда'),(82,8,'Проблемы инвалидов'),(83,9,'Проблемы СМИ'),(84,9,'Цензура'),(85,9,'Развитие журналистики');
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

-- Dump completed on 2012-11-25 17:05:45
