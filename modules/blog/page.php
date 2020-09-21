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
//print_r($r);
    $context .= '<div class="container">
	<div class="row">
	    <div class="col-md-3">
	    <image src="' . WWW_IMAGE_PATH . 'articles/' . $r->image . '" />
	    </div>
	    <div class="col-md-9">
	        <div class="row mb-2">
	            <div class="col-md-12">
	                <div class="card">
	                    <div class="card-body">
	                        <div class="row">
	                            <div class="col-md-12">
	                                <div class="news-title">
	                                    <h2>' . $r->title . '</h2>
	                                </div>
	                                <div class="news-cats">
	                                    <ul class="list-unstyled list-inline mb-1">

		                                <li class="list-inline-item"><i class="fa fa-folder-o text-danger"></i>
    		                                    <small>' . $r->pdate . '</small>
		                                </li>




		                                </ul>
		                            </div>
		                            <hr>
		                            <div class="news-content">
		                                ' . $r->content . '

		                            </div>
		                            <hr>
		                            <div class="news-footer">
		                                <div class="news-likes">
		                                     <button type="button" class="btn btn-outline-secondary"><i class="fa fa-thumbs-o-up text-success"></i> <span class="badge ">Likes 4</span></button>
		                                      <button type="button" class="btn btn-outline-secondary"><i class="fa fa-thumbs-o-down text-danger"></i><span class="badge">Disklikes 4</span></button>
		                                </div>
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
</div>';
}
$template = 'blog';

include TEMPLATE_DIR . DS . $template . ".html";
