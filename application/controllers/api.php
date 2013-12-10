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
    $myquestion = $this->api_model->get_my_question($uid,$page);
    echo json_encode($myquestion);
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
   * is post method
   * Dec 2013-12-09
   */
    private function is_post_method()
    {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') return TRUE;
    }
}
