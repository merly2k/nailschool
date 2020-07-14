<?php

use SVG\SVG;
use SVG\Nodes\Shapes\SVGRect;
use SVG\Nodes\Texts;
use SVG\Nodes\Shapes;
use SVG\Nodes\Structures\SVGDefs;
use SVG\Nodes\Structures\SVGStyle;

function getPackImg($ids = 1, $days = 1, $lang) {

    //if($lang=='ua'){$text5='днів';}else{$text5='дней';}
    if ($lang == 'ua')
    {
	$text5 = numberof($days, ' д', array('ень', 'ні', 'нів'));
    }
    else
    {
	$text5 = numberof($days, ' д', array('ень', 'ня', 'ней'));
    }
// image with 100x100 viewport
    $image	 = new SVG('300', '300');
    $style	 = new SVGDefs();
    $style->addChild(new SVGStyle("/* cyrillic-ext */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 400;
  src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v14/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
  unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 400;
  src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v14/JTUSjIg1_i6t8kCHKm459W1hyzbi.woff2) format('woff2');
  unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 400;
  src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v14/JTUSjIg1_i6t8kCHKm459WZhyzbi.woff2) format('woff2');
  unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 400;
  src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v14/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 400;
  src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v14/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* cyrillic-ext */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 900;
  src: local('Montserrat Black'), local('Montserrat-Black'), url(https://fonts.gstatic.com/s/montserrat/v14/JTURjIg1_i6t8kCHKm45_epG3gTD_u50.woff2) format('woff2');
  unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}
/* cyrillic */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 900;
  src: local('Montserrat Black'), local('Montserrat-Black'), url(https://fonts.gstatic.com/s/montserrat/v14/JTURjIg1_i6t8kCHKm45_epG3g3D_u50.woff2) format('woff2');
  unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}
/* vietnamese */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 900;
  src: local('Montserrat Black'), local('Montserrat-Black'), url(https://fonts.gstatic.com/s/montserrat/v14/JTURjIg1_i6t8kCHKm45_epG3gbD_u50.woff2) format('woff2');
  unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 900;
  src: local('Montserrat Black'), local('Montserrat-Black'), url(https://fonts.gstatic.com/s/montserrat/v14/JTURjIg1_i6t8kCHKm45_epG3gfD_u50.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 900;
  src: local('Montserrat Black'), local('Montserrat-Black'), url(https://fonts.gstatic.com/s/montserrat/v14/JTURjIg1_i6t8kCHKm45_epG3gnD_g.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
", 'text/css'));
//$style->('@import url(https://fonts.googleapis.com/css?family=Montserrat:400,900&display=swap&subset=cyrillic-ext);');

    $doc	 = $image->getDocument();
// blue 40x40 square at (0, 0)
    $doc->addChild($style);
    $dis	 = '';
    $d	 = 0;
    for ($index = 0; $index < $ids; $index++)
    {
	$d	 = $index * 9 + 9;
	$dis	 .= "$d ,";
	$color	 = array('#B13986', '#EFA93F', '#EFF294', '#27CE27', '#6E2B99', '#EFA93F', '#B13986');
	$square	 = new SVGRect($d, $d, 240, 240);
	$q	 = 6 - $index;
	$square->setStyle('fill', $color[$q]);
	$square->setStyle('opacity', '0.9');
	$doc->addChild($square);
    }
    $st	 = 65 + $d;
    $vt	 = 24 + $d;
    $gt	 = 152 + $d;
    $bn1	 = "m$st,$vt l110,0 a25,25 0 0,1 0,90 l-110,0 a20,20 0 0,1 0,-90 z";
    $bn2	 = "m$st,$gt l110,0 a20,20 0 0,1 0,50 l-110,0 a20,20 0 0,1 0,-50 z";

    $button1 = new Shapes\SVGPath($bn1);
    $button2 = new Shapes\SVGPath($bn2);
    $button1->setStyle('fill', '#ffffff');
    $button1->setStyle('opacity', '0.8');
    $button2->setStyle('fill', '#ffffff');
    $button2->setStyle('opacity', '0.8');

    $doc->addChild($button1);
    $doc->addChild($button2);

    $text1	 = "$ids ";
    $xt	 = new Texts\SVGText($text1, $st, $st + 29);
    $xt->setSize('56pt');
    $xt->setStyle('fill', '#584550');
    $xt->setAttribute('font-family', 'Montserrat');
    $xt->setStyle('font-face', 'Montserrat');
    $xt->setStyle('font-weight', '750');

    $text2	 = "в";
    $xt1	 = new Texts\SVGText($text2, $st + 58, $st + 29);
    $xt1->setSize('24pt');
    $xt1->setStyle('fill', '#584550');
    $xt1->setAttribute('font-family', 'Montserrat');
    $xt1->setStyle('font-face', 'Montserrat');
    $xt1->setStyle('font-weight', '800');

    $text3	 = "1";
    $xt2	 = new Texts\SVGText($text3, $st + 83, $st + 29);
    $xt2->setSize('56pt');
    $xt2->setStyle('fill', '#584550');
    $xt2->setAttribute('font-family', 'Montserrat');
    $xt2->setStyle('font-face', 'Montserrat');
    $xt2->setStyle('font-weight', '750');

    $text4 = $days;
    if ($days <= 9)
    {
	$tk = 12;
    }
    else
    {
	$tk = 1;
    }
    $xt3 = new Texts\SVGText($text4, $st + $tk, $st + 125);
    $xt3->setSize('28pt');
    $xt3->setStyle('fill', '#584550');
    $xt3->setAttribute('font-family', 'Montserrat');
    $xt3->setStyle('font-face', 'Montserrat');
    $xt3->setStyle('font-weight', '700');

    if ($days <= 9)
    {
	$ts = 38;
    }
    else
    {
	$ts = 48;
    }
    $xt4 = new Texts\SVGText($text5, $st + $ts, $st + 125);
    $xt4->setSize('18pt');
    $xt4->setStyle('fill', '#584550');
    $xt4->setAttribute('font-family', 'Montserrat');
    $xt4->setStyle('font-face', 'Montserrat');
    $xt4->setStyle('font-weight', '400');

    $doc->addChild($xt);
    $doc->addChild($xt1);
    $doc->addChild($xt2);
    $doc->addChild($xt3);
    $doc->addChild($xt4);
    return str_replace("\n", "", $image->toXMLString(false));
//
//    return $image;
}

//header('Content-Type: image/svg+xml');
$ids	 = $this->param[0];
$days	 = $this->param[1];
$lang	 = $this->param[2];
//$text = str_replace("\n", "", getPackImg($ids, $days));
//echo $text;
echo getPackImg($ids, $days, $lang);
