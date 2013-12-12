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

}
