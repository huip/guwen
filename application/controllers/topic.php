<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topic extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('topic/index_model');
    $this->load->model('topic/info_model');
    $this->load->model('conn_model');
  }
  /*
   * topic index page
   * @author huip
   * 2013 Nov 
   */
  public function index()
  {
    $data = $this->render_info();
    $data['topic_list'] = $this->index_model->get_topic_list(1);
    $data['tag_list']      = $this->conn_model->get_tag_list();
    $this->load->view('conn/header');
    $this->load->view('topic/nav',$data);
    $this->load->view('topic/index',$data);
    $this->load->view('conn/footer');
  }

  /*
   * topic info page
   * @author huip
   * 2013 Nov 
   */
  public function info($id)
  {
    $data = $this->render_info();
    $data['mess_info'] = $this->info_model->get_mess_info($id,1);
    $data['topic_info'] = $this->info_model->get_topic_info($id);
    $this->load->view('conn/header');
    $this->load->view('topic/nav',$data);
    $this->load->view('topic/info',$data);
    $this->load->view('conn/footer');
  }

  /*
   * get new pages
   * @author huip
   * 2013 Nov 
   */
  public function get_new_pages()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $pages = $_POST['current_page'];
      $res = $this->index_model->get_topic_list($pages);
      echo $res;
    }
    else
    {
      show_404();
    }
  }

  public function get_info_pages()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $pages = $_POST['current_page'];
      $id = $_POST['tag_id'];
      $res = $this->info_model->get_mess_info($id,$pages);
      echo $res;
    }
    else
    {
      show_404();
    }
  }

  /*
   * common render info of topic page
   * @author huip
   * 2013 Nov
   */
  private function render_info()
  {
    $data['user_id'] = $this->session->userdata('user_id');
    $data['user_img'] = $this->session->userdata('user_img');
    $data['user_name'] = $this->session->userdata('user_name');
    $data['hot_ques'] = $this->conn_model->get_hot_ques();
    $data['hot_cate'] = $this->conn_model->get_hot_cate();
    $data['hot_person'] = $this->conn_model->get_hot_person();
    return $data;
  }
}
