<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		date_default_timezone_set('PRC');
		$this->load->helper('url');
		$this->load->model("conn_model");
		$this->load->model("search/index_model");
		//$this->load->library('session');
	}

	public function index()
	{
		print_r($_SESSION);
	}
}
?>