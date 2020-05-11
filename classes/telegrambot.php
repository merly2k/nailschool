<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of telegrambot
 *
 * @author merly
 */
class telegrambot {

    function send($curse, $leadtype, $name, $phone, $lname = '', $email = '') {
	$txt = '';
	/* https://api.telegram.org/botXXXXXXXXXXXXXXXXXXXXXXX/getUpdates,
	  где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

//Переменная $name,$phone, $mail получает данные при помощи метода POST из формы
	//extract($param);
//в переменную $token нужно вставить токен, который нам прислал @botFather
	$token = "1238870246:AAEs7tPNcLq5_6psuPonbE_WEFlwoMfiPxw";

//нужна вставить chat_id (Как получить chad id, читайте ниже)
// https://api.telegram.org/bot1238870246:AAEs7tPNcLq5_6psuPonbE_WEFlwoMfiPxw/getUpdates
	$chat_id = "263149696";

//Далее создаем переменную, в которую помещаем PHP массив
	$arr = array(
	    'тип:'		 => "$leadtype",
	    'курс:'		 => "$curse",
	    'Имя:'		 => "$name",
	    'Фамилия:'	 => "$lname",
	    'E-mail:'	 => "$email",
	    'Телефон:'	 => "$phone"
	);

//При помощи цикла перебираем массив и помещаем переменную $txt текст из массива $arr
	foreach ($arr as $key => $value)
	{
	    $txt .= "<b>" . $key . "</b> " . $value . "%0A";
	};

//Осуществляется отправка данных в переменной $sendToTelegram
	$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}";
	//echo $url;

	$options = array(
	    'http' => array
		(
		'method' => 'POST'));
	$context = stream_context_create($options);
	$result	 = file_get_contents($url, false, $context);
    }

}

