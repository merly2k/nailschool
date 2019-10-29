<?php

namespace seo;

class search {
    var $SearchSite;
    var $SearchWord;
    var $SearchRefer;
    var $SearchRPage;
    var $SearchPage;
    var $SearchTime;

function Yandex_str($str)
{
//  text=
    parse_str($str);
    if (isset($text))
    {
    if (isset($p))
    {
        $this->SearchPage = $p;
        $this->SearchPage++;
        return convert_cyr_string ($text, "k", "w");
    }
    return $text;
    }
}

function Rambler_str($str)
{
//  words=
    parse_str($str);
    if (isset($words))
    {
        if (isset($start))
        {
            $this->SearchPage = round($start/15);
            $this->SearchPage++;
        }
    return $words;
    }
}

function MailRu_str($str)
{
//  q==
    parse_str($str);
    if (isset($q))
    {
        if (isset($num))
        {
            $this->SearchPage = round($num/10);
            $this->SearchPage++;
        }
    return $q;
    }
}

function Google_str($str)
{
//  q=
    parse_str($str);
    if (isset($q))
    {
        if (isset($start))
        {
            $this->SearchPage = round($start/10);
            $this->SearchPage++;
        }
    return utf2win($q);
    }
}

function Aport_str($str)
{
//  r=
    parse_str($str);
    if (isset($r))
    {
        if (isset($p))
        {
        $this->SearchPage = $p;
        $this->SearchPage++;
        }
    return $r;
    }
}

function Yahoo_str($str)
{
//  p=
    parse_str($str);
    if (isset($p))
    {
    return utf2win($p);
    }
}

function Aol_str($str)
{
//  query=
    parse_str($str);
    if (isset($query))
    {
    return $query;
    }
}

function Msn_str($str)
{
//  q=
    parse_str($str);
    if (isset($q))
    {
        if (isset($first))
        {
            $this->SearchPage = round($first/10);
            $this->SearchPage++;
        }
    return utf2win($q);
    }
}

function SearchWords($SRefer, $SPage, $STime)
{
    global $_SERVER;
$tmp = parse_url(urldecode(trim($SRefer)));
$site = $tmp['host'];
$str = $tmp['query'];
$this->SearchPage = 1;
if (eregi("yandex", $site)) // Yandex
{
    $s_word = $this->Yandex_str($str);
}
elseif (eregi("rambler.", $site)) // Rambler
{
    $s_word = $this->Rambler_str($str);
}
elseif(eregi("mail.ru", $site)) //MailRu
{
    $s_word = $this->MailRu_str($str);
}
elseif (eregi("google.", $site)) // Google
{
    $s_word = $this->Google_str($str);
}
elseif (eregi("sm.aport", $site)) // Aport
{
    $s_word = $this->Aport_str($str);
}
elseif (eregi("yahoo", $site)) // Yahoo
{
    $s_word = $this->Yahoo_str($str);
}
elseif (eregi("aolsearch", $site)) // AOL
{
    $s_word = $this->Aol_str($str);
}
elseif (eregi("msn.com", $site)) // MSN
{
    $s_word = $this->Msn_str($str);
}
else // N/A
{
    $s_word = FALSE;
}
    $this->SearchSite = $site;
    $this->SearchWord = $s_word;
    $this->SearchRefer = $SRefer;
    $this->SearchRPage = $SPage;
    $this->SearchTime = $STime;
}

function SearchWordsFromClass($SSW)
{
$this->SearchWords($SSW->SRefer, $SSW->SPage, $SSW->STime);
}

function Load($arr)
{
$this->SearchSite   = @$arr[0];
$this->SearchWord   = @$arr[1];
$this->SearchRefer  = @$arr[2];
$this->SearchRPage  = @$arr[3];
$this->SearchPage   = @$arr[4];
$this->SearchTime   = @$arr[5];
}
}
