<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('widgets_model'); // load widgets model
    $this->load->model('index_model'); // load index model
  }

  /*
   * @author huip
   * api router page
   * render api router
   * Dec 2013-12-05
   */
  public function index()
  {
    $this->load->view("api");
  }
  /*
   * @author huip
   * widgets
   * return hot tags,question,person
   * Dec 2013-12-05
   */
  public function widgets()
  {
    $widgets = [];
    $widgets['hot_cate'] = $this->widgets_model->get_hot_cate();
    $widgets['hot_ques'] = $this->widgets_model->get_hot_ques();
    $widgets['hot_person'] = $this->widgets_model->get_hot_person();
    echo json_encode($widgets);
  }

  /*
   * @author huip
   * widgets api
   * return question list
   * Dec 2013-12-05
   */
  public function question($page)
  {
    $list = $this->index_model->get_question_list($page);
    echo json_encode($list);
  }

  /*
   * @author huip
   * get question
   * return question info
   * Dec 2013-12-05
   */
  public function qinfo($qid)
  {
    $data = [];
    $data['info'] = $this->index_model->get_question_info($qid);
    $data['comments'] = $this->index_model->get_comments($qid);
    echo json_encode($data);
  }
  /*
   * @author huip
   * get relative question
   * return relative question list
   * Dec 2013-12-05
   */
  public function relative($qid)
  {
    $relative = $this->index_model->get_relative_question($qid);
    echo json_encode($relative);
  }

  /*
   * @author huip
   * get relative question
   * return relative question list
   * Dec 2013-12-05
   */
  public function uinfo($uid)
  {
    $uinfo = $this->index_model->get_u_info($uid);
    echo json_encode($uinfo);
  }
}
