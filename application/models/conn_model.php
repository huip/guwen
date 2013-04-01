<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Conn_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_tag_list()
	{

		$sql = "SELECT tag_name,id FROM guwen_tag";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;

	}

	public function get_hot_ques()
	{
		$sql = "SELECT ms.msgid,ms.post_time,ms.ques_title,ms.browser, (SELECT count(*) FROM guwen_comment 
		WHERE comment_quesid = ms.msgid) AS anwser,(SELECT tag_name FROM guwen_tag WHERE id = ms.ques_cate ) 
		AS ques_cate FROM guwen_message AS ms, guwen_user AS us 
		WHERE ms.user_id = us.user_id ORDER BY anwser DESC,ms.post_time DESC, ms.browser DESC  LIMIT 5";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}

	public function get_hot_cate()
	{
		$sql = "SELECT DISTINCT tg.tag_name,tg.id,tg.tag_img FROM guwen_tag AS tg,guwen_message  AS ms  ORDER BY ms.post_time DESC LIMIT 5 ";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}
}
?>