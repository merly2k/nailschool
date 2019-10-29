<?php
set_time_limit(490);
$tpl		 = 'admin';
$mod_name	 = 'Импорт товаров';
$context	 = '<pre>';

use xmltojson as jd;

$ct	 = new model\category();
$tovar	 = new model\tovar();
$toption = new model\produkt_param();
$json	 = jd::Parse(APP_PATH . '/import/yandex_market.xml');

//$context.= print_r( $json ,true);
$categories = $json->shop->categories->category;
foreach ($categories as $k => $cat)
{
    $id	 = (array) $cat->attributes()->id;
    $catid	 = $id[0];
    $catname = (array) $cat[0];
    $catname = $catname[0];
    $param	 = array('id' => $catid, 'name' => $catname);
    $ct->insert($param);
}

$prod = $json->shop->offers->offer;
foreach ($prod as $r)
{
    $imglist = array();
    //print_r($r->picture);
    
    
	foreach ($r->picture as $url)
	{
	   // saveImage($url);
	    $imglist[] = basename($url);
	    //echo implode(', ', $imglist);
	}
    
    $PrId =$r->attributes()->id;
    $param = array(
	'id'		 => $r->attributes()->id,
	'article'	 => $r->vendorCode,
	'name'		 => $r->name,
	'meta'		 => '',
	'deckription'	 => $r->description,
	'type'		 => '',
	'price'		 => $r->price,
	'valut'		 => $r->currencyId,
	'otg'		 => 'шт',
	'min_obs'	 => '',
	'opt_price'	 => '',
	'min_opt'	 => '',
	'img'		 => implode(', ', $imglist),
	'show'		 => $r->pickup,
	'sklad'		 => '',
	'category'	 => $r->categoryId,
	'postavka'	 => $r->delivery,
	'brand'		 => $r->vendorCode,
	'country'	 => $r->country_of_origin,
	'discount'	 => '',
	'comment'	 => '',
	'fulURL'	 => translit($r->name),
	'YelowLabel'	 => ''
    );
    echo $tovar->insert($param);

    foreach ($r->param as $k => $v)
    {
	$param1 = array(
	    'prodID'=>$PrId,
	    'name_ua'	 => $v->attributes()->name,
	    'value_ua'	 => $v,
	    'unit_ua'	 => $v->attributes()->unit,
	    'name_ru'	 => '',
	    'value_ru'	 => '',
	    'unit_ru'	 => '',
	    'name_en'	 => '',
	    'value_en'	 => '',
	    'unit_en'	 => ''
	);
	$context.=$toption->insert($param1);
    }
}
$context .= '</pre>';

function saveImage($url) {
    $streamContext = stream_context_create(
    array('http'=>
        array(
            'timeout' => 12,  //12 seconds
        )
    )
);

//Pass this stream context to file_get_contents via the third parameter.
    $c		 = file_get_contents($url,false, $streamContext);
    $save_path	 = APP_PATH . "/images/product/" . basename($url);
    file_put_contents($save_path, $c);
    echo 'file' . basename($url). 'saved';
}

include TEMPLATE_DIR . DS . $tpl . ".html";



















































































































































































