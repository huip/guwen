<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class User extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->model('api/user_model');
  }

  public function info_get()
  {
    if(!$this->get('id'))
    {
      $this->response(NULL, 400);
    }
    $info = $this->user_model->get_info($this->get('id'));
    $this->response($info);
  }

  public function question_get()
  {
    if(!$this->get('id') && !$this->get('page'))
    {
      $this->response(NULL, 400);
    }
    $data['question'] = $this->user_model->get_question($this->get('id'),$this->get('page'));
    $this->response($data);
  }
  /*
   * @author huip
   * get my answer by uid
   * return relative question list
   * Dec 2013-12-09
   */
  public function answer_get()
  {
    if(!$this->get('id') && !$this->get('page'))
    {
      $this->response(NULL, 400);
    }
    $data['answer'] = $this->user_model->get_answer($this->get('id'),$this->get('page'));
    echo json_encode($data);
  }

}
