<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
        public function __construct()
        {
            $this->load->database();
        }

        public function index()
        {
           $sql = "SELECT us.user_img,ms.user_name,us.user_id,ms.msgid,ms.post_time,ms.ques_title,ms.ques_socore,ms.browser,
           ms.ques_content ,ms.is_best,(SELECT count(*) FROM guwen_comment WHERE comment_quesid = ms.msgid) AS anwser,
           (SELECT tag_name FROM guwen_tag WHERE id = ms.ques_cate ) AS ques_cate FROM guwen_message AS ms, guwen_user AS us 
           WHERE ms.user_id = us.user_id ORDER BY anwser DESC,ms.post_time DESC, ms.browser DESC  LIMIT 20";
                $query = $this->db->query($sql);
                $res = $query->result_array();
                return $res;
        }
}
?>