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
    //print_r($r);
    if ($r->link != 'virtual'):

	$tfut .= '
<div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-2 mb-3">
			<p><b>' . $r->$mlang . '</b></p>
			<p class="tel">' . $r->phones . '</p>
			<span class="social-icon">';
	if (firstChar($r->fb) != '#')
	{
	    $tfut .= '<a style = "color: white;" href = "' . $r->fb . '"><i class = "fab fa-facebook-square fa-2x" aria-hidden = "true"></i></a>';
	}
	else
	{
	    $tfut .= '';
	}
	if (firstChar($r->inst) != '#')
	{
	    $tfut .= '<a style = "color: white;" href = "' . $r->inst . '"><i class = "fab fa-instagram fa-2x" aria-hidden = "true"></i></a>';
	}
	else
	{
	    $tfut .= '';
	}
	$tfut .= '    <a style = "color: white;" href = "https://www.youtube.com/channel/UCZcCF_9g8Cp2mE1WG66IEjg"><i class = "fab fa-youtube-square fa-2x" aria-hidden = "true"></i></a >
			</span>
		    </div>';
    endif;
//print_r($r);
    $mista[$r->link] = $r->$mlang;
    $otherTown	 .= '<a class="dropdown-item" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '/">' . $r->$mlang . '</a>';

    if ($k % 2)
    {
	$townItem .= '<div class="row no-gutters">
    <div class="col-md-6 mb-5 align-items-center town-info d-none d-sm-flex">
        <img class="img-fluid d-block" src="' . WWW_IMG_PATH . 'towns/' . $r->image . '" alt="' . $r->$mlang . '" >
    </div>
    <div class="col-md-6 mb-5 align-items-center town-info">
        <div class="text">
      <h3><span class="gradient-text text-uppercase">' . $r->$mlang . '</span></h3>
      ' . $r->$addr . '
      <a href="' . WWW_BASE_PATH . 'curses/' . $r->link . '/">
      <div class="link-cities gradient-text mx-sm-0 mx-md-2 m-lg-auto">
          <span><b>' . l('m15') . '</b></span>
          <span class="site_btn">' . l('m16') . '</span>
      </div>
      </a>
        </div>
    </div>
  </div>
	';
    }
    else
    {
	$townItem .= '<div class="row no-gutters">
    <div class="col-md-6 mb-5 align-items-center town-info">
        <div class="text">
      <h3><span class="gradient-text text-uppercase">' . $r->$mlang . '</span></h3>
      ' . $r->$addr . '
      <a href="' . WWW_BASE_PATH . 'curses/' . $r->link . '/">
      <div class="link-cities gradient-text">
          <span><b>' . l('m15') . '</b></span>
          <span class="site_btn">' . l('m16') . '</span>
      </div>
      </a>
        </div>
    </div>
    <div class="col-md-6 mb-5">
        <img class="img-fluid d-block" src="' . WWW_IMG_PATH . 'towns/' . $r->image . '" alt="' . $r->$mlang . '" >
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

    /* if ($k == 0)
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

     */
    $fidOut .= '<div class="slide">
			    <div class="card px-2">
			        <img class="photo-graduate pb-3" src="' . WWW_IMAGE_PATH . 'feedback/' . $it->image . '" alt="">
			        <p class="name-graduate">' . $it->$name . ', ' . $it->age . $ag[$lang] . '</p>
			        <span class="sity-graduate">' . $it->$misto . '</span>
			        <p class="courses-graduate pt-2">' . $it->$feed . '</p>
	    	    </div>
    		</div>';
}

if (ONLINE_ONLY == 'Y'):
    $acsia = $ra->GetRandOnline();
    //print_r($acsia);

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
    $randAction = '<div class="col-12 col-sm-7 col-md-4 col-lg-3 col-xl-3 px-md-0 px-lg-0 d-grid align-items-center themed-grid-col">
			    <div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 online-course-name text-center text-sm-left">
				    <p>Онлайн-курс</p>
				    <p>' . $acsia->$mlang . '</p>
				</div>
			    </div>
			</div>
			<div class="col-12 col-sm-5 col-md-3 col-lg-5 col-xl-5 px-md-0 px-lg-0 themed-grid-col deadline">
			    <p class="text-center"><span class="text-uppercase akcia">' . l('akcia') . '</span><br />до ' . $acsia->deadline . '&nbsp;</p>
			</div>
			<div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-4 px-md-0 px-lg-0 themed-grid-col">
			    <div class="sale text-center m-auto">
				<p style="margin:0 auto;"><del>' . $acsia->coast . '</del>&nbsp;<span>грн</span> <b>' . $acsia->coast . '</b>&nbsp;<span>грн</span></p>
				<a href="#" class="btn btn-warning btn-lg btn-block text-uppercase font-weight-bold" data-toggle="modal" data-target="#akcia">' . $aza . '</a>
			    </div>
			</div>';
else:
    $acsia = $ra->GetRandAction();


    if ($acsia != '')
    {
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
	$day_s		 = date('d', strtotime($acsia->start));
	$months_s	 = date('M', strtotime($acsia->start));
//print_r($acsia);
	$dateX		 = strtotime($acsia->start);
	$monts		 = localeMomts($lang, date('m', $dateX));
	$start		 = date('d', $dateX);
	$randAction	 = '
			<div class="col-12 col-sm-7 col-md-4 col-lg-4 col-xl-4 px-md-0 px-lg-0 themed-grid-col nearest-course-col">
			    <div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 px-md-2 pl-lg-3 themed-grid-col">
				    <p><b>' . l('firstcurs') . ':</b>' . $acsia->$name . '</p>
				</div>
			    </div>
			    <div class="row">
				<div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 px-1 px-md-0 themed-grid-col text-center location">
				    <div class="align-middle">
					<img src="' . WWW_IMG_PATH . 'location-pink.svg" alt="">
				    </div>
				    <p class="text-center">&nbsp;' . $mista[$acsia->miso] . '</p>
				</div>
				<div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 px-1 px-md-0 themed-grid-col text-center date">
				    <div class="align-middle">
					<span class="align-middle">' . $start . '</span>
				    </div>
				    <p class="text-center">' . $monts . '</p>
				</div>
				<div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 px-1 px-md-0 themed-grid-col text-center duration">
				    <div class="align-middle">
					<span class="align-middle">' . $acsia->finish . '</span>
				    </div>
				    <p class="text-center">' . numberof($acsia->finish, ' д', $lar) . '</p>
				</div>
			    </div>
			</div>
			<div class="col-12 col-sm-5 col-md-3 col-lg-3 col-xl-2 px-md-0 px-lg-0 themed-grid-col deadline">
			    '
		. '<p class="text-center"><span class="text-uppercase akcia">' . l('akcia') . '</span><br />до ' . $acsia->deadline . '&nbsp;</p>'
		. '</div>
			<div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-6 px-md-0 px-lg-0 themed-grid-col">
			    <div class="sale text-center">

				<p style="margin:0 auto;"><del>' . $acsia->coast . '</del>&nbsp;<span>грн</span> <b>' . $acsia->ac_coast . '</b>&nbsp;<span>грн</span></p>


				<a href="#" class="btn btn-warning btn-lg btn-block text-uppercase font-weight-bold" data-toggle="modal" data-target="#akcia">' . l('akcia_btn') . '</a>
			    </div>
			</div>
			<div class="col-12 col-sm-0 col-md-0 col-lg-0 col-xl-0 themed-grid-col girl d-none d-xl-flex">
			    <img src="' . WWW_IMG_PATH . 'girl.png" alt="">
			</div>
    	';
    }
    else
    {
	$randAction = '';
    }
endif;
$film	 = new model\video();
$video	 = '';
$c	 = 0;
foreach ($film->getList() as $vi)
{
//print_r($vi);
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
    <div class="slide text-center">
	' . $vi->link . '

    <div class="enroll">
      <h3><span class="text-uppercase font-weight-bold">' . $vi->$name . '</span></h3>
      <hr />
      <p class="text-left"><small>' . $vi->$dekr . '
      <a href="' . $vi->kurse . '" class="btn gradient-text font-weight-bold">' . $aza . '</a></small></p>
    </div>

    </div>
    ';
}

$tpl = 'indexn';
include TEMPLATE_DIR . $tpl . ".html";




























