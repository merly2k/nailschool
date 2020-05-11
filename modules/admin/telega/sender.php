<?php

$txt = '';
/* https://api.telegram.org/botXXXXXXXXXXXXXXXXXXXXXXX/getUpdates,
  где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

//Переменная $name,$phone, $mail получает данные при помощи метода POST из формы
extract($_POST);
$name	 = $_POST['user_name'];
$phone	 = $_POST['user_phone'];
$email	 = $_POST['user_email'];

//в переменную $token нужно вставить токен, который нам прислал @botFather
$token = "1238870246:AAEs7tPNcLq5_6psuPonbE_WEFlwoMfiPxw";

//нужна вставить chat_id (Как получить chad id, читайте ниже)
// https://api.telegram.org/bot1238870246:AAEs7tPNcLq5_6psuPonbE_WEFlwoMfiPxw/getUpdates
$chat_id = "263149696";

//Далее создаем переменную, в которую помещаем PHP массив
$arr = array(
    'Имя пользователя: '	 => $user_name,
    'Телефон: '		 => $user_phone,
    'Email:'		 => $user_email,
    'Сообщение:'		 => $message
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
//Если сообщение отправлено, напишет "Thank you", если нет - "Error"
;
if ($result)
{
    echo "Thank you";
}
else
{
    echo "Error";
}
?>












