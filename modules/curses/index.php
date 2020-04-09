<?php

$otherTown = '';
if (isset($_SESSION['lang']))
{
    $lang = mb_strtolower(@$_SESSION['lang']);
}
else
{
    $lang = "ua";
}
$link = $this->param[0];

$km		 = new model\misto();
$currentMisto	 = ($km->getByName($link));
$mlang		 = 'name_' . $lang;
$curses		 = new model\curses();
$packs		 = new model\packets();
$bc['ua']	 = 'Курси ';
$bc['ru']	 = 'Курсы ';
$vidminnik	 = array('ua'	 => array(
	'dnipro'	 => 'у Дніпрі',
	'kyiv'		 => 'у Київі',
	'zaporizhzhya'	 => 'у Запоріжжї',
	'nicolaev'	 => 'у Миколаєві',
	'virtual'	 => 'on-line',
    ),
    'ru'	 => array(
	'dnipro'	 => 'в Днепре',
	'kyiv'		 => 'в Киеве',
	'zaporizhzhya'	 => 'в Запорожье',
	'nicolaev'	 => 'в Николаеве',
	'virtual'	 => 'on-line',
    )
);
if ($link != 'virtual')
{
    $tpl = "courses";
}
else
{
    $tpl = "olcourses";
}
foreach ($km->getall($link)as $r)
{
    //print_r($r);

    $curMistoLink	 = $link;
    $otherTown	 .= '<a class="dropdown-item" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '/">' . $r->$mlang . '</a>';
    $item		 = '';
}

$misto	 = $currentMisto->$mlang;
$gmap	 = $currentMisto->gmap;
foreach ($curses->getALL($curMistoLink) as $curs)
{
    //print_r($curs);

    $name	 = 'name_' . $lang;
    $anonce	 = 'anonce_' . $lang;
    $zia	 = array();
    $zia	 = explode(' ', $curs->$mlang);
//echo count($zia);
    $nth	 = 'nth-word-' . count($zia);

    if ($lang == 'ua')
    {
	$ddey = numberof($curs->finish, ' д', array('ень', 'ні', 'нів'));
    }
    else
    {
	$ddey = numberof($curs->finish, ' д', array('ень', 'ня', 'ней'));
    }
    if ($curs->ac_coast > 0)
    {
	$price = $curs->ac_coast;
    }
    else
    {
	$price = $curs->coast;
    }
    if ($curs->action == 'Y')
    {
	$sb	 = "sale_button";
	$pb	 = '<strong class="' . $sb . '"><span class="oldprice">' . $curs->coast . '</span><span class="newprice">' . $curs->ac_coast . '</span></strong> грн <div class="pod"></div>';
    }
    else
    {
	$sb	 = "";
	$pb	 = '<strong class="' . $sb . '">' . $curs->coast . '</strong> грн <div class="pod"></div>';
    }
    $item .= '<a class="course__item" href="' . WWW_BASE_PATH . 'curses/curse/' . $curMistoLink . '/' . $curs->link . '">
                    <div>
			<h2 class="course__headline"><strong  class="' . $nth . '">' . $curs->$name . '</strong></h2>
                        <p class="course__title">' . $curs->$anonce . '</p>
                    </div>
                    <div class="course__price">
			<div class="wrapper_course_price ' . $sb . '">
                            <div class="course__price__price">
                                ' . $pb . '
                            </div>
                        </div>
                    <span class="course__price__day"><strong>' . $curs->finish . '</strong>' . $ddey . '</span>
                    </div>
                </a>';
}

$packets = '';
$packets = ' <section class="course-package-outer">
<h2 class="section-title">' . l('z4') . '</h2>';
foreach ($packs->getPackets($link) as $k)
{
    //print_r($k);
    $kcount		 = 0;
    $kurses		 = new model\curses();
    $cursesblosk	 = '';
    $totalcoast	 = 0;
    //print_r($k);

    for ($index = 1; $index <= 7; $index++)
    {
	$kurs = 'kurs' . $index . '_id';
	if ($k->$kurs != 0 and $k->$kurs != '')
	{
	    $r = $kurses->getCurseById($k->$kurs);

	    $cursesblosk	 .= '<li class="course-package-list__item">
                        <span class="course-package-list__name">
                        <a href="' . WWW_BASE_PATH . 'curses/curse/' . $curMistoLink . '/' . $r->link . '">  <strong>' . $r->$mlang . '</strong></a>
			</span>
                            <span class="course-package-list__price">
                          <strong>' . $r->coast . '</strong> грн</span>
                        </li>';
	    $totalcoast	 += $r->coast;
	    $kcount++;
	}
    }
    $econ	 = ($lang == 'ua') ? 'ЕКОНОМІЯ' : 'ЭКОНОМИЯ';
    $vcon	 = ($lang == 'ua') ? 'Вартість з урахуванням знижки' : 'Стоимость пакета с учетом скидки';
    $dcon	 = ($lang == 'ua') ? 'Вартість всіх пакетів окремо' : 'Стоимость всех пакетов по отдельности';

    $cocon = l('seminar_select');

    $seminarcoast	 = '700.00';
    $filename	 = WWW_BASE_PATH . "svggen/$kcount/$k->dayz/$lang";
    $svgimg		 = file_get_contents($filename);
    $packets	 .= '<div class="container">
		<div class="course-package">
		    <div class="svg-container"><a class="shm" data-toggle="modal" data-target="#calme" data-id="' . $k->id . '" data-name="' . $k->$name . '">' . $svgimg . '</a></div>
		    <div class="course-package_mid">
                    <ul class="course-package-list">
                        <li class="course-package__headline"><a class="shm" data-toggle="modal" data-target="#calme" data-id="' . $k->id . '" data-name="' . $k->$name . '">«' . $k->$name . '»</a></li>'
	    . $cursesblosk;
    if ($k->seminar == 'Y')
    {
	$packets	 .= '<li class="course-package-list__item">'
		. '<span class="course-package-list__name"><strong>' . $cocon . '</strong></span>
	    <span class="course-package-list__price">
                          <strong>' . $seminarcoast . '</strong> грн</span></li>
                    </ul>';
	$totalcoast	 = $totalcoast + $seminarcoast;
    }
    $packets .= '  <p class="alone-price">
                    <span>' . $dcon . ':</span>
                    <span><strong class="alone-price_delete">' . $totalcoast . '</strong>грн</span>
                    </p>
                </div>

                <div class="package-price">
                    <p class="package-price__title">' . $vcon . ': </p>
                    <div class="package-price__price"><strong>' . $k->coast . '</strong>грн</div>
                    <div class="package-price__price">
                        <strong>' . $econ . '</strong>
                        <span class="package-price__price_alert"><strong>' . ($totalcoast - $k->coast) . '</strong>грн</span>
                    </div>
		    <a class="shm btn btn-warning btn-lg btn-block text-uppercase font-weight-bold" data-toggle="modal" data-target="#calme" data-id="' . $k->id . '" data-name="' . $k->$name . '">' . l('z3') . ' </a>
                </div>
            </div>
            </div>
';
}
$packets .= '</section>';
$cc	 = $bc[$lang] . $vidminnik[$lang][$link];

include TEMPLATE_DIR . $tpl . ".html";
