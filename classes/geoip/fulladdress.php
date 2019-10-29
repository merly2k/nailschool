<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fulladdress
 *
 * @author merly
 */
class fulladdress {
    function getByCoordinates($lat,$long){
	//AIzaSyAgo83mZXhQCFzF2Y3pQYJUC1ivAXKwiX4
$key=GOOGLE_MAPS_KEY;
$url="https://maps.google.com/maps/api/geocode/json?latlng=$lat,$long&key=$key";
$curl_return= $this->curl_get($url);

$obj=json_decode($curl_return);

echo $obj->results[0]->formatted_address;

    }
function curl_get($url,  array $options = array())
{
    $defaults = array(
        CURLOPT_URL => $url,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 4
    );

    $ch = curl_init();
    curl_setopt_array($ch, ($options + $defaults));
    if( ! $result = curl_exec($ch))
    {
        trigger_error(curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

}
