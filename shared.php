<?php

function pprint($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function imgUpload() {
    //   print_r($_FILES);
    $uploaddir	 = APP_PATH . DS . 'images' . DS;
    $uploadfile	 = $uploaddir . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile))
    {
	return basename($_FILES['image']['name']);
    }
    else
    {
	echo "Возможная атака с помощью файловой загрузки!\n";
    }
}

function numberof($numberof, $value, $suffix) {
    $keys		 = array(2, 0, 1, 1, 1, 2);
    $mod		 = $numberof % 100;
    $suffix_key	 = $mod > 4 && $mod < 20 ? 2 : $keys[min($mod % 10, 5)];

    return $value . $suffix[$suffix_key];
    /* образование окончаний для слов после числа
     *  numberof($numberof, ' д', array('ень', 'ні', 'нів'));выводит 1 день, 2 дні и так далее
     */
}

function get_client_ip() {
    $ipaddress	 = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
	$ipaddress	 = $_SERVER['HTTP_CLIENT_IP'];
    else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
	$ipaddress	 = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_X_FORWARDED'])
	$ipaddress	 = $_SERVER['HTTP_X_FORWARDED'];
    else if ($_SERVER['HTTP_FORWARDED_FOR'])
	$ipaddress	 = $_SERVER['HTTP_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_FORWARDED'])
	$ipaddress	 = $_SERVER['HTTP_FORWARDED'];
    else if ($_SERVER['REMOTE_ADDR'])
	$ipaddress	 = $_SERVER['REMOTE_ADDR'];
    else
	$ipaddress	 = 'UNKNOWN';

    return $ipaddress;
}

function SBl($id, $lang) {
    $t	 = new model\btblock();
    $z	 = $t->getById($id);

    $header	 = 'header_' . $lang;
    $cont	 = 'content_' . $lang;
    return $z->$header . $z->$cont;
}

function setCheckboxStatus($val) {
    if ($val == "Y"):
	return " checked='checked'";
    else:
	return "";
    endif;
}

function checkbox2field($val) {
    if ($val == "on"):
	return "Y";
    else:
	return "N";
    endif;
}

function to_array($data) {

    if (is_object($data))
    {
	$data = get_object_vars($data);
    }

    if (is_array($data))
    {
	return array_map(__FUNCTION__, $data);
    }
    else
    {
	return $data;
    }
}

function translit($string) {
    $table	 = array(
	'А'	 => 'A', 'Б'	 => 'B', 'В'	 => 'V', 'Г'	 => 'G', 'Д'	 => 'D',
	'Е'	 => 'E', 'Ё'	 => 'YO', 'Ж'	 => 'ZH', 'З'	 => 'Z', 'И'	 => 'I',
	'Й'	 => 'J', 'К'	 => 'K', 'Л'	 => 'L', 'М'	 => 'M', 'Н'	 => 'N',
	'О'	 => 'O', 'П'	 => 'P', 'Р'	 => 'R', 'С'	 => 'S', 'Т'	 => 'T',
	'У'	 => 'U', 'Ф'	 => 'F', 'Х'	 => 'H', 'Ц'	 => 'C', 'Ч'	 => 'CH',
	'Ш'	 => 'SH', 'Щ'	 => 'SCH', 'Ь'	 => '', 'Ы'	 => 'Y', 'Ъ'	 => '',
	'Э'	 => 'E', 'Ю'	 => 'YU', 'Я'	 => 'YA',
	'а'	 => 'a', 'б'	 => 'b', 'в'	 => 'v', 'г'	 => 'g', 'д'	 => 'd',
	'е'	 => 'e', 'ё'	 => 'yo', 'ж'	 => 'zh', 'з'	 => 'z', 'и'	 => 'i',
	'й'	 => 'j', 'к'	 => 'k', 'л'	 => 'l', 'м'	 => 'm', 'н'	 => 'n',
	'о'	 => 'o', 'п'	 => 'p', 'р'	 => 'r', 'с'	 => 's', 'т'	 => 't',
	'у'	 => 'u', 'ф'	 => 'f', 'х'	 => 'h', 'ц'	 => 'c', 'ч'	 => 'ch',
	'ш'	 => 'sh', 'щ'	 => 'sch', 'ь'	 => '', 'ы'	 => 'y', 'ъ'	 => '',
	'э'	 => 'e', 'ю'	 => 'yu', 'я'	 => 'ya',
    );
    $string	 = str_replace('"', '', $string);
    $string	 = str_replace("'", '', $string);
    $output	 = str_replace(
	    array_keys($table),
		array_values($table), $string
    );

// таеже те символы что неизвестны
    $output	 = preg_replace('/[^-a-z0-9._\[\]\'"]/i', ' ', $output);
    $output	 = preg_replace('/ +/', '-', $output);

    return $output;
}

function l($frase) {
    if (isset($_SESSION['lang']))
    {
	$lang = mb_strtolower($_SESSION['lang']);
    }
    else
    {
	$lang = 'ua';
    }

    $ls	 = new model\translation();
    $frases	 = $ls->getStrByLang($lang);
    if (array_key_exists($frase, $frases))
    {
	return $frases[$frase];
    }
    else
    {
	$tr	 = array('ident' => $frase, 'lang' => $lang, 'langtext' => $frase);
	$lu	 = new model\translation();
	$lu->InsertTranslation($tr);
	return $frase;
    }
}

function metatags() {
    $seo	 = new model\seobase();
    $turl	 = substr(WWW_BASE_PATH, 0, -1) . $_SERVER['REQUEST_URI'];
    $turl	 = preg_replace("#\?(.*)#", "", $turl);
    $turl	 = rtrim($turl, '/');

    if ($turl == rtrim(WWW_BASE_PATH, '/'))
    {
	$ned	 = array('#http://#', '#https://#', '#/#');
	$zurl	 = preg_replace($ned, '', $turl);
    }
    else
    {
	$zurl = str_replace(rtrim(WWW_BASE_PATH, '/'), "", $turl);
    }
    $zurl	 = ltrim($zurl, '/');
    $s	 = @$seo->getByUrl(rtrim($zurl, '/'));

    if ($seo->found>= 1)
    {
	//echo "$turl найден";
	$keyli	 = $s;
	$m3	 = '
	<meta name="identifier-url" content="' . rtrim(WWW_BASE_PATH, '/') . $keyli->url . '" />
    <meta name="title" content="' . htmlspecialchars($keyli->title) . '" />
    <meta name="description" content="' . htmlspecialchars($keyli->deckription) . '" />
    <meta name="robots" content="Index,follow" />
    <link rel="canonical" href="' . $turl . '"/>
    <meta name="abstract" content="Nails School" />
    <meta name="keywords" content="' . $keyli->keywords . '" />
    <meta name="author" content="merlinsoft" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="revisit-after" content="15" />
    <meta name="language" content="UA" />
	<meta name="copyright" content="© 2018 development by merlinsoft" />
	<!-- facebook -->
    <meta property="og:site_name" content="' . SITE_NAME . '"/>
    <meta property="og:locale" content="ru_RU"/>
	<meta property="og:type" content="article"/>
	<meta property="og:title" content="' . htmlspecialchars($keyli->title) . '"/>
	<meta property="og:url" content="' . $turl . '" />
	<meta property="og:image" content="' . WWW_IMAGE_PATH . 'ns.jpg" />

    <meta property="og:description" content="' . htmlspecialchars($keyli->deckription) . '"/><!-- var from back -->
	<!-- twitter -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="Автор">
	<meta name="twitter:title" content="' . htmlspecialchars($keyli->title) . '">
	<meta name="twitter:description" content="' . htmlspecialchars($keyli->deckription) . '">';
    }
    else
    {
	$deckription	 = "ногтевой сервис";
	$m3		 = '<meta name="identifier-url" content="' . WWW_BASE_PATH . '" />
        <meta name="title" content="Nails School — школа маникюра ногтевой сервис" />
                <meta name="description" content="' . $deckription . '" />
        <meta name="abstract" content="Nails School — школа маникюра ногтевой сервис" />
        <meta name="author" content="merlinsoft" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta name="revisit-after" content="15" />
        <meta name="language" content="UA" />
        <meta name="copyright" content="© 2018 development by merlinsoft" />
    <meta name="robots" content="Index,follow" />
	<meta property="og:image" content="' . WWW_IMAGE_PATH . 'ns.jpg" />
    <meta property="og:title" content=""/><!-- var from back -->
	<meta property="og:description" content="' . $deckription . '"/><!-- var from back -->

    <link rel="canonical" href="' . $turl . '"/>';
	$seo->insert($zurl, 'Nails School', $deckription, '');
    }

    return $m3;
}

;

function pismo($subject, $usermail, $html) {

    $mail		 = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->CharSet	 = 'UTF-8';

    $mail->Host	 = "mail.finansicalservice.com"; // SMTP server example
    $mail->SMTPDebug = 0;   // enables SMTP debug information (for testing)
    $mail->SMTPAuth	 = true; // enable SMTP authentication
    $mail->Port	 = 25;  // set the SMTP port for the GMAIL server
    $mail->Username	 = "info@finansicalservice.com"; // SMTP account username example
    $mail->Password	 = "123123123qweqweqwe"; // SMTP account password example

    $mail->From	 = $email;
    $mail->FromName	 = $name;
    $mail->setFrom('info@finansicalservice.com', 'Support of the FinansicalService');
    $mail->addReplyTo('info@finansicalservice.com', 'Support of the FinansicalService');
    $mail->addAddress($usermail, 'User');
    $mail->Subject	 = $subject;
    $mail->msgHTML($html);
    $mail->AltBody	 = strip_tags($html, '');
    $mail->send();
}

function strToHex($string) {
    $hex = '';
    for ($i = 0; $i < strlen($string); $i++)
    {
	$ord	 = ord($string[$i]);
	$hexCode = dechex($ord);
	$hex	 .= substr('0' . $hexCode, -2);
    }
    return strToUpper($hex);
}

function hexToStr($hex) {
    $string = '';
    for ($i = 0; $i < strlen($hex) - 1; $i += 2)
    {
	$string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    }
    return $string;
}

function explode_images($str) {
    $reg	 = '@<img.*?>@';
    preg_match_all('/(<img[^>]+>)/i', $str, $matches);
//preg_match_all($reg, $str, $result);
    $result	 = $matches[0];
    return $result;
}

function localeMomts($locale, $mnum) {
    $mnum	 = ltrim($mnum, '0');
    //echo $mnum;
    $loc	 = array(
	'ua'	 => array('', 'cічня', 'лютого', 'березня', 'квітня', 'травня', 'червня', 'липня', 'серпня', 'вересня', 'жовтня', 'листопада', 'грудня'),
	'ru'	 => array('', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря')
    );
    return $loc[$locale][$mnum];
}

function getExtension($filename) {
    return substr(strrchr($filename, '.'), 1);
}

function firstChar($string) {
    return mb_substr($string, 0, 1, "UTF-8");
}

function randomOnline($prep, $lang, $current = '') {
    $r = new model\curses();

    $name = 'name_' . $lang;
    if ($current == ''):
	$q = "SELECT * FROM `cursses` WHERE `miso`='virtual' ORDER BY RAND() LIMIT 1;";
    else:
//	echo  $current;
	$q = "SELECT * FROM `cursses` WHERE `miso`='virtual' and `link`!='" . $current . "' ORDER BY RAND() LIMIT 1;";
    endif;
//    echo $q;
    $t	 = $r->get_result($q);
    $out	 = $t[0];
    return '<a href="' . $out->link . '">' . $prep . $out->$name . '</a>';
}
