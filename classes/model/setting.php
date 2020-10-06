<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of setting
 *
 * @author merly
 */
class setting extends \db{
    public function __construct() {
        parent::__construct();
    }
    
    public function getSetting() {
    
        $q="SELECT SQL_CALC_FOUND_ROWS * FROM `setting` LIMIT 10;";
        
            return $this->get_result($q);
        
    }
    
        public function getSettingById($id) {
    
        $q="SELECT SQL_CALC_FOUND_ROWS * FROM `setting` where id='$id' LIMIT 10;";
        
            return $this->get_result($q);
        
    }

    public function addSetting($param) {
        extract($param);
        $q="INSERT INTO `setting` (`currency`,`obsag`)"
                . " VALUES ('"
                .$currensy
                ."','"
                .$obsag
                . "');";
        //echo $q;
            $this->query($q);
            return $this->lastState;
        
    }
    public function UpdateSetting($param) {
        extract($param);
        $s=array();
        if($currensy!=''){$s[]="`currency`='$currensy'";}
        if($obsag!=''){$s[]="`obsag`='$obsag'";}
        $q="UPDATE `setting` SET "
                .implode(', ', $s).
                " WHERE  `id`='".$id."';";
        //echo $q;
            return $this->query($q);
        
    }
    public function deleteSetting($id) {
    
        $q="DELETE FROM `setting` WHERE `id`=$id;";
        $this->query($q);
        return $this->lastState;
        
    }
}
