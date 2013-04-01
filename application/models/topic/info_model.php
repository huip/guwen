<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Info_model extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
    }


    public function get_mess_info($id,$pages)
    {

            $pagesize = 10;
            $sqls = "SELECT COUNT(msgid) AS num FROM guwen_message WHERE ques_cate= ?";
            $querys = $this->db->query($sqls,array($id));
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
            $sql = "SELECT us.user_id,us.user_name,us.user_img, ms.msgid,ms.ques_title,ms.ques_socore,ms.ques_content,
            ms.browser,ms.post_time,'$numpage' AS num,(SELECT count(id) FROM guwen_comment WHERE comment_quesid = ms.msgid) AS anwser,
            (SELECT tag_name FROM guwen_tag WHERE id = ms.ques_cate ) AS ques_cate
            FROM guwen_user AS us ,guwen_message AS ms WHERE us.user_id = ms.user_id 
            AND ms.ques_cate = ?  ORDER BY ms.msgid DESC LIMIT $offset,$pagesize";
            $query = $this->db->query($sql,array($id));
            $res = $query->result_array();
            if($offset == 0 )
            {

                return $res;

            }
            else
            {
                if($pages > $numpage)
                {
                    return json_encode(array('data' => 'null'));
                }
                else
                {
                    return json_encode($res);
                }
            }

    }

    public function get_topic_info($id)
    {
        $sql = "SELECT tag_name,id FROM guwen_tag WHERE id = '$id' ";
        $query = $this->db->query($sql,array($id));
        $res = $query->result_array();
        $info = array();
        foreach ($res as $key => $value) {
                $info[$key] = $value;
        }

        return $info;
    }

}