<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 11-Jan-18
 * Time: 3:22 PM
 * Project: procurement
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_orders extends CI_Controller{

    public function __construct(){
        parent::__construct();
    }


    public function index($args = ""){
        if($this->session->userdata('employee_id') != null) {
            if ($args == "new") {
                //echo "new";
                $data['po_vendors'] = $this->po_model->get_po_vendors();
                $this->load->view('new_purchase_order', $data);
                //exit;
            } else {
                $this->load->view('purchase_orders');
            }
        }
        else{
            redirect(base_url('login'), 'Location');
        }


    }

    public function new_(){
        if($this->session->userdata('employee_id') != null) {
            $data['po_vendors'] = $this->po_model->get_po_vendors();
            $this->load->view('new_purchase_order', $data);
        }
        else{
            redirect(base_url('login'), 'Location');
        }
    }

    public function submit_purchase_order(){
        //echo "test";
        $form_data = $this->input->dump_post();
        $form_page = $form_data['form_page'];
        //var_dump($form_data);

       // exit;
        $item_counter = $form_data['item_counter'];
        $items_array = array();
        for($i=1; $i<=$item_counter; $i++){
            $x = $i-1;
            $item['description'] = $form_data['description_' . $i];
            $item['quantity'] = $form_data['quantity_' . $i];
            $item['unit_price'] = $form_data['unit_price_' . $i];
            $item['total'] = $form_data['total_' . $i];

            array_push($items_array, $item);
            //var_dump($item);
        }
        //$a= json_encode($items_array);
        $new_form_data['items'] = json_encode($items_array);
        $new_form_data['supplier'] = $form_data['supplier'];
        $new_form_data['payment_method'] = $form_data['payment_method'];
        $new_form_data['notes'] = $form_data['notes'];
        $new_form_data['created_by'] = $form_data['created_by'];
        //var_dump($a);

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
            $new_form_data['uploaded_files'] = json_encode($all_uploaded_files);
        }
        unset($form_data['uploader_count']);


        unset($form_data['supplier']);
        unset($form_data['payment_method']);
        unset($form_data['notes']);
        unset($form_data['created_by']);

        //var_dump($new_form_data);

        $data['all_data'] = $new_form_data;


        $result = $this->po_model->submit_purchase_order($new_form_data);
       if($result === true){
           $data['vendor_details'] = $this->vendor_model->get_vendor_address($new_form_data['supplier']);
           //$this->load->view('purchase_order', $data);

           $this->load->library('pdfgenerator');
           $html = $this->load->view('purchase_order', $data, true);
           $filename = 'report_'.time();
           $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');

           //redirect(base_url($form_page)."/success");
       }
       elseif($result === false){
           redirect(base_url($form_page)."/fail");
       }
    }

    //public function



}