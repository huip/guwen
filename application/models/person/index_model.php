<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_person_info($uid)
	{
		$sql = "SELECT us.user_name,us.user_motto,us.user_img,us.user_score,us.user_id FROM guwen_user AS us WHERE us.user_id = ?";
		$query = $this->db->query($sql,array($uid));
		$res = $query->result_array();
		return $res;
	}


	public function get_my_question($uid)
	{
		$sql = "SELECT DISTINCT ms.ques_title,ms.browser,ms.msgid,ms.post_time,
			(SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid ) 
			as answer FROM guwen_message AS ms  WHERE ms.user_id  = ? ORDER BY ms.msgid DESC";
		$query = $this->db->query($sql,array($uid));
		return  $query->result_array();
	}

	public function get_my_answer($uid)
	{
		$sql = "SELECT DISTINCT ms.ques_title,ms.post_time,ms.browser,ms.msgid,
			(SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid ) AS answer,
			(SELECT comment_content FROM guwen_comment WHERE comment_quesid = ms.msgid 
			AND comment_uid = '$uid'  LIMIT 1 ) AS myanswer FROM guwen_message AS ms ,guwen_comment AS cmt
			WHERE cmt.comment_quesid = ms.msgid AND cmt.comment_uid = ? ORDER BY ms.msgid DESC" ;
		$query = $this->db->query($sql,array($uid));
		return $query->result_array();
	}


}
?>