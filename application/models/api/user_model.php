<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  /*
   * @author huip
   * get  user info
   * Dec 2013-12-7
   */
  public function get_info($uid)
  {
    $sql = "SELECT us.name,us.motto,us.gravatar,us.score,us.uid,
      (SELECT rank FROM guwen_rank WHERE us.score >= score ORDER BY id DESC LIMIT 1) 
      AS rank ,(SELECT (score - us.score) FROM guwen_rank WHERE score > us.score ORDER BY id ASC LIMIT 1)
      AS gap FROM guwen_user AS us  WHERE us.uid = ?";
    $query = $this->db->query($sql,array($uid));
    $res = $query->result_array();
    return $res;
  }
  /*
   * @author huip
   * get user question
   * Dec 2013-12-8
   */
  public function get_question($uid,$page)
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

}
