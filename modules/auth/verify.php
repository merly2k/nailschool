<?php

//открывает сессию
session_start();
//проверяет соответствие коду CAPTCHA
if ($_SESSION["code"] == $_POST["captcha"]) {
    //сообщаем строку true, если код соответствует
    echo 'true';
} else {
    //сообщаем строку false, если код не соответствует
    echo 'false';
}
?>