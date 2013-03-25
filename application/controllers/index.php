<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	   	date_default_timezone_set('PRC');
	   	$this->load->helper('url');
	   	$this->load->library('session');
	   	$this->load->model("index/index_model");
	   	$this->load->model("sns_model");
	             $this->load->model("keywords_model");
	             $this->load->model("conn_model");

	}

	public function index()
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$data['tag_list']      = $this->conn_model->get_tag_list();
		$message = $this->index_model->get_message_list();
		
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
		$this->load->view("conn/nav",$data);
		$this->load->view('register_view');
		$this->load->view('conn/footer');
	}

	public function login()
	{
		$data['user_id'] = $this->session->userdata("user_id");
		$data['user_img'] = $this->session->userdata("user_img");
		$data['user_name'] = $this->session->userdata("user_name");
		$this->load->view('conn/header');
		$this->load->view("conn/nav",$data);
		$this->load->view('login_view');
		$this->load->view('conn/footer');
	}

	
	

	
	public function scwc_api()
	{
		$url = "http://www.xunsearch.com/scws/api.php";
		$ques_title = $_POST['question_title'];
		$ques_content = $_POST['question_content'];
		$cate = $_POST['cate'];
		$ques_id = $_POST['ques_id'];
 		$data = array();
		$data['ques_id'] = $ques_id;
		$data['ques_cate'] = $cate;
		$postdata = http_build_query(
		    array(
		        'data' => $ques_title.$ques_content,
		        'multi' => '0',
		        'ignore' => 'yes',
		        'duality' => 'yes',
		        'traditional' => 'yes',
		        'respond' => 'json'
		    )
		);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $postdata
		    )
		);

		$context  = stream_context_create($opts);
		$content = json_decode(trim(file_get_contents($url,false,$context)));

		if( $content->status == "ok" ){
		             $words = $content->words;
			global $keywords;
			foreach ($words as $key => $value) {

				if( strlen($value->word) > "3"){
					
					$keywords .=$value->word.",";

				}
				
			}

			$data['keywords'] = $keywords;
			$data['id'] = "";

		};

		$this->sns_model->save_keywords($data);

	}
	
 }
 ?>