ALTER TABLE `persons` DROP FOREIGN KEY `persons_fk0`;

ALTER TABLE `persons` DROP FOREIGN KEY `persons_fk2`;

ALTER TABLE `photos` DROP FOREIGN KEY `photos_fk0`;

ALTER TABLE `places` DROP FOREIGN KEY `places_fk0`;

ALTER TABLE `places` DROP FOREIGN KEY `places_fk1`;

ALTER TABLE `ipvotings` DROP FOREIGN KEY `ipvotings_fk0`;

DROP TABLE IF EXISTS `functions`;

DROP TABLE IF EXISTS `persons`;

DROP TABLE IF EXISTS `citys`;

DROP TABLE IF EXISTS `countrys`;

DROP TABLE IF EXISTS `photos`;

DROP TABLE IF EXISTS `places`;

DROP TABLE IF EXISTS `ipvotings`;

