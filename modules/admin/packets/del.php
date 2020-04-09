<?php

$a	 = new model\packets();
$id	 = $this->param[0];
$a->delPackets($id);
echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "packets'); }, 900)</script>";







