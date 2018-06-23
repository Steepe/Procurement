<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 11-Jan-18
 * Time: 9:45 PM
 * Project: procurement
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Po_model extends CI_Model{
    function get_po_vendors(){
        $query = $this->db->query("SELECT vendor_name FROM tbl_quotations");
        return $query->result_array();
    }

    function submit_purchase_order($new_form_data){
        $this->db->insert('tbl_po', $new_form_data);

        if ($this->db->affected_rows() == '1'){
            return true;
        }
        return false;
    }

}