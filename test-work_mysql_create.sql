CREATE TABLE `functions` (
	`id` bigint NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `persons` (
	`id` bigint NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`fam` varchar(255) NOT NULL,
	`function_id` bigint NOT NULL,
	`birthday` bigint NOT NULL,
	`note` TEXT NOT NULL,
	`content` TEXT NOT NULL,
	`avatar` varchar(255),
	`place_id` bigint NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `citys` (
	`id` bigint NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `countrys` (
	`id` bigint NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `photos` (
	`id` bigint NOT NULL AUTO_INCREMENT,
	`person_id` bigint NOT NULL,
	`pathphoto` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `places` (
	`id` bigint NOT NULL AUTO_INCREMENT,
	`city_id` bigint NOT NULL,
	`country_id` bigint NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `ipvotings` (
	`id` bigint NOT NULL AUTO_INCREMENT,
	`ip` bigint NOT NULL,
	`photo_id` bigint NOT NULL,
	`like` bool NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `persons` ADD CONSTRAINT `persons_fk0` FOREIGN KEY (`function_id`) REFERENCES `functions`(`id`);

ALTER TABLE `persons` ADD CONSTRAINT `persons_fk2` FOREIGN KEY (`place_id`) REFERENCES `places`(`id`);

ALTER TABLE `photos` ADD CONSTRAINT `photos_fk0` FOREIGN KEY (`person_id`) REFERENCES `persons`(`id`);

ALTER TABLE `places` ADD CONSTRAINT `places_fk0` FOREIGN KEY (`city_id`) REFERENCES `citys`(`id`);

ALTER TABLE `places` ADD CONSTRAINT `places_fk1` FOREIGN KEY (`country_id`) REFERENCES `countrys`(`id`);

ALTER TABLE `ipvotings` ADD CONSTRAINT `ipvotings_fk0` FOREIGN KEY (`photo_id`) REFERENCES `photos`(`id`);

