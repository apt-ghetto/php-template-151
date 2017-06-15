SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `devbugtracker`;
CREATE DATABASE `devbugtracker` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `devbugtracker`;

DROP TABLE IF EXISTS `bug`;
CREATE TABLE `bug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(1024) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('NEW','FIXED','INVALID') NOT NULL DEFAULT 'NEW',
  `importance` enum('BLOCKER','CRITICAL','HIGH','MIDDLE','LOW','UNDECIDED') NOT NULL DEFAULT 'UNDECIDED',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `bug` (`id`, `description`, `title`, `status`, `importance`) VALUES
(1,	'Dies dient nur zum Test',	'Test Bug 1',	'NEW',	'UNDECIDED'),
(2,	'Ja, dass ist jetzt wirklich der Gipfel!',	'Bug 22',	'NEW',	'LOW'),
(3,	'Die Beschreibung darf durchaus auch sehr lang sein. Es hat ja Platz und man kommt auch eher draus.',	'Bug 2',	'NEW',	'MIDDLE'),
(4,	'Dumme Cheib! Verdammt',	'Ja nei!',	'NEW',	'BLOCKER'),
(5,	'Wegen einer schwarzen Katze hat Liseli heute Morgen die Milch verschüttet. Aber es ist ja eigentlich nicht ihre Schuld, sondern eben jene der schwarzen Katze.',	'Liseli',	'INVALID',	'LOW'),
(6,	'Ja, dass kann schon sein.',	'Lisbeth',	'INVALID',	'LOW');

DROP TABLE IF EXISTS `nutzer`;
CREATE TABLE `nutzer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nutzername` varchar(100) NOT NULL,
  `passhash` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varbinary(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `nutzer` (`id`, `nutzername`, `passhash`, `email`, `token`) VALUES
(1,	'apt',	'$2y$10$K1ZA9dONqjW2H37r94iSMuAspgZK7hHLSs74.arGxA3/ONPa/wlNu',	'apt@ghetto.ch',	NULL),
(2,	'globi',	'$2y$10$CK.OO4ZvVXgvsDvL5Z7z7O5V.ZpLesBGzGJWU0cvFIMbW49YHQ.VC',	'globi@globi.ch',	UNHEX('3266346330363038343363636136353362666230383364323735383463393861')),
(14,	'harambe',	'$2y$10$2CC5dapyRvkK4RfQgjqPPuv88y5zjBBiibBB9onpH2rJWVaf7tmHC',	'harambekarambe@gmail.com',	NULL),
(16,	'gabi',	'$2y$10$wDu1zlhCM29E8FzKJe2f2uEKeaag6QfRMnaNw8LdRj1WoTzlQjEVK',	'ga@bi.ch',	UNHEX('3638303339656163303737316139396333613765363433386435623737643031'));