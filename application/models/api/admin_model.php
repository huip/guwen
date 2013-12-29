<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends  CI_Model
{
    public function __construct()
    {
        $this->load->database();
    } 

    /*
     * @author polande 
     * get login log
     * 2013-12-20
     */

    public function get_login_log()
    {
        $sql = "SELECT * from guwen_log";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}
