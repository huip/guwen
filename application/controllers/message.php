<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('PRC');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('conn_model');
		$this->load->model('message/index_model');
	}

	public function index()
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$data['answer'] = $this->index_model->get_answer($data['user_id'],1);
		$this->load->view('conn/header');
		$this->load->view("message/nav",$data);
		$this->load->view("message/index");
		$this->load->view('conn/footer');
	}

	public function reply()
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$data['reply'] = $this->index_model->get_reply($data['user_id'],1);
		$this->load->view('conn/header');
		$this->load->view("message/nav",$data);
		$this->load->view("message/reply");
		$this->load->view('conn/footer');
	}

	public function favour()
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$data['favour'] = $this->index_model->get_favour($data['user_id'],1);
		$this->load->view('conn/header');
		$this->load->view("message/nav",$data);
		$this->load->view("message/favour");
		$this->load->view('conn/footer');
	}

	public function best()
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$data['best'] = $this->index_model->get_best($data['user_id'],1);
		$this->load->view('conn/header');
		$this->load->view("message/nav",$data);
		$this->load->view("message/best");
		$this->load->view('conn/footer');   
	}

	public function get_new_pages()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$pages = $_POST['current_page'];
			$index = $_POST['index'];
			$uid = $_POST['uid'];

			switch ($index) {
				case 'answer':
				$res = $this->index_model->get_answer($uid,$pages);
				echo $res;
			break;

			case 'reply':
				$res = $this->index_model->get_reply($uid,$pages);
				echo $res;
			break;

			case 'favour':
				$res = $this->index_model->get_favour($uid,$pages);
				echo $res;
			break;

			case 'best':
				$res = $this->index_model->get_best($uid,$pages);
				echo $res;
			break;
			}
		}
		else
		{
			show_404();
		}
	}

}
?>

