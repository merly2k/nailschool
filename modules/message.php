<?php
// [name][email][phone][title][message]
extract($_POST);
$type=(!$_POST['type'])?'oter':$_POST['type'];
$template='scontact';
$s=new model\setting();
$r=$s->get('adminMail');

        $address = $r[0]->val;
        $from = $r[0]->val;
        $append='';
        $subject = "новое обращение на сайте";
        $tt = new templator();
        $tt->LoadTemplate('mail' . DS . 'default');
        $mbody = array('unsubckrible' => '', 'maintext' => "$umessage", 'append' => "$append");
        $body = $tt->Render($mbody);
        echo mailagent($from,$from, $subject, $body);
        
        

