<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class index_model extends CI_Model
{
	public function __construct()
	{
	   $this->load->database();
	}

      public function get_user_info()
      {
         $sql = "SELECT us.user_name,us.user_email,us.user_id,us.reg_time,us.user_score 
                      FROM guwen_user AS us";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;
      }
}