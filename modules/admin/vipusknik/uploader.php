<?php

class Uploader {

    private
	    $files		 = array();
    private
	    $extensions	 = array();
    private
	    $errors		 = array();
    private
	    $store_directory		 = APP_PATH . "/images/vipusknik/";
    private
	    $resize_image_library_instance	 = null;

    public
	    function __construct($files) {
	if (is_array($files) === false)
	{
	    $files[] = $files;
	}

	$this->files = $files;
    }

    public
	    function set_upload_to($store_directory) {
	$this->store_directory = $store_directory;
    }

    public
	    function set_valid_extensions($extensions, $case_sensitive = false) {
	$this->extensions	 = $extensions;
	$this->case_sensitive	 = $case_sensitive;
    }

    public
	    function set_resize_image_library($resize_image_library_instance) {
	$this->resize_image_library_instance = $resize_image_library_instance;
    }

    public
	    function is_valid_extension() {
	$total = count($this->files);
	for ($i = 0; $i < $total; $i++)
	{
	    if (empty($this->files['name'][$i]) === false)
	    {
		$file_extension = $this->get_extension($this->files['name'][$i]);

		if (in_array($file_extension, $this->extensions) === false)
		{
		    $this->errors['type']		 = "extension";
		    $this->errors['file_name']	 = $this->files['name'][$i];
		    $this->errors['file_extension']	 = $file_extension;
		    return false;
		}
	    }
	}
	return true;
    }

    public
	    function run() {
	$total = count($this->files);
	for ($i = 0; $i < $total; $i++)
	{
	    if (empty($this->files['name'][$i]) === false)
	    {
		if (move_uploaded_file($this->files['tmp_name'][$i], $this->store_directory . '/' . $this->files['name'][$i]) == false)
		{
		    $this->errors['type']		 = "run";
		    $this->errors['file_name']	 = $this->files['name'][$i];
		}
	    }
	}

	return empty($this->errors);
    }

    public
	    function resize($scale_size = 50) {
	$total = count($this->files);
	for ($i = 0; $i < $total; $i++)
	{
	    $image = realpath($this->store_directory . '/' . $this->files['name'][$i]);

	    if (file_exists($image) === true && is_file($image) === true)
	    {
		$this->resize_image_library_instance->init($image);
		$this->resize_image_library_instance->scale($scale_size);
		if ($this->resize_image_library_instance->save($image) === false)
		{
		    $this->errors['type']		 = "resize";
		    $this->errors['file_name']	 = $image;
		}
	    }
	}

	return empty($this->errors);
    }

    public
	    function get_errors() {
	return $this->errors;
    }

    //
    private
	    function get_extension($filename) {
	$info = pathinfo($filename);
	return $info['extension'];
    }

    private
	    function get_filename($file) {
	$info = pathinfo($file);
	return $info['filename'];
    }

}

?>
