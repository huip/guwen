<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }

            public function get_message_list($pages)
            {   
              
                $pagesize = 10;
                $sqls = "SELECT COUNT(msgid) AS num FROM guwen_message";
                $querys = $this->db->query($sqls);
                $re = $querys->result_array();
                $offset = ($pages-1)*$pagesize;
                $count = $re[0]['num'];
                $numpage = $count/$pagesize;
                $sql = "SELECT us.user_img,ms.user_name,us.user_id,ms.msgid,ms.post_time,ms.ques_title,
                            ms.ques_socore,ms.browser,ms.ques_content ,ms.is_best,
                            (SELECT count(*) FROM guwen_comment WHERE comment_quesid = ms.msgid) AS anwser,(SELECT tag_name FROM guwen_tag WHERE id = ms.ques_cate ) AS ques_cate
                            FROM guwen_message AS ms, guwen_user AS us WHERE ms.user_id = us.user_id ORDER BY msgid DESC LIMIT $offset,$pagesize";
                $query = $this->db->query($sql);
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

            public function get_anser_num($ques_id)
            {
                $sql = "SELECT count(id) AS anwser FROM guwen_comment WHERE comment_quesid = ?";
                $query = $this->db->query($sql,array($ques_id));
                $res = $query->result_array();
                foreach ($res as $value) {
                    
                    return $value['anwser'];
                }

            }   
}
