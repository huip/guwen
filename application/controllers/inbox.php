<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inbox extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model("inbox/index_model");
    $this->load->model("conn_model");
  }

  public function index()
  {
    $data = $this->check_login();
    $data['inbox'] = $this->index_model->inbox($data['user_id']);
    $this->index_model->check_inbox($data['user_id']);
    $this->load->view("inbox/nav",$data);
    $this->load->view("inbox/index",$data);
    $this->load->view('conn/footer'); 
  }

  public function info($id)
  {
    $this->load->view('conn/header');
    $result = is_login();
    foreach ($result as $key => $value) {
      if( ! array_key_exists('user_email',$result) )
      {
        show_404();
      }
    }
    $data['user_id'] = $this->session->userdata("user_id");
    $data['user_img'] = $this->session->userdata("user_img");
    $data['user_name'] = $this->session->userdata("user_name");
    $data['tag_list']      = $this->conn_model->get_tag_list();
    $data['info'] = $this->index_model->info($id,1);
    $this->load->view("inbox/nav",$data);
    $this->load->view("inbox/info",$data);
    $this->load->view('conn/footer'); 
  }

  public function get_new_pages()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $pages = $_POST['current_page'];
      $id = $_POST['page_id'];
      $res = $this->index_model->info($id,$pages);
      echo $res;
    }
    else
    {
      show_404();
    }
  }
  private function check_login()
  {
    $this->load->view('conn/header');
    $result = is_login();
    foreach ($result as $key => $value) {
      if( ! array_key_exists('user_email',$result) )
      {
        show_404();
      }
    }
    $data['user_id'] = $this->session->userdata("user_id");
    $data['user_img'] = $this->session->userdata("user_img");
    $data['user_name'] = $this->session->userdata("user_name");
    $data['tag_list']      = $this->conn_model->get_tag_list();
    return $data;
  }
}
?>
  
