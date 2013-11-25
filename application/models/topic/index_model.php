<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
    }


    public function get_topic_list($pages)
    {
        $pagesize = 10;
        $sqls = "SELECT COUNT(id) AS num FROM guwen_tag";
        $querys = $this->db->query($sqls);
        $re = $querys->result_array();
        $offset = ($pages-1)*$pagesize;
        $count = $re[0]['num'];
        $numpage = ceil($count/$pagesize);
        $sql = "SELECT DISTINCT tg.tag_name,tg.id,tg.tag_img,'$numpage' AS num FROM guwen_tag AS tg,guwen_message  AS ms  ORDER BY ms.post_time DESC LIMIT $offset,$pagesize  ";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        foreach ($res as $key => $value) {
                    
                    $sql = "SELECT msgid,ques_title,post_time,   (SELECT count(*) FROM guwen_comment 
                                WHERE comment_quesid = msgid) AS anwser
                                FROM guwen_message WHERE ques_cate = '$value[id]' ORDER BY msgid DESC LIMIT 3";
                    $query =  $this->db->query($sql);
                    $res[$key]['ques'] = $query->result_array();

        }
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

}
?>