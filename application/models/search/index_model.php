<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }

        public function search($w)
        {
          
          $sql = "SELECT DISTINCT ms.ques_title,ms.msgid,ms.browser,ms.post_time,
                      (SELECT count(id) FROM guwen_comment WHERE comment_quesid =ms.msgid) AS answer 
                      FROM guwen_message AS ms,guwen_comment AS cmt WHERE ms.msgid = cmt.comment_quesid 
                      AND  ms.ques_title LIKE '%$w%' OR ms.ques_content LIKE '%$w%' ORDER BY ms.post_time DESC";
          $query = $this->db->query($sql);
          $res = $query->result_array();
          return $res;
        }
    }
  ?>