<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of digest
 *
 * @author merly
 */
namespace bootstrap;
class digest {
    
    //put your code here
    function render($obj,$base) {
	$context='<ul class="double">';
foreach ($obj as $row) {
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
		                                <a title="'.$row->name.'" href="'.WWW_BASE_PATH.$base.'/'.$row->link.'"><h4>'.$row->name.'</h4></a>
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
		                                <a href="'.WWW_BASE_PATH.$base.'/'.$row->link.'" class="btn btn-outline-default btn-sm">Read More</a>
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
return $context;
    }
}
