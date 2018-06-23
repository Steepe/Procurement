<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 9/22/14
 * Time: 6:50 AM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Procurement_model extends CI_Model {

    function get_last_id(){
        $query = $this->db->query("SELECT MAX(req_id) AS req_id FROM (tbl_requests)");
        return $query->row();

    }

    function get_last_emergency_id(){
        $query = $this->db->query("SELECT MAX(emergency_id) AS req_id FROM (tbl_emergency_requests)");
        return $query->row();

    }

    function get_users_online(){
        $query = $this->db->query("SELECT * FROM ci_sessions WHERE `data` != ''");
        return $query->num_rows();

    }


    function submit_request($new_form_data){
        //$employee_id = $new_form_data['employee_id'];
       // $amount = $new_form_data['amount'];
        $this->db->insert('tbl_requests', $new_form_data);

        if ($this->db->affected_rows() == '1'){
                return true;
            }
        return false;
    }

    function get_request($request_id){
        $query = $this->db->query("SELECT a.*, b.employee_email FROM tbl_requests a JOIN tbl_users b ON b.employee_id = a.employee_id WHERE req_id = '$request_id'");
        return $query->result();
    }

    function load_requests_1($employee_id){
        $query = $this->db->query("SELECT a.*, c.department_name, e.user_type, f.is_read  as approval_role FROM tbl_requests a, tbl_read f JOIN tbl_users b ON b.employee_id = a.employee_id
JOIN tbl_departments c ON c.department_id = a.department_id JOIN tbl_approval_role e ON e.status_id = a.approval_role WHERE a.employee_id= '$employee_id' AND f.req_id = a.req_id");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return FALSE;
        }

    }

    function load_requests_2($department_id){
        $query = $this->db->query("SELECT r.*, d.department_name FROM tbl_requests r JOIN tbl_departments d ON d.department_id = r.department_id WHERE r.department_id = '$department_id'");
        $result = $query->result_array();
        return $result;
    }


    function load_requests_3(){
        $query = $this->db->query("SELECT r.*, d.department_name FROM tbl_requests r JOIN tbl_departments d ON d.department_id = r.department_id WHERE r.approval_status = 'approved' AND r.amount < '250000'");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return FALSE;
        }
    }

    function load_requests_4(){
        $query = $this->db->query("SELECT r.*, d.department_name FROM tbl_requests r JOIN tbl_departments d ON d.department_id = r.department_id WHERE r.amount > '250000.00' AND r.approval_status = 'approved'");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return FALSE;
        }
    }

    function load_requests_5(){
        $query = $this->db->query("SELECT r.*, d.department_name FROM tbl_requests r JOIN tbl_departments d ON d.department_id = r.department_id WHERE (r.amount < '250000.00' AND r.approval_role = '3') or (r.amount > '250000.00' and r.approval_role = '4') ORDER  BY r.date DESC");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return FALSE;
        }
    }


    function load_requests_6(){
        $query = $this->db->query("SELECT r.*, d.department_name FROM tbl_requests r JOIN tbl_departments d ON d.department_id = r.department_id WHERE r.approval_status = 'approved' AND r.approval_role >= '5'");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return FALSE;
        }
    }

    function load_all_requests(){
        $query = $this->db->query("SELECT a.*, b.employee_name, c.department_name, e.user_type as approval_role FROM tbl_requests a JOIN tbl_users b ON b.employee_id = a.employee_id JOIN tbl_departments c ON c.department_id = a.department_id JOIN tbl_approval_role e ON e.status_id = a.approval_role");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return false;
        }
    }

    function get_comments($request_id){
        $query = $this->db->query("SELECT * FROM tbl_comments WHERE request_id = '$request_id' ORDER BY comment_date ASC");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return FALSE;
        }
    }


    function submit_comment_approval($form_data){
        $approval_status = $form_data['approval_status'];
        $approval_role = $form_data['approval_role'];
        if(isset( $form_data['request_in_budget'])) {
            $is_in_budget = $form_data['request_in_budget'];
        }
        unset($form_data['request_in_budget']);
        unset($form_data['approval_role']);
        if(isset($form_data['procurement_amount'])){
        $procurement_amount = $form_data['procurement_amount'];
        unset($form_data['procurement_amount']);
        }
        $this->db->insert('tbl_comments', $form_data);
        $employee_name= $form_data['employee_name'];
        $request_id= $form_data['request_id'];

        if ($this->db->affected_rows() == '1'){
            $query_statement = "UPDATE tbl_requests SET approval_role = '$approval_role', approval_status = '$approval_status', approver = '$employee_name', ";
            if($approval_role == 2){
                $query_statement .= "request_in_budget = '$is_in_budget', ";
            }
            if(isset($procurement_amount)){
                $query_statement .= "procurement_amount = '$procurement_amount', ";
            }
            $query_statement .= "approve_date = NOW() WHERE req_id = '$request_id'";

            $query = $this->db->query($query_statement);

            if($query == TRUE){
                return TRUE;
            }
        }
        return FALSE;
    }

    function submit_add_new_product($form_data){
        $this->db->insert('tbl_products', $form_data);
        if ($this->db->affected_rows() == '1'){
            return true;
        }
    }

    function get_suppliers(){
        $query = $this->db->query("SELECT vendor_name FROM tbl_vendors");
        $result = $query->result_array();
            return $result;
    }

    function submit_emergency_request($form_data){
        //$employee_id = $new_form_data['employee_id'];
        // $amount = $new_form_data['amount'];
        $this->db->insert('tbl_emergency_requests', $form_data);

        if ($this->db->affected_rows() == '1')
        {
            return true;
        }
        return false;
    }

    function load_emergency_requests(){
        $query = $this->db->query("SELECT a.*, b.employee_name, c.department_name FROM tbl_emergency_requests a JOIN tbl_users b ON b.employee_id = a.employee_id JOIN tbl_departments c ON c.department_id = a.department_id");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return false;
        }
    }

    function get_emergency_request($emergency_id){
        $query = $this->db->query("SELECT a.*, b.employee_email FROM tbl_emergency_requests a JOIN tbl_users b ON b.employee_id = a.employee_id WHERE emergency_id = '$emergency_id'");
        return $query->result();
    }


    function submit_emergency_comment($form_data){
        $this->db->insert('tbl_emergency_comments', $form_data);
        if ($this->db->affected_rows() == '1'){
                return TRUE;
        }
        return FALSE;
    }

    function get_emergency_comments($emergency_id){
        $query = $this->db->query("SELECT * FROM tbl_emergency_comments WHERE emergency_id = '$emergency_id' ORDER BY comment_date ASC");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return FALSE;
        }
    }

    function budget(){
        $query = $this->db->query("SELECT supervisor_email FROM tbl_departments WHERE department_name = 'Budget Affirmation'");
        $result = $query->row();
        return $result;
    }

    function coo(){
        $query = $this->db->query("SELECT supervisor_email FROM tbl_departments WHERE department_name = 'COO Affirmation'");
        $result = $query->row();
        return $result;
    }

    function is_read($request_id, $employee_id){
        $query = $this->db->query("SELECT * FROM tbl_read WHERE req_id = '$request_id' AND employee_id = '$employee_id'");
        $result = $query->result();
        if(count($result) == 0){
            //var_dump(count($result));
            $input_data['req_id'] = $request_id;
            $input_data['employee_id'] = $employee_id;
            $input_data['is_read'] = 1;

            $this->db->insert('tbl_read', $input_data);

            if ($this->db->affected_rows() == '1'){
                return TRUE;
            }
            return FALSE;
        }
    }

    function check_read($employee_id){
        $query = $this->db->query("SELECT req_id FROM tbl_read WHERE employee_id = '$employee_id'");
        $result = $query->result_array();
        return $result;
    }

    function get_finance_approved_request(){
        $query = $this->db->query("SELECT r.*, d.department_name FROM tbl_requests r JOIN tbl_departments d ON d.department_id = r.department_id WHERE r.approval_status = 'approved' AND (r.approval_role = '3' OR r.approval_role = '4' )ORDER BY r.req_id DESC");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return FALSE;
        }
    }

    function get_approved_vendors_list(){
        $query = $this->db->query("SELECT vendor_name, vendor_email FROM tbl_vendors WHERE vendor_email != '' AND is_approved = '1'");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return FALSE;
        }
    }

    function get_vendors_list(){
        $query = $this->db->query("SELECT vendor_id, vendor_name, vendor_email, vendor_contact, vendor_service, is_approved FROM tbl_vendors WHERE vendor_email != ''");
        if ($query->num_rows() > 0){
            $my_results = $query->result_array();
            return $my_results;
        }else{
            return FALSE;
        }
    }


    function do_add_new_vendor($form_data){
        $this->db->insert('tbl_vendors', $form_data);

        if ($this->db->affected_rows() == '1')
        {
            return true;
        }
        return false;
    }

    function delete_vendor($vendor_id){
        $this->db->delete('tbl_vendors', array('vendor_id' => $vendor_id));
    }

    function toggle_vendor_approval($id, $is_approved){
        $this->db->query("UPDATE tbl_vendors SET is_approved = '$is_approved' WHERE vendor_id = '$id'");
        if ($this->db->affected_rows() == '1')
        {
            return true;
        }
        return false;

    }

    function get_vendor($vendor_id){
        $query = $this->db->query("SELECT * FROM tbl_vendors WHERE vendor_id = '$vendor_id'");
        $result = $query->row();
        return $result;
    }

    function get_proc_nos(){
        $query = $this->db->query("SELECT procurement_no, request_subject FROM tbl_requests WHERE approval_status = 'approved' AND approval_role = '5'");
        $results = $query->result_array();
        return $results;
    }

    function submit_quotation($form_data){
        $this->db->insert('tbl_quotations', $form_data);

        if ($this->db->affected_rows() == '1')
        {
            return true;
        }
        return false;
    }





    /*    function get_hod_list(){
            $this->db->select('supervisor_name, supervisor_email');
            $this->db->order_by("supervisor_name", "asc");
            $query = $this->db->get('tbl_supervisors');
            $results = $query->result_array();
            return $results;
        }*/
}