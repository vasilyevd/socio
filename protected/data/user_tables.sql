-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 19 2012 г., 17:26
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- База данных: `socio`
--

-- --------------------------------------------------------

--
-- Структура таблицы `user_persons`
--

DROP TABLE IF EXISTS `user_persons`;
CREATE TABLE IF NOT EXISTS `user_persons` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(40) NOT NULL,
  `password` varchar(120) default NULL,
  `email` varchar(120) NOT NULL,
  `name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `last_name` varchar(255) default NULL,
  `status` int(1) NOT NULL default '1',
  `question` text,
  `answer` text,
  `creation_date` datetime default NULL,
  `activation_code` varchar(32) default NULL,
  `activation_time` datetime default NULL,
  `last_login` datetime default NULL,
  `ban` datetime default NULL,
  `ban_reason` text,
  `params` text NOT NULL,
  `lastaction` datetime default NULL,
  `avatar` varchar(255) default NULL,
  `notifyType` enum('None','Digest','Instant','Threshold') default 'Instant',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user_persons`
--

INSERT INTO `user_persons` (`id`, `username`, `password`, `email`, `name`, `second_name`, `last_name`, `status`, `question`, `answer`, `creation_date`, `activation_code`, `activation_time`, `last_login`, `ban`, `ban_reason`, `params`, `lastaction`, `avatar`, `notifyType`) VALUES
(1, 'vasilyevdmitro', '593c9b4a9390551d53e5cacf28ebd638', 'vasilyev.dmitro@gmail.com', 'Дмитрий', 'Владимирович', 'Васильев', 1, NULL, NULL, '2012-05-14 17:54:30', '11ab9b500fe9bc435e763e0779b2a959', '2012-11-16 19:10:43', '2012-05-25 14:47:42', NULL, NULL, '', NULL, NULL, 'Instant'),
(2, 'vasilyev', '593c9b4a9390551d53e5cacf28ebd638', 'vasilyev_d@mail.ru', 'Дмитрий', 'Владимирович', 'Васильевgg', 4, NULL, NULL, '2012-05-22 22:01:14', NULL, '2012-05-22 22:01:14', '2012-05-25 14:44:59', NULL, NULL, '', NULL, NULL, 'Instant');
