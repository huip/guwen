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

  /*
   * @author huip
   * get my anwser
   * Dec 2013-12-20
   */
  public function get_answer($uid,$pages)
  {
    $pagesize = 10;
    $sql = "SELECT COUNT(qid) AS num FROM guwen_question WHERE uid =  ?";
    $query = $this->db->query($sql,array($uid));
    $result = $query->result_array();
    $offset = ($pages-1)*$pagesize;
    $count = count($result) > 0?$result[0]['num']:1;
    $numpage = ceil($count/$pagesize);
    $sql = "SELECT DISTINCT q.qtitle,q.ctime,q.click,q.qid, '$numpage' AS num,
      (SELECT count(id) FROM guwen_comment WHERE comment_quesid = q.qid ) AS answer,
      (SELECT comment_content FROM guwen_comment WHERE comment_quesid = q.qid 
      AND comment_uid = '$uid'  LIMIT 1 ) AS myanswer FROM guwen_question AS q ,guwen_comment AS cmt
      WHERE cmt.comment_quesid = q.qid AND cmt.comment_uid = ? ORDER BY q.qid DESC LIMIT $offset,$pagesize" ;
    $query = $this->db->query($sql,array($uid));
    $result = $query->result_array();
    return $result;
  }

  /*
   * @author huip
   * user login
   * Dec 2013-12-09
   */
  public function login($data)
  {
    $email = $data['email'];
    $password = $data['password'];
    $sql = "SELECT role FROM guwen_user WHERE email = ? AND password = ? ";
    $query = $this->db->query($sql,array($email,$password));
    return $query->result_array();
  }

  public function get_login($email)
  {
    $sql = "SELECT uid ,name,email,gravatar,role FROM guwen_user WHERE email = ? ";
    $query = $this->db->query($sql,array($email));
    return $query->result_array();
  }
  // set user login log
  public function login_log($data)
  {
    $this->db->insert('guwen_log',$data);
  }

  public function login_score($data)
  {
    $this->db->where('uid',$data);
    $this->db->update('guwen_user',$this->add_score("2"));
    return TRUE;
  }

  private function add_score($score)
  {
    $sql = "SELECT score FROM guwen_user WHERE uid = ?";
    $query = $this->db->query($sql,array(get_user_info("uid")));
    $res = $query->result_array();
    foreach ($res as $value) {
      $current_score = intval($value['score']);
    }
    return array("score" => $current_score + intval($score));
  }

}
