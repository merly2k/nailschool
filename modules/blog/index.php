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

if (is_numeric($page))
{
    $template	 = "blog"; //uncomment this string if not use default template
    $context	 = '';

    $context .= '<ul class="double">';
    if ($lang == 'ua')
    {
	$c	 = new model\blog();
	$blog	 = $c->getBlog();
	$bbl	 = $c->getBlog(0, 1000);
    }
    else
    {
	$c	 = new model\blogl();
	$blog	 = $c->getBlog($lang);
	$bbl	 = $c->getBlog($lang, 0, 1000);
    }

    foreach ($bbl as $row)
    {
	//print_r($row);
	if ($row->image != ''):
	    $artimg = '<img src="' . WWW_IMG_PATH . 'articles/' . $row->image . '" class="">';
	else:
	    $artimg = '<img src="' . WWW_IMG_PATH . 'articles/plaseholder.png" class="">';
	endif;

	$totalItems = $c->found;


	$context .= '
	    <li>
	<div class = "card">
	    <div class = "card-body">
		<div class = "row">
		    <div class = "col-md-4 digest">
		    ' . $artimg . '
		    </div>
		    <div class = "col-md-8">
			<div class = "news-title">
			    <a title = "' . $row->title . '" href = "' . WWW_BASE_PATH . 'blog/page/' . $row->link . '"><h4>' . $row->pdate . '</h4></a>
			</div>

			<div class = "news-content">
			<h2>' . $row->title . '</h2>
			   ' . truncate(strip_tags($row->content), 250, array('ending' => '', 'exact' => true, 'html' => true)) . '
			    <div class = "news-buttons">
				<a href = "' . WWW_BASE_PATH . 'blog/page/' . $row->link . '" class = "btn btn-outline-default btn-sm">&#10097;&#10097;&#10097;</a>
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	</div>


	</li>
	';
    }
    $context	 .= '</ul>';
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
}
else
{
    if ($page == 'pages')
    {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location:" . WWW_BASE_PATH . "blog");
	exit();
    }

    $cur	 = $page;
    $bl	 = new model\blog();
    $row	 = $bl->SelectByURL($cur);
//print_r($row);
    $id	 = $row->id;
    $title	 = $row->title;
    $content = $row->content;
    $pdate	 = $row->pdate;
    if ($row->image == '')
    {
	$image = 'https://via.placeholder.com/680x200/?text=no+image';
    }
    else
    {
	$image = $row->image;
    }

    $ids		 = $bl->getIds();
    $ids['title']	 = array_map("translit", $ids['title']);

    $CurId	 = array_search($cur, $ids['title']);
    $next	 = getNext($CurId, $ids['title']);
    if ($next != 'last')
    {
	$low		 = $bl->SelectByURL($next);
	$nextTitle	 = $low->title;
	$nextLink	 = WWW_BASE_PATH . 'blog/' . $next;
	if ($low->image == '')
	{
	    $nextImage = 'https://via.placeholder.com/424x200/?text=no+image';
	}
	else
	{
	    $nextImage = $low->image;
	}
    }
    else
    {
	$nextTitle	 = 'более новых статей нет';
	$nextImage	 = '';
	$nextLink	 = WWW_BASE_PATH . 'blog';
    }

    $prev = getPrew($CurId, $ids['title']);
    if ($prev != 'first')
    {
//echo $prev;
	$pow		 = $bl->SelectByURL($prev);
	$prevTitle	 = $pow->title;
	$prevLink	 = WWW_BASE_PATH . 'blog/' . $prev;
	if ($pow->image == '')
	{
	    $prevImage = 'https://via.placeholder.com/424x200/?text=no+image';
	}
	else
	{
	    $prevImage = $pow->image;
	}
    }
    else
    {
	$prevLink	 = WWW_BASE_PATH . 'blog/';
	$prevImage	 = '';
	$prevTitle	 = "более ранних статей нет";
    }



    $latest	 = new model\blog();
    $blog	 = $latest->getLast();

    $template = 'blog-page';

    include TEMPLATE_DIR . DS . $template . ".html";
}

function getNext($id, $ds) {
    reset($ds);

    $nextid	 = $id + 1;
    $lastKey = end(array_keys($ds));
    if ($nextid >= $lastKey)
    {
	return 'last';
    }
    else
    {
	return $ds[$nextid];
    }
}

function getPrew($id, $ds) {
    reset($ds);
    $FirstKey	 = key($ds);
    $previd		 = $id - 1;
    if ($previd <= $FirstKey)
    {
	return 'first';
    }
    else
    {
	return $ds[$previd];
    }
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
