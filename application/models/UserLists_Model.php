<?php

class UserLists_Model extends CI_Model
{

    public function __construct(){
        ini_set('memory_limit', '256M');
        $this->load->helper('log4php');
    }
  
    public function get_user_details_model(){
        $this->db->select('first_name,last_name,email_address,mobile,profile_picture,address,created_on'); 
        $this->db->from('users')->where('usertype','user');
        $this->db->order_by('user_id','asc');
        $query = $this->db->get()->result_array();
        $debug = $this->db->last_query();
        log_debug($debug);
        return $query;
    }
   
}
?>