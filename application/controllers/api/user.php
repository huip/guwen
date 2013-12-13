<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class User extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->model('api/user_model');
    $this->load->library('session');
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
    $this->response($data);
  }

  public function login_post()
  {
    if(!$this->post('email') && !$this->post('password'))
    {
      $this->response(NULL, 400);
    }
    $data = array(
        'email' => trim($this->post('email'),' \t\n'),
        'password' => md5( trim($this->post('password'),' \t\n').'guwen'),
    );
    $result = $this->user_model->login($data);
    $is_register = count($result);
    if($is_register == '0')
    {
      $status['error_code'] = '100';
      $this->response($status);
      return FALSE;
    }
    else
    {
      $status['error_code'] = '200';
      $this->response($status);
      $data = $this->user_model->get_login($data['email']);
      foreach ($data as $key => $value) {
        $this->session->set_userdata($value);
      }
      $log_info = array(
        'id' => '',
        'name' => get_user_info('name'),
        'time' => get_local_time(),
        'ip' => get_remote_ip(),
        'client' => get_user_info('user_agent'),
      );
      $this->user_model->login_log($log_info);
      $this->user_model->login_score(get_user_info('uid'));
    }
  }
}
