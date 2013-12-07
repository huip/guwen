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
 }
