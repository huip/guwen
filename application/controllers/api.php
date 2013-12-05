<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('widgets_model'); // load widgets model
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
   * widgets api
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

}
