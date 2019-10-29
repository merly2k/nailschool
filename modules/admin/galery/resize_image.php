<?php
/*
	$image = new ResizeImage();
	
	$image->init('picture.jpg');
	$image->resize(250,400);
	$image->save('picture2.jpg');
	
	$image->init('picture.jpg');
	$image->resize_to_width(250);
	$image->save('picture2.jpg');
	
	$image->init('picture.jpg');
	$image->scale(50);
	$image->save('picture2.jpg');
	
	$image->init('picture.jpg');
	$image->resize_to_height(500);
	$image->save('picture2.jpg');
	$image->resize_to_height(200);
	$image->save('picture3.jpg');
	
	$image->init('picture.jpg');
	$image->resize_to_width(150);
	$image->output();
 */
class ResizeImage {
   
	private $image;
	private $image_type;
 
	public function init($filename) {
		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];
		
		switch($this->image_type) {
			case IMAGETYPE_JPEG:
				$this->image = imagecreatefromjpeg($filename);
				break;
			case IMAGETYPE_GIF:
				$this->image = imagecreatefromgif($filename);
				break;
			case IMAGETYPE_PNG:
				$this->image = imagecreatefrompng($filename);
				break;
		}
	}
	
	public function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
		switch($image_type) {
			case IMAGETYPE_JPEG:
				imagejpeg($this->image, $filename, $compression);
				break;
			case IMAGETYPE_GIF:
				imagegif($this->image,$filename);
				break;
			case IMAGETYPE_PNG:
				imagepng($this->image,$filename);
				break;
			default:
				return false;
				break;
		}
		
		if($permissions != null) {
			chmod($filename, $permissions);
		}
		
		return true;
	}

	public function output($image_type = IMAGETYPE_JPEG) {
		switch($image_type) {
			case IMAGETYPE_JPEG:
				imagejpeg($this->image);
				break;
			case IMAGETYPE_GIF:
				imagegif($this->image); 
				break;
			case IMAGETYPE_PNG:
				imagepng($this->image);
				break;
		}  
	}

	public function get_width() {
		return imagesx($this->image);
	}
   
	public function get_height() {
		return imagesy($this->image);
	}
	
	public function resize_to_height($height) {
		$ratio = $height / $this->get_height();
		$width = $this->get_width() * $ratio;
		$this->resize($width, $height);
	}
   
	public function resize_to_width($width) {
		$ratio = $width / $this->get_width();
		$height = $this->get_height() * $ratio;
		$this->resize($width, $height);
	}
   
	public function scale($scale) {
		$width = $this->get_width() * $scale/100;
		$height = $this->get_height() * $scale/100; 
		$this->resize($width, $height);
	}
	
	public function resize($width,$height) {
		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->get_width(), $this->get_height());
		$this->image = $new_image;   
	}
}
?>