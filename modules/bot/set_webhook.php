<?php

$inif		 = APP_PATH . "/modules/bot/test.ini";
$ini_array	 = parse_ini_file($inif, true);
//print_r($ini_array['keys']['APIkey']);
$auth_token	 = $ini_array['keys']['APIkey'];
$webhook	 = WWW_BASE_PATH . 'bot';

$jsonData = '{
		"auth_token": "' . $auth_token . '",
		"url": "' . $webhook . '",
		"event_types": ["subscribed", "unsubscribed", "delivered", "message", "seen"]
	}';

$ch		 = curl_init('https://chatapi.viber.com/pa/set_webhook');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$response	 = curl_exec($ch);
$err		 = curl_error($ch);
curl_close($ch);
if ($err)
{
    echo($err);
}
else
{
    echo($response);
}
?>
