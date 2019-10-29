<?php

print_r($_POST);
$a = new model\setting();
$a->deleteSetting($_POST["id"]);
header('Refresh: 0; url=' . WWW_ADMIN_PATH . 'setting');
