<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller 
{	
	public function __construct() {
        parent:: __construct();

		$this->load->helper('url');
        $this->load->model("main_model", "Main_model");
        $this->load->library("pagination");
        $data["theme"] = $this->config->item('theme');
        $data["title"] = $this->config->item('title');
 		$this->load->vars($data);
    }

	public function index()
	{
		$config = array();
        $config["base_url"] = base_url() . "main/index";
        $config["total_rows"] = $this->Main_model->record_count();
        $config["per_page"] = 5;
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
        $data["results"] = $this->Main_model->fetch_projects($config["per_page"], $page, "desc");

        if(!$data["results"]){
        	$data["results"] = $this->Main_model->fetch_projects($config["per_page"], 0);
        }

        $data["links"] = $this->pagination->create_links();
 
        $this->load->view("main_view", $data);
	}
}