SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `bug`;
CREATE TABLE `bug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(1024) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('NEW','FIXED') NOT NULL DEFAULT 'NEW',
  `importance` enum('BLOCKER','CRITICAL','HIGH','MIDDLE','LOW','UNDECIDED') NOT NULL DEFAULT 'UNDECIDED',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `bug` (`id`, `description`, `title`, `status`, `importance`) VALUES
(1,	'Dies dient nur zum Test',	'Test Bug 1',	'NEW',	'UNDECIDED'),
(2,	'beschreibung',	'Bug 22',	'NEW',	'UNDECIDED'),
(3,	'beschreibung',	'Bug 2',	'NEW',	'UNDECIDED');

DROP TABLE IF EXISTS `nutzer`;
CREATE TABLE `nutzer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nutzername` varchar(100) NOT NULL,
  `passhash` varchar(500) NOT NULL,
  `salt` int(11) DEFAULT NULL,
  `loggedin` bit(1) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `token` varbinary(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `nutzer` (`id`, `nutzername`, `passhash`, `salt`, `loggedin`, `email`, `token`) VALUES
(1,	'apt',	'$2y$10$K1ZA9dONqjW2H37r94iSMuAspgZK7hHLSs74.arGxA3/ONPa/wlNu',	NULL,	NULL,	'apt@ghetto.ch',	NULL),
(2,	'globi',	'$2y$10$NBYL4PVuyqy8scBmCgIFqOFUMOZgyE6.OyhThOs.l35faG.W.68du',	NULL,	NULL,	'globi@globi.ch',	NULL),
(14,	'harambe',	'$2y$10$9kzOuYxEFV5miJyXusE2Ku3yCddPWJy9enS1YcwSxoJh07A0.zn8i',	NULL,	NULL,	'harambekarambe@gmail.com',	NULL);
