<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usercenter extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	   	date_default_timezone_set('PRC');
	   	$this->load->helper('url');
	   	$this->load->model('user_model');
	   	$this->load->library('session');
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
		$data['question_info'] = $this->user_model->get_my_question(get_user_info("user_id"));
		$data['person_info'] = $this->user_model->get_person_info(get_user_info("user_id"));
		$this->load->view("conn/nav",$data);
		$this->load->view("usercenter_question",$data);
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
		$data['answer_info'] = $this->user_model->get_my_answer(get_user_info("user_id"));
		$data['person_info'] = $this->user_model->get_person_info(get_user_info("user_id"));
		$this->load->view("conn/nav",$data);
		$this->load->view("usercenter_anwser",$data);
		$this->load->view('conn/footer');
	}

	public function message()
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
		$data['message_info'] = $this->user_model->get_my_message(get_user_info("user_id"));
		$data['person_info'] = $this->user_model->get_person_info(get_user_info("user_id"));
		$this->load->view("conn/nav",$data);
		$this->load->view("usercenter_message",$data);
		$this->load->view('conn/footer');

	}

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
		$data['profile_info'] = $this->user_model->get_my_profile(get_user_info("user_id"));
		$data['person_info'] = $this->user_model->get_person_info(get_user_info("user_id"));
		$this->load->view("conn/nav",$data);
		$this->load->view("usercenter_profile",$data);
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
		$data['acount_info'] = $this->user_model->get_my_acount(get_user_info("user_id"));
		$data['person_info'] = $this->user_model->get_person_info(get_user_info("user_id"));
		$this->load->view("conn/nav",$data);
		$this->load->view("usercenter_acount",$data);
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
		$data['acount_info'] = $this->user_model->get_my_acount(get_user_info("user_id"));
		$data['person_info'] = $this->user_model->get_person_info(get_user_info("user_id"));
		$this->load->view("conn/nav",$data);
		$this->load->view("usercenter_image",$data);
		$this->load->view('conn/footer');
	}

	public function upimage()
	{	
		$data['imgpath'] = $_POST['imgpath'];
		$this->load->view("usercenter_upimage",$data);

	}

	public function person_question($uid)
	{
		$this->load->view('conn/header');
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['person_question'] = $this->user_model->get_my_question($uid);
		$data['person_info'] = $this->user_model->get_person_info($uid);
		$data['uid'] = $uid;
		$this->load->view("conn/nav",$data);
		$this->load->view("usercenter_person",$data);
		$this->load->view('conn/footer');
	}

	public function person_answer($uid)
	{
		$this->load->view('conn/header');
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['person_answer'] = $this->user_model->get_my_answer($uid);
		$data['person_info'] = $this->user_model->get_person_info($uid);
		$data['uid'] = $uid;
		$this->load->view("conn/nav",$data);
		$this->load->view("usercenter_person_answer",$data);
		$this->load->view('conn/footer');
	}

}