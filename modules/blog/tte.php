<?php

$r	 = new model\blog();
$zz	 = $r->getTags();
foreach ($zz as $k => $v)
{
    $t[] = '{text: "' . $k . '", weight: "' . $v . '"}';
}
$za = implode(', ', $t);
print_r($za);
