<?php

$a	 = new model\faqo();
$id	 = $this->param[0];
$a->del($id);
echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "faqo'); }, 900)</script>";







