<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of atmail
 *
 * @author vyhodnoj
 */
class atmail {
    public $from;
    public $subj;
    public $to;
    public $body;
    private $encoding;
    private $headers;
    public function __construct() {
	$this->from="From: Служба поддержки пользователей <noreplay@finansicalservice.com>";
	$this->subj = 'Служба поддержки пользователей'; //Загаловок сообщения
	$this->headers .= "X-Sender: testsite < mail@finansicalservice.com >\n";
	$this->headers  = 'MIME-Version: 1.0' . "\r\n";
	$this->headers .= "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $this->headers .= "From: Служба поддержки пользователей <noreplay@finansicalservice.com>\r\n"; //Наименование и почта отправителя
	$this->headers .= 'X-Mailer: PHP/' . phpversion();
	$this->headers .= "X-Priority: 1\n"; // Urgent message!
	$this->headers .= "Return-Path: noreplay@finansicalservice.com\n"; // Return path for errors
    }
public function prepare($message) {
    $this->body = '
                <html>
                    <head>
                        <title>'.$this->subj.'</title>
                    </head>
                    <body>
                        <p>'.$message.'</p>
                        <p></p>                        
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
    echo $this->body;
}
function send() {
    
   if(@mail($this->to, $this->subj, $this->body, $this->headers)){
       return 1;
   }  else {
    return 0;
};
}
}