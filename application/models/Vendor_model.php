<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 18-Jan-18
 * Time: 12:29 AM
 * Project: procurement
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Vendor_model extends CI_Model{

    function get_vendor_address($vendor_name){
        $query = $this->db->query("SELECT vendor_address, vendor_contact, vendor_telephone FROM tbl_vendors WHERE vendor_name ='$vendor_name'");
        $result = $query->row();
        return $result;
    }

}