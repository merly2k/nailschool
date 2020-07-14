<?php

$act		 = 'index';
$act		 = @$this->param[0];
$brouse		 = '';
$lsize		 = '';
ini_set("max_execution_time", 0);
$tpl		 = 'admin';
$modal_name	 = '';
$modal_content	 = '';
$mod_name	 = "Телеграмм";
$filename	 = APP_PATH . '/sitemap.xml';
$context	 = "<h2>настройка уведомлений в Телеграмм</h2>";
if (!file_exists("telegram.ini")):
    $context .= 'file created';
    write_php_ini(array('token' => 'test', 'chat_id' => 'chat'), "telegram.ini");
endif;

switch ($act)
{
    case 'updateToken':
	$ini_array		 = parse_ini_file("telegram.ini");
	$ini_array['token']	 = $_POST['token'];
	write_php_ini($ini_array, "telegram.ini");
	break;
    case 'updateChat_id':
	$ini_array		 = parse_ini_file("telegram.ini");
	$ini_array['chat_id']	 = $_POST['chat_id'];
	write_php_ini($ini_array, "telegram.ini");

	break;

    default:

	$context = '<h2>Создание Бота в Telegram</h2>
<p>Начните диалог в телеграм с <code>BotFather</code>:</p>
<pre>🔍 ПОИСК -&gt; BotFather</pre>
<p class="note-blue"><strong>BotFather:</strong> Бот по имени <code>BotFather</code> управляет созданием новых ботов. Используйте его для создания своих ботов и для управления уже существующими.
Создайте нового бота, для этого в чате с BotFather наберите команду
<strong>/newbot</strong>. Придумайте удобное имя для вашего бота, например: <code>Notifier</code>.
Придумайте уникальной идентификатор, который обязательно должен оканчиваться на «bot», например:
<code>notifier_bot</code>
<p>Как только бот будет создан, вы получите токен для подключения к Telegram API.введите его в форму ниже и нажмите сохранить</p>
<p class="blue">
<strong>ТОКЕН:</strong>
Это строка необходимая для авторизации бота и отправки запросов к Telegram API.<br> Пример токена:<code>4334584910:AAEPmjlh84N62Lv3jGWEgOftlxxAfMhB1gs</code></p>
<strong>Внимание! если у вас уже настроен токен - пропустите все действия до получения chat_id!</strong>
<h2>Получение Chat ID</h2>
<p class="note-blue"><strong>CHAT ID:</strong> Чтобы отправить сообщение через Telegram API, боту необходимо указать ID чата в который он будет писать. ID чата будет сгенерирован в момент отправки первого сообщения вашему боту.</p>
<p>Начните чат с ботом:</p>
<pre>🔍 ПОИСК -&gt; ИМЯ_ВАШЕГО_БОТА -&gt; СТАРТ</pre>
Отправьте команду <code>/start</code>:
теперь отправте боту любое сообщение с текстом,
чтобы узнать ID чата, откройте следующую ссылку под формой - "Ваша ссылка для поиска chat_id" и найдите в хмл файле строку в которой есть ваша фраза отправленная боту. скопируйте айди чата как показано на рисунке и вставте его в форму chat_id ниже</p>
	<img src="' . WWW_IMAGE_PATH . 'api.png">
	';
	break;
}
$ini_array	 = parse_ini_file("telegram.ini");
extract($ini_array);
//$context	 .= print_r($ini_array, true);
$context	 .= "<form class='form-inline' method='post' action='" . WWW_ADMIN_PATH . "settings/telegram/updateToken'><div class='form-group row'>"
	. "<label>Token</label><input class='form-control' name='token' value='$token'><button type='submit' class='btn btn-primary mb-2'>save Token</button></form></div>";
if (isset($token))
{
    $context .= "<a target='blanc' href='https://api.telegram.org/bot" . $token . "/getUpdates'> <strong>Ваша ссылка для поиска chat_id</strong></a>";
}
else
{

}
$context .= "<form class='form-inline'method='post' action='" . WWW_ADMIN_PATH . "settings/telegram/updateChat_id'><div class='form-group row'>"
	. "<label>Chat_ID</label><input class='form-control' name='chat_id' value='$chat_id'><button type='submit' class='btn btn-primary mb-2'>save Chat ID</button>"
	. " </form></div>";
//telegram.ini
//$token
include TEMPLATE_DIR . DS . $tpl . ".html";

function write_php_ini($array, $file) {
    $res = array();
    foreach ($array as $key => $val)
    {
	if (is_array($val))
	{
	    $res[]	 = "[$key]";
	    foreach ($val as $skey => $sval)
		$res[]	 = "$skey = " . (is_numeric($sval) ? $sval : '"' . $sval . '"');
	}
	else
	    $res[] = "$key = " . (is_numeric($val) ? $val : '"' . $val . '"');
    }
    safefilerewrite($file, implode("\r\n", $res));
}

function safefilerewrite($fileName, $dataToSave) {
    if ($fp = fopen($fileName, 'w'))
    {
	$startTime = microtime(TRUE);
	do
	{
	    $canWrite = flock($fp, LOCK_EX);
	    // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
	    if (!$canWrite)
		usleep(round(rand(0, 100) * 1000));
	} while ((!$canWrite)and ( (microtime(TRUE) - $startTime) < 5));

	//file was locked so now we can store information
	if ($canWrite)
	{
	    fwrite($fp, $dataToSave);
	    flock($fp, LOCK_UN);
	}
	fclose($fp);
    }
}

