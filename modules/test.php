<?php

ini_set("max_execution_time", 0);
$tpl		 = 'admin';
$context	 = '';
$nt		 = '';
$toc		 = '';
$brouse		 = '';
$lsize		 = '';
$mod_name	 = "SEO/Метатеги сайта по страницам";
$tags		 = new model\seobase();
$list		 = new seo\sitemap();
//$list->get_links(WWW_BASE_PATH);
$list->set_ignore(array("javascript:", "#", "malito:", "tg:", "tel:", "viber:", "skype:", ".css", ".js", ".ico", ".jpg", ".png", ".jpeg", ".swf", ".gif", "curse/"));
$list->get_links(WWW_BASE_PATH);
//$list->set_ignore(array("javascript:", "malito:","(#*.)","chat", "tel:", "viber:", "skype:", ".css", ".js", ".ico", ".jpg", ".png", ".jpeg", ".swf", ".gif"));
$real		 = $list->get_array();
$realz		 = array();
echo "<pre>";
//print_r($real);
foreach ($real as $ur)
{
    $ra	 = preg_split("#/#", $ur);
    $va	 = array_reverse(array_splice($ra, 2));
    $ba	 = array_splice($va, 2);
    echo "BA:";
    print_r($ba);
    $f	 = count($va);
    echo "VA:";
    print_r($va);
    echo $f . '<hr>';
    if (isset($va[0])and $va[0] != ''):
	$jdat[] = "['" . @$va[0] . "', '" . $va[1] . "','" . $ur . "']";
    else:
	$jdat[] = "['" . @$ba[0] . "', '" . $va[1] . "','" . $ur . "']";
    endif;
}
$r	 = ",
";
$jdat	 = implode($r, $jdat);

echo $jdat;
