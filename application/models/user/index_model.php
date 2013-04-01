<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
    }


        public function get_my_question($uid,$pages)
        {
            $pagesize = 10;
            $sqls = "SELECT COUNT(msgid) AS num FROM guwen_message WHERE user_id =  ?";
            $querys = $this->db->query($sqls,array($uid));
            $re = $querys->result_array();
            $offset = ($pages-1)*$pagesize;
            if(count($re)>0)
            {
                $count = $re[0]['num'];
            }
            else
            {
                $count = 1;
            }
            $numpage = ceil($count/$pagesize);
            $sql = "SELECT DISTINCT ms.ques_title,ms.browser,ms.msgid,ms.post_time,'$numpage' AS num,
            (SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid ) 
            as answer FROM guwen_message AS ms  WHERE ms.user_id  = ? ORDER BY ms.msgid DESC LIMIT $offset,$pagesize";
            $query = $this->db->query($sql,array($uid));
            $res = $query->result_array();
            if($offset == 0 )
            {   
                return $res;
            }
            else
            {
                if($pages >= $numpage)
                {
                    return json_encode(array('data' => 'null'));
                }
                else
                {
                    return json_encode($res);
                }
            }
        }

        public function get_my_answer($uid,$pages)
        {
            $pagesize = 10;
            $sqls = "SELECT COUNT(msgid) AS num FROM guwen_message WHERE user_id =  ?";
            $querys = $this->db->query($sqls,array($uid));
            $re = $querys->result_array();
            $offset = ($pages-1)*$pagesize;
            if(count($re)>0)
            {
                $count = $re[0]['num'];
            }
            else
            {
                $count = 1;
            }
            $numpage = ceil($count/$pagesize);
            $sql = "SELECT DISTINCT ms.ques_title,ms.post_time,ms.browser,ms.msgid,'$numpage' AS num,
            (SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid ) AS answer,
            (SELECT comment_content FROM guwen_comment WHERE comment_quesid = ms.msgid 
            AND comment_uid = '$uid'  LIMIT 1 ) AS myanswer FROM guwen_message AS ms ,guwen_comment AS cmt
             WHERE cmt.comment_quesid = ms.msgid AND cmt.comment_uid = ? ORDER BY ms.msgid DESC LIMIT $offset,$pagesize" ;
            $query = $this->db->query($sql,array($uid));
            $res = $query->result_array();
            if($offset == 0 )
            {   
                return $res;
            }
            else
            {
                if($pages >= $numpage)
                {
                    return json_encode(array('data' => 'null'));
                }
                else
                {
                    return json_encode($res);
                }
            }
        }

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
            $sql = "SELECT us.user_name,us.user_motto,us.user_img,us.user_score,us.user_id FROM guwen_user AS us WHERE us.user_id = ?";
            $query = $this->db->query($sql,array($uid));
            $res = $query->result_array();
            return $res;
        }
}
?>