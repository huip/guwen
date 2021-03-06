<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Widgets_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
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
      (SELECT COUNT(qid) FROM guwen_question WHERE qcate = tg.id ) AS num 
      FROM 
      guwen_tag AS tg,guwen_question  AS q 
      ORDER BY num DESC , 
      q.ctime 
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
      us.uid,us.name,us.gravatar ,
      (SELECT rank FROM guwen_rank
      WHERE us.score >= score ORDER BY id DESC LIMIT 1) 
      AS 
      rank
      FROM guwen_user AS us
      ORDER BY
        (SELECT count(id) FROM guwen_answer WHERE uid = us.uid )
       DESC  LIMIT 10";
    $query = $this->db->query($sql);
    $res = $query->result_array();
    return $res;
  }
}
