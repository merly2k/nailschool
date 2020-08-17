<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of sysvars
 *
 * @author merly
 */
class sysvars extends \db {

    public
	    function getVar($varname) {
	$t = $this->get_result("SELECT `varvalue` FROM `sysvar` WHERE  `varname`='$varname';");
	return $t[0]->varvalue;
    }

    public
	    function update($varname, $varval) {
	$q = "UPDATE `sysvar` SET `varvalue`='$varval' WHERE `varname`='$varname';";
	$this->query($q);
	return $this->lastState;
    }

}
