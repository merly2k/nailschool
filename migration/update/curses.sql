ALTER TABLE `cursses`
	ADD COLUMN `hideprog` ENUM('Y','N') NOT NULL DEFAULT 'N' COMMENT 'скрыть блок крограмма курса' AFTER `hidedeckr`;
