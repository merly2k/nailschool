<?php
$site_url = WWW_BASE_PATH.'upload/'; //edit path
$directory = APP_PATH."/upload/"; //edit path
$images = glob($directory.'*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);
$target=$this->param[0];

		$i=0;		
		foreach ($images as $image) { 
		$image = basename($image);
		$image = $site_url.$image;
		?>
		<div id="image_<?php echo $i ?>" style="margin:5px;float:left;width:155px;height:145px;">
        <div class="thumb" data-image="<?php echo $image; ?>"><span><img class="pop" style="" src="<?php echo $image; ?>" /></span></div>
		<div style="margin:-10px 0 10px 0" class="pull-right">
		<a data-toggle="tooltip" class="delete-image" data-image_id="<?php echo $i ?>" data-image="<?php echo basename($image) ?>" href="javascript:;" title="Delete image"><i class="fa fa-trash-o fa-lg"></i></a>
		&nbsp;&nbsp;<a data-toggle="tooltip" class="insert-image" data-image="<?php echo $image ?>" title="insert image" href="javascript:;"><i class="fa fa-sign-in fa-lg"></i></a>
		</div>
		</div>
		<?php
		$i++;

		} 

                
