<?php

//print_r($_POST);
$a = new model\setting();
$a->UpdateSetting($_POST);
header('Refresh: 0; url=' . WWW_ADMIN_PATH . 'setting');
