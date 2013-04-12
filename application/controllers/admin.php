<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('PRC');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model("admin/index_model");

	}

	public function index() 
	{
		$this->load->view('conn/header');
		$this->load->view("admin/nav");
		$data['user_info'] = $this->index_model->get_user_info();
		$this->load->view("admin/index",$data);
	}


	public function clear_keywords()
	{
		$res = $this->index_model->clear_keywords();
		var_dump($res);
	}
}