<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topic extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	   	date_default_timezone_set('PRC');
	   	$this->load->helper('url');
	   	$this->load->library('session');
	             $this->load->model("topic/index_model");
	             $this->load->model("topic/info_model");
	}

	public function index()
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['topic_list'] = $this->index_model->get_topic_list();
		$this->load->view("conn/header");
		$this->load->view("topic/nav",$data);
		$this->load->view("topic/index",$data);
		$this->load->view('conn/footer');
	}

	public function info($id)
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['mess_info'] = $this->info_model->get_mess_info($id);
		$data['topic_info'] = $this->info_model->get_topic_info($id);
		$this->load->view("conn/header");
		$this->load->view("topic/nav",$data);
		$this->load->view("topic/info",$data);
		$this->load->view('conn/footer');	
	}

}