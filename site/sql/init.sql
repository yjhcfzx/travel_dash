CREATE TABLE `inquiry` (
	`id` INT NOT NULL  AUTO_INCREMENT,
	`name` VARCHAR(500) NOT NULL DEFAULT '',
	`status` BIT NOT NULL DEFAULT b'0' COMMENT '0 pending 1 active 2 deleted',
	PRIMARY KEY `id` (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1;


CREATE TABLE `inquiry_question` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`question` VARCHAR(500) NOT NULL DEFAULT '',
	`inqiry_id` INT NOT NULL ,
	`status` BIT NOT NULL DEFAULT b'0',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;
