<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
  }

  public function index() 
  {
    $this->load->view('dev2/document/index');
  }

  public function huip()
  {
    $this->load->view('dev2/document/huip');
  }
  public function polande()
  {
    $this->load->view('dev2/document/polande');
  }
   public function tibic()
  {
    
    $this->load->view('dev2/document/tibic');
  }
}
