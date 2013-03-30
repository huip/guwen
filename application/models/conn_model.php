<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Conn_model extends CI_Model
{
        public function __construct()
        {
            $this->load->database();
        }

        public function get_tag_list()
        {

            $sql = "SELECT tag_name,id FROM guwen_tag";
            $query = $this->db->query($sql);
            $res = $query->result_array();
            return $res;

        }
}
?>