<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Widgets_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  /*
   * @author huip
   * get hot question
   * Dec 2013-12-05
   */
  public function get_hot_ques()
  {
    $sql = "SELECT 
      ms.msgid,ms.post_time,ms.ques_title,ms.browser, 
      (SELECT count(*) FROM guwen_comment 
      WHERE 
      comment_quesid = ms.msgid) AS anwser,
      (SELECT tag_name FROM guwen_tag WHERE id = ms.ques_cate )
      AS 
      ques_cate FROM guwen_message AS ms, guwen_user AS us
      WHERE ms.user_id = us.user_id 
      ORDER BY 
      (anwser*0.5+ms.browser*0.3 +0.2/(NOW()-ms.post_time) )/((NOW()-ms.post_time)/1000 +anwser + ms.browser)
      DESC LIMIT 5";
    $this->db->cache_on();
    $query = $this->db->query($sql);
    $res = $query->result_array();
    return $res;
  }

  /*
   * @author huip
   * get hot categoreis
   * Dec 2013-12-05
   */
  public function get_hot_cate()
  {
    $sql = "SELECT DISTINCT 
      tg.tag_name,tg.id,tg.tag_img,
      (SELECT COUNT(msgid) FROM guwen_message WHERE ques_cate = tg.id ) AS num 
      FROM 
      guwen_tag AS tg,guwen_message  AS ms 
      ORDER BY num DESC , 
      ms.post_time 
      DESC LIMIT 5";
    $this->db->cache_on();
    $query = $this->db->query($sql);
    $res = $query->result_array();
    return $res;
  }

  /*
   * @author huip
   * get hot person
   * Dec 2013-12-05
   */
  public function get_hot_person()
  {
    $sql = "SELECT  
      us.user_id,us.user_name,us.user_img ,
      (SELECT rank FROM guwen_rank
      WHERE us.user_score >= score ORDER BY id DESC LIMIT 1) 
      AS 
      rank
      FROM guwen_user AS us
      ORDER BY
        (SELECT count(id) FROM guwen_comment WHERE comment_uid = us.user_id )
       DESC  LIMIT 10";
    $query = $this->db->query($sql);
    $res = $query->result_array();
    return $res;
  }
}
