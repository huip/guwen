<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tip_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /*
     * @author polande
     * get tip list
     * 2013-12-20
     */
    public function get_tip()
    {
        $sql = "SELECT * from guwen_tip";
        $query = $this->db->query($sql);
        $result = $query->result_array(); 
        return $result;
    }

}

