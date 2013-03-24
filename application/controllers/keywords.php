<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keywords extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	   	date_default_timezone_set('PRC');
	   	$this->load->helper('url');
	   	$this->load->model('user_model');
	   	$this->load->library('session');
	}

}

