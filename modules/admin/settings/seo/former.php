<?php

//print_r($this);
$f		 = new bootstrap\input();
$tags		 = new model\seobase();
$brouse		 = '';
$lsize		 = '';
$protocol	 = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
if ($_POST)
{
//   print_r($_POST);
    echo $tags->insert($_POST['url'], $_POST['title'], $_POST['deckription'], $_POST['keywords']);
    header("location: " . WWW_ADMIN_PATH . "settings/seo/metatags");
}
else
{
    $uri	 = implode('/', $this->param);
    //echo $uri . "<br>";
    $cll	 = preg_replace("@" . $_SERVER["SERVER_NAME"] . "/@", '', $uri);

    $row = $tags->getByUrl($cll);

    //print_r($row);

    if (isset($row->url))
    {
	$url = $row->url;
    }
    else
    {
	$url = $uri;
    }
    $nt	 = '' . $cll . '<br><form method="post" action="' . WWW_ADMIN_PATH . 'settings/seo/former">' . PHP_EOL;
    $nt	 .= '     <div class="card">' . PHP_EOL;
    if ($url == $_SERVER["SERVER_NAME"])
    {
	$nt .= "<div class='card-header'>URL: " . $protocol . $_SERVER["SERVER_NAME"] . "/"
		. "<a href='" . $protocol . $_SERVER["SERVER_NAME"] . "'  target='_blank'> &nbsp;Перейти на страницу</a></div>" . PHP_EOL;
    }
    else
    {
	$nt .= "     <div class='card-header'>URL: " . $protocol . $_SERVER["SERVER_NAME"] . '/' . $url . " <a href='" . $protocol . $_SERVER["SERVER_NAME"] . '/' . $url . "' target='_blank'>Перейти на страницу</a></div>" . PHP_EOL;
    }
    $nt	 .= $f->input('url', '', 'hidden', 'url', '', $row->url) . PHP_EOL;
    $nt	 .= $f->input('Title', 'title', 'text', 'title', 'title', @$row->title) . PHP_EOL;
    $nt	 .= $f->Textarea("Description", 'deckription', @$row->deckription, 3) . PHP_EOL;
    $nt	 .= $f->Textarea("Keywords", 'keywords', @$row->keywords, 6) . PHP_EOL;
    $nt	 .= '<button class="btn btn-info" type="submit">Cохранить теги</button>' . PHP_EOL;
    $nt	 .= '</div>' . PHP_EOL
	    . '</form>' . PHP_EOL
	    . '<br>' . PHP_EOL;

    echo $nt;
}



































