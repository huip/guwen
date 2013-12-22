<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class Topic extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->model('api/topic_model');
  }

  public function list_get()
  {
    if(!$this->get('id'))
    {
      $this->response(NULL, 400);
    }
    $data = $this->topic_model->get_list($this->get('id'));
    $this->response($data);
  }

  public function question_get()
  {
    if(!$this->get('id') && !$this->get('page'))
    {
      $this->response(NULL, 400);
    }
    $data['question'] = $this->topic_model->get_question($this->get('id'),$this->get('page'));
    $this->response($data);
  }
}
