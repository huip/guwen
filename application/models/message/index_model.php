<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
    }

     public function get_answer($uid)
     {
            $sql = "SELECT ms.ques_title,us.user_name,ms.msgid,us.user_id,cmt.comment_time FROM guwen_message AS ms,guwen_user AS us , guwen_comment AS cmt
                         WHERE ms.msgid = cmt.comment_quesid AND us.user_id = cmt.comment_uid AND ms.user_id=? ORDER BY cmt.comment_time DESC";
            $query = $this->db->query($sql,$uid);
            $res = $query->result_array();
            return $res;
     }

     public function get_reply($uid)
     {
          $sql = "SELECT cmt.comment_content,rpy.reply_content,rpy.time,ms.ques_title,ms.msgid,us.user_name,us.user_id FROM guwen_comment AS cmt, guwen_comment_reply AS rpy , guwen_user AS us ,guwen_message AS ms WHERE cmt.id = rpy.comment_id AND us.user_id = rpy.reply_uid AND cmt.comment_quesid = ms.msgid AND cmt.comment_uid = ?";
          $query = $this->db->query($sql,$uid);
          $res = $query->result_array();
          return $res;
     }

     public function get_favour($uid)
     {
        $sql = "SELECT DISTINCT us.user_name,ms.ques_title,cmt.comment_content,us.user_id,ms.msgid,slg.favour_time FROM guwen_user AS us,guwen_message AS ms ,guwen_comment as cmt,guwen_snslog AS slg WHERE slg.uid = us.user_id AND slg.is_favour = 0 AND ms.msgid = slg.quesid AND cmt.comment_uid = slg.uid AND slg.comment_id = cmt.id AND slg.uid = ? ";
        $query = $this->db->query($sql,$uid);
        $res = $query->result_array();
        return $res;
     }
     public function get_best($uid)
     {
          $sql  = "SELECT us.user_name,us.user_id,ms.ques_title,ms.msgid,cmt.comment_content,blg.time FROM guwen_user AS us ,guwen_bestanwserlog AS blg,guwen_message AS ms,guwen_comment AS cmt WHERE blg.ques_id = ms.msgid AND blg.uid = us.user_id AND cmt.comment_quesid = blg.ques_id AND cmt.id = blg.comment_id AND blg.uid = ? ORDER BY blg.time DESC";
          $query = $this->db->query($sql,$uid);
          $res = $query->result_array();
          return $res;
     }
}
?>