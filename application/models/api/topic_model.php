<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Topic_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  /*
   * @author huip
   * get topic list $page:pages
   * Dec 2013-12-11
   */
  public function get_list($page)
  {
    $pagesize = 10;
    $sql = "SELECT COUNT(id) AS num FROM guwen_tag";
    $query = $this->db->query($sql);
    $result = $query->result_array();
    $offset = ($page-1)*$pagesize;
    $count = $result[0]['num'];
    $numpage = ceil($count/$pagesize);
    $sql = "SELECT DISTINCT tg.tag_name,tg.id,tg.tag_img,'$numpage' AS num FROM 
      guwen_tag AS tg,guwen_question  AS q  ORDER BY q.ctime DESC LIMIT $offset,$pagesize";
    $query = $this->db->query($sql);
    $result = $query->result_array();
    foreach ($result as $key => $value) {
      $sql = "SELECT qid,qtitle,ctime,(SELECT count(*) FROM guwen_comment 
                  WHERE comment_quesid = qid) AS anwser
                  FROM guwen_question WHERE qcate = '$value[id]' ORDER BY qid DESC LIMIT 3";
      $query =  $this->db->query($sql);
      $result[$key]['qlist'] = $query->result_array();
    }
    return $result;
  }

  /*
   * @author huip
   * get topic list $page:pages
   * Dec 2013-12-11
   */
  public function get_question($id,$pages)
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

