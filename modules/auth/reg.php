<?php

//
error_reporting(99999);
print_r($_POST);
if ($_POST):
    saveUser();
endif;

function saveUser($referer = 0) {

    $dbs = new db();

    extract($_POST);
    //[login][password][confirm]
    $q = "INSERT INTO `user` ("
            . " `login`,"
            . " `password`,"
            . " `role`,"
            . " `api_key`,"
            . " `seq_key`)"
            . " VALUES ("
            . "'$login',"
            . " MD5('$password'),"
            . " '2',"
            . " '',"
            . " '')"
            . "; ";
    echo $q;
    $dbs->query($q);
    $content = '' . $dbs->lastState;
    $template = "empty";

    include TEMPLATE_DIR . $template . ".html";
}

?>
