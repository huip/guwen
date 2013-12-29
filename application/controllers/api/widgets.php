<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class Widgets extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('api/widgets_model');
    $this->load->model('api/question_model');
    $this->load->model('api/tip_model');
  }

  /*
   * @author huip
   * widgets
   * return hot tags,question,person
   * Dec 2013-12-05
   */
  function index_get()
  {
    $widgets['hot_cate'] = $this->widgets_model->get_hot_cate();
    $widgets['hot_ques'] = $this->question_model->get_hotest(1,5);
    $widgets['hot_person'] = $this->widgets_model->get_hot_person();
    $widgets['tip'] = $this->tip_model->get_tip();
    $this->response($widgets);
  }
}
