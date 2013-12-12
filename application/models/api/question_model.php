<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Question_model extends CI_Model
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
  public function get_list($page)
  {   
    $pagesize = 10;
    $sql = "SELECT COUNT(qid) AS num FROM guwen_question";
    $query = $this->db->query($sql);
    $result = $query->result_array();
    $offset = ($page-1)*$pagesize;
    $count = count($result) > 0?$result[0]['num']:1;
    $numpage = ceil($count/$pagesize);
    $sql = "SELECT us.gravatar,us.name,us.uid,q.qid,q.ctime,q.qtitle,'$numpage' AS num,
                IF(status = 0,'未解决','已解决') AS status,
                q.qscore,q.click,
                (SELECT count(*) FROM guwen_comment WHERE comment_quesid = q.qid) AS anwser,
                (SELECT tag_name FROM guwen_tag WHERE id = q.qcate ) AS qcate
                FROM guwen_question AS q, guwen_user AS us WHERE q.uid = us.uid 
                ORDER BY qid DESC LIMIT $offset,$pagesize";
    $query = $this->db->query($sql);
    $result = $query->result_array();
    return $result;
  }

  /*
   * @author huip
   * get index question info
   * Dec 2013-12-7
   */
  public function get_info($qid)
  {
    $sql = " SELECT q.qid ,us.name,q.qtitle,q.qcontent,
      q.uid,q.qscore, q.ctime,q.status,
      (SELECT tag_name FROM guwen_tag WHERE id = q.qcate) AS 
      qcate
      FROM guwen_question AS q, guwen_user AS us  
      WHERE us.uid = q.uid AND qid = ?";
    $query = $this->db->query($sql,array($qid));
    $result = $query->result_array();
    return $result;
  }

  /*
   * @author huip
   * get relative question info
   * Dec 2013-12-7
   */
  public function get_relative($qid)
  {
    $relative = array();
    $keywords = array();
    $keyword = array();
    $relative_ques = array();
    $realativewords = array();
    $sql = "SELECT keywords FROM guwen_keywords WHERE qid = ?";
    $query = $this->db->query($sql,array($qid));
    $res = $query->result_array();
    foreach ($res as $key => $value) {
      $keywords = explode(',',$value['keywords']);
    }
    $sql = "SELECT keywords ,qid,qcate FROM guwen_keywords WHERE qid !=?";
    $query = $this->db->query($sql,array($qid));
    $re = $query->result_array();
    foreach ($re as $key => $value) {
      $keyword[$key]= explode(',',$value['keywords']);
      $keyword[$key]['qid'] = $value['qid'];
      $keyword[$key]['qcate'] = $value['qcate'];
    }
    foreach ($keyword as $key => $value) {
      $diff = array_diff($keywords,$value);
      if(count($diff) != 0)
      {
        if( (1- count($diff)/count($keywords)) >= 0.3 )
        {
          $relative[$key]['score'] = (1-count($diff)/count($keywords));
          $relative[$key]['qid'] = $value['qid'];
          $relative[$key]['qcate'] = $value['qcate'];
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
      $sql = "SELECT qtitle,qid,(SELECT tag_name FROM guwen_tag WHERE id = '$value[qcate]' ) AS qcate,
      (SELECT COUNT(id) FROM guwen_comment WHERE comment_quesid = '$value[qid]') AS anwser 
      FROM guwen_question  WHERE qid = '$value[qid]'";
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
  public function get_comments($qid)
  {
    $sql = "SELECT cmt.id,cmt.comment_content,cmt.comment_time,cmt.comment_quesid ,cmt.comment_uid,
      cmt.comment_favour,us.gravatar,us.name,us.uid,
      (SELECT count(id) FROM guwen_comment_reply WHERE comment_id = cmt.id) as reply_num,
      (SELECT uid FROM guwen_bestanwserlog WHERE comment_id = cmt.id) AS best_uid 
      FROM  guwen_comment AS cmt ,guwen_user AS us 
      WHERE  us.uid = cmt.comment_uid  AND cmt.comment_quesid = ? 
      ORDER BY (SELECT time FROM guwen_bestanwserlog WHERE comment_id = cmt.id) DESC, cmt.id DESC";
    $query = $this->db->query($sql,array($qid));
    $res = $query->result_array($query);
    foreach ($res as $key => $value) 
    {
      $sql = "SELECT DISTINCT  reply.reply_content ,reply.time,us.name,us.gravatar,us.uid 
      FROM guwen_comment_reply as reply ,guwen_user as us ,guwen_comment AS cmt
      WHERE reply.comment_id  = ? AND reply.reply_uid = us.uid 
      AND cmt.comment_quesid = ? ";

      $query = $this->db->query($sql,array($value['id'],$value['comment_quesid']));
      $re = $query->result_array();
      $res[$key]['reply'] = $re;
    }
    return $res;
  }

  /*
   * @author huip
   * get my question
   * Dec 2013-12-8
   */
  public function get_user($uid,$page)
  {
    $pagesize = 10;
    $sql = "SELECT COUNT(qid) AS num FROM guwen_question WHERE uid =  ?";
    $query = $this->db->query($sql,array($uid));
    $result = $query->result_array();
    $offset = ($page-1)*$pagesize;
    $count = count($result) > 0?$result[0]['num']:1;
    $numpage = ceil($count/$pagesize);
    $sql = "SELECT DISTINCT q.qtitle,q.click,q.qid,q.ctime, '$numpage' AS num,
      (SELECT count(id) FROM guwen_comment WHERE comment_quesid = q.qid ) 
      as answer FROM guwen_question AS q  WHERE q.uid  = ? ORDER BY q.qid DESC LIMIT $offset,$pagesize";
    $query = $this->db->query($sql,array($uid));
    return $query->result_array();
  }

 public function get_topic($id,$pages)
  {
    $pagesize = 15;
    $sql = "SELECT COUNT(qid) AS num FROM guwen_question WHERE qcate= ?";
    $query = $this->db->query($sql,array($id));
    $result = $query->result_array();
    $offset = ($pages-1)*$pagesize;
    $count = count($result) > 0?$result[0]['num']:1;
    $numpage = ceil($count/$pagesize);
    $sql = "SELECT us.uid,us.name,us.gravatar, q.qid,q.qtitle,q.qscore,
    q.click,q.ctime,'$numpage' AS num,(SELECT count(id) FROM guwen_comment WHERE comment_quesid = q.qid) AS anwser,
    (SELECT tag_name FROM guwen_tag WHERE id = q.qcate ) AS qcate
    FROM guwen_user AS us ,guwen_question AS q WHERE us.uid = q.uid 
    AND q.qcate = ?  ORDER BY q.qid DESC LIMIT $offset,$pagesize";
    $query = $this->db->query($sql,array($id));
    $result = $query->result_array();
    return $result;
  }
}
