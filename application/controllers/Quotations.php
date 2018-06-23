<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 20-Dec-17
 * Time: 9:43 PM
 * Project: procurement
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quotations extends MY_Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        if($this->session->userdata('employee_id') != null) {
            $data['finance_approved_requests'] = $this->procurement_model->get_finance_approved_request();
            $data['get_uploaded_quotes'] = $this->quotations_model->get_uploaded_quotes();
            $data['vendors_list'] = $this->procurement_model->get_approved_vendors_list();
                $this->load->view('rfqs', $data);
        }
        else{
            redirect(base_url('login'), 'Location');
        }
    }

    public function new_rfq(){
        if($this->session->userdata('employee_id') != null) {
            $data['finance_approved_requests'] = $this->procurement_model->get_finance_approved_request();
            $data['vendors_list'] = $this->procurement_model->get_approved_vendors_list();
            $this->load->view('new_rfq', $data);
        }
        else{
            redirect(base_url('login'), 'Location');
        }
    }

    public function upload(){
        if($this->session->userdata('employee_id') != null) {
            $data['finance_approved_requests'] = $this->procurement_model->get_finance_approved_request();
            $this->load->view('upload_quotation', $data);
        }
    else{
        redirect(base_url('login'), 'Location');
    }
}


    public function do_upload_quotation(){
        $form_data = $this->input->dump_post();

        $form_page = $form_data['form_page'];

        $uploader_count = $form_data['uploader_count'];
        // echo $uploader_count;
        if($uploader_count > 0){
            $all_uploaded_files = array();

            for($u=0; $u<$uploader_count; $u++){
                $status = "uploader_".$u."_status";
                // echo $status."<br>";
                if($form_data[$status] == 'done'){
                    $tmp_name = "uploader_".$u."_tmpname";
                    $uploaded_files['tmp_name'] = $form_data[$tmp_name];
                    //array_push($all_uploaded_files, $uploaded_files['tmp_name']);

                    $filename = "uploader_".$u."_name";
                    $uploaded_files['filename'] = $form_data[$filename];
                    // array_push($all_uploaded_files, $uploaded_files['filename']);

                    //var_dump($uploaded_files);
                    array_push($all_uploaded_files, $uploaded_files);
                    unset($form_data[$filename]);
                    unset($form_data[$tmp_name]);
                    unset($form_data[$status]);
                    //unset($form_data[$filename]);

                }
            }
            $form_data['uploaded_files'] = json_encode($all_uploaded_files);
            //var_dump($new_form_data['uploaded_files']);
          //  exit;

        }
        unset($form_data['uploader_count']);

        //var_dump($form_data);
        //exit;

        //var_dump($new_form_data);
        // exit;
        unset($form_data['form_page']);

        $result = $this->procurement_model->submit_quotation($form_data);
        if($result === true){
            //echo $result;
            redirect(base_url($form_page)."/success");
        }
        elseif($result === false){
            redirect(base_url($form_page)."/fail");
        }
    }

    public function view_quote($quote_id){
        if($this->session->userdata('employee_id') != null) {
        $data['finance_approved_requests'] = $this->procurement_model->get_finance_approved_request();
        $data['quotation'] = $this->quotations_model->get_quotation($quote_id);
        $this->load->view('view_quote', $data);
        }
        else{
            redirect(base_url('login'), 'Location');
        }
    }


}