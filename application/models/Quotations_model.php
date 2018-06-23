<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 03-Jan-18
 * Time: 2:17 AM
 * Project: procurement
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Quotations_model extends CI_Model{


    function get_uploaded_quotes(){
        $query = $this->db->query("SELECT * FROM tbl_quotations");
        return $query->result_array();
    }

    function get_quotation($quote_id){
        $query = $this->db->query("SELECT * FROM tbl_quotations WHERE quotation_id = '$quote_id'");
        return $query->row();
    }
}