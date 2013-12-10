<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model("index/index_model");
    $this->load->model("conn_model");

  }
  // index page 
  public function index()
  {
    $this->load->view("dev2/index");
    $this->load->view("dev2/templates/huip");
    //$this->load->view("dev2/templates/tibic");
    $this->load->view("dev2/templates/aresyz");
  }
  // login page
  public function login()
  {
    $data = $this->render_user_info();
    $this->load->view('conn/header');
    $this->load->view("index/nav",$data);
    $this->load->view('index/login');
    $this->load->view('conn/footer');
  }
  // render user info from session
  private function render_user_info()
  {
      $data['user_id'] = $this->session->userdata("user_id");
    $data['user_img'] = $this->session->userdata("user_img");
    $data['user_name'] = $this->session->userdata("user_name");
    return $data;
  }
}
