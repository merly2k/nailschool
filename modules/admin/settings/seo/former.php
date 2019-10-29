<?php

//print_r($this);
$f = new bootstrap\input();
$tags = new model\seobase();
if ($_POST) {
//   print_r($_POST);
echo   $tags->insert($_POST['url'], $_POST['title'], $_POST['deckription'], $_POST['keywords']);
    header("location: ".WWW_ADMIN_PATH."settings/seo/metatags");
} else {
    $uri = implode('/', $this->param);
    $row=$tags->getByUrl($uri);
        
    //print_r($row);
    
    if (isset($row->url)) {
        $url = $this->protocol.$row->url;
    } else {
        $url = $this->protocol . $uri;
    }
    $nt = '<form method="post" action="' . WWW_ADMIN_PATH . 'settings/seo/former">' . PHP_EOL;
    $nt .= '     <div class="card">' . PHP_EOL;
    $nt .= "     <div class='card-header'>URL: " . $url . " <a href='" . $url . "' target='_blank'>Перейти на страницу</a></div>" . PHP_EOL;
    $nt .= $f->input('url', '', 'hidden', 'url', '', $row->url) . PHP_EOL;
    $nt .= $f->input('Title', 'title', 'text', 'title', 'title', @$row->title) . PHP_EOL;
    $nt .= $f->Textarea("Description", 'deckription', @$row->deckription, 3) . PHP_EOL;
    $nt .= $f->Textarea("Keywords", 'keywords', @$row->keywords, 6) . PHP_EOL;
    $nt .= '<button class="btn btn-info" type="submit">Cохранить теги</button>' . PHP_EOL;
    $nt .= '</div>' . PHP_EOL
            . '</form>' . PHP_EOL
            . '<br>' . PHP_EOL;

    echo $nt;
}














