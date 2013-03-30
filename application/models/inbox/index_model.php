<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index_model extends CI_Model
{
    public function __construct()
    {
    $this->load->database();
    }

    public function inbox($uid)
    {

      $sql = "SELECT id,my_id, to_id,time FROM guwen_inbox_link WHERE to_id = ? ORDER BY time DESC";
      $query = $this->db->query($sql,$uid);
      $res = $query->result_array();
      foreach ($res as $key => $value) {

          $user = "SELECT user_name,user_id,user_img FROM guwen_user WHERE user_id = '$value[my_id]'";
          $inboxs = "SELECT inbox,time,(SELECT count(inbox) FROM guwen_inbox WHERE my_id = '$value[my_id]') AS inboxnum FROM guwen_inbox WHERE my_id = '$value[my_id]'  ORDER BY time DESC LIMIT 1 ";
          $user_info = $this->db->query($user);
          $inbox_info = $this->db->query($inboxs);
          $res[$key]['inbox_info'] = $inbox_info->result_array();
          $res[$key]['user_info'] = $user_info->result_array();

      }
      return $res;
      }

    public function check_inbox($uid)
    {
        $data = array(

        'is_check' => '1'
        );
        $this->db->where("to_id",$uid);
        $this->db->update("guwen_inbox",$data);
    }

    public function info($id)
    {

          $sql = "SELECT to_id,my_id FROM guwen_inbox_link WHERE id = ?";
          $query = $this->db->query($sql,$id);
          $res = $query->result_array();
          foreach ($res as  $value) {
              $sql = "SELECT inbox,my_id,(SELECT user_name FROM guwen_user WHERE user_id = my_id) AS name , (SELECT user_img FROM guwen_user WHERE user_id = my_id) AS user_img,time  
              FROM guwen_inbox WHERE (to_id = '$value[to_id]' AND my_id = '$value[my_id]' ) OR ( to_id = '$value[my_id]' AND my_id = '$value[to_id]') ORDER BY time DESC";
              $query = $this->db->query($sql);
              $info['user_info'] = $query->result_array();
          }

        return $info;

    }

}
