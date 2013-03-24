<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
    }


    public function get_topic_list()
    {
        $sql = "SELECT tg.id,tg.tag_img,tg.tag_name FROM guwen_tag AS tg ";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        foreach ($res as $key => $value) {
                    
                    $sql = "SELECT msgid,ques_title,post_time FROM guwen_message WHERE ques_cate = '$value[id]' ORDER BY msgid DESC LIMIT 5";
                    $query =  $this->db->query($sql);
                    $res[$key]['ques'] = $query->result_array();

        }

        return $res;
    }
}