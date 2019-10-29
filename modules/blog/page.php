<?php
$lang=mb_strtolower($_SESSION['lang']);
$cur = $this->param[0];
$context='';
if($lang=='ua'){
  $blog=new model\blog();
$Blog=$blog->SelectByURL($cur);

}
else
{
$blog=new model\blogl();
$Blog=$blog->SelectByURL($lang,$cur);
    
}
foreach ($Blog as $r){
//print_r($r);
$context.='<div class="container">
	<div class="row">
	    <div class="col-md-9">
	        <div class="row mb-2">
	            <div class="col-md-12">
	                <div class="card">
	                    <div class="card-body">
	                        <div class="row">
	                            <div class="col-md-12">
	                                <div class="news-title">
	                                    <h2>'.$r->name .'</h2>
	                                </div>
	                                <div class="news-cats">
	                                    <ul class="list-unstyled list-inline mb-1">
	                                        <li class="list-inline-item"><i class="fa fa-folder-o text-danger"></i>
    		                                    <small>'.$r->autor.'</small>
		                                </li>
		                                <li class="list-inline-item"><i class="fa fa-folder-o text-danger"></i>
    		                                    <small>'.$r->postdate.'</small>
		                                </li>
		                                  
		                                    
		                                    
		                                    
		                                </ul>
		                            </div>
		                            <hr>
		                            <div class="news-content">
		                                '.$r->article.'
		                                
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
</div>'	;
    

}
$template = 'index';

include TEMPLATE_DIR . DS . $template . ".html";
