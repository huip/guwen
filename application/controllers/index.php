<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('PRC');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model("index/index_model");
		$this->load->model("keywords_model");
		$this->load->model("conn_model");

	}

	public function index()
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$data['hot_ques'] = $this->conn_model->get_hot_ques();
		$data['hot_cate'] = $this->conn_model->get_hot_cate();
		$message = $this->index_model->get_message_list(1);
		$this->load->view('conn/header');
		$this->load->view("index/nav",$data);
		if(count( $message ) != 0){

			foreach ($message as $key=>$value) {

				$data['list_info'][$key] = $value;

			}

			$this->load->view("index/index",$data);
		}


		$this->load->view('conn/footer');
	}

	/**user register
	*author huip
	*return bool
	*/
	public function register()
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$this->load->view('conn/header');
		$this->load->view("index/nav",$data);
		$this->load->view('index/register');
		$this->load->view('conn/footer');
	}

	public function login()
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$this->load->view('conn/header');
		$this->load->view("index/nav",$data);
		$this->load->view('index/login');
		$this->load->view('conn/footer');
	}

	public function get_new_pages()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$pages = $_POST['current_page'];
			$res = $this->index_model->get_message_list($pages);
			echo $res;
		}
		else
		{
			show_404();
		}

	}

}
?>
