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
$lcontent		 = 'lcontent_' . $lang;
$content		 = 'content_' . $lang;
$title   ="title_".$lang;
$km		 = new model\misto();
$blimg		 = '';
$c		 = new model\blog;
$context	 = '';
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
    $mista[$r->link] = $r->$mlang;
    $otherTown	 .= '<a class="dropdown-item" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '">' . $r->$mlang . '</a>';
}
$tags = tagcloud();


if (!isset($this->param[0]))
{
    $template	 = "blog"; //uncomment this string if not use default template
    $context	 = '';

    $context .= '';

    $blog	 = $c->getBlog();
    $bbl	 = $c->getBlog(0, 1000);

    foreach ($bbl as $row)
    {
	if ($row->image != ''):
	    $artimg = '<img class="img-fluid" src="' . WWW_IMG_PATH . 'articles/' . $row->image . '" >';
	else:
	    $artimg = '<img class="img-fluid" src="' . WWW_IMG_PATH . 'articles/plaseholder.png" >';
	endif;

	$totalItems = $c->found;

	$context .= '
		<div class = "row">
		    <div class = "col-md-4">
		    ' . $artimg . '
		    </div>
		    <div class = "col-md-8">
			<div class = "news-title">
			    <a title = "' . $row->$title . '" href = "' . WWW_BASE_PATH . 'blog/' . $row->link . '" ></a>
			</div>
			<div class = "news-content">
			<h2>' . $row->$title . '</h2>
			   ' . truncate(strip_tags($row->$content), 250, array('ending' => '', 'exact' => true, 'html' => true)) . '...
			    <div class = "news-buttons">
				<a href = "' . WWW_BASE_PATH . 'blog/' . $row->link . '" >' . l('readmore') . '&#10097;&#10097;&#10097;</a>
			    </div>
			</div>
		    </div>
		    <hr>
		</div>
	';
    }

    include TEMPLATE_DIR . DS . $template . ".html";
}
else
{
    $bl = new model\blog();

    $cc = $bl->SelectByURL($this->param[0]);
    foreach ($cc as $r)
    {


	if ($r->image != ''):
	    $artimg = WWW_IMG_PATH . 'articles/' . $r->image;
	else:
	    $artimg = WWW_IMG_PATH . 'articles/plaseholder.png';
	endif;
	$context = '
				<div class="row">
					    <image src="' . $artimg . '"  width="100%">
				</div>
				<div class="row">
				    <div class="col-md-12">
					<div class="news-title">
					    <h2 style=""class="title-pink">' . $r->$title . '</h2>
					</div>
					<hr>
					<div class="news-content">
		                           ' . $r->$content . '
					</div>
                                        <hr>
                                    </div>
				</div>				
';
    }


    $template = 'article';
    $tram=$bl->getIndex();
    
    $pos=array_search($this->param[0], $tram['link']);
    $last= array_search(array_pop($tram['link']), $tram['link']);
    if($pos==0){
        $prev=$last;
        $next=$pos+1;
    }elseif ($pos>0 and $pos<$last) {
        $prev=$pos-1;
        $next=$pos+1;
    }else{
        $prev=$pos-1;
        $next=0;
    }
    if ($tram['image'][$prev] != ''):
    $artimgprev = WWW_IMG_PATH . 'articles/' . $tram['image'][$prev];
    else:
    $artimgprev = WWW_IMG_PATH . 'articles/plaseholder.png';
    endif;
    if ($tram['image'][$next] != ''):
    $artimgnext = WWW_IMG_PATH . 'articles/' . $tram['image'][$next];
    else:
    $artimgnext = WWW_IMG_PATH . 'articles/plaseholder.png';
    endif;
    $lister="<div class='row'>"
            . "<div class='col-md-6'><a href='".WWW_BASE_PATH."blog/".$tram['link'][$prev]."'>"
            . "<img src='$artimgprev' class='img-thumbnail'>"
            . "<br>".$tram[$title][$prev]."<br>".truncate(strip_tags($tram[$lcontent][$prev]), 250, array('ending' => '', 'exact' => true, 'html' => true))
            . "</a>"
            . "</div>"
            . "<div class='col-md-6'><a href='".WWW_BASE_PATH."blog/".$tram['link'][$next]."'>"
            . "<img src='$artimgnext' class='img-thumbnail'>"
            . "<br>".$tram[$title][$next]."<br>".truncate(strip_tags($tram[$lcontent][$next]), 250, array('ending' => '', 'exact' => true, 'html' => true))
            . "</a>"
            . "</div>"
            . "</div>";
    include TEMPLATE_DIR . DS . $template . ".html";
}

function truncate($text, $length = 100, $options = array()) {
    $default = array(
	'ending' => '...', 'exact'	 => true, 'html'	 => false
    );
    $options = array_merge($default, $options);
    extract($options);

    if ($html)
    {
	if (mb_strlen(preg_replace('/<.*?>/', '', $text)) <= $length)
	{
	    return $text;
	}
	$totalLength	 = mb_strlen(strip_tags($ending));
	$openTags	 = array();
	$truncate	 = '';

	preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);
	foreach ($tags as $tag)
	{
	    if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2]))
	    {
		if (preg_match('/<[\w]+[^>]*>/s', $tag[0]))
		{
		    array_unshift($openTags, $tag[2]);
		}
		else if (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag))
		{
		    $pos = array_search($closeTag[1], $openTags);
		    if ($pos !== false)
		    {
			array_splice($openTags, $pos, 1);
		    }
		}
	    }
	    $truncate .= $tag[1];

	    $contentLength = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3]));
	    if ($contentLength + $totalLength > $length)
	    {
		$left		 = $length - $totalLength;
		$entitiesLength	 = 0;
		if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE))
		{
		    foreach ($entities[0] as $entity)
		    {
			if ($entity[1] + 1 - $entitiesLength <= $left)
			{
			    $left--;
			    $entitiesLength += mb_strlen($entity[0]);
			}
			else
			{
			    break;
			}
		    }
		}

		$truncate .= mb_substr($tag[3], 0, $left + $entitiesLength);
		break;
	    }
	    else
	    {
		$truncate	 .= $tag[3];
		$totalLength	 += $contentLength;
	    }
	    if ($totalLength >= $length)
	    {
		break;
	    }
	}
    }
    else
    {
	if (mb_strlen($text) <= $length)
	{
	    return $text;
	}
	else
	{
	    $truncate = mb_substr($text, 0, $length - mb_strlen($ending));
	}
    }
    if (!$exact)
    {
	$spacepos = mb_strrpos($truncate, ' ');
	if (isset($spacepos))
	{
	    if ($html)
	    {
		$bits = mb_substr($truncate, $spacepos);
		preg_match_all('/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER);
		if (!empty($droppedTags))
		{
		    foreach ($droppedTags as $closingTag)
		    {
			if (!in_array($closingTag[1], $openTags))
			{
			    array_unshift($openTags, $closingTag[1]);
			}
		    }
		}
	    }
	    $truncate = mb_substr($truncate, 0, $spacepos);
	}
    }
    $truncate .= $ending;

    if ($html)
    {
	foreach ($openTags as $tag)
	{
	    $truncate .= '</' . $tag . '>';
	}
    }

    return $truncate;
}

function tagcloud() {
    $r	 = new model\blog();
    $zz	 = $r->getTags();
    //print_r($zz);
    $t	 = array();
    foreach ($zz as $k => $v)
    {
   // print_r($k);
    
	$taga= preg_split('@,@', $v);
        foreach ($taga as $tag){
		$wej = random_int(1, 10);
    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
	$t[]='{text: "<a href=\"'.WWW_BASE_PATH.'blog/'.$k.'\">'.$tag.'</span></a>", weight: '.$wej.'}';
}
        }
    //}
    $za = implode(', ', $t);
    return($za);
}
