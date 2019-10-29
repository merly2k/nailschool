<?php

//print_r($this->param);
if (isset($_SESSION['lang']))
{
    $lang = mb_strtolower(@$_SESSION['lang']);
}
else
{
    $lang = "ua";
}
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
$misto		 = $currentMisto->$mlang;
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
    $otherTown	 .= '<li><a class="" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '/">' . $r->$mlang . '</a></li>';

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
$tpl	 = 'curse';

$curses	 = new model\curses();
$cc	 = $curses->getCurse($town, $link);
$k	 = $cc[0];
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

//print_r($k);
$randAction = '
<div class="sale">
<p class="sale__text">Акция! <del></del> <strong>' . $k->ac_coast . '</strong> грн</p>
<a href="' . $k->link . '" class="sale__btn" style="cursor: pointer;" data-toggle="modal" data-target="#akcia">Записаться на курс! </a>

</div>
<img class="close-course__img" src="' . WWW_IMAGE_PATH . '/girl.png" alt="">

';

//print_r($mista);



if (count($cc) > 0)
{
    foreach ($cc as $row)
    {
	$context	 = '';
	$name		 = $row->$lname;
	$decription	 = $row->$ldecription;
	$fulltext	 = $row->$lfulltext;
	$dateX		 = strtotime($row->start);
	$start		 = date('d', $dateX);
	$monts		 = localeMomts($lang, date('m', $dateX));
	$coast		 = $row->coast;

	$colors	 = new \model\gradients();
	$color	 = $colors->getGradient($row->basecolor);

	$cursCSS = "
    .course-manikyura .section-title {
    color: $color->start !important;
}

.course-manikyura .close-course-list__block {
    color: $color->start !important;
}

.course-manikyura .gradient-block {
    background-image: -moz-linear-gradient(0deg, $color->start 0%, $color->middle 30%, $color->end 100%);
    background-image: -webkit-linear-gradient(0deg, $color->start 0%, $color->middle 30%, $color->end 100%);
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);

}

.course-manikyura .gradient-text {
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-image: -moz-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);
    background-image: -webkit-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);

}

.course-manikyura .close-course {
    background-image: -moz-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);
    background-image: -webkit-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);
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

	$context .= '    <div class="row">
					<div class="col-12 col-xl"><img class="about__img" src="' . WWW_IMG_PATH . 'nails.png" alt=""></div>
					<div class="col-12 col-xl d-flex flex-column justify-content-center">
					    <div class="about-block">
						' . $decription . '
					    </div>
					</div>
				    </div>
				    <div class="row">
					<div class="col-12 col-xl d-flex flex-column justify-content-center">
					    <div class="about-block">
					    ' . $fulltext . '
						<button class="sale__btn about-block__btn popmake-zapisatsya-na-konsultatsiyu pum-trigger" style="cursor: pointer;">
						    ' . l('z3') . ' </button>
						<p class="about-block__text">мы предоставляем базу моделей и расходные материалы высокого качества</p>

					    </div>
					</div>
					<div class="col-12 col-xl bg_iframe">
					<iframe src="https://www.youtube.com/embed/tYz4IGoDhow" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" width="560" height="315" frameborder="0"></iframe>
					</div>
				    </div>';
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
$bc['ua']	 = 'Курси у ';
$bc['ru']	 = 'Курсы в ';
$vidminnik	 = array('ua'	 => array(
	'dnipro'	 => 'Дніпрі',
	'kyiv'		 => 'Київі',
	'zaporizhzhya'	 => 'Запоріжжї',
	'nicolaev'	 => 'Миколаєві',
    ),
    'ru'	 => array(
	'dnipro'	 => 'Днепре',
	'kyiv'		 => 'Киеве',
	'zaporizhzhya'	 => 'Запорожье',
	'nicolaev'	 => 'Николаеве',
    )
);
$cc		 = $bc[$lang] . $vidminnik[$lang][$this->param[0]];
//echo $context;
include TEMPLATE_DIR . DS . $tpl . ".html";
