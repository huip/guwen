<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	   	date_default_timezone_set('PRC');
	   	$this->load->helper('url');
	   	$this->load->model('user_model');
	   	$this->load->library('session');
	   	$this->load->library('image_lib');
	}

	/**user register
	*author huip
	*return bool
	*/
	public function register()
	{

		$data = array(

				'id'                	  => '',
				'user_email' 	  => $_POST['useremail'],
				'user_name'	  => $_POST['username'],
				'user_id'       	  => $this->get_uid(),
				'user_password' => md5($_POST['userpassword'].'guwen'),
				'reg_time'	  => get_local_time(),
				'user_img'	  => 'default.jpg',
				'user_score'	  => '250',

			);
		$res = $this->user_model->is_register($data);
		if( $res > 0 )
		{
			echo 1;
		}
		else
		{
			$this->user_model->user_register($data);	
		}

		

	}

	public function login()
	{
		$data = array(

				'user_email'        => $_POST['useremail'],
				'user_password' => md5($_POST['userpassword'].'guwen'),

			);

		$res = $this->user_model->user_login($data);
		if($res == "0")
		{
			echo 0;
		}
		else
		{

			echo 1;
			$data = $this->user_model->get_user_info($data['user_email']);

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

			$this->user_model->user_login_log($log_info);
			$this->user_model->login_score(get_user_info('user_id'));

		}
	}

	public function login_off()
	{
		$array_items = array('user_name' => '', 'user_email' => '','user_id' => '');
 		$this->session->unset_userdata($array_items);
		echo "<script>window.location.href='".base_url()."index.php/index'</script>";

	}

	public function post_message()
	{
		$question_title = $_POST['question_title'];
		$question_content = $_POST['question_content'];
		$cate = $_POST['cate'];
		$question_socore = $_POST['question_socore'];
		$question_anoy = $_POST['question_anoy'];

		$data = array(

				'msgid' =>'',
				'user_name' => get_user_info('user_name'),
				'user_id'     => get_user_info('user_id'),
				'ques_title' => $question_title,
				'ques_content' => $question_content,
				'is_public' => $question_anoy,
				'ques_cate' => $cate,
				'ques_socore' => $question_socore,
				'post_time' => get_local_time()
			);
		$res = $this->user_model->post_message($data);
		foreach ($res as $key => $value) {
			
			echo json_encode(array('msgid'=>$value['msgid'],'status'=>'1'));
		}

	}

	public function auto_upload_file()
	{
		$upload_dir = "";
		$file_name = "";
		$file_type ="";
		if ($_FILES["userfile"]["error"] > 0)
		 {
		  echo "Error: " . $_FILES["userfile"]["error"] . "<br>";
		 }
		else
		  {
			$file_name = explode(".", $_FILES['userfile']['name']);
			$file_type = $file_name['1'];
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
	}

	public function profile_alter()
	{
		$nickname = $_POST['nickname'];
		$profile = $_POST['profile'];
		$data = array(
			'user_name' => $nickname, 
			'profile'	        => $profile,
			'user_id'       => get_user_info("user_id")
		);

		$res = $this->user_model->profile_alter($data);
		if( $res )
		{
			$this->session->set_userdata('user_name',$data['user_name']);
			echo "修改成功";

		}
	}

	public function is_true_password()
	{
		$password = "";
		$old_password = md5($_POST['oldpassword'].'guwen');
		$res = $this->user_model->is_true_password(get_user_info('user_id'));
		foreach ($res as  $value) {
			
			$password = $value['user_password'];
		}

		if( $old_password == $password )
		{
			echo "";
		}
		else
		{
			echo "就密码错误！";
		}


	}

	public function acount_alter()
	{
		$user_email =  $_POST['email'];
		$new_password = md5($_POST['password']."guwen");
		$data = array(

			'user_email' => $user_email,
			'user_password' => $new_password,
			'user_id' => get_user_info("user_id")
		);

		$res = $this->user_model->acount_alter($data);
		if( $res )
		{
			echo "修改成功！";
		}
		else {
			echo "修改失败！";
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
				$this->user_model->image_alter($data);
				$this->session->set_userdata('user_img',$data['user_img']);
				echo "true";
			}

		}

	}

	public function set_best_answer()
	{
		$comment_uid = $_POST['comment_uid'];
		$score = $_POST['score'];
		$msgid = $_POST['msgid'];
		$data = array(

			'user_id' => $comment_uid,
			'user_score' => $score,
			'msgid'         => $msgid
		);

		$res = $this->user_model->set_best_answer($data);
		if( $res )
		{
			echo "true";
		}
	}

	public function check_score()
	{
		$data = array(

			'user_score' => $_POST['score'],
			'user_id' => $_POST['uid']
		);
		$res = $this->user_model->check_score($data);

		if( $res < 0 )
		{
			echo "积分不够请修改积分！";
		}
	}

	/**get_uid
	*author huip
	*return string
	*/
	private function get_uid()
	{
		return uniqid();
	}
}