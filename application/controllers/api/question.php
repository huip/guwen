<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class Question extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->model('api/question_model');
  }

  public function list_get()
  {
    if(!$this->get('page'))
    {
      $this->response(NULL, 400);
    }
    $list= $this->question_model->get_list($this->get('page'));
    $this->response($list);
  }

  public function info_get()
  {
    if(!$this->get('id'))
    {
      $this->response(NULL, 400);
    }
    $data['questions'] = $this->question_model->get_info($this->get('id'));
    $data['answers'] = $this->question_model->get_answer($this->get('id'));
    $this->response($data);
  }

  public function relative_get()
  {
    if(!$this->get('id'))
    {
      $this->response(NULL, 400);
    }
    $data['relative'] = $this->question_model->get_relative($this->get('id'));
    $this->response($data);
  }

  public function unanswerd_get()
  {
    if(!$this->get('page'))
    {
      $this->response(NULL, 400);
    }
    $data['unanswerd'] = $this->question_model->get_unanswerd();
    $this->response($data);
  }
  
  public function hotest_get()
  {
    if(!$this->get('page'))
    {
      $this->response(NULL, 400);
    }
    $data['hotests'] = $this->question_model->get_hotest($this->get('page'),10);
    $this->response($data);
  }
}
