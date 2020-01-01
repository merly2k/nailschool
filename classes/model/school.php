<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of school
 *
 * @author merly
 */
class school extends \db{
    function getByLink($link) {
	$q="SELECT * FROM `school` WHERE `misto`='$link'";
	//echo $q;
	$out=$this->get_result($q);
	if(count ($out)>0):
	return $out[0];
	else:
	  $p=array('id'=>'',
	      'misto'=>$link,
	      'osnashennia'=>'',
	      'osn_img'=>'',
	      'ergonomik'=>'',
	      'ergonomik_img'=>'',
	      'location'=>'',
	      'location_img'=>'',
	      'shop'=>'',
	      'shop_img'=>'',
	      'konsult'=>'',
	      'konsult_img'=>'',
	      'tur'=>'',
	      'tur_link'=>'');
      $this->insert($p);
      return $this->getByLink($link);
	endif;
    }
    
    function insert($param){
	extract($param);
	$q="INSERT INTO `school` (`id`, `misto`, `osnashennia`, `osn_img`, `ergonomik`, `ergonomik_img`, `location`, `location_img`, `shop`, `shop_img`, `konsult`, `konsult_img`, `tur`, `tur_link`)"
	. " VALUES ('$id', '$misto', '$osnashennia', '$osn_img', '$ergonomik', '$ergonomik_img', '$location', '$location_img', '$shop', '$shop_img', '$konsult', '$konsult_img', '$tur', '$tur_link');";
	$this->query($q);
	return $this->lastState;
    }
    
    function update($param) {
	extract($params);
	$q = "UPDATE `school` SET ";
	foreach ($params as $k => $v) {
	    $p[] = "`$k`='$v'";
	}
	$q.=implode(", ", $p) . " WHERE  `id`=$id;";
	//echo $q;
	$this->query($q);

	return $this->lastState;
    }
}





















