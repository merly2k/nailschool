<?php

if (isset($_SESSION['lang']))
{
    $lang = mb_strtolower($_SESSION['lang']);
}
else
{
    $lang = "ua";
}
$otherTown	 = '';
$mlang		 = 'name_' . $lang;
$km		 = new model\misto();
if (!isset($this->param[0]))
{
    $page = 0;
}
$termin	 = $_POST['search'];
$termin	 = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $termin);

$bl	 = new model\blog();
// Создаем строку для регулярного выражения
$pattern = "/((?:^|>)[^<]*)(" . $termin . ")/si";
// Подсвеченная строка
$replace = '$1<b style="color:#FF0000; background:#FFFF00;">$2</b>';
// Заменяем
$out	 = '';
foreach ($bl->search($termin) as $html)
{
    $out	 .= "<div class='row'><h4><a href='" . WWW_BASE_PATH . "blog/" . $html->link . "'>";
    $out	 .= preg_replace($pattern, $replace, $html->title, -1, $count1);
    $out	 .= "</a></h3>";
    $z	 = preg_replace($pattern, $replace, $html->content, - 1, $count2);

    $out	 .= "<p class='text-muted'>" . wph_cut_by_words(380, strip_tags($z)) . "<p>";
    $out	 .= "" . l('found:') . ($count1 + $count2) . '</div>';
}
    $context =l('serchterm').'<b style="color: red">'.$termin." </b>";
if ($out == '')
{

    $context.= l('notfound');
    
}
else{
    $context.= $out;
}

function wph_cut_by_words($maxlen, $text) {
    $len	 = (mb_strlen($text) > $maxlen) ? mb_strripos(mb_substr($text, 0, $maxlen), ' ') : $maxlen;
    $cutStr	 = mb_substr($text, 0, $len);
    $temp	 = (mb_strlen($text) > $maxlen) ? $cutStr . '...' : $cutStr;
    return $temp;
}

function tagcloud() {
    $r	 = new model\blog();
    $zz	 = $r->getTags();
    foreach ($zz as $k => $v)
    {
	if ($v > 1):
	    $t[] = '{text: "' . $k . '", weight: "' . $v . '"}
		';
	endif;
    }
    $za = implode(', ', $t);
    return($za);
}

$template	 = 'blog';
$tags		 = tagcloud();
$tfut		 = '';
$townItem	 = "";
foreach ($km->getall()as $k => $r)
{
    // print_r($r);
    $addr = 'addr_' . $lang;
    if ($r->link != 'virtual'):
	$button	 = 'm16';
	$tfut	 .= '
<div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-2 mb-3">
			<p><b>' . $r->$mlang . '</b></p>
			<p class="tel">' . $r->phones . '</p>
			<span class="social-icon">';
	if (firstChar($r->fb) != '#')
	{
	    $tfut .= '<a style = "color: white;" target="_blank" href = "' . $r->fb . '"><i class = "fab fa-facebook-square fa-2x" aria-hidden = "true"></i></a>';
	}
	else
	{
	    $tfut .= '';
	}
	if (firstChar($r->inst) != '#')
	{
	    $tfut .= '<a style = "color: white;" target="_blank" href = "' . $r->inst . '"><i class = "fab fa-instagram fa-2x" aria-hidden = "true"></i></a>';
	}
	else
	{
	    $tfut .= '';
	}
	$tfut .= '    <a style = "color: white;" target="_blank" href = "https://www.youtube.com/channel/UCZcCF_9g8Cp2mE1WG66IEjg"><i class = "fab fa-youtube-square fa-2x" aria-hidden = "true"></i></a >
			</span>
		    </div>';
    else:
	$button = 'm16a';
    endif;
//print_r($r);
    $mista[$r->link] = $r->$mlang;
    $otherTown	 .= '<a class="dropdown-item" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '">' . $r->$mlang . '</a>';

    if ($k % 2)
    {
	$townItem .= '<div class="row no-gutters">
    <div class="col-md-6 mb-5 align-items-center town-info d-flex">
        <img class="img-fluid d-block" src="' . WWW_IMG_PATH . 'towns/' . $r->image . '" alt="' . $r->$mlang . '" >
    </div>
    <div class="col-md-6 mb-5 align-items-center town-info">
      <div class="text">
        <h3><span class="gradient-text text-uppercase">' . $r->$mlang . '</span></h3>
        ' . $r->$addr . '
        <a href="' . WWW_BASE_PATH . 'curses/' . $r->link . '">
          <div class="link-cities gradient-text">
            <span><b>' . l('m15') . '</b></span>
            <span class="site_btn">' . l($button) . '</span>
          </div>
        </a>
      </div>
    </div>
  </div>
	';
    }
    else
    {
	$townItem .= '<div class="col-md-6 mb-5 align-items-center d-flex d-md-none">
      <img class="img-fluid d-block" src="' . WWW_IMG_PATH . 'towns/' . $r->image . '" alt="' . $r->$mlang . '" >
  </div>
  <div class="row no-gutters">
    <div class="col-md-6 mb-5 align-items-center town-info">
      <div class="text">
        <h3><span class="gradient-text text-uppercase">' . $r->$mlang . '</span></h3>
        ' . $r->$addr . '
        <a href="' . WWW_BASE_PATH . 'curses/' . $r->link . '">
          <div class="link-cities gradient-text">
            <span><b>' . l('m15') . '</b></span>
            <span class="site_btn">' . l($button) . '</span>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-6 mb-5 align-items-center d-none d-md-flex">
        <img class="img-fluid d-block" src="' . WWW_IMG_PATH . 'towns/' . $r->image . '" alt="' . $r->$mlang . '" >
    </div>
  </div>
	';
    }
}
include TEMPLATE_DIR . DS . $template . ".html";
