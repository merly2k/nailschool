<?php
$a= new model\curses();
$id= $this->param[0];
$a->delCurse($id);
echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "curses'); }, 900)</script>";




