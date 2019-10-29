<?php

//print_r($_POST);
$tr=new \model\translation();
echo $tr->updateTranslation($_POST);
echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "settings/translation/'); }, 900)</script>";
