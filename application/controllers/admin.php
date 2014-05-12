<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
        parent:: __construct();
		$this->load->helper('url');
        $this->load->model("admin_model", "Admin_model");
        $this->load->library("pagination");
        $data["theme"] = $this->config->item('theme');
        $data["title"] = $this->config->item('title');

        if($this->session->userdata('logged_in')){
    		$data["user"] = $this->session->userdata('username');    	
        }

 		$this->load->vars($data);
    }

	public function index()
	{
		if(!$this->session->userdata('logged_in')){
			redirect('admin/login' , 'refresh');
		}else{
			$config = array();
	        $config["base_url"] = base_url() . "admin/index";

	        if(isset($_POST['search'])){
	       		 $config["total_rows"] = $this->Admin_model->record_count_search($_POST['search']);
	    	}else{
	       		 $config["total_rows"] = $this->Admin_model->record_count();	    		
	    	}

	        $config["per_page"] = 10;
	        $config["uri_segment"] = 3;

	        //tags

			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_link'] = '&raquo;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';

	        $this->pagination->initialize($config);
	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	        if(isset($_POST['search'])){
	       		$data["results"] = $this->Admin_model->fetch_projects_search($config["per_page"], $page, $_POST['search']);
	    	}else{
	     		$data["results"] = $this->Admin_model->fetch_projects($config["per_page"], $page);
	    	}

	        $data["links"] = $this->pagination->create_links();	
			$this->load->view('admin/dashboard_view' , $data);
		}
	}

	public function add(){
		if(!$this->session->userdata('logged_in')){
			redirect('admin/login' , 'refresh');
		}else{
			if(isset($_POST['title']))
			{
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '0';

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
				{
					$data["message"] = $this->upload->display_errors();
					$this->load->view('admin/error_view', $data);
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
  
 					$config_r['image_library'] = 'gd2';    				
      				$config_r['source_image']   = $this->upload->upload_path.$this->upload->file_name;
			        $config_r['maintain_ratio'] = FALSE;
			        $config_r['width']   = 700;
			        $config_r['height'] = 300;

					$this->load->library('image_lib', $config_r); 

	                if ( !$this->image_lib->resize()){
						$data["message"] = $this->image_lib->display_errors();
						$this->load->view('admin/error_view', $data); 
	              	}

					if(!$this->Admin_model->add_project($_POST['title'], $_POST['subheader'], $_POST['text'], 
						$_POST['link'], (base_url() . "uploads/" .$this->upload->file_name), $_POST['language']))
					{
							$data["message"] = "There has been an error with the database.";
							$this->load->view('admin/error_view', $data);
					}

					$data["message"] = "Project has been added!";
					$this->load->view('admin/success_view', $data);
				}
			}else{
				$data['d'] = "";
				$this->load->view('admin/add_view' , $data);
			}
		}
	}

	public function edit(){

		if(!$this->session->userdata('logged_in')){
			redirect('admin/login' , 'refresh');
		}else{
			$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

			if(isset($_POST['title']))
			{
				if(isset($_POST['delete'])){

						if(!$this->Admin_model->remove_project($id))
						{
							$data["message"] = "There has been an error with the database.";
							$this->load->view('admin/error_view', $data);					
						}else{
							$data["message"] = "Project removed!";
							$data["closable"] = true; 
							$this->load->view('admin/success_view', $data);
							return;
						}

				}else{

						if(!$this->Admin_model->mod_project($id, $_POST['title'], $_POST['subheader'], $_POST['text'], $_POST['link']))
						{
							$data["message"] = "There has been an error with the database.";
							$this->load->view('admin/error_view', $data);					
						}else{
							$data["message"] = "Project modified!";
							$data["closable"] = true; 
							$this->load->view('admin/success_view', $data);
						}
				}
			}

			$data["result"] = $this->Admin_model->fetch_project($id);

			if(!$data["result"]){
					$data["message"] = "This project does not exist.";
					$this->load->view('admin/error_view' , $data);
			}else{
					$data["result"] = $data["result"][0];	
					$this->load->view('admin/edit_view' , $data);
			}
		}
	}

	public function login(){

		if(!isset($_POST['username']) && !isset($_POST['password'])){
			$data['login_succeed'] = true;
		}else{
			$data['login_succeed'] = $this->Admin_model->login($_POST['username'], $_POST['password']);

			if($data['login_succeed'] == true){
				$this->session->set_userdata('logged_in', '1');
				$this->session->set_userdata('username', $_POST['username']);
				redirect('admin/index','refresh');
			}
		}

		$this->load->view('admin/login_view', $data);
	}

	public function logout(){
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');
		redirect('admin/login','refresh');
	}
}