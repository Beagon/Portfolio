<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_image {

    public function __construct()
    {
		$this->load->helper('url');
    }

    public function upload_image($image)
	{
		if($image['image']['name'])
		{
			if(!$image['image']['error'])
			{
				$new_file_name = strtolower($image['image']['tmp_name']);
				move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $new_file_name);
				return base_url() . 'uploads/' . $new_file_name;
			}else{
				return false;
			}
		}
    }

}
