<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_answer($uid,$pages)
	{
		$pagesize = 10;
		$sqls = "SELECT COUNT(ms.msgid) AS num FROM guwen_message AS ms,guwen_user AS us,
			guwen_comment AS cmt WHERE ms.msgid = cmt.comment_quesid AND us.user_id = cmt.comment_uid 
			AND ms.user_id= ?";
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
		$sql = "SELECT ms.ques_title,us.user_name,ms.msgid,us.user_id,cmt.comment_time,'$numpage' AS num
			 FROM guwen_message AS ms,guwen_user AS us , guwen_comment AS cmt WHERE
			ms.msgid = cmt.comment_quesid AND us.user_id = cmt.comment_uid AND ms.user_id=? 
			ORDER BY cmt.comment_time DESC LIMIT $offset,$pagesize";
		$query = $this->db->query($sql,$uid);
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

	public function get_reply($uid,$pages)
	{
		$pagesize = 10;
		$sqls = "SELECT COUNT(cmt.id) AS num FROM guwen_comment AS cmt, guwen_comment_reply AS rpy , 
			guwen_user AS us ,guwen_message AS ms WHERE cmt.id = rpy.comment_id AND 
			us.user_id = rpy.reply_uid AND cmt.comment_quesid = ms.msgid AND cmt.comment_uid = ?";
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
		$sql = "SELECT cmt.comment_content,rpy.reply_content,rpy.time,ms.ques_title,ms.msgid,us.user_name,
			us.user_id,'$numpage' AS num FROM guwen_comment AS cmt, guwen_comment_reply AS rpy , 
			guwen_user AS us ,guwen_message AS ms WHERE cmt.id = rpy.comment_id AND 
			us.user_id = rpy.reply_uid AND cmt.comment_quesid = ms.msgid AND cmt.comment_uid = ? 
			ORDER BY rpy.time DESC LIMIT $offset,$pagesize";

		$query = $this->db->query($sql,$uid);
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

	public function get_favour($uid,$pages)
	{
		$pagesize = 10;
		$sqls = "SELECT  count(slg.id) AS num FROM guwen_user AS us,guwen_message AS ms ,
			guwen_comment as cmt,guwen_snslog AS slg WHERE slg.uid = us.user_id AND slg.is_favour = 0
			AND ms.msgid = slg.quesid  AND slg.comment_id = cmt.id 
			AND  cmt.comment_uid = ?";
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
		$sql = "SELECT DISTINCT us.user_name,ms.ques_title,cmt.comment_content,us.user_id,ms.msgid,
			'$numpage' AS num, slg.favour_time FROM guwen_user AS us,guwen_message AS ms ,
			guwen_comment as cmt,guwen_snslog AS slg WHERE slg.uid = us.user_id AND slg.is_favour = 0
			AND ms.msgid = slg.quesid  AND slg.comment_id = cmt.id 
			AND  cmt.comment_uid = ? ORDER BY slg.favour_time DESC LIMIT $offset,$pagesize";
		$query = $this->db->query($sql,$uid);
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

	public function get_best($uid,$pages)
	{
		$pagesize = 10;
		$sqls = "SELECT COUNT(cmt.id) AS num FROM guwen_user AS us ,guwen_bestanwserlog AS blg,
			guwen_message AS ms,guwen_comment AS cmt WHERE blg.ques_id = ms.msgid AND 
			blg.uid = us.user_id AND cmt.comment_quesid = blg.ques_id AND cmt.id = blg.comment_id
			 AND blg.uid = ? ORDER BY blg.time DESC";
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
		$sql  = "SELECT us.user_name,us.user_id,ms.ques_title,ms.msgid,cmt.comment_content,blg.time,
			'$numpage' AS num FROM guwen_user AS us ,guwen_bestanwserlog AS blg,guwen_message 
			AS ms,guwen_comment AS cmt WHERE blg.ques_id = ms.msgid AND blg.uid = us.user_id 
			AND cmt.comment_quesid = blg.ques_id AND cmt.id = blg.comment_id AND blg.uid = ? 
			ORDER BY blg.time DESC LIMIT $offset,$pagesize";
		$query = $this->db->query($sql,$uid);
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

	public function get_answer_num($uid)
	{
		$sql = "SELECT COUNT(cmt.id) AS num FROM guwen_message AS ms,guwen_comment AS cmt WHERE 
			ms.msgid = cmt.comment_quesid AND  cmt.is_check = 0  AND   ms.user_id= ? ";
		$query = $this->db->query($sql,array($uid));
		$res = $query->result_array();

		return $res[0]['num'];
	}

	public function get_reply_num($uid)
	{
		$sql = "SELECT COUNT(rpy.id) AS num FROM guwen_comment AS cmt, guwen_comment_reply AS rpy , 
			guwen_user AS us ,guwen_message AS ms WHERE cmt.id = rpy.comment_id AND 
			us.user_id = rpy.reply_uid AND cmt.comment_quesid = ms.msgid AND rpy.is_check = 0 AND cmt.comment_uid = ?";
		$query = $this->db->query($sql,array($uid));
		$res = $query->result_array();
		return $res[0]['num'];	
	}

	public function get_favour_num($uid)
	{
		$sql = "SELECT  count(slg.id) AS num FROM guwen_user AS us,guwen_message AS ms ,
			guwen_comment as cmt,guwen_snslog AS slg WHERE slg.uid = us.user_id AND slg.is_favour = 0
			AND ms.msgid = slg.quesid  AND slg.comment_id = cmt.id AND slg.is_check = 0
			AND  cmt.comment_uid = ?";
		$query = $this->db->query($sql,array($uid));
		$res = $query->result_array();
		return $res[0]['num'];	
	}

	public function get_best_num($uid)
	{
		$sql = "SELECT COUNT(id) AS num FROM guwen_bestanwserlog WHERE is_check = 0 AND uid = ?";
		$query = $this->db->query($sql,array($uid));
		$res = $query->result_array();
		return $res[0]['num'];
	}

	public function check_best($uid)
	{
		$data = array(

			'is_check' => '1'
		);
		$this->db->where("uid",$uid);
        		$this->db->update("guwen_bestanwserlog",$data);
		
        		
	}
	public function check_answer($uid)
	{
		$data = array(

			'is_check' => '1'
		);
		
		$sql = "UPDATE guwen_comment SET is_check = 1 WHERE  comment_quesid IN (SELECT msgid FROM 
        			guwen_message WHERE user_id = ?  )";
		$this->db->query($sql,array($uid));	
	}

	public function check_reply($uid)
	{
		$data = array(

			'is_check' => '1'
		);

		$sql = "UPDATE guwen_comment_reply SET is_check = 1 WHERE comment_id IN (SELECT id FROM 
			guwen_comment WHERE comment_uid = ?)";
		$this->db->query($sql,array($uid));
	}

	public function check_favour($uid)
	{
		$data = array(

			'is_check' => '1'
		);
		$sql = "UPDATE guwen_snslog SET is_check = 1 WHERE comment_id IN (SELECT id FROM 
			guwen_comment WHERE comment_uid = ?)";
		$this->db->query($sql,array($uid));
	}
}
?>