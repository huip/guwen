<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('question/index_model');
    $this->load->model("conn_model");
    $this->load->model("keywords_model");
  }
  /*
   * question list page
   * @author huip
   * @ Dec 2013
   */
  public function index($qid)
  {
    $data['user_id'] = $this->session->userdata("user_id");
    $data['user_img'] = $this->session->userdata("user_img");
    $data['user_name'] = $this->session->userdata("user_name");
    $data['tag_list'] = $this->conn_model->get_tag_list();
    $this->load->view('conn/header');
    $this->load->view('question/nav',$data);
    $data['question'] = $this->index_model->get_question_detail($qid);
    $data['comment'] = $this->index_model->get_comment($qid);
    $this->index_model->set_ques_browser($qid);
    $res = $this->keywords_model->get_relative_ques($qid);
    $data['relative_question'] = $res;
    $this->load->view('question/index',$data);
    $this->load->view('conn/footer');
  }
}
