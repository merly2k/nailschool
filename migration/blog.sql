ALTER TABLE `blog`
	CHANGE COLUMN `title` `title_ua` VARCHAR(250) NULL DEFAULT NULL COMMENT 'Заголовок(ua)' COLLATE 'utf8_general_ci' AFTER `id`,
	ADD COLUMN `tirle_ru` VARCHAR(250) NULL DEFAULT NULL COMMENT 'Заголовок(ru)' AFTER `title_ua`,
	DROP INDEX `title`,
	ADD FULLTEXT INDEX `tirle_ru` (`tirle_ru`),
	ADD FULLTEXT INDEX `title_ua` (`title_ua`);
