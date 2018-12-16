-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `paylogs`;
CREATE TABLE `paylogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` tinytext,
  `order_no` tinytext,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `type` varchar(10) DEFAULT NULL,
  `i` int(11) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2018-12-16 08:30:15
