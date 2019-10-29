<?php

namespace seo;


class SaveSearchWord
{
    var $SRefer;
    var $SPage;
    var $STime;

function Load($arr)
{
$this->SRefer     = trim(@$arr[0]);
$this->SPage      = trim("http://".$_SERVER['HTTP_HOST'].trim(@$arr[1]));
$this->STime      = trim(@$arr[2]);
}

function Set($SRefer, $SPage, $STime)
{
$this->SRefer     = trim($SRefer);
$this->SPage      = trim($SPage);
$this->STime      = trim($STime);
}
}