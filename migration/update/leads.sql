ALTER TABLE `leads`
	CHANGE COLUMN `curse` `curse` VARCHAR(50) NOT NULL DEFAULT '' AFTER `id`;