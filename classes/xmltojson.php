<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of xmltojson
 *
 * @author merly
 */
class xmltojson {

	public static function Parse ($url) {
		$fileContents= mb_convert_encoding( file_get_contents("$url"), 'UTF-8' );
		//$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
		//$fileContents = trim(str_replace('"', "'", $fileContents));
		$simpleXml = simplexml_load_string($fileContents,null,LIBXML_NOCDATA);
		//print_r($simpleXml);
		//$json = json_encode($simpleXml,JSON_UNESCAPED_UNICODE);
		//return json_decode($json);
		return $simpleXml;
	}

}

