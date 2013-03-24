<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}

		public function user_register($data)
		{
			$this->db->insert('guwen_user',$data);
		}

		public function user_login($data)
		{
			$user_email = $data['user_email'];
			$user_password = $data['user_password'];
			$sql = "SELECT * FROM guwen_user WHERE user_email = ? AND user_password = ? ";
			$query = $this->db->query($sql,array($user_email,$user_password));

			return count($query->result_array());

		}

		public function get_user_info($useremail)
		{
			$sql = "SELECT user_id ,user_name,user_email,user_img FROM guwen_user WHERE user_email = ? ";

			$query = $this->db->query($sql,array($useremail));
			return $query->result_array();
		}

		public function user_login_log($data)
		{
			$this->db->insert('guwen_log',$data);
		}

		/** judge user is register
		*author huip
		*return bool
		*/
		public function is_register($data)
		{	
			$user_email = $data['user_email'];
			$user_password = $data['user_password'];
			$sql = "SELECT * FROM guwen_user WHERE user_email = ? ";
			$query = $this->db->query($sql,array($user_email,$user_password));
			return count($query->result_array());
		}

		public function post_message($data)
		{
			$res = $this->db->insert('guwen_message',$data);
			$this->db->where('user_id',$data['user_id']);
			$this->db->update('guwen_user',$this->add_score('-'.$data['ques_socore']));
			if($res) {
				
				$sql = "SELECT msgid FROM guwen_message WHERE user_id = ? ORDER BY msgid DESC LIMIT 1";
				$query = $this->db->query($sql,array(get_user_info("user_id")));
				$re = $query->result_array();
				return $re;
			}
		}

		// public function get_my_question($uid)
		// {
		// 	$sql = "SELECT DISTINCT ms.ques_title,ms.browser,ms.msgid,ms.post_time,
		// 	(SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid ) 
		// 	as answer FROM guwen_message AS ms  WHERE ms.user_id  = ? ORDER BY ms.msgid DESC";
		// 	$query = $this->db->query($sql,array($uid));
		// 	return  $query->result_array();
		// }

		// public function get_my_answer($uid)
		// {
		// 	$sql = "SELECT DISTINCT ms.ques_title,ms.post_time,ms.browser,ms.msgid,
		// 	(SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid ) AS answer,
		// 	(SELECT comment_content FROM guwen_comment WHERE comment_quesid = ms.msgid 
		// 	AND comment_uid = '$uid'  LIMIT 1 ) AS myanswer FROM guwen_message AS ms ,guwen_comment AS cmt
		// 	 WHERE cmt.comment_quesid = ms.msgid AND cmt.comment_uid = ? ORDER BY ms.msgid DESC" ;
		// 	$query = $this->db->query($sql,array($uid));
		// 	return $query->result_array();
		// }

		// public function get_my_message($uid)
		// {
		// 	$sql = "SELECT DISTINCT ms.ques_title,ms.msgid
		// 	 FROM guwen_comment AS cmt ,guwen_message AS ms 
		// 	 WHERE (SELECT count(id)  FROM guwen_comment WHERE comment_quesid = ms.msgid ) > 0   AND ms.user_id = ? ORDER BY cmt.comment_time ";
		// 	$query = $this->db->query($sql,array($uid));
		// 	$res = $query->result_array();
			
		// 	foreach ($res as $key => $value) {
		// 		$sql = "SELECT DISTINCT us.user_name,us.user_id,LEFT(cmt.comment_time,10) AS time 
		// 		FROM guwen_user AS us , guwen_comment AS cmt 
		// 		WHERE cmt.comment_uid = us.user_id AND cmt.comment_quesid = ?";
		// 		$query = $this->db->query($sql,array($value['msgid']));
		// 		$res[$key]['user_name'] =  $query->result_array() ;
				
		// 	}

		// 	return $res;
		// }



		// public function get_my_profile($uid)
		// {
		// 	$sql = "SELECT user_name,user_motto FROM guwen_user WHERE user_id = ?";
		// 	$query = $this->db->query($sql,array($uid));
		// 	$res = $query->result_array();
		// 	return $res;
		// }

		// public function get_my_acount($uid)
		// {
		// 	$sql = "SELECT user_email FROM guwen_user WHERE user_id = ? ";
		// 	$query = $this->db->query($sql,array($uid));
		// 	$res = $query->result_array();
		// 	return $res;
		// }

		// public function profile_alter($data)
		// {
		// 	$alter_info = array(

		// 		'user_name'   => $data['user_name'],
		// 		'user_motto'  => $data['profile']

		// 	);
		// 	$this->db->where('user_id',$data['user_id']);
		// 	$this->db->update('guwen_user',$alter_info);
		// 	return TRUE;
		// }

		// public function acount_alter($data)
		// {
		// 	$this->db->where('user_id',$data['user_id']);
		// 	$this->db->update('guwen_user',$data);
		// 	return TRUE;
		// }

		// public function image_alter($data)
		// {
		// 	$this->db->where('user_id',$data['user_id']);
		// 	$this->db->update('guwen_user',$data);
		// 	return TRUE;	
		// }

		// public function is_true_password($uid)
		// {
		// 	$sql = "SELECT user_password FROM guwen_user WHERE user_id = ?";
		// 	$query = $this->db->query($sql,array($uid));
		// 	$res = $query->result_array();
		// 	return $res;
		// }

		// public function get_person_info($uid)
		// {
		// 	$sql = "SELECT us.user_name,us.user_motto,us.user_img,us.user_score FROM guwen_user AS us WHERE us.user_id = ?";
		// 	$query = $this->db->query($sql,array($uid));
		// 	$res = $query->result_array();
		// 	return $res;
		// }

		public function set_best_answer($data)
		{
			$mes_best = array(

				'is_best' => '1'
			);
			$bestlog = array(

				'id' => '',
				'ques_id' => $data['msgid'],
				'uid'         => $data['user_id'],
				'time'       => get_local_time()
			);
			$this->db->where('user_id',$data['user_id']);
			$this->db->update('guwen_user',$this->add_score($data['user_score']));
			$this->db->where('msgid',$data['msgid']);
			$this->db->update('guwen_message',$mes_best);
			$this->db->insert('guwen_bestanwserlog',$bestlog);
			return TRUE;
		}

		public function check_score($data)
		{
			$sql = "SELECT (user_score - '$data[user_score]') AS score  FROM guwen_user WHERE user_id = ?";
			$query = $this->db->query($sql,array($data['user_id']));
			$res = $query->result_array();
			foreach ($res as $value) {
				
				return $value['score'];
			}
			
		}

		public function login_score($data)
		{
			$this->db->where('user_id',$data);
			$this->db->update('guwen_user',$this->add_score("1"));
		}

		private function add_score($score)
		{

			$sql = "SELECT user_score FROM guwen_user WHERE user_id = ?";
			$query = $this->db->query($sql,array(get_user_info("user_id")));
			$res = $query->result_array();
			foreach ($res as $value) {
				$current_score = $value['user_score'];
			}
			return array("user_score" => $current_score + $score);
		}

}
?>

