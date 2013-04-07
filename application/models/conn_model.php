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
		$sql = "SELECT DISTINCT tg.tag_name,tg.id,tg.tag_img,(SELECT COUNT(msgid) FROM guwen_message WHERE ques_cate = tg.id ) AS num 
			FROM guwen_tag AS tg,guwen_message  AS ms ORDER BY num DESC , ms.post_time DESC LIMIT 5 ";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}

	public function get_hot_person()
	{
		$sql = "SELECT  us.user_id,us.user_name,us.user_img ,(SELECT rank FROM guwen_rank
			 WHERE us.user_score >= score ORDER BY id DESC LIMIT 1) AS rank
			FROM guwen_user AS us, guwen_comment AS cmt ,guwen_bestanwserlog AS blg,guwen_comment_reply AS rpl,
			guwen_message AS  ms WHERE us.user_id = cmt.comment_uid AND cmt.comment_uid = blg.uid AND rpl.comment_id = cmt.id
			GROUP BY cmt.comment_uid ORDER BY (SUM(cmt.comment_favour)*0.3+SUM(rpl.id)*0.1+(us.user_score*0.1) +sum(blg.id)*0.5/sum(cmt.id))  DESC  LIMIT 10";
		$query = $this->db->query($sql);
		$res = $query->result_array();
		return $res;
	}
}
?>