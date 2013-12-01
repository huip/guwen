<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Keywords_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_relative_ques($ques_id)
  {
    $relative = array();
    $keywords = array();
    $keyword = array();
    $relative_ques = array();
    $realativewords = array();
    $sql = "SELECT keywords FROM guwen_keywords WHERE ques_id = ?";
    $query = $this->db->query($sql,array($ques_id));
    $res = $query->result_array();
    foreach ($res as $key => $value) {
      $keywords = explode(',',$value['keywords']);
    }
    $sql = "SELECT keywords ,ques_id,ques_cate FROM guwen_keywords WHERE ques_id !=?";
    $query = $this->db->query($sql,array($ques_id));
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
}
