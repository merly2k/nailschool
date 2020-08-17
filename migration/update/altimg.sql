/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  merly
 * Created: 27 лип. 2020 р.
 */

ALTER TABLE `vipusknik`
	ADD COLUMN `title` VARCHAR(250) NULL DEFAULT NULL AFTER `imgname`;
ALTER TABLE `photogalery`
	ADD COLUMN `title` VARCHAR(250) NULL DEFAULT NULL AFTER `imgname`;
