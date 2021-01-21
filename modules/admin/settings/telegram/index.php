<?php

$act		 = 'index';
$act		 = @$this->param[0];
$brouse		 = '';
$lsize		 = '';
ini_set("max_execution_time", 0);
$tpl		 = 'admin/admin';
$modal_name	 = '';
$modal_content	 = '';
$mod_name	 = "Телеграмм";
$mista		 = new model\misto();
$context	 = "<h2>настройка уведомлений в Телеграмм</h2>";
if (!file_exists("telegram.ini")):
    $context	 .= 'file created';
    $ini['main']	 = array('token' => '1238870246:AAEs7tPNcLq5_6psuPonbE_WEFlwoMfiPxw');
    foreach ($mista->getList() as $m)
    {
	$ini["$m->link"] = array('chat_id' => '263149696');
    }
    write_php_ini($ini, "telegram.ini");
endif;

switch ($act)
{
    case 'updateToken':
	$ini_array			 = parse_ini_file("telegram.ini", true);
	$ini_array['main']['BotName']	 = $_POST['BotName'];
	$ini_array['main']['token']	 = $_POST['token'];
	$ini_array['main']['mainChat']	 = $_POST['mainChat'];
	write_php_ini($ini_array, "telegram.ini");
	break;
    case 'updateChat_id':
	$ini_array			 = parse_ini_file("telegram.ini", true);
	$ini_array_new			 = array_replace($ini_array, $_POST);
	write_php_ini($ini_array_new, "telegram.ini");

	break;

    default:

	$context = '<h2>Создание Бота в Telegram</h2>
<div class="row">
<div class="col-12">
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
</div>
</div>
<h2>Получение Chat ID</h2>
<hr>
<div class="row"><div class="col-6">
<p class="note-blue"><strong>CHAT ID:</strong> Чтобы отправить сообщение через Telegram API, боту необходимо указать ID чата в который он будет писать. ID чата будет сгенерирован в момент отправки первого сообщения вашему боту.</p>
<p>Начните чат с ботом:</p>
<pre>🔍 ПОИСК -&gt; ИМЯ_ВАШЕГО_БОТА -&gt; СТАРТ</pre>
Отправьте команду <code>/start</code>:
<p>теперь отправте боту любое сообщение с текстом,
чтобы узнать ID чата, откройте следующую ссылку под формой - "Ваша ссылка для поиска chat_id" и найдите в хмл файле строку в которой есть ваша фраза отправленная боту. скопируйте айди чата как показано на рисунке и вставте его в форму chat_id ниже</p><br>
	</div><div class="col-6"><img src="' . WWW_IMAGE_PATH . 'api.png" /></div></div>
	';
	break;
}
$ini_array = parse_ini_file("telegram.ini", true);
//$context	 .= print_r($ini_array, true);

extract($ini_array);
$context .= "<div class='container'>"
	. "<form  method='post' action='" . WWW_ADMIN_PATH . "settings/telegram/updateToken'>"
	. "<div class='form-group row'>"
	. "<label class='col-form-label col-3'>Token</label>"
	. "<input class='form-control col-7' name='token' value='" . $main['token'] . "'>"
	. "<label class='col-form-label col-3'>Имя бота</label>"
	. "<input class='form-control col-7' name='BotName' value='" . $main['BotName'] . "'>"
	. "<label class='col-form-label col-3'>бот для всех городов</label>"
	. "<input class='form-control col-7' name='mainChat' value='" . $main['mainChat'] . "'>"
	. "<button type='submit' class='btn btn-primary mb-2 col-2'>save Token</button>"
	. "</div>"
	. "</form>";
if (isset($main['token']))
{
    $context .= "<div class='row'><a target='blanc' href='https://api.telegram.org/bot" . $main['token'] . "/getUpdates'> <strong>Ваша ссылка для поиска chat_id</strong></a><br></div>";
}
else
{

}

foreach ($mista->getList() as $v)
{
    $town	 = $v->name_ru . '&nbsp;';
    $ll	 = ${$v->link}['chat_id'];
    $context .= "<form method='post' action='" . WWW_ADMIN_PATH . "settings/telegram/updateChat_id'>"
	    . "<div class='form-group row'>"
	    . "<label class='col-form-label col-3'>$town Chat_ID</label>"
	    . "<input class='form-control col-7' name='" . $v->link . "[chat_id]' value='" . $ll . "'>"
	    . "<button type='submit' class='btn btn-primary mb-2 col-2'>save Chat ID</button>"
	    . "</div>"
	    . " </form>";
}
$context .= "</div>";

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
