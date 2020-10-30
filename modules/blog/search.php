<?php

if (isset($_SESSION['lang']))
{
    $lang = mb_strtolower($_SESSION['lang']);
}
else
{
    $lang = "ua";
}
$otherTown	 = '';
$mlang		 = 'name_' . $lang;
$km		 = new model\misto();
if (!isset($this->param[0]))
{
    $page = 0;
}
$termin	 = $_POST['search'];
$bl	 = new model\blog();
// Создаем строку для регулярного выражения
$pattern = "/((?:^|>)[^<]*)(" . $termin . ")/si";
// Подсвеченная строка
$replace = '$1<b style="color:#FF0000; background:#FFFF00;">$2</b>';
// Заменяем
$out	 = '';
foreach ($bl->search($termin) as $html)
{
    $out	 .= "<div class='row'><h3><a href='" . WWW_BASE_PATH . "blog/page/" . $html->link . "'>";
    $out	 .= preg_replace($pattern, $replace, $html->title, -1, $count1);
    $out	 .= "</a></h3>";
    $z	 = preg_replace($pattern, $replace, $html->content, - 1, $count2);

    $out	 .= "<p class='text-muted'>" . wph_cut_by_words(380, strip_tags($z)) . "<p>";
    $out	 .= "" . l('found:') . ($count1 + $count2) . '</div>';
}
echo $out;

function wph_cut_by_words($maxlen, $text) {
    $len	 = (mb_strlen($text) > $maxlen) ? mb_strripos(mb_substr($text, 0, $maxlen), ' ') : $maxlen;
    $cutStr	 = mb_substr($text, 0, $len);
    $temp	 = (mb_strlen($text) > $maxlen) ? $cutStr . '...' : $cutStr;
    return $temp;
}

function tagcloud() {
    $r	 = new model\blog();
    $zz	 = $r->getTags();
    foreach ($zz as $k => $v)
    {
	if ($v > 1):
	    $t[] = '{text: "' . $k . '", weight: "' . $v . '"}
		';
	endif;
    }
    $za = implode(', ', $t);
    return($za);
}

$template	 = 'blog-page';
$tags		 = tagcloud();
include TEMPLATE_DIR . DS . $template . ".html";
