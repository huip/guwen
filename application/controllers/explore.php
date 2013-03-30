<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Explore extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
      date_default_timezone_set('PRC');
      $this->load->helper('url');
      $this->load->library('session');
      $this->load->model("explore/index_model");
               $this->load->model("conn_model");

  }

  public function index()
  {
    $data['user_id'] = $this->session->userdata("user_id");
    $data['user_img'] = $this->session->userdata("user_img");
    $data['user_name'] = $this->session->userdata("user_name");
    $data['tag_list']      = $this->conn_model->get_tag_list();
    $explore = $this->index_model->index(1);
    $this->load->view('conn/header');
    $this->load->view("explore/nav",$data);
    if(count( $explore ) != 0){

      foreach ($explore as $key=>$value) {
        
        $data['list_info'][$key] = $value;
        
      }


      $this->load->view("explore/index",$data);
    }
    $this->load->view('conn/footer');

  }

  public function get_new_pages()
  {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {

          $pages = $_POST['current_page'];
          $res = $this->index_model->index($pages);
          echo $res;
        }
        else
        {
          echo "404 not found";
        }
  }

}
?>
