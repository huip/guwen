<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Person extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	   	date_default_timezone_set('PRC');
	   	$this->load->helper('url');
	   	$this->load->model('person/index_model');
	   	$this->load->library('session');
	}

      public function question($uid)
      {
            $this->load->view('conn/header');
            $data['user_id'] = $this->session->userdata("user_id");
            $data['user_img'] = $this->session->userdata("user_img");
            $data['user_name'] = $this->session->userdata("user_name");
            $data['person_question'] = $this->index_model->get_my_question($uid);
            $data['person_info'] = $this->index_model->get_person_info($uid);
            $data['uid'] = $uid;
            $this->load->view("person/nav",$data);
            $this->load->view("person/question",$data);
            $this->load->view('conn/footer');
      }

      public function answer($uid)
      {
            $this->load->view('conn/header');
            $data['user_id'] = $this->session->userdata("user_id");
            $data['user_img'] = $this->session->userdata("user_img");
            $data['user_name'] = $this->session->userdata("user_name");
            $data['person_answer'] = $this->index_model->get_my_answer($uid);
            $data['person_info'] = $this->index_model->get_person_info($uid);
            $data['uid'] = $uid;
            $this->load->view("person/nav",$data);
            $this->load->view("person/answer",$data);
            $this->load->view('conn/footer');
      }

}
?>