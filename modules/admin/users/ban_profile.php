<?php

// UI(user interfaces)
$template = "cabinet"; //"index";
$mod_name = 'блокировка акаунта';
$ajax = "";
$postPrint = '';
$context = "<article class='module width_full'><header><h3>Блокировка Пользователя</h3></header>
		<div class='module_content'> ";
$db = new db();
$zapros = "select * from users where id='" . $this->param[0] . "';";
$db->get_rows($zapros);
//var_dump($db->result);
$userdata = $db->result[0];
$context.= profile_form($userdata);
unset($db->result);
$db->close();
if (!empty($_POST)) {
    $message = save_profile($this->param[0], $userdata);
}

function profile_form($dataarray) {
    extract($dataarray);
    //$out=print_r($dataarray,true);
    //id username email name surname fname
    $out = "
<div class='box'>
<form method='POST' accept-charset='utf-8'>
    <input type='hidden' name='id' value='$id'>
    <input type='hidden' name='email' value='$email'>
Вы собираетесь блокировать пользователя:<b> $name $surname $fname($username),</b><br /> если вы действительно хотите это сделать выберите режим блокировки
    <select name='ban'>
        <option>выберите режим</option>
        <option>7 дней</option>
        <option>1 мес.</option>
        <option>6 мес.</option>
        <option>1 год</option>
        <option>Навсегда</option>
    </select>
<button type='submit' name='reg' value='ban'>Блокировать</button>
</form></div>
";
    return $out;
}

//<a href='#' onClick='updateElement(\".help\",\"test1\");'>test</a>
$postPrint.="
        function updateTooltip(tag,urls){
            $(tag).tooltip({
                    txt: $.ajax({
                        url: urls,
                        async: false
                                }).responseText,
                    effect: 'show',
                    duration: 90
               });
        }
        function clearElement(tag){
        var clean='';
         $(tag).html(clean);
        }
        ";
include TEMPLATE_DIR . DS . $template . ".html";

function save_profile($id, $profile) {
    extract($_POST);

    switch ($ban) {
	case '7 дней':
	    $ban_date = 'NOW() + INTERVAL 7 DAY';
	    break;
	case '1 мес.':
	    $ban_date = 'NOW() + INTERVAL 1 MONTH';
	    break;
	case '6 мес.':
	    $ban_date = 'NOW() + INTERVAL 6 MONTH';
	    break;
	case '1 год':
	    $ban_date = 'NOW() + INTERVAL 1 YEAR';
	    break;
	case 'Навсегда':
	    $ban_date = 'NOW() + INTERVAL 100 YEAR';

	    break;
	default:
	    return "не указан срок блокировки";
	    break;
    }

    $up = new db();
    $za = "UPDATE `users` SET  `ban`='$ban_date' WHERE  `id`='$id';";
    //echo $za;
    $up->query($za);
    $ss = send_message($email, $profile);
    return $up->lastState . "Письмо о бане на адрес $email :" . $ss;
}

function send_message($to, $profile) {
    try {
	$mail = new phpmailer(true);
	//New instance, with exceptions enabled
	$body = load_mail_template(MAIL_TEMPLATE . 'ban.html', $profile);
	//print_r($body);
	$mail->Mailer = MAIL_SERVICE;
	$mail->PluginDir = APP_PATH . DS . 'locales' . DS;
	$mail->SetLanguage("ru", $mail->PluginDir);
	$mail->AddReplyTo(MAIL_FROM, MAIL_FROM_SIGN);
	$mail->From = MAIL_FROM;
	$mail->FromName = MAIL_FROM_SIGN;
	$mail->CharSet = 'utf-8';
	$mail->AddAddress($to);
	$mail->Subject = "you have ban";
	$mail->AltBody = load_mail_template(MAIL_TEMPLATE . 'ban.txt', $profile);
// optional, comment out and test
	$mail->WordWrap = 80; // set word wrap
	$mail->MsgHTML($body);
	$mail->IsHTML(true); // send as HTML
	$mail->Send();
	return "отправлено";
    } catch (phpmailerException $e) {
	return FALSE . $e->errorMessage();
    }
}

function load_mail_template($template, $data) {
    ob_start();
    extract($data);
    include($template); //get template file, parse variables
    $ret = ob_get_contents(); // store HTML in $template
    ob_end_clean();
    return $ret;
}

?>
