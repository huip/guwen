<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_person_info($uid)
	{
		$sql = "SELECT us.user_name,us.user_motto,us.user_img,us.user_score,us.user_id,
			(SELECT rank FROM guwen_rank WHERE us.user_score >= score ORDER BY id DESC LIMIT 1) 
			AS rank ,(SELECT (score - us.user_score) FROM guwen_rank WHERE score > us.user_score ORDER BY id ASC LIMIT 1)
			AS gap FROM guwen_user AS us  WHERE us.user_id = ?";
		$query = $this->db->query($sql,array($uid));
		$res = $query->result_array();
		return $res;
	}


	public function get_my_question($uid,$pages)
	{
		$pagesize = 10;
		$sqls = "SELECT COUNT(msgid) AS num FROM guwen_message WHERE user_id =  ?";
		$querys = $this->db->query($sqls,array($uid));
		$re = $querys->result_array();
		$offset = ($pages-1)*$pagesize;

		if(count($re)>0)
		{
			$count = $re[0]['num'];
		}
		else
		{
			$count = 1;
		}
		$numpage = ceil($count/$pagesize);
		$sql = "SELECT DISTINCT ms.ques_title,ms.browser,ms.msgid,ms.post_time, '$numpage' AS num,
			(SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid ) 
			as answer FROM guwen_message AS ms  WHERE ms.user_id  = ? ORDER BY ms.msgid DESC LIMIT $offset,$pagesize";
		$query = $this->db->query($sql,array($uid));
		$res = $query->result_array();
		if($offset == 0 )
		{	
			return $res;
		}
		else
		{
			if($pages > $numpage)
			{
				return json_encode(array('data' => 'null'));
			}
			else
			{
				return json_encode($res);
			}
		}
	}

	public function get_my_anwser($uid,$pages)
	{
		$pagesize = 10;
		$sqls = "SELECT COUNT(msgid) AS num FROM guwen_message WHERE user_id =  ?";
		$querys = $this->db->query($sqls,array($uid));
		$re = $querys->result_array();
		$offset = ($pages-1)*$pagesize;
		if(count($re)>0)
		{
			$count = $re[0]['num'];
		}
		else
		{
			$count = 1;
		}
		$numpage = ceil($count/$pagesize);
		$sql = "SELECT DISTINCT ms.ques_title,ms.post_time,ms.browser,ms.msgid, '$numpage' AS num,
			(SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid ) AS answer,
			(SELECT comment_content FROM guwen_comment WHERE comment_quesid = ms.msgid 
			AND comment_uid = '$uid'  LIMIT 1 ) AS myanswer FROM guwen_message AS ms ,guwen_comment AS cmt
			WHERE cmt.comment_quesid = ms.msgid AND cmt.comment_uid = ? ORDER BY ms.msgid DESC LIMIT $offset,$pagesize" ;
		$query = $this->db->query($sql,array($uid));
		$query = $this->db->query($sql,array($uid));
		$res = $query->result_array();
		if($offset == 0 )
		{	
			return $res;
		}
		else
		{
			if($pages >= $numpage)
			{
				return json_encode(array('data' => 'null'));
			}
			else
			{
				return json_encode($res);
			}
		}
	}


}
?>
