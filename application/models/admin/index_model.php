<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class index_model extends CI_Model
{
  public function __construct()
  {
     $this->load->database();
  }
  /*
   * get user info
   */
  public function get_user_info()
  {
    $sql = "SELECT 
            us.user_name,
            us.user_email,
            us.user_id,
            us.reg_time,
            us.user_score 
            FROM guwen_user AS us";
    $query = $this->db->query($sql);
    $res = $query->result_array();
    return $res;
  }
  // clear no function keywords
  public function clear_keywords()
  {
    $whither_words = array(
      "一些","还是","如题","用下","价的","什么","大公","如题","这么",
      "今天","一道","的问","我严","请问","的餐","这里","谁知","特的",
      "始了","员都","都喜","欢在","为什","什么"
    );
    $sql = "SELECT id,keywords FROM guwen_keywords";
    $query = $this->db->query($sql);
    $res = $query->result_array();
    foreach ($res as $key => $value)
    {
      $keywords_diff = implode(",",array_diff(explode(",", $value['keywords']),$whither_words));
      $sql = "UPDATE guwen_keywords SET keywords ='$keywords_diff'   WHERE id = ?";
      $query = $this->db->query($sql,$value['id']);
    }
    return $keywords_diff;
  }
  // get user login infomation
  public function get_login_info($offset)
  {
      $pagesize = 20;
      $sql = "SELECT * FROM guwen_log ORDER BY login_time DESC LIMIT $offset,$pagesize";
      $query = $this->db->query($sql);
      $res = $query->result_array();
      return $res;
  }
}
