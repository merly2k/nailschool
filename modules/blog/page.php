<?php

$paginator = '';
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


$lang	 = mb_strtolower($_SESSION['lang']);
$cur	 = $this->param[0];
$context = '';
if ($lang == 'ua')
{
    $blog	 = new model\blog();
    $Blog	 = $blog->SelectByURL($cur);
}
else
{
    $blog	 = new model\blogl();
    $Blog	 = $blog->SelectByURL($lang, $cur);
}
foreach ($Blog as $r)
{
    if ($r->image != ''):
	$artimg = WWW_IMG_PATH . 'articles/' . $r->image;
    else:
	$artimg = WWW_IMG_PATH . 'articles/plaseholder.png';
    endif;
    $context .= '
				<div class="row">
				    <div class="col-md-3">
					    <image src="' . $artimg . '"  width="100%">
				    </div>
				    <div class="col-md-9">
					<div class="row mb-2">
					    <div class="col-md-12">
						<div class="card">
						    <div class="card-body">
							<div class="row">
							    <div class="col-md-12">
								<div class="news-title">
								    <h2 style=""class="title-pink">' . $r->title . '</h2>
								</div>
								<div class="news-cats">
								    <ul class="list-unstyled list-inline mb-1">

									<li class="list-inline-item">
									    <time>' . $r->pdate . '</time>
									</li>
								    </ul>
								</div>
								<hr>
								<div class="news-content">
		                                ' . $r->content . '
								</div>
								<hr>

							    </div>
							</div>
						    </div>
						</div>
					    </div>
					</div>

				    </div>


				</div>
';
}
$tfut = '';

foreach ($km->getall()as $k => $r)
{
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
$template = 'article';

include TEMPLATE_DIR . DS . $template . ".html";
