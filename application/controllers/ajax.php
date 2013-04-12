<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('PRC');
		$this->load->helper('url');
		$this->load->model('ajax_model');
		$this->load->library('session');
		$this->load->library('image_lib');
	}

	public function check_is_register()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$data['data'] = $_POST['data'];
			$data['cate'] = $_POST['cate'];
			$res = $this->ajax_model->check_is_register($data);
			echo json_encode(array('status' => $res));
		}
		else
		{
			show_404();
		}
	}

	public function register()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
			$data = array(

				'id'                    => '',
				'user_email'    => $_POST['useremail'],
				'user_name'   => $_POST['username'],
				'user_id'           => $this->get_uid(),
				'user_password' => md5($_POST['userpassword'].'guwen'),
				'reg_time'    => get_local_time(),
				'user_img'    => base_url()."data/uploadimg/thumbnail/defaultperson.png",
				'user_score'    => '5',

			);
			
			$res = $this->ajax_model->user_register($data); 
			if($res)
			{
				
				$user_info = $this->ajax_model->get_user_info($data['user_email']);

				foreach ($user_info as $key => $value) {

					$this->session->set_userdata($value);

				}

				$log_info = array(

					'id'                    => '',
					'user_name'     => get_user_info('user_name'),
					'login_time'      => get_local_time(),
					'login_ip'          => get_remote_ip(),
					'login_client'    =>get_user_info('user_agent'),

				);

				$inbox = array(

					'id'            => '',
					'to_id'       => $data['user_name'],
					'my_id'     => "51614ae439b6d",
					'inbox'     => $this->get_reg_inbox(),
					'is_check' => 0,
					'time'        => get_local_time()
				);

				$inbox_link = array(

					'id' => '',
					'to_id' => $data['user_name'],
					'my_id' => '51614ae439b6d',
					'time' => get_local_time()

				);

				$this->ajax_model->user_login_log($log_info);
				$login = $this->ajax_model->login_score(get_user_info('user_id'));
				if( $login )
				{
					$res = $this->ajax_model->post_inbox($inbox);
					if( $res )
					{
						$res = $this->ajax_model->update_inbox_link($inbox_link);
					}

					echo  json_encode(array('status' => 'ok'));
				}
			}
			else
			{
				echo  json_encode(array('status' => 'fail'));
			}
		}
		else
		{
			show_404();
		}

	}

	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$data = array(

				'user_email'        => $_POST['useremail'],
				'user_password' => md5($_POST['userpassword'].'guwen'),

			);

			$res = $this->ajax_model->user_login($data);
			if($res == "0")
			{
				echo json_encode( array('status' =>0));
			}
			else
			{

				echo json_encode( array('status' =>1));
				$data = $this->ajax_model->get_user_info($data['user_email']);

				foreach ($data as $key => $value) {

					$this->session->set_userdata($value);

				}

				$log_info = array(

					'id'                    => '',
					'user_name'     => get_user_info('user_name'),
					'login_time'      => get_local_time(),
					'login_ip'          => get_remote_ip(),
					'login_client'    =>get_user_info('user_agent'),

				);

				$this->ajax_model->user_login_log($log_info);
				$this->ajax_model->login_score(get_user_info('user_id'));

			}
		}
		else
		{
			show_404();
		}
	}

	public function login_off()
	{
		$array_items = array('user_name' => '', 'user_email' => '','user_id' => '');
		$this->session->unset_userdata($array_items);
		echo "<script>window.location.href='".base_url()."index.php/index'</script>";
		
	}

	public function get_index_anwser()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$ques_id = $_POST['quesid'];
			$res = $this->ajax_model->get_index_anwser($ques_id);
			echo $res;
		}
		else
		{
			show_404();
		}
	}

	public function add_comment()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if( get_user_info("user_id") !=NULL )
			{


				$data = array(

					'id' =>'',
					'comment_content' => htmlspecialchars($_POST['comment_content']),
					'comment_time' => get_local_time(),
					'comment_quesid' => $_POST['ques_id'],
					'comment_uid'   => get_user_info("user_id")

				);

				$res = $this->ajax_model->add_comment($data);
			}
			else
			{
				echo "请先登录!";
			}
		}
		else
		{
			show_404();
		}
	}

	public function add_favour()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$uid  = get_user_info("user_id");
			if( $uid != NULL) {
				$comment_id = $_POST['comment_id'];
				$quesid = $_POST['quesid'];
				$comment_uid = $_POST['comment_uid'];
				$data = array(

					'id'                             => $comment_id,
					'comment_favour'    => '0',
					'comment_quesid'   =>$quesid,
					'comment_uid'         => $comment_uid

				);
				$this->ajax_model->set_favour_log($data);
				$res = $this->ajax_model->add_favour($data);
				if( $res != NULL )
				{

					if( count( $res ) != "0")
					{

						foreach ($res as $value) {

							echo json_encode( array("status" =>$value['comment_favour']));
						} 

					} 
				}
			} else {

				echo json_encode(array("status"=>"fail"));
			}

		}
		else
		{
			show_404();
		}
	}

	public function add_reply()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{

			if( get_user_info("user_id") != NULL )
			{
				$reply_content = htmlspecialchars($_POST['reply_content']);
				$comment_id = $_POST['comment_id'];
				$data = array(
					'reply_content' => $reply_content,
					'reply_uid'         => get_user_info("user_id"),
					'comment_id'    => $comment_id,
					'time'                 => get_local_time()
				);

				$res   = $this->ajax_model->add_reply($data);
				if( $res )
				{
					$user_info =  array(

					'user_img' => get_user_info("user_img"),
					'user_name' => get_user_info("user_name"),
					'time'            => get_local_time(),
					'user_id'       => get_user_info("user_id")

					);

					echo  json_encode($user_info);
				}
			} 
			else
			{
				echo "请先登录!";
			}
		}
		else
		{
			show_404();
		}
	}

	public function get_reply_list()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
		$comment_id = $_POST['comment_id'];
		$res = $this->ajax_model->get_reply_list($comment_id);
		echo $res;
		}
		else
		{
			show_404();
		}
	}

	public function get_reply_num()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$comment_id = $_POST['comment_id'];
			$res = $this->ajax_model->get_reply_num($comment_id);
			echo $res;
		}
		else
		{
			show_404();
		}

	}

	public function post_message()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$question_title = htmlspecialchars($_POST['question_title']);
			$question_content = htmlspecialchars($_POST['question_content']);
			$cate = $_POST['cate'];
			$question_socore = htmlspecialchars($_POST['question_socore']);
			$question_anoy = $_POST['question_anoy'];
			$data = array(

				'msgid' =>'',
				'user_id'     => get_user_info('user_id'),
				'ques_title' => $question_title,
				'ques_content' => $question_content,
				'is_public' => $question_anoy,
				'ques_cate' => $cate,
				'ques_socore' => $question_socore,
				'post_time' => get_local_time()
			);
			$res = $this->ajax_model->post_message($data);
			foreach ($res as $key => $value) {

				echo json_encode(array('msgid'=>$value['msgid'],'status'=>'1'));

			}
		}
		else
		{
			show_404();
		}

	}

	public function profile_alter()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$nickname = htmlspecialchars($_POST['nickname']);
			$profile = htmlspecialchars($_POST['profile']);
			$data = array(
				'user_name' => $nickname, 
				'profile'         => $profile,
				'user_id'       => get_user_info("user_id")
			);
			$res = $this->ajax_model->profile_alter($data);
			if( $res )
			{
				$this->session->set_userdata('user_name',$data['user_name']);
				echo "修改成功";

			}
		}
		else
		{
			show_404();
		}
	}

	public function auto_upload_file()
	{
		$upload_dir = "";
		$file_name = "";
		$file_type ="";
		$img_file = array('jpg','png','gif','jpeg','bmp','JPG','PNG','GIF','BMP','JPEG');
		if ($_FILES["userfile"]["error"] > 0)
		{
			echo "Error: " . $_FILES["userfile"]["error"] . "<br>";
		}
		else
		{

			if($_FILES['userfile']['size']/1024 > 300)
			{
				echo "toobig";
				return false;
			}
			else
			{

				$file_name = explode(".", $_FILES['userfile']['name']);
				$file_type = $file_name['1'];
				if(in_array($file_type, $img_file))
				{

					$uiq = $this->get_uid();

					$user_temp = $file_name['0'].$uiq.".".$file_type;

					if (file_exists("data/uploadimg/" . $_FILES["userfile"]["name"]))
					{
						echo $_FILES["userfile"]["name"] . " already exists. ";
					}
					else
					{
						move_uploaded_file($_FILES["userfile"]["tmp_name"],"data/uploadimg/" . $user_temp);
						echo base_url()."data/uploadimg/".$user_temp;
					}
				}
				else
				{
					echo "notimg";

				}
			}

		}
	}

	public function acount_alter()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$user_email =  $_POST['email'];
			$new_password = md5($_POST['password']."guwen");
			$data = array(

				'user_email' => $user_email,
				'user_password' => $new_password,
				'user_id' => get_user_info("user_id")
			);

			$res = $this->ajax_model->acount_alter($data);
			if( $res )
			{
				echo json_encode(array('status' => 'ok'));

			}
			else
			{
				echo json_encode(array('status' => 'false'));
			}
		}
		else
		{
			show_404();
		}
	}

	public function is_true_password()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$password = "";
			$old_password = md5($_POST['oldpassword'].'guwen');
			$res = $this->ajax_model->is_true_password(get_user_info('user_id'));
			foreach ($res as  $value) {

				$password = $value['user_password'];
			}

			if( $old_password == $password )
			{
				echo json_encode(array('status' => 'ok'));
			}
			else
			{
				echo json_encode(array('status' => 'fail'));
			}
		}
		else
		{
			show_404();
		}
	}

	public function crop_image()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{

			$targ_w = $targ_h = 100;
			$jpeg_quality = 90;
			$src = $_POST['imgpath'];
			$endsrc = "data/uploadimg/thumbnail/".$this->get_uid().".jpg";
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
			$targ_w,$targ_h,$_POST['w'],$_POST['h']);
			header('Content-type: image/jpeg');
			$res = imagejpeg($dst_r,$endsrc,$jpeg_quality);
			if( $res )
			{ 
				$data = array(

				'user_img' => base_url().$endsrc,
				'user_id' => get_user_info("user_id")

				);
				$this->ajax_model->image_alter($data);
				$this->session->set_userdata('user_img',$data['user_img']);
				echo "true";
			}
			else
			{
				echo "false";
			}
		}
		else
		{
			show_404();
		}

	}

	public function set_best_answer()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$comment_uid = $_POST['comment_uid'];
			$msgid = $_POST['msgid'];
			$cid = $_POST['cid'];
			$data = array(

				'user_id' => $comment_uid,
				'ques_score' => intval($this->ajax_model->get_message_score($msgid)),
				'msgid'         => $msgid,
				'comment_id' => $cid
			);

			$res = $this->ajax_model->set_best_answer($data);
			if( $res )
			{
				echo "true";
			}
		}
		else
		{
			show_404();
		}
	}

	public function check_score()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$data = array(

				'user_score' => intval($_POST['score']),
				'user_id' => $_POST['uid']

			);
			$res = $this->ajax_model->check_score($data);

			if( $res < 0 )
			{
				echo "积分不够请修改积分！";
			}
		}
		else
		{
			show_404();
		}
	}

	public function scwc_api()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$url = "http://www.xunsearch.com/scws/api.php";
			$ques_title = htmlspecialchars($_POST['question_title']);
			$ques_content = htmlspecialchars($_POST['question_content']);
			$cate = htmlspecialchars($_POST['cate']);
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

			if( $content->status == "ok" )
			{
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

			$this->ajax_model->save_keywords($data);
		}
		else
		{
			show_404();
		}

	}

	public function post_inbox()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$status = array();
			$inbox = htmlspecialchars($_POST['inbox']);
			$to_id = htmlspecialchars($_POST['user_name']);
			$data = array(

				'id'            => '',
				'to_id'       => $to_id,
				'my_id'     => get_user_info('user_id'),
				'inbox'     => $inbox,
				'is_check' => 0,
				'time'        => get_local_time()
			);

			$inbox_link = array(

				'id' => '',
				'to_id' => $to_id,
				'my_id' => get_user_info('user_id'),
				'time' => get_local_time()

			);


			$res = $this->ajax_model->post_inbox($data);
			if( $res )
			{
				$res = $this->ajax_model->update_inbox_link($inbox_link);
				if( $res )
				{
					$status['status'] = 'ok'; 
				}
				else
				{
					$status['status'] = 'fail';
				}

			}
			else
			{
				$status['status'] = 'fail';
			}

			echo json_encode($status);

		}
		else
		{
			show_404();
		}
	}

	function get_new_inbox()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$user_id = $_POST['user_id'];
			$data = array(

			'my_id' => $user_id,

			);
			$res = $this->ajax_model->get_new_inbox($data);
			echo json_encode($res);
		}
		else
		{
			show_404();
		}

	}

	public function get_user_infos()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$user_name= htmlspecialchars($_POST['user_name']);
			$res = $this->ajax_model->get_user_infos($user_name);
			echo json_encode($res);
		} 
		else
		{
			show_404();
		}
	}

	public function create_cate()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$cate_name= htmlspecialchars($_POST['cate_name']);
			$data = array(

				'id' => '',
				'tag_name' =>$cate_name,
				'create_time' => get_local_time(),
				'create_uid' => get_user_info("user_id"),
				'tag_img'      => base_url()."/data/uploadimg/thumbnail/defaultlogo.png"
			);
			$res = $this->ajax_model->create_cate($data);
			echo json_encode($res);
		} 
		else
		{
			show_404();
		}	
	}

	
	private function get_uid()
	{
		return uniqid();
	}

	private function get_reg_inbox()
	{
		return $this->ajax_model->get_reg_inbox();
	}

}

?>
