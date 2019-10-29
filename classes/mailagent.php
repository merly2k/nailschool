<?php
class mailagent {

 private $_SMTPServer = 'smtp.gmail.com';
 private $_SMTPLogin = 'merly2k@gmail.com';
 private $_SMTPPass = 'vfcnth';
 private $_mail = null;
 private $_mailFrom = 'email';

 private function initMailAgent()
 {
  require_once('class.phpmailer.php');

  $this->_mail  = new phpailer();
  // Устанавливаем, что наши сообщения будет идти через
  // SMTP сервер
  $this->_mail->IsMail();
  

  // Можно раскомментировать след. строчку для отладки
  // 1 = Ошибки и сообщения
  // 2 = Только сообщения
  //$mail->SMTPDebug  = 0;        		

  // Включение SMTP аутентификации
  // Большинство серверов ее требуют
  //$this->_mail->SMTPAuth   = true;
  // SMTP Сервер отправки сообщений
  //$this->_mail->Host       = $this->_SMTPServer;
  // Порт сервера (чаще всего 25)
  //$this->_mail->Port       = 25;
  // SMTP Логин для авторизации
  //$this->_mail->Username   = $this->_SMTPLogin;
  // SMTP Пароль для авторизации
  //$this->_mail->Password   = $this->_SMTPPass;
  // Кодировка сообщения
  //$this->_mail->CharSet    = 'utf-8';
 }

 public function sendMail( $address, $subject, $body, $from='' )
 {
  if ($this->_mail == null) {
   $this->initMailAgent();
  }

  // Устанавливаем от кого будет уходить почта
  $this->_mail->SetFrom($from=='' ? $this->_mailFrom : $from);
  // Устанавливаем заголовк письма
  $this->_mail->Subject    = $subject;
  // Текст сообщения
  $this->_mail->MsgHTML($body);

  if (is_array($address)) {
   // Отправка сообщений сразу нескольким пользователям
   foreach($address as $value) {
    $this->_mail->AddAddress($value);
   }
  } else {
   // Адрес получателя. Второй параметр - имя получателя (не обязательно)
   $this->_mail->AddAddress($address);
  }
  // Отправляем сообщение
  if(!$this->_mail->Send()) {
    echo "Ошибка отправки: " . $this->_mail->ErrorInfo;
  } else {
    echo "Сообщение отправлено!";
  }
 }

}

?>
