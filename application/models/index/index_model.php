<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }

            public function get_message_list()
            {
                $sql = "SELECT us.user_img,ms.user_name,us.user_id,ms.msgid,ms.post_time,ms.ques_title,
                            ms.ques_socore,ms.browser,ms.ques_content ,ms.is_best,
                            (SELECT count(*) FROM guwen_comment WHERE comment_quesid = ms.msgid) AS anwser,(SELECT tag_name FROM guwen_tag WHERE id = ms.ques_cate ) AS ques_cate
                            FROM guwen_message AS ms, guwen_user AS us WHERE ms.user_id = us.user_id ORDER BY msgid DESC LIMIT 20";
                $query = $this->db->query($sql);
                $res = $query->result_array();
               return $res;
            }

            public function get_anser_num($ques_id)
            {
                $sql = "SELECT count(id) AS anwser FROM guwen_comment WHERE comment_quesid = ?";
                $query = $this->db->query($sql,array($ques_id));
                $res = $query->result_array();
                foreach ($res as $value) {
                    
                    return $value['anwser'];
                }

            }

            public function get_question_detail($ques_id)
            {
                $sql = " SELECT * FROM guwen_message WHERE msgid = ? ";
                $query = $this->db->query($sql,array($ques_id));
                $res = $query->result_array();
               return $res;
            }

            public function get_comment($ques_id)
            {
                $sql = "SELECT cmt.id,cmt.comment_content,cmt.comment_time,cmt.comment_quesid ,cmt.comment_uid,cmt.comment_favour,us.user_img,us.user_name,us.user_id,
                            (SELECT count(id) FROM guwen_comment_reply WHERE comment_id = cmt.id) as reply_num
                             FROM guwen_comment AS cmt ,guwen_user AS us
                             WHERE  us.user_id = cmt.comment_uid  AND cmt.comment_quesid = ?  ORDER BY cmt.id DESC";
                $query = $this->db->query($sql,array($ques_id));
                $res = $query->result_array($query);
                return $res;
            }

            public function get_index_anwser($ques_id)
            {
                $sql = "SELECT  cmt.comment_content,us.user_img,us.user_name,us.user_id FROM guwen_comment AS cmt ,guwen_user AS us WHERE cmt.comment_uid = us.user_id AND cmt.comment_quesid = ?";
                $query = $this->db->query($sql,array($ques_id));
                $res = $query->result_array();
                return json_encode($res);
            }

            public function add_reply($data)
            {
                $this->db->insert("guwen_comment_reply",$data);
                return TRUE;
                
            }

            public function get_reply_num($comment_id)
            {
                $sql = "SELECT count(id) FROM guwen_comment_reply WHERE comment_id = ?";
                $query = $this->db->query($sql,array($comment_id));
                $res = $query->result_array();
                return json_encode($res);
            }

            public function get_reply_list($comment_id)
            {
                $sql = "SELECT reply.reply_content ,reply.time,us.user_name,us.user_img,us.user_id FROM guwen_comment_reply as reply ,guwen_user as us WHERE reply.comment_id  = ? AND reply.reply_uid = us.user_id ";
                $query = $this->db->query($sql,array($comment_id));
                $res = $query->result_array();
                return json_encode($res);

            }

}
