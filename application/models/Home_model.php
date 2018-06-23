<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 10/16/14
 * Time: 2:50 PM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

    function get_users_online(){
        $query = $this->db->query("SELECT * FROM ci_sessions WHERE `data` != ''");
        return $query->num_rows();
    }

    //function get_last_visit($)

} 