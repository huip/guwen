<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
    }


    public function get_my_question($uid)
        {
            $sql = "SELECT DISTINCT ms.ques_title,ms.browser,ms.msgid,ms.post_time,
            (SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid ) 
            as answer FROM guwen_message AS ms  WHERE ms.user_id  = ? ORDER BY ms.msgid DESC";
            $query = $this->db->query($sql,array($uid));
            return  $query->result_array();
        }

        public function get_my_answer($uid)
        {
            $sql = "SELECT DISTINCT ms.ques_title,ms.post_time,ms.browser,ms.msgid,
            (SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid ) AS answer,
            (SELECT comment_content FROM guwen_comment WHERE comment_quesid = ms.msgid 
            AND comment_uid = '$uid'  LIMIT 1 ) AS myanswer FROM guwen_message AS ms ,guwen_comment AS cmt
             WHERE cmt.comment_quesid = ms.msgid AND cmt.comment_uid = ? ORDER BY ms.msgid DESC" ;
            $query = $this->db->query($sql,array($uid));
            return $query->result_array();
        }

        // public function get_my_message($uid)
        // {
        //     $sql = "SELECT DISTINCT ms.ques_title,ms.msgid
        //      FROM guwen_comment AS cmt ,guwen_message AS ms 
        //      WHERE (SELECT count(id)  FROM guwen_comment WHERE comment_quesid = ms.msgid ) > 0   AND ms.user_id = ? ORDER BY cmt.comment_time ";
        //     $query = $this->db->query($sql,array($uid));
        //     $res = $query->result_array();
            
        //     foreach ($res as $key => $value) {
        //         $sql = "SELECT DISTINCT us.user_name,us.user_id,LEFT(cmt.comment_time,10) AS time 
        //         FROM guwen_user AS us , guwen_comment AS cmt 
        //         WHERE cmt.comment_uid = us.user_id AND cmt.comment_quesid = ?";
        //         $query = $this->db->query($sql,array($value['msgid']));
        //         $res[$key]['user_name'] =  $query->result_array() ;
                
        //     }

        //     return $res;
        // }



        public function get_my_profile($uid)
        {
            $sql = "SELECT user_name,user_motto FROM guwen_user WHERE user_id = ?";
            $query = $this->db->query($sql,array($uid));
            $res = $query->result_array();
            return $res;
        }

        public function get_my_acount($uid)
        {
            $sql = "SELECT user_email FROM guwen_user WHERE user_id = ? ";
            $query = $this->db->query($sql,array($uid));
            $res = $query->result_array();
            return $res;
        }

        public function profile_alter($data)
        {
            $alter_info = array(

                'user_name'   => $data['user_name'],
                'user_motto'  => $data['profile']

            );
            $this->db->where('user_id',$data['user_id']);
            $this->db->update('guwen_user',$alter_info);
            return TRUE;
        }

        public function acount_alter($data)
        {
            $this->db->where('user_id',$data['user_id']);
            $this->db->update('guwen_user',$data);
            return TRUE;
        }

        public function image_alter($data)
        {
            $this->db->where('user_id',$data['user_id']);
            $this->db->update('guwen_user',$data);
            return TRUE;    
        }

        public function is_true_password($uid)
        {
            $sql = "SELECT user_password FROM guwen_user WHERE user_id = ?";
            $query = $this->db->query($sql,array($uid));
            $res = $query->result_array();
            return $res;
        }

        public function get_person_info($uid)
        {
            $sql = "SELECT us.user_name,us.user_motto,us.user_img,us.user_score FROM guwen_user AS us WHERE us.user_id = ?";
            $query = $this->db->query($sql,array($uid));
            $res = $query->result_array();
            return $res;
        }
}
?>