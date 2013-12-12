<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class Question extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->model('api_model');
  }

  /*
   * @author huip
   * api router page
   * render api router
   * dec 2013-12-05
   */
  public function list_get()
  {
    if(!$this->get('page'))
    {
      $this->response(NULL, 400);
    }
    $questions= $this->api_model->get_question_list($this->get('page'));
    $this->response($questions);
  }
 }
