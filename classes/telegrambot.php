<?php

class telegrambot {

    public
	    $token;
    public
	    $chat_id;

    public
	    function getToken() {
	return $this->token;
    }

    public
	    function getChat_id() {
	return $this->chat_id;
    }

    public
	    function setToken($token) {
	$this->token = $token;
    }

    public
	    function setChat_id($chat_id) {
	$this->chat_id = $chat_id;
    }

    function send($curse, $leadtype, $name, $phone, $lname = '', $email = '') {
	$txt = '';
	/* https://api.telegram.org/botXXXXXXXXXXXXXXXXXXXXXXX/getUpdates,
	  где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

//Переменная $name,$phone, $mail получает данные при помощи метода POST из формы
	//extract($param);
//в переменную $token нужно вставить токен, который нам прислал @botFather
	if (isset($this->token))
	{
	    $token = $this->token;
	}
	else
	{
	    $token = "1238870246:AAEs7tPNcLq5_6psuPonbE_WEFlwoMfiPxw";
	}

//нужна вставить chat_id (Как получить chad id, читайте ниже)
// https://api.telegram.org/bot1238870246:AAEs7tPNcLq5_6psuPonbE_WEFlwoMfiPxw/getUpdates
	if (isset($this->chat_id))
	{
	    $chat_id = $this->chat_id;
	}
	else
	{
	    $chat_id = "263149696";
	}

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
	$t	 = json_decode($result);
	/** for debug uncoment this string
	  if ($t->ok == 1){  print_r($this->chat_id);	}else{print_r($t)}
	 */
    }

}

