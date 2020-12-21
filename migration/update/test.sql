#//ALTER TABLE `cursses` ADD COLUMN `hidestart` ENUM('Y','N')   COMMENT 'скрыть дату' AFTER `start`;
ALTER TABLE `cursses`
	CHANGE COLUMN `hidestart` `hidestart` ENUM('Y','N') NOT NULL DEFAULT 'N'