<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of seobase
 *
 * @author merly
 */
class seobase extends \db{
    public function insert($url,$title,$deckription,$keywords,$hide=0){
        $q="INSERT INTO `seo` (`url`, `title`, `deckription`, `keywords`,`hide`)"
        . " VALUES ('$url', '$title', '$deckription', '$keywords','$hide')"
        . " ON DUPLICATE KEY UPDATE `title`='$title', `deckription`='$deckription', `keywords`='$keywords', `hide`='$hide'; ";

        $this->query($q);

        return $this->lastState;
    }
    public function getByUrl($url) {
	//ECHO $url;
        $r=$this->get_result("SELECT * FROM `seo` WHERE `url` like '%$url';");
	
        return $r[0];
    }
    public function GetAll() {
        return $this->get_result("SELECT * FROM `seo` WHERE `hide`=0");
    }

}
