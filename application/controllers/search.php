<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('PRC');
		$this->load->helper('url');
		$this->load->model("conn_model");
		$this->load->model("search/index_model");
		$this->load->library('session');
	}

	public function index($w)
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$res = $this->index_model->search($w);
		$data['search'] = $res; 
		$this->load->view('conn/header');
		$this->load->view("search/nav",$data);
		$this->load->view("search/index",$data);
		$this->load->view("conn/footer");
	}
}
?>