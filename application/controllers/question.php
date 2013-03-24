<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	   	date_default_timezone_set('PRC');
	   	$this->load->helper('url');
	   	$this->load->library('session');
             $this->load->model('index/index_model');
             $this->load->model('sns_model');
             $this->load->model("keywords_model");
	}

	public function index($ques_id)
	{

		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$this->load->view('conn/header');
		$this->load->view('conn/nav',$data);
		$data['question'] = $this->index_model->get_question_detail($ques_id);
		$data['comment'] = $this->index_model->get_comment($ques_id);
		$this->sns_model->set_ques_browser($ques_id);
		$res = $this->keywords_model->get_relative_ques($ques_id);
		$data['relative_question'] = $res;
		$this->load->view('question_list_view',$data);
		$this->load->view('conn/footer');
		

	}
}