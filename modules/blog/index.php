<?php
$page = (isset($this->param[0]))? $this->param[0]: 1;
$lang=mb_strtolower($_SESSION['lang']);
use JasonGrimes\Paginator;

if(is_numeric($page)){
$template = "index"; //uncomment this string if not use default template
$context='';
if($lang=='ua'){
$c = new model\blog();
$blog=$c->getBlog();
} else{
    $c= new model\blogl();
$blog=$c->getBlog($lang);
}
$offset = 0;
$page_result = 10;

if ($page > 1) {
    $offset = ($page - 1) * $page_result ;
}
$context.='<ul class="double">';
if($lang=='ua'){
    $bbl=$c->getBlog($offset, $page_result);
    
}
else
{
    
$bbl=$c->getBlog($lang,$offset, $page_result);}

foreach ($bbl as $row) {
    $row->lcontent=preg_replace("/<img[^>]+\>/i", "", $row->lcontent); 
     $e=explode_images($row->article);
     $t=count($e);
     if($t>1){
	 foreach($e as $i){
	     $i = preg_replace('/style=*(.*)" /', ' ', $i);
	     $imgl.='<div class="carousel-item">'.$i.'</div>';
	 }
	 $artimg='<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">'.
    $imgl.'
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>';
     }elseif($t==0){
	 $artimg="";
     }else{
     $artimg=preg_replace('/style=*(.*)" /', ' ', $e[0]);
     };
     
$totalItems = $c->found;
$urlPattern = WWW_BASE_PATH.'blog/(:num)';
$paginator = new Paginator($totalItems, $page_result, $page, $urlPattern);
    $context.='<li>
		
		    <div class="row mb-2">
		        <div class="col-md-12">
		            <div class="card">
		                <div class="card-body">
		                    <div class="row">
		                        <div class="col-md-4 digest">
		                            '.$artimg.'
		                        </div>
		                        <div class="col-md-8">
		                            <div class="news-title">
		                                <a title="'.$row->name.'" href="'.WWW_BASE_PATH.'blog/page/'.$row->link.'"><h4>'.$row->name.'</h4></a>
		                            </div>
		                            <div class="news-cats">
		                                <ul class="list-unstyled list-inline mb-1">
		                                     <li class="list-inline-item">
		                                            <i class="fa fa-folder-o text-danger"></i>
    		                                        <small>'.$row->autor.'</small>
		                                    </li>
		                                     <li class="list-inline-item">
		                                            <i class="fa fa-folder-o text-danger"></i>
    		                                        <small>'.$row->postdate.'</small>
		                                    </li>
		                                </ul>
		                            </div>
		                            <div class="news-content">
		                                <p >'.$row->lcontent.'...</p>
		                            </div>
		                            <div class="news-buttons">
		                                <a href="'.WWW_BASE_PATH.'blog/page/'.$row->link.'" class="btn btn-outline-default btn-sm">Read More</a>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
				
		</li>';
    
}
$context.='</ul>';

include TEMPLATE_DIR . DS . $template . ".html";
}else{
if($page=='pages'){
 header("HTTP/1.1 301 Moved Permanently"); 
 header("Location:".WWW_BASE_PATH."blog"); 
 exit(); 
}
    
$cur = $page;
$bl = new model\blog();
$row = $bl->SelectByURL($cur);
//print_r($row);
$id = $row->id;
$title = $row->title;
$content = $row->content;
$pdate = $row->pdate;
if ($row->image == '') {
    $image = 'https://via.placeholder.com/680x200/?text=no+image';
} else {
    $image = $row->image;
}

$ids = $bl->getIds();
$ids['title'] = array_map("translit", $ids['title']);

$CurId = array_search($cur, $ids['title']);
$next = getNext($CurId, $ids['title']);
if ($next != 'last') {
    $low = $bl->SelectByURL($next);
    $nextTitle = $low->title;
    $nextLink =WWW_BASE_PATH . 'blog/'.$next;
    if ($low->image == '') {
        $nextImage = 'https://via.placeholder.com/424x200/?text=no+image';
    } else {
        $nextImage = $low->image;
    }
} else {
    $nextTitle = 'более новых статей нет';
    $nextImage = '';
    $nextLink = WWW_BASE_PATH . 'blog';
}

$prev = getPrew($CurId, $ids['title']);
if ($prev != 'first') {
//echo $prev;
    $pow = $bl->SelectByURL($prev);
    $prevTitle = $pow->title;
    $prevLink=WWW_BASE_PATH . 'blog/'.$prev;
    if ($pow->image == '') {
        $prevImage = 'https://via.placeholder.com/424x200/?text=no+image';
    } else {
        $prevImage = $pow->image;
    }
} else {
    $prevLink=WWW_BASE_PATH . 'blog/';
    $prevImage = '';
    $prevTitle="более ранних статей нет";
}



$latest = new model\blog();
$blog = $latest->getLast();

$template = 'blog-page';

include TEMPLATE_DIR . DS . $template . ".html";

}
function getNext($id, $ds) {
    reset($ds);

    $nextid = $id + 1;
    $lastKey = end(array_keys($ds));
    if ($nextid >= $lastKey) {
        return 'last';
    } else {
        return $ds[$nextid];
    }
}

function getPrew($id, $ds) {
    reset($ds);
    $FirstKey = key($ds);
    $previd = $id - 1;
    if ($previd <= $FirstKey) {
        return 'first';
    } else {
        return $ds[$previd];
    }
}









































































































