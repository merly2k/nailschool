<?php

error_reporting(0);
if (isset($_SESSION['lang']))
{
    $lang = mb_strtolower(@$_SESSION['lang']);
}
else
{
    $lang = "ua";
}


if (!isset($this->param[0])):
    $tpl		 = "town";
    $misto		 = array(
	"ua"	 => "вибір міста",
	"en"	 => "Select the town",
	"ru"	 => "вибор города",
    );
    $ob		 = array(
	"ua"	 => "Оберіть місто",
	"en"	 => "Select the town",
	"ru"	 => "Выберите город",
    );
    $upl		 = array(
	"ua"	 => "На жаль, місто не обрано!<br> Оберіть місто у меню.",
	"ru"	 => "Вы не выбрали город!<br> Выберите город в меню."
    );
    $ups		 = $upl["$lang"];
    $curmisto	 = $ob["$lang"];
    $mlang		 = 'name_' . $lang;
    $otherTown	 = '';
    $mashas		 = WWW_IMAGE_PATH . 'grl/girl.png';
    $km		 = new model\misto();

    foreach ($km->getAll() as $r)
    {
	$otherTown .= "<a class='dropdown-item' href='" . WWW_BASE_PATH . "curses/" . $r->link . "'>" . $r->$mlang . "</a>
		";
    }

else:

    if (isset($this->param[1])):

	$lname		 = 'name_' . $lang;
	$ldecription	 = 'decription_' . $lang;
	$mlang		 = 'name_' . $lang;
	$addr		 = 'addr_' . $lang;
	$otherTown	 = '';
	$tfut		 = '';
	$lfulltext	 = 'fulltext_' . $lang;
	$km		 = new model\misto();
	$link		 = $this->param[0];
	$currentMisto	 = ($km->getByName($link));
//print_r($currentMisto);
	$addr		 = 'addr_' . $lang;
	$ttown		 = 'name_' . $lang;
	$fulladress	 = $currentMisto->$ttown . ',' . strip_tags($currentMisto->$addr);
	$misto		 = $currentMisto->$mlang;
	$gmap		 = $currentMisto->gmap;
	foreach ($km->getall()as $k => $r)
	{
	    $mista[$r->link] = $r->$mlang;
	    $otherTown	 .= '<a class="dropdown-item" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '">' . $r->$mlang . '</a>';

	    $butons = array(
		'ua'	 => array(
		    "b1"	 => 'перейти на сторінку',
		    "b2"	 => 'навчального центра'
		),
		'ru'	 => array(
		    "b1"	 => 'перейти на страницу',
		    "b2"	 => 'учебного центра'
		)
	    );
	}



//print_r($this->param);
	$town	 = $this->param[0];
	$link	 = $this->param[1];
	switch ($town)
	{
	    case 'virtual':

		$tpl = "online";

		break;

	    default:
		$tpl = 'curse';

		break;
	}

	$faddr		 = $km->getByName($town);
	$sch		 = new model\school();
	$school		 = $sch->getByLink($town);
//print_r($school);
	$sch_osnashennia = htmlspecialchars_decode($school->{'osnashennia_' . $lang}, ENT_NOQUOTES);
	$sch_ergonomik	 = htmlspecialchars_decode($school->{'ergonomik_' . $lang}, ENT_NOQUOTES);
	$sch_location	 = htmlspecialchars_decode($school->{'location_' . $lang}, ENT_NOQUOTES);
	$sch_shop	 = htmlspecialchars_decode($school->{'shop_' . $lang}, ENT_NOQUOTES);
	$sch_konsult	 = htmlspecialchars_decode($school->{'konsult_' . $lang}, ENT_NOQUOTES);
	$sch_tur	 = htmlspecialchars_decode($school->{'tur_' . $lang}, ENT_NOQUOTES);
	if (firstChar($faddr->fb) != '#')
	{
	    $tfut = '
        <a target="_blank" href="' . $faddr->fb . '"><i class="fab fa-facebook-square"></i></a>';
	}
	if (firstChar($faddr->inst) != '#')
	{
	    $tfut .= '        	<a target="_blank" href="' . $faddr->inst . '"><i class="fab fa-instagram"></i></a>';
	}
	$tfut	 .= '<a target="_blank" href = "https://www.youtube.com/channel/UCZcCF_9g8Cp2mE1WG66IEjg"><i class = "fab fa-youtube-square"></i></a>
';
	$curses	 = new model\curses();
	$cc	 = $curses->getCurse($town, $link);

	$k = $cc[0];

	if ($k->darunok == 'N')
	{
	    $valut = '';
	}
	else
	{
	    $darlang = 'darunok_' . $lang;
	    $valut	 = $k->$darlang . '<br>';
	}

	$zia	 = array();
	$zia	 = explode(' ', $k->$mlang);
//echo count($zia);
	$nth	 = 'nth-word-' . count($zia);
	if (isset($k->{'googldock_' . $lang}))
	{
	    $gdoc = $k->{'googldock_' . $lang};
	}
	else
	{
	    $gdoc = '#';
	}
//echo $gdoc;
	if (firstChar($gdoc) != '#'):
	    $btnDetail = '<a href="' . $gdoc . '" class="btn btn-warning btn-lg btn-block text-uppercase font-weight-bold" target="_blanc" >' . l('detail_btn') . '</a>';
	else:
	    $btnDetail = '<a class="btn btn-warning btn-lg btn-block text-uppercase font-weight-bold" data-toggle="modal" data-target="#calme" >' . l('detail_btn') . '</a>';
	endif;
	$ved	 = 'video_' . $lang;
//print_r($k);
	$video	 = $k->$ved;
	if ($lang == 'ua')
	{
	    $lar	 = array('ень', 'ні', 'нів');
	    $act_lan = 'Акція!';
	    $aza	 = 'Записатись на курс!';
	}
	else
	{
	    $lar	 = array('ень', 'ня', 'ней');
	    $act_lan = 'Акция!';
	    $aza	 = 'Записаться на курс!';
	}
	$mashas	 = '';
	$mashas	 = WWW_IMG_PATH . 'grl/' . $k->mashas;

	if (count($cc) > 0)
	{
	    foreach ($cc as $row)
	    {
		$context	 = '';
		$name		 = $row->$lname;
		$decription	 = $row->$ldecription;
		$fulltext	 = $row->$lfulltext;
		$dateX		 = strtotime($row->start);
		$hidestart	 = $row->hidestart;
		$start		 = date('d', $dateX);
		$monts		 = localeMomts($lang, date('m', $dateX));
		$coast		 = $row->coast;
		$tur		 = $row->tur;

		$colors	 = new \model\gradients();
		$color	 = $colors->getGradient($row->basecolor);

		$cursCSS = "
    .course-manikyura .section-title {
    color: $color->start !important;
}

.course-manikyura .close-course-list__block {
    color: $color->start !important;
}
.line-sale-v2,.line-sale-v3,
 .gradient-block {
    background-image: -moz-linear-gradient(0deg, $color->start 0%, $color->middle 30%, $color->end 100%) !important;;
    background-image: -webkit-linear-gradient(0deg, $color->start 0%, $color->middle 30%, $color->end 100%) !important;;
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%) !important;;

}
.nongradient{background-color: $color->end !important;}

.gradient-text {
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-image: -moz-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%)!important;;
    background-image: -webkit-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%)!important;;
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%)!important;;

}


main .nearest-course {
    background-image: -moz-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%) !important;
    background-image: -webkit-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%)!important;
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%)!important;
    padding: 16px 0;
}
ol.about-list {
  list-style: none;
  counter-reset: my-awesome-counter;
}
ol.about-list li {
  counter-increment: my-awesome-counter;
}
ol.about-list li::before {
  content: counter(my-awesome-counter) \". \";
  color: #e7437c;
  font-weight: bold;
}
";
	    }
	}
	else
	{
	    $context = "для вашего города курсов нет";
	}
	$context	 .= "<script>
        var x=document.getElementById('geo');
        function getLocation()
         {
        if (navigator.geolocation)
        {
        navigator.geolocation.getCurrentPosition(showPosition);
        }
        else{x.innerHTML='Geolocation is not supported by this browser.';}
        }
        function showPosition(position)
        {
        x.innerHTML='Latitude: ' + position.coords.latitude +
        '<br>Longitude: ' + position.coords.longitude;
        }
        getLocation()
        </script>";
	$bc['ua']	 = 'Курси ';
	$bc['ru']	 = 'Курсы ';
	$vidminnik	 = array('ua'	 => array(
		'dnipro'	 => 'у Дніпрі',
		'kyiv'		 => 'у Києві',
		'zaporizhzhya'	 => 'у Запоріжжі',
		'mykolaiv'	 => 'у Миколаєві',
		'virtual'	 => 'онлайн',
	    ),
	    'ru'	 => array(
		'dnipro'	 => 'в Днепре',
		'kyiv'		 => 'в Киеве',
		'zaporizhzhya'	 => 'в Запорожье',
		'mykolaiv'	 => 'в Николаеве',
		'virtual'	 => 'онлайн',
	    )
	);

	$cc = $bc[$lang] . $vidminnik[$lang][$this->param[0]];

	$data		 = new db();
	$comments	 = array();
	$q		 = "SELECT SQL_CALC_FOUND_ROWS * FROM comments WHERE `page`='$link' ORDER BY id ASC";
	$result		 = $data->get_result($q);
//echo $data->lastState;
	foreach ($result as $row)
	{
	    $comments[] = new comment((array) $row);
	}
	$page_coment = '';
	foreach ($comments as $c)
	{
	    $page_coment .= $c->markup($color->start);
	}
//галерея работ
	$g	 = new model\photogalery();
	$files	 = $g->GetPhotos($town, $link);

	$o		 = new templator();
	$galery		 = '';
	$id		 = 0;
	$workingdir	 = APP_PATH . "/images/galery/";
	$wdir		 = WWW_IMG_PATH . "galery/";
	$fl		 = glob($workingdir . '*.{gif, jpg, png}', GLOB_BRACE);
	$fl		 = array_map('basename', $files);

	foreach ($fl as $f)
	{
	    if (in_array($f, $files))
	    {
		$id++;
		$pl1	 = '<div class = "slide"><img src = "' . $wdir . $f . '" alt = "' . $id . '"></div>';
		$galery	 .= $pl1;
	    }
	    else
	    {
		echo "$f not in " . print_r($fl, true) . '<br>';
	    }
	};


//галерея выпускников
	$g1		 = new model\vipusknik;
	$files1		 = $g1->GetPhotos($town, $link);
	$oz		 = new templator();
	$vipusk		 = '';
	$id1		 = 0;
	$wdir1		 = WWW_IMG_PATH . "vipusknik/";
	$workingdir1	 = APP_PATH . "/images/vipusknik/";
	$fl1		 = glob($workingdir . '*.{gif,jpg,png}', GLOB_BRACE);
	$fl1		 = array_map('basename', $fl1);

//print_r($fl1);
	foreach ($files1 as $f)
//{
//<div class="slide"><img src="slider-photo.png"></div>
//    if (in_array($f, $fl1))
	{
	    $id1++;
	    $pll	 = '<div class = "slide"><img src = "' . $wdir1 . $f . '" alt = "' . $id1 . '"></div>';
	    $vipusk	 .= $pll;
//    }
	};
//$vipusk.=print_r($fl1,true);
	$fago	 = new bildfaqo();
	$qa	 = $fago->getFAQO($town, $lang);
	$detect	 = new mobiledetect();
	if ($detect->isMobile())
	{
	    $vibellink = '<a href="viber://add?number=38' . preg_replace('/[^0-9]/', '', $currentMisto->viber) . ' ">' . $currentMisto->viber . '</a>';
	    //$vibellink .= ' <a href="viber://chat?number=38' . preg_replace('/[^0-9]/', '', $currentMisto->viber) . '">чат</a>';
	}
	else
	{
	    $vibellink = '<a href="viber://add?number=+38' . preg_replace('/[^0-9]/', '', $currentMisto->viber) . '">' . $currentMisto->viber . '</a>';
	}
    else:

	$otherTown = '';
	if (isset($_SESSION['lang']))
	{
	    $lang = mb_strtolower(@$_SESSION['lang']);
	}
	else
	{
	    $lang = "ua";
	}
	$link		 = $this->param[0];
	$sc		 = new model\sysvars();
	$seminarcoast	 = $sc->getVar('seminarcoast');

	$km		 = new model\misto();
	$currentMisto	 = ($km->getByName($link));
	$mlang		 = 'name_' . $lang;
	$curses		 = new model\curses();
	$packs		 = new model\packets();
	$bc['ua']	 = 'Курси ';
	$bc['ru']	 = 'Курсы ';
	$vidminnik	 = array('ua'	 => array(
		'dnipro'	 => 'у Дніпрі',
		'kyiv'		 => 'у Києві',
		'zaporizhzhya'	 => 'у Запоріжжі',
		'mykolaiv'	 => 'у Миколаєві',
		'virtual'	 => 'онлайн',
	    ),
	    'ru'	 => array(
		'dnipro'	 => 'в Днепре',
		'kyiv'		 => 'в Киеве',
		'zaporizhzhya'	 => 'в Запорожье',
		'mykolaiv'	 => 'в Николаеве',
		'virtual'	 => 'онлайн',
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
	    $otherTown	 .= '<a class="dropdown-item" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '">' . $r->$mlang . '</a>';
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
	    if ($curs->darunok == 'N')
	    {
		$valut = ' грн';
	    }
	    else
	    {
		$valut = ' + <img src="' . WWW_IMAGE_PATH . 'gift.png" style="width: 17px;" class="align-content-center">';
	    }

	    if ($curs->action == 'Y' or $curs->darunok == 'Y')
	    {
		$sb = "sale_button";
		if ($curs->action == 'Y')
		{
		    $pb = '<strong class="' . $sb . '"><span class="oldprice">' . $curs->coast . ' грн</span><span class="newprice">' . $curs->ac_coast . $valut . '</span></strong> <div class = "pod"></div>';
		}
		else
		{
		    $pb = '<strong class="' . $sb . '"><span class="oldprice">' . $curs->coast . ' грн</span><span class="newprice">' . $curs->coast . $valut . '</span></strong> <div class = "pod"></div>';
		}
	    }
	    else
	    {
		$sb	 = "";
		$pb	 = '<strong class = "' . $sb . '">' . $curs->coast . ' грн</strong><div class = "pod"></div>';
	    }
	    $item .= '<a class = "course__item" href = "' . WWW_BASE_PATH . 'curses/' . $curMistoLink . '/' . $curs->link . '">
	<div>
	<h2 class = "course__headline">' . $curs->$name . '</h2>
	<p class = "course__title">' . $curs->$anonce . '</p>
	</div>
	<div class = "course__price">
	<div class = "wrapper_course_price ' . $sb . '">
	<div class = "course__price__price">
	' . $pb . '
	</div>
	</div>
	<span class = "course__price__day"><strong>' . $curs->finish . '</strong>' . $ddey . '</span>
	</div>
	</a>';
	}
	if (count($packs->getPackets($link)) < 1)
	{
	    $packets = '';
	}
	else
	{
	    $packets = ' <section class = "course-package-outer">
	<h2 class = "section-title">' . l('z4') . '</h2>';
	    foreach ($packs->getPackets($link) as $k)
	    {
		//print_r($k);
		$name		 = 'name_' . $lang;
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

			$cursesblosk	 .= '<li class = "course-package-list__item">
	<span class = "course-package-list__name">
	<a href = "' . WWW_BASE_PATH . 'curses/' . $curMistoLink . '/' . $r->link . '"> ' . $r->$mlang . '</a>
	</span>
	<span class = "course-package-list__price">
	' . $r->coast . ' грн</span>
	</li>';
			$totalcoast	 += $r->coast;
			$kcount++;
		    }
		}
		$econ	 = ($lang == 'ua') ? 'ЕКОНОМІЯ' : 'ЭКОНОМИЯ';
		$vcon	 = ($lang == 'ua') ? 'Вартість з урахуванням знижки' : 'Стоимость пакета с учетом скидки';
		$dcon	 = ($lang == 'ua') ? 'Вартість всіх курсів окремо' : 'Стоимость всех курсов по отдельности';

		$cocon = l('seminar_select');

		if ($k->seminar == 'Y')
		{
		    $zuza		 = $kcount + 1;
		    $filename	 = WWW_BASE_PATH . "svggen/$zuza/$k->dayz/$lang";
		}
		else
		{
		    $filename = WWW_BASE_PATH . "svggen/$kcount/$k->dayz/$lang";
		}
		if (firstChar($k->link) == '#')
		{
		    $slink = '<li class = "course-package__headline"><a class = "shm" data-toggle = "modal" data-target = "#calme" data-id = "p' . $k->id . '" data-name = "' . $k->$name . '">' . $k->$name . '</a></li>';
		}
		else
		{
		    $slink = '<li class = "course-package__headline"><a style = "color: inherit; text-decoration: none;" href = "' . $k->link . '">' . $k->$name . '</a></li>';
		}
		$svgimg	 = file_get_contents($filename);
		$packets .= '<div class = "container">
	<div class = "course-package">
	<div class = "svg-container"><a class = "shm" data-toggle = "modal" data-target = "#calme" data-id = "p' . $k->id . '" data-name = "' . $k->$name . '">' . $svgimg . '</a></div>
	<div class = "course-package_mid">
	<ul class = "course-package-list">
	' . $slink
			. $cursesblosk;
		if ($k->seminar == 'Y')
		{
		    $packets	 .= '<li class = "course-package-list__item">'
			    . '<span class = "course-package-list__name">' . $cocon . '</span>
	    <span class = "course-package-list__price">
	    ' . $seminarcoast . ' грн</span></li>
	    ';
		    $totalcoast	 = $totalcoast + $seminarcoast;
		}
		if (firstChar($k->link) == '#')
		{
		    $lb = '<a class = "shm btn sale__btn btn-lg btn-block text-uppercase font-weight-bold" data-toggle = "modal" data-target = "#calme" data-id = "' . $k->id . '" data-name = "' . $k->$name . '">' . l('z3') . ' </a>';
		}
		else
		{
		    $lb = '<a class = "shm btn sale__btn btn-lg btn-block text-uppercase font-weight-bold" href = "' . $k->link . '" >' . l('z3') . ' </a>';
		}
		$packets .= '</ul><p class = "alone-price">
	<span>' . $dcon . ':</span>
	<span><strong class = "alone-price_delete">' . $totalcoast . '</strong> грн</span>
	</p>
	</div>

	<div class = "package-price">
	<p class = "package-price__title">' . $vcon . ': </p>
	<div class = "package-price__price"><strong>' . $k->coast . '</strong> грн</div>
	<div class = "package-price__price">
	<strong>' . $econ . '</strong>
	<span class = "package-price__price_alert"><strong>' . ($totalcoast - $k->coast) . '</strong> грн</span>
	</div>
	<p class = "discount-card text-center my-4"><span><strong>+</strong></span>' . l('m17') . ' </p>
	' . $lb . '
	</div>
	</div>
	</div>
	';
	    }
	    $packets .= '</section>';
	}
	$cc	 = $bc[$lang] . $vidminnik[$lang][$link];
	$detect	 = new mobiledetect();
	if ($detect->isMobile())
	{
	    $vibellink = '<a href="viber://add?number=38' . preg_replace('/[^0-9]/', '', $currentMisto->viber) . ' ">' . $currentMisto->viber . '</a>';
	    //$vibellink .= ' <a href="viber://chat?number=38' . preg_replace('/[^0-9]/', '', $currentMisto->viber) . '">чат</a>';
	}
	else
	{
	    $vibellink = '<a href="viber://add?number=+38' . preg_replace('/[^0-9]/', '', $currentMisto->viber) . '">' . $currentMisto->viber . '</a>';
	}
    endif;
endif;
include TEMPLATE_DIR . $tpl . ".html";
