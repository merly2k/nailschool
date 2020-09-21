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

foreach ($km->getall()as $k => $r)
{
    $otherTown .= '<a class="dropdown-item" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '">' . $r->$mlang . '</a>';
}
$page	 = (isset($this->param[0])) ? $this->param[0] : 1;
$lang	 = mb_strtolower($_SESSION['lang']);

use JasonGrimes\Paginator;

if (is_numeric($page))
{
    $template	 = "blog"; //uncomment this string if not use default template
    $context	 = '';
    if ($lang == 'ua')
    {
	$c	 = new model\blog();
	$blog	 = $c->getBlog();
    }
    else
    {
	$c	 = new model\blogl();
	$blog	 = $c->getBlog($lang);
    }
    $offset		 = 0;
    $page_result	 = 10;

    if ($page > 1)
    {
	$offset = ($page - 1) * $page_result;
    }
    $context .= '<ul class="double">';
    if ($lang == 'ua')
    {
	$bbl = $c->getBlog($offset, $page_result);
    }
    else
    {

	$bbl = $c->getBlog($lang, $offset, $page_result);
    }

    foreach ($bbl as $row)
    {
	if ($row->image != ''):
	    $artimg = '<img src="' . WWW_IMG_PATH . 'articles/' . $row->image . '" class="">';
	else:
	    $artimg = '<img src="' . WWW_IMG_PATH . 'articles/plaseholder.png" class="">';
	endif;

	$totalItems = $c->found;

	$urlPattern	 = WWW_BASE_PATH . 'blog/(:num)';
	$paginator	 = new Paginator($totalItems, $page_result, $page, $urlPattern);
	$context	 .= '<li>
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
			   ' . $row->lcontent . '...
			    <div class = "news-buttons">
				<a href = "' . WWW_BASE_PATH . 'blog/page/' . $row->link . '" class = "btn btn-outline-default btn-sm">&#10097;&#10097;&#10097;</a>
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	</div>


	</li>';
    }
    $context .= '</ul>';

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

