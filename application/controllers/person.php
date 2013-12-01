<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Person extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
    $this->load->model('person/index_model');
    $this->load->model("conn_model");
    $this->load->library('session');
  }

  /*
   * user center question list
   * @author huip
   * Dec 2013
   */
  public function question($uid)
  {
    $data = $this->render_info($uid);
    $data['person_question'] = $this->index_model->get_my_question($uid,1);
    $this->load->view("person/nav",$data);
    $this->load->view("person/question",$data);
    $this->load->view('conn/footer');
  }

  /*
   * user center answer list
   * @author huip
   * Dec 2013
   */
  public function answer($uid)
  {
    $data = $this->render_info($uid);
    $data['person_anwser'] = $this->index_model->get_my_anwser($uid,1);
    $this->load->view("person/nav",$data);
    $this->load->view("person/answer",$data);
    $this->load->view('conn/footer');
  }

  /*
   * get new page
   * @author huip
   * Dec 2013
   */
  public function get_new_pages()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $pages = $this->input->post('current_page');
      $uid = $this->input->post('uid');
      $page = $this->input->post('index');
      if($page == "other-answer"){
        $res = $this->index_model->get_my_answer($uid,$pages);
      }
      else
      {
        $res = $this->index_model->get_my_question($uid,$pages);
      }
      echo $res;
    }
    else
    {
      show_404();
    }
  }
  /*
   * render the common info
   * @author huip
   * Dec 2013
   */
  private function render_info($uid)
  {
    $this->load->view('conn/header');
    $data['user_id'] = $this->session->userdata("user_id");
    $data['user_img'] = $this->session->userdata("user_img");
    $data['user_name'] = $this->session->userdata("user_name");
    $data['person_info'] = $this->index_model->get_person_info($uid);
    $data['tag_list']      = $this->conn_model->get_tag_list();
    $data['uid'] = $uid;
    return $data;
  }
}
