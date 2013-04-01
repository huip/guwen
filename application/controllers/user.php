<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	   	date_default_timezone_set('PRC');
	   	$this->load->helper('url');
	   	$this->load->model('user/index_model');
	   	$this->load->library('session');
	   	$this->load->model("conn_model");
	}

	public function index()
	{
		$this->load->view('conn/header');
		$result = is_login();	
		foreach ($result as $key => $value) {
			if( ! array_key_exists('user_email',$result) )
			{
				show_404();
			}
		}
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['question_info'] = $this->index_model->get_my_question(get_user_info("user_id"),1);
		$data['person_info'] = $this->index_model->get_person_info(get_user_info("user_id"));
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$this->load->view("user/nav",$data);
		$this->load->view("user/question",$data);
		$this->load->view('conn/footer');

	}

	public function answer()
	{
		$this->load->view('conn/header');
		$result = is_login();	
		foreach ($result as $key => $value) {
			if( ! array_key_exists('user_email',$result) )
			{
				show_404();
			}
		}
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['answer_info'] = $this->index_model->get_my_answer(get_user_info("user_id"),1);
		$data['person_info'] = $this->index_model->get_person_info(get_user_info("user_id"));
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$this->load->view("user/nav",$data);
		$this->load->view("user/anwser",$data);
		$this->load->view('conn/footer');
	}

	public function profile()
	{
		$this->load->view('conn/header');
		$result = is_login();	
		foreach ($result as $key => $value) {
			if( ! array_key_exists('user_email',$result) )
			{
				show_404();
			}
		}
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['profile_info'] = $this->index_model->get_my_profile(get_user_info("user_id"));
		$data['person_info'] = $this->index_model->get_person_info(get_user_info("user_id"));
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$this->load->view("user/nav",$data);
		$this->load->view("user/profile",$data);
		$this->load->view('conn/footer');
	}

	public function acount()
	{
		$this->load->view('conn/header');
		$result = is_login();	
		foreach ($result as $key => $value) {
			if( ! array_key_exists('user_email',$result) )
			{
				show_404();
			}
		}
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['acount_info'] = $this->index_model->get_my_acount(get_user_info("user_id"));
		$data['person_info'] = $this->index_model->get_person_info(get_user_info("user_id"));
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$this->load->view("user/nav",$data);
		$this->load->view("user/acount",$data);
		$this->load->view('conn/footer');

	}

	public function image()
	{
		$this->load->view('conn/header');
		$result = is_login();	
		foreach ($result as $key => $value) {
			if( ! array_key_exists('user_email',$result) )
			{
				show_404();
			}
		}
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['acount_info'] = $this->index_model->get_my_acount(get_user_info("user_id"));
		$data['person_info'] = $this->index_model->get_person_info(get_user_info("user_id"));
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$this->load->view("user/nav",$data);
		$this->load->view("user/image",$data);
		$this->load->view('conn/footer');
	}

	public function upimage()
	{	
		$data['imgpath'] = $_POST['imgpath'];
		$this->load->view("user/upimage",$data);

	}

	public function get_new_pages()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$pages = $_POST['current_page'];
			$uid = $_POST['uid'];
			$page = $_POST['index'];
			if($page == "my-answer"){

				$res = $this->index_model->get_my_answer($uid,$pages);
			}
			else
			{
				$res = $this->index_model->get_my_question($uid,$pages);
			}
			echo $res;
		}
		else
		{
			show_404();
		}
	}

	
}