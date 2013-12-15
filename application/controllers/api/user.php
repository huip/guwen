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
    $this->load->helper('url');
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
      $this->response($status);
    }
  }

  /*
   * @author huip
   * register api
   * Dec 2013-12-10
   */
  public function register_post()
  {
      if( $this->post('email') == "" || 
        $this->post('name') == "" || 
        $this->post('password') == "" ||
        $this->check_email($this->post('email')) == FALSE
       )
      {
        $status['error_code'] = "300";
        $this->response($status);
        return FALSE;
      }
      else
      {
        $data = array(
          'value' => $this->post('email'),
          'type' => 'email'
        );
        $result = $this->user_model->check_is_register($data);
        if( count($result) > 0 ) {
          $status['error_code'] = '102';
          $this->response($status);
          return FALSE;
        }
      }
      $data = array(
        'id' => '',
        'email' => $this->post('email'),
        'name' => $this->post('name'),
        'uid' => $this->get_uid(),
        'password' => md5($this->post('password').'guwen'),
        'ctime' => get_local_time(),
        'gravatar' => base_url()."data/uploadimg/thumbnail/defaultperson.png",
        'score' => '5',
      );
      $result = $this->user_model->register($data); 
      if($result)
      {
        $user_info = $this->user_model->get_login($data['email']);
        foreach ($user_info as $key => $value) {
          $this->session->set_userdata($value);
        }
        $log_info = array(
          'id'  => '',
          'name' => get_user_info('name'),
          'time' => get_local_time(),
          'ip' => get_remote_ip(),
          'client' => get_user_info('user_agent'),
        );
        $inbox = array(
          'id' => '',
          'to_id' => $data['name'],
          'my_id' => "51614ae439b6d",
          'inbox' => $this->get_reginbox(),
          'is_check' => 0,
          'time' => get_local_time()
        );
        $inbox_link = array(
          'id' => '',
          'to_id' => $data['name'],
          'my_id' => '51614ae439b6d',
          'time' => get_local_time()
        );
        $this->user_model->login_log($log_info);
        $login = $this->user_model->login_score(get_user_info('user_id'));
        if( $login )
        {
          $res = $this->user_model->post_inbox($inbox);
          if( $res )
          {
            $res = $this->user_model->update_inbox_link($inbox_link);
          }
          $status['error_code'] = 202;
        }
      }
      else
      {
        $status['error_code'] = 102;
      }
      $this->response($status);
  }

  /*
   * @author huip
   * get register inbox message
   * Dec 2013-12-10
   */
  private function get_reginbox()
  {
    return $this->user_model->get_reginbox();
  }

  /*
   * @author huip
   * check email
   * Dec 2013-12-10
   */
  private function check_email($email)
  {
    if( filter_var($email, FILTER_VALIDATE_EMAIL) ) 
    {
      return TRUE;  
    }
    else
    {
      return FALSE;
    } 
  }

  /*
   * @author huip
   * create user id
   * Dec 2013-12-10
   */
  private function get_uid()
  {
    return uniqid();
  }

}
