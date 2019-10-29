<?php

$otherTown = '';
if (isset($_SESSION['lang']))
{
    $lang = mb_strtolower($_SESSION['lang']);
}
else
{
    $lang = "ua";
}


$fidOut		 = '';
$fe		 = new model\feedbask();
$km		 = new model\misto();
$ra		 = new model\curses();
$mlang		 = 'name_' . $lang;
$anoncelang	 = 'anonce_' . $lang;
$addr		 = 'addr_' . $lang;
$declang	 = 'decription_' . $lang;
$townItem	 = '';
$tfut		 = '';
foreach ($km->getall()as $k => $r)
{

    $tfut		 .= '<div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-2">
	<b>' . $r->$mlang . '</b>
		<p class="tel">+38 067 867 65 33</p>
		<span class="social-icon">
	        <a href=""><img class="link-shop" src="' . WWW_IMG_PATH . 'tw.png" alt=""></a>
	        <a href=""><img class="link-shop" src="' . WWW_IMG_PATH . 'fb.png" alt=""></a>
		</span>

	</div>';
    //print_r($r);
    $mista[$r->link] = $r->$mlang;
    $otherTown	 .= '<a class="dropdown-item" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '/">' . $r->$mlang . '</a>';
    $butons		 = array(
	'ua'	 => array(
	    "b1"	 => 'перейти на сторінку',
	    "b2"	 => 'навчального центра'
	),
	'ru'	 => array(
	    "b1"	 => 'перейти на страницу',
	    "b2"	 => 'учебного центра'
	)
    );
    if ($k % 2)
    {
	$townItem .= '<div class="row">
		<div class="col-md-6">
		    <img class="img-fluid d-block" src="' . WWW_IMG_PATH . $r->image . '" alt="' . $r->$mlang . '" >
		</div>
		<div class="col-md-6">
		    <div class="text  align-middle">
			<span class="gradient-text">' . $r->$mlang . '</span>
			<p>' . $r->$addr . '</p>
			<div class="link-cities gradient-text">
			    <span><b>' . $butons[$lang]['b1'] . '</b></span>
			    <a class="site_btn" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '/">' . $butons[$lang]['b2'] . '</a>
			</div>
		    </div>
		</div>
	</div>
	';
    }
    else
    {
	$townItem .= '<div class="row">
		<div class="col-md-6">
		    <div class="text  align-middle">
			<span class="gradient-text">' . $r->$mlang . '</span>
			<p>' . $r->$addr . '</p>
			<div class="link-cities gradient-text">
			    <span><b>' . $butons[$lang]['b1'] . '</b></span>
			    <a class="site_btn" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '/">' . $butons[$lang]['b2'] . '</a>
			</div>
		    </div>
		</div>
		<div class="col-md-6">
		    <img class="img-fluid d-block" src="' . WWW_IMG_PATH . $r->image . '" alt="' . $r->$mlang . '" >
		</div>
	</div>
	';
    }
}
$ffar = $fe->getAll();
foreach ($ffar as $k => $it)
{
    
    $misto	 = 'misto_' . $lang;
    $name	 = 'name_' . $lang;
    $feed	 = 'feed_' . $lang;
    $ag	 = array('ua' => ' роки', 'ru' => ' лет');

    if ($k == 0)
    {
	$asi	 = 'active';
	$fidOut	 .= "<div class='carousel-item row no-gutters $asi'>";
	$fidOut	 .= '
	    <div class="col-4 float-left card border-light">
    <img class="photo-graduate" src="' . WWW_IMG_PATH . $it->image . '" alt="">
    <p class="name-graduate">' . $it->$name . ', ' . $it->age . $ag[$lang] . ' </p>
    <span class="sity-graduate">' . $it->$misto . '</span>
    <p class="courses-graduate">' . $it->$feed . '</p>
	    </div>';
	
    }
    elseif (($k+1) == count($ffar))
    {
	$fidOut	 .= '
	    <div class="col-4 float-left card border-light">
    <img class="photo-graduate" src="' . WWW_IMG_PATH . $it->image . '" alt="">
    <p class="name-graduate">' . $it->$name . ', ' . $it->age . $ag[$lang] . ' </p>
    <span class="sity-graduate">' . $it->$misto . '</span>
    <p class="courses-graduate">' . $it->$feed . '</p>
	    </div>';
	$fidOut	 .= "</div>";
    }
    elseif (($k+1) % 3 == 0)
    {
	$fidOut	 .= '
	    <div class="col-4 float-left card border-light">
    <img class="photo-graduate" src="' . WWW_IMG_PATH . $it->image . '" alt="">
    <p class="name-graduate">' . $it->$name . ', ' . $it->age . $ag[$lang] . ' </p>
    <span class="sity-graduate">' . $it->$misto . '</span>
    <p class="courses-graduate">' . $it->$feed . '</p>
	    </div>';
	$fidOut	 .= "</div>"
		. "<div class='carousel-item row no-gutters'>";
    }
    else
    {

$fidOut	 .= '
	    <div class="col-4 float-left card border-light">
    <img class="photo-graduate" src="' . WWW_IMG_PATH . $it->image . '" alt="">
    <p class="name-graduate">' . $it->$name . ', ' . $it->age . $ag[$lang] . ' </p>
    <span class="sity-graduate">' . $it->$misto . '</span>
    <p class="courses-graduate">' . $it->$feed . '</p>
	    </div>';
    }
}
$acsia = $ra->GetRandAction();
if ($acsia != '')
{
    if ($lang == 'ua')
    {
	$act_lan = 'Акція!';
	$aza	 = 'Записатись на курс!';
    }
    else
    {
	$act_lan = 'Акция!';
	$aza	 = 'Записаться на курс!';
    }
    $randAction = '<div class="container">
    <div class="row">
    <div class="col-1"></div>
	<div class="col-6">
	    <p class="bgw"><img class="medium-ico" src="images/location-icon-white.png" alt="">' . $mista[$acsia->miso] . '</p>
	    <p class="bgw">' . $acsia->$mlang . '<br>
	    <b>' . $acsia->$anoncelang . '</b></p>
        </div>
	<div class="col-4">
	    <p class="sale__text">' . $act_lan . ' <del>' . $acsia->coast . '</del> <strong>' . $acsia->ac_coast . '</strong> грн
	    <a href="' . $acsia->link . '" class="sale__btn" style="cursor: pointer;" data-toggle="modal" data-target="#akcia">
	    ' . $aza . '</a>
	    </p>
	</div>
	<div class="col-1"></div>
	</div>
	</div>';
}
else
{
    $randAction = '';
}

$film	 = new model\video();
$video	 = '';
$c	 = 0;
foreach ($film->getList() as $vi)
{
    $c++;
    if ($c <= 1)
    {
	$acty = 'active';
    }
    else
    {
	$acty = '';
    }
    if ($lang == 'ua')
    {
	$dekr = 'dekr_ua';
    }
    else
    {
	$dekr = 'decr_ru';
    }
    $video .= '
     <div class="carousel-item align-content-center ' . $acty . '">
	' . $vi->link . '
	<div class="popup">
	    <b>КУРС МАНИКЮРА</b>
	    <p class="www">' . $vi->$dekr . '</p>
	    <a class="gradient-text" href="#" tabindex="0">Записаться на курс</a>
	</div>
    </div>
    ';
}

$tpl = 'indexn';
include TEMPLATE_DIR . $tpl . ".html";
?>
