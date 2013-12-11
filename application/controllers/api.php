<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('PRC');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('widgets_model'); // load widgets model
    $this->load->model('api_model'); // load index model
    $status = [];
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
    $list = $this->api_model->get_question_list($page);
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
    $data = array(
      'info' => $this->api_model->get_question_info($qid),
      'comments' => $this->api_model->get_comments($qid)
    );
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
    $relative = $this->api_model->get_relative_question($qid);
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
    $uinfo = $this->api_model->get_u_info($uid);
    echo json_encode($uinfo);
  }

 /*
   * @author huip
   * get user question list by uid
   * return relative question list
   * Dec 2013-12-08
   */
  public function myquestion($uid,$page)
  {
    $data = [];
    $data['question'] = $this->api_model->get_my_question($uid,$page);
    echo json_encode($data);
  }

  /*
   * @author huip
   * get my answer by uid
   * return relative question list
   * Dec 2013-12-09
   */
  public function myanswer($uid,$page)
  {
    $myanswer = $this->api_model->get_my_answer($uid,$page);
    echo json_encode($myanswer);
  }

  /*
   * @author huip
   * user login
   * Dec 2013-12-09
   */
  public function login()
  {
    if ($this->is_post_method())
    {
      $data = array(
        'user_email' => $this->input->post('email'),
        'user_password' => md5( $this->input->post('password').'guwen'),
      );
      $result = $this->api_model->user_login($data);
      $is_register = count($result);
      if($is_register == '0')
      {
        $status['error_code'] = '100';
        echo json_encode( $status );
        return FALSE;
      }
      else
      {
        $status['error_code'] = '200';
        echo json_encode( $status );
        $data = $this->api_model->get_user_info($data['user_email']);
        foreach ($data as $key => $value) {
          $this->session->set_userdata($value);
        }
        $log_info = array(
          'id' => '',
          'user_name' => get_user_info('user_name'),
          'login_time' => get_local_time(),
          'login_ip' => get_remote_ip(),
          'login_client' => get_user_info('user_agent'),
        );
        $this->api_model->user_login_log($log_info);
        $this->api_model->login_score(get_user_info('user_id'));
      }
    }
    else
    {
      show_404();
    }
  }

  /*
   * @author huip
   * check is register
   * Dec 2013-12-10
   */
  public function checkregister()
  {
    if ( $this->is_post_method() )
    {
      $data = array(
        'value' => $this->input->post('value'),
        'type' => $this->input->post('type')
      );
      $result = $this->api_model->check_is_register($data);
      $status['error_code'] = count($result) > 0?102:202;
      echo json_encode($status);
    }
    else
    {
      show_404();
    }
  }
  /*
   * @author huip
   * register api
   * Dec 2013-12-10
   */
  public function register()
  {
    if ( $this->is_post_method() )
    {
      if( $this->input->post('useremail') == "" || 
        $this->input->post('username') == "" || 
        $this->input->post('userpassword') == "" ||
        $this->check_email($this->input->post('useremail')) == FALSE
       )
      {
        $status['error_code'] = "300";
        echo json_encode($status);
        return FALSE;
      }
      else
      {
        $data = array(
          'value' => $this->input->post('useremail'),
          'type' => 'user_email'
        );
        $res = $this->api_model->check_is_register($data);
        if( count($res) > 1 ) {
          $status['error_code'] = '102';
          echo json_encode($status);
          return FALSE;
        }
      }
      $data = array(
        'id' => '',
        'user_email' => $this->input->post('useremail'),
        'user_name' => $this->input->post('username'),
        'user_id' => $this->get_uid(),
        'user_password' => md5($this->input->post('userpassword').'guwen'),
        'reg_time' => get_local_time(),
        'user_img' => base_url()."data/uploadimg/thumbnail/defaultperson.png",
        'user_score' => '5',
      );
      $result = $this->api_model->user_register($data); 
      if($result)
      {
        $user_info = $this->api_model->get_user_info($data['user_email']);
        foreach ($user_info as $key => $value) {
          $this->session->set_userdata($value);
        }
        $log_info = array(
          'id'  => '',
          'user_name' => get_user_info('user_name'),
          'login_time' => get_local_time(),
          'login_ip' => get_remote_ip(),
          'login_client' => get_user_info('user_agent'),
        );
        $inbox = array(
          'id' => '',
          'to_id' => $data['user_name'],
          'my_id' => "51614ae439b6d",
          'inbox' => $this->get_reg_inbox(),
          'is_check' => 0,
          'time' => get_local_time()
        );
        $inbox_link = array(
          'id' => '',
          'to_id' => $data['user_name'],
          'my_id' => '51614ae439b6d',
          'time' => get_local_time()
        );
        $this->api_model->user_login_log($log_info);
        $login = $this->api_model->login_score(get_user_info('user_id'));
        if( $login )
        {
          $res = $this->api_model->post_inbox($inbox);
          if( $res )
          {
            $res = $this->api_model->update_inbox_link($inbox_link);
          }
          $status['error_code'] = 202;
        }
      }
      else
      {
        $status['error_code'] = 102;
      }
      echo json_encode($status);
    }
    else
    {
      show_404();
    }
  }
  /*
   * @author huip
   * is post method
   * Dec 2013-12-09
   */
  private function is_post_method()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') return TRUE;
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
  /*
   * @author huip
   * get register inbox message
   * Dec 2013-12-10
   */
  private function get_reg_inbox()
  {
    return $this->api_model->get_reg_inbox();
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
}
