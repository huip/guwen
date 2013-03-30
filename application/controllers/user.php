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
				echo "<script>alert('您无权进入该页面，请先登录！');window.location.href='".base_url()."index.php/index/login'</script>";
				return FALSE;
			}
		}
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['question_info'] = $this->index_model->get_my_question(get_user_info("user_id"));
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
				echo "<script>alert('您无权进入该页面，请先登录！');window.location.href='".base_url()."index.php/index/login'</script>";
				return FALSE;
			}
		}
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['answer_info'] = $this->index_model->get_my_answer(get_user_info("user_id"));
		$data['person_info'] = $this->index_model->get_person_info(get_user_info("user_id"));
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$this->load->view("user/nav",$data);
		$this->load->view("user/anwser",$data);
		$this->load->view('conn/footer');
	}

	// public function message()
	// {
	// 	$this->load->view('conn/header');
	// 	$result = is_login();	
	// 	foreach ($result as $key => $value) {
	// 		if( ! array_key_exists('user_email',$result) )
	// 		{
	// 			echo "<script>alert('您无权进入该页面，请先登录！');window.location.href='".base_url()."index.php/index/login'</script>";
	// 			return FALSE;
	// 		}
	// 	}
	// 	$data['user_id'] = $this->session->userdata("user_id");
	// 	$data['user_img'] = $this->session->userdata("user_img");
	// 	$data['user_name'] = $this->session->userdata("user_name");
	// 	$data['message_info'] = $this->index_model->get_my_message(get_user_info("user_id"));
	// 	$data['person_info'] = $this->index_model->get_person_info(get_user_info("user_id"));
	// 	$data['tag_list']      = $this->conn_model->get_tag_list();
	// 	$this->load->view("user/nav",$data);
	// 	$this->load->view("user/message",$data);
	// 	$this->load->view('conn/footer');

	// }

	public function profile()
	{
		$this->load->view('conn/header');
		$result = is_login();	
		foreach ($result as $key => $value) {
			if( ! array_key_exists('user_email',$result) )
			{
				echo "<script>alert('您无权进入该页面，请先登录！');window.location.href='".base_url()."index.php/index/login'</script>";
				return FALSE;
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
				echo "<script>alert('您无权进入该页面，请先登录！');window.location.href='".base_url()."index.php/index/login'</script>";
				return FALSE;
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
				echo "<script>alert('您无权进入该页面，请先登录！');window.location.href='".base_url()."index.php/index/login'</script>";
				return FALSE;
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

	
}