ALTER TABLE `cursses`
	ADD COLUMN `hidestart` ENUM('Y','N') NOT NULL DEFAULT 'N' COMMENT 'скрыть дату' AFTER `start`;
