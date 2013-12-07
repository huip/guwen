<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }
  /*
   * @author huip
   * get index question list
   * Dec 2013-12-7
   */
  public function get_question_list($page)
  {   
    $pagesize = 10;
    $sqls = "SELECT COUNT(msgid) AS num FROM guwen_message";
    $query = $this->db->query($sqls);
    $result = $query->result_array();
    $offset = ($page-1)*$pagesize;
    $count = count($result) > 0?$result[0]['num']:1;
    $numpage = ceil($count/$pagesize);
    $sql = "SELECT us.user_img,us.user_name,us.user_id,ms.msgid,ms.post_time,ms.ques_title,'$numpage' AS num,
                IF(is_best = 0,'未解决','已解决') AS is_best,
                ms.ques_socore,ms.browser,
                (SELECT count(*) FROM guwen_comment WHERE comment_quesid = ms.msgid) AS anwser,
                (SELECT tag_name FROM guwen_tag WHERE id = ms.ques_cate ) AS ques_cate
                FROM guwen_message AS ms, guwen_user AS us WHERE ms.user_id = us.user_id 
                ORDER BY msgid DESC LIMIT $offset,$pagesize";
    $query = $this->db->query($sql);
    $result = $query->result_array();
    return $result;
  }

  /*
   * @author huip
   * get index question info
   * Dec 2013-12-7
   */
  public function get_question_info($qid)
  {
    $sql = " SELECT ms.msgid ,us.user_name,ms.ques_title,ms.ques_content,
      ms.user_id,ms.ques_socore, ms.post_time,ms.is_best,
      (SELECT tag_name FROM guwen_tag WHERE id = ms.ques_cate) AS 
      ques_cate
      FROM guwen_message AS ms, guwen_user AS us  
      WHERE us.user_id = ms.user_id AND msgid = ?";
    $query = $this->db->query($sql,array($qid));
    $result = $query->result_array();
    return $result;
  }

  /*
   * @author huip
   * get relative question info
   * Dec 2013-12-7
   */
  public function get_relative_question($qid)
  {
    $relative = array();
    $keywords = array();
    $keyword = array();
    $relative_ques = array();
    $realativewords = array();
    $sql = "SELECT keywords FROM guwen_keywords WHERE ques_id = ?";
    $query = $this->db->query($sql,array($qid));
    $res = $query->result_array();
    foreach ($res as $key => $value) {
      $keywords = explode(',',$value['keywords']);
    }
    $sql = "SELECT keywords ,ques_id,ques_cate FROM guwen_keywords WHERE ques_id !=?";
    $query = $this->db->query($sql,array($qid));
    $re = $query->result_array();
    foreach ($re as $key => $value) {
      $keyword[$key]= explode(',',$value['keywords']);
      $keyword[$key]['ques_id'] = $value['ques_id'];
      $keyword[$key]['ques_cate'] = $value['ques_cate'];
    }
    foreach ($keyword as $key => $value) {
      $diff = array_diff($keywords,$value);
      if(count($diff) != 0)
      {
        if( (1- count($diff)/count($keywords)) >= 0.3 )
        {
          $relative[$key]['score'] = (1-count($diff)/count($keywords));
          $relative[$key]['ques_id'] = $value['ques_id'];
          $relative[$key]['ques_cate'] = $value['ques_cate'];
        }
      }
    }
    rsort($relative);
    if( count($relative) < 5)
    {
      $realativewords = $relative;
    }
    else
    {
      for($i = 0; $i < 5; $i++)
      {
        $realativewords[$i] = $relative[$i]; 
      };
    }
    foreach ($realativewords as $key => $value) {
      $sql = "SELECT ques_title,msgid,(SELECT tag_name FROM guwen_tag WHERE id = '$value[ques_cate]' ) AS ques_cate,
      (SELECT COUNT(id) FROM guwen_comment WHERE comment_quesid = '$value[ques_id]') AS anwser 
      FROM guwen_message  WHERE msgid = '$value[ques_id]'";
      $query = $this->db->query($sql);
      $res = $query->result_array();
      $relative_ques[$key] = $res;
    }
    return $relative_ques;
  }

  /*
   * @author huip
   * get  question comment info
   * Dec 2013-12-7
   */
  public function get_comments($ques_id)
  {
    $sql = "SELECT cmt.id,cmt.comment_content,cmt.comment_time,cmt.comment_quesid ,cmt.comment_uid,
      cmt.comment_favour,us.user_img,us.user_name,us.user_id,
      (SELECT count(id) FROM guwen_comment_reply WHERE comment_id = cmt.id) as reply_num,
      (SELECT uid FROM guwen_bestanwserlog WHERE comment_id = cmt.id) AS best_uid 
      FROM  guwen_comment AS cmt ,guwen_user AS us 
      WHERE  us.user_id = cmt.comment_uid  AND cmt.comment_quesid = ? 
      ORDER BY (SELECT time FROM guwen_bestanwserlog WHERE comment_id = cmt.id) DESC, cmt.id DESC";
    $query = $this->db->query($sql,array($ques_id));
    $res = $query->result_array($query);
    foreach ($res as $key => $value) 
    {
      $sql = "SELECT DISTINCT  reply.reply_content ,reply.time,us.user_name,us.user_img,us.user_id 
      FROM guwen_comment_reply as reply ,guwen_user as us ,guwen_comment AS cmt
      WHERE reply.comment_id  = ? AND reply.reply_uid = us.user_id 
      AND cmt.comment_quesid = ? ";

      $query = $this->db->query($sql,array($value['id'],$value['comment_quesid']));
      $re = $query->result_array();
      $res[$key]['reply'] = $re;
    }
    return $res;
  }

  /*
   * @author huip
   * get  user info
   * Dec 2013-12-7
   */
  public function get_u_info($uid)
  {
    $sql = "SELECT us.user_name,us.user_motto,us.user_img,us.user_score,us.user_id,
      (SELECT rank FROM guwen_rank WHERE us.user_score >= score ORDER BY id DESC LIMIT 1) 
      AS rank ,(SELECT (score - us.user_score) FROM guwen_rank WHERE score > us.user_score ORDER BY id ASC LIMIT 1)
      AS gap FROM guwen_user AS us  WHERE us.user_id = ?";
    $query = $this->db->query($sql,array($uid));
    $res = $query->result_array();
    return $res;
  }
}
