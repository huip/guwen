<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('admin/index_model');
  }
  /*
   * admin index page
   * @author huip
   * 2013 Nov
   */
  public function index() 
  {
    if($this->is_admin())
    {
      // $this->load->view('conn/header');
      // $this->load->view('admin/nav');
      
      $data['user_info'] = $this->index_model->get_user_info();
      $this->load->view('dev2/admin/index',$data);
    }
    else
    {
      //tempory 设置，不用登录进入后台。2013 12-12
      $data['user_info'] = $this->index_model->get_user_info();
      $this->load->view('dev2/admin/index',$data);
      //show_404();
    }
  }
  /*
   * clear keywords 
   * @author huip
   * 2013 Nov review
   */
  public function clear_keywords()
  {
    if($this->is_admin())
    {
      $res = $this->index_model->clear_keywords();
    }
  }

  /* 
   * get user login information
   * @author huip
   * return array
   * 2013 Nov
   */
  public function get_login_info($offset)
  {
    if($this->is_admin())
    {
      $this->load->view('conn/header');
      $this->load->view('admin/nav');
      $data['login_info'] = $this->index_model->get_login_info($offset);
      $this->load->view("admin/logininfo",$data);
    }
    else
    {
      show_404();
    }
  }
  
  /*
   * insert tip from admin
   * @author polande
   * 2013 12
   *
   */
  public function insert_tip()
  {
    //$data['tip'] = $this->input->post('inputTip'); 
    $data['tip'] = $_POST['inputTip'];
    $this->index_model->insert_tip($data['tip']);
    redirect('/admin', 'refesh');
  }

  /*
   *@author huip
   *return boolen
   *2013 Nov
   */
  private function is_admin()
  {
    $user_role = $this->session->userdata('user_role');
    if($user_role == '1') return TRUE;
  }
  
}
