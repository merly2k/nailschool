/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  merly
 * Created: Aug 11, 2020
 */

CREATE TABLE `sysvar` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`varname` VARCHAR(50) NULL DEFAULT NULL,
	`varvalue` VARCHAR(255) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	UNIQUE INDEX `varname` (`varname`) USING BTREE
)
ENGINE=InnoDB
;
