<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Info_model extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
    }


    public function get_mess_info($id)
    {
        $sql = "SELECT us.user_id,us.user_name,us.user_img, ms.msgid,ms.ques_title,ms.ques_socore,ms.ques_content,
                    ms.browser,ms.post_time,(SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid) AS anwser,
                    (SELECT tag_name FROM guwen_tag WHERE id = ms.ques_cate ) AS ques_cate
                     FROM guwen_user AS us ,guwen_message AS ms WHERE us.user_id = ms.user_id 
                    AND ms.ques_cate = ?  ORDER BY ms.msgid DESC ";
        $query = $this->db->query($sql,array($id));
        $res = $query->result_array();
        return $res;

    }

    public function get_topic_info($id)
    {
        $sql = "SELECT tag_name,tag_img FROM guwen_tag WHERE id = '$id' ";
        $query = $this->db->query($sql,array($id));
        $res = $query->result_array();
        $info = array();
        foreach ($res as $key => $value) {
                $info[$key] = $value;
        }

        return $info;
    }

}