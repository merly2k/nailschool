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
if(@$_POST['hide']=='on'){$hide=1;}else{$hide=0;}
    echo $tags->insert($_POST['url'], $_POST['title'], $_POST['deckription'], $_POST['keywords'],$hide);
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
    $nt	 =  '<br><form method="post" action="' . WWW_ADMIN_PATH . 'settings/seo/former">' . PHP_EOL;
    $nt	 .= '     <div class="card">' . PHP_EOL;
    if ($url == $_SERVER["SERVER_NAME"])
    {
	$nt .= "<div class='card-header'>URL: " . $protocol . $_SERVER["SERVER_NAME"] . "/"
		. "<a href='" . $protocol . $_SERVER["SERVER_NAME"] . "'  target='_blank'> &nbsp;Перейти на страницу</a></div>" . PHP_EOL;
    }
    else
    {
	$nt .= "     <div class='card-header'>URL: " . $protocol . $_SERVER["SERVER_NAME"]."/" . $cll . " <a href='" . $protocol . $_SERVER["SERVER_NAME"].'/' . $cll . "' target='_blank'>Перейти на страницу</a></div>" . PHP_EOL;
    }
    if($row->hide==1){$status="checked='checked'";}else{$status='';}
    $nt	 .= $f->input('url', '', 'hidden', 'url', '', $cll) . PHP_EOL;
    $nt	 .= $f->input('Title', 'title', 'text', 'title', 'title', @$row->title) . PHP_EOL;
    $nt	 .= $f->Textarea("Description", 'deckription', @$row->deckription, 3) . PHP_EOL;
    $nt	 .= $f->Textarea("Keywords", 'keywords', @$row->keywords, 6) . PHP_EOL;
    $nt	 .= $f->checkbox('hide',"скрыть в сайтмапе",'hide',$status ) . PHP_EOL;
    $nt	 .= '<button class="btn btn-info" type="submit">Cохранить теги</button>' . PHP_EOL;
    $nt	 .= '</div>' . PHP_EOL
	    . '</form>' . PHP_EOL
	    . '<br>' . PHP_EOL;

    echo $nt;
}






































