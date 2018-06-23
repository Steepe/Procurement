<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 9/9/14
 * Time: 8:49 AM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
    public function __construct(){
        parent::__construct();
    }


    public  function index(){
        //echo '<pre>';
        //var_dump($this->session->all_userdata());
        //echo '</pre class ="xdebug-var-dump">';
        //$users_online = $this->home_model->get_users_online();
       // $data['users_online'] = $users_online;
        if($this->session->userdata('employee_id') != null){
            $this->load->view("dashboard");
        }else{
            redirect(base_url('login'), 'Location');
        }
    }


    public function logout(){
       $set_logout_time = $this->login_model->insert_time($this->session->userdata('employee_email'));

        if($set_logout_time == true){
        $this->session->sess_destroy();
        redirect(base_url(''), 'Location');
        }
    }

    public function request($request_type, $success=""){
        if($this->session->userdata('employee_id') != null) {
            $data['last_id'] = $this->procurement_model->get_last_id();
            if($success != ""){
                $data['success'] = $success;
            }

            $view = $request_type . '_form';
            $this->load->view($view, $data);
        }
        else{
            redirect(base_url('login'), 'Location');
        }
    }

    public function do_submit_request(){
        $form_data = $this->input->dump_post();
        //var_dump($form_data);

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
            $new_form_data['uploaded_files'] = json_encode($all_uploaded_files);
        }
        unset($form_data['uploader_count']);



        $new_form_data['date'] = date("Y-m-d H:i:s");
        $new_form_data['procurement_no'] = $form_data['procurement_no'];
        $new_form_data['employee_id'] = $form_data['employee_id'];
        $new_form_data['requested_by'] = $form_data['requested_by'];
        $new_form_data['department_id'] = $form_data['department_id'];
        $new_form_data['amount'] = str_ireplace(',', '', $form_data['amount'] );
        $new_form_data['approval_role'] = $this->session->userdata('user_role');
        $new_form_data['approver'] = $this->session->userdata('employee_name');
        $new_form_data['request_subject'] = $form_data['request_subject'];
        $new_form_data['request_type'] = $form_data['request_type'];



        unset($form_data['procurement_no']);
        unset($form_data['employee_id']);
        unset($form_data['requested_by']);
        unset($form_data['department_id']);
        unset($form_data['amount']);
        unset($form_data['request_subject']);
        unset($form_data['form_page']);

        $new_form_data['details'] = json_encode($form_data);
        //var_dump($new_form_data);
        // exit;
        $result = $this->procurement_model->submit_request($new_form_data);
        if($result === true){
            //echo $result;


            $body = "Hello ".$this->session->userdata('supervisor_name'). ",<br>A procurement request has just been submitted for your attention. <a href='http://www.thispresenthouse.org/procurement'>Click Here</a> to view your request inbox.";

            $subject = "New procurement request from ".$this->session->userdata('employee_name');

            $superv_email = $this->session->userdata('supervisor_email');


            $message_result = $this->sendSwiftMail($subject, $superv_email, $body);

            //var_dump($message_result);
            //exit;

/*            if($message_result == true){
                $data['result'] = $result;
                $this->load->view('admin/forgot_password_success', $data);
            }*/


            redirect(base_url($form_page)."/success");
        }
        elseif($result === false){
            redirect(base_url($form_page)."/fail");
        }
    }

    public function request_list(){
        $employee_id = $this->session->userdata('employee_id');
        $user_role =  $this->session->userdata('user_role');
        $department_id =  $this->session->userdata('department_id');
        if($this->session->userdata('employee_id') != null){

            $data['users_online'] = $this->procurement_model->get_users_online();
            $data['read'] = $this->procurement_model->check_read($employee_id);

            if($user_role == 1){
                $data['lists'] = $this->procurement_model->load_requests_1($employee_id);
                $this->load->view('request_inbox', $data);
            }
            elseif($user_role == 2){
                $data['lists'] = $this->procurement_model->load_requests_2($department_id);
                $this->load->view('request_inbox', $data);
            }
            elseif($user_role == 3){
                $data['lists'] = $this->procurement_model->load_requests_3();
                $this->load->view('request_inbox', $data);
            }
            elseif($user_role == 4){
                $data['lists'] = $this->procurement_model->load_requests_4();
                $this->load->view('request_inbox', $data);
            }
            elseif($user_role == 5){
                $data['lists'] = $this->procurement_model->load_requests_5();
                $this->load->view('request_inbox', $data);
            }
            elseif($user_role == 6){
                $data['lists'] = $this->procurement_model->load_requests_6();
                $this->load->view('request_inbox', $data);
            }
        }else{
            $this->session->set_userdata('last_page', uri_string());
            redirect(base_url('login'), 'Location');
        }

    }


    public function inbox($request_id, $success=""){
        if($this->session->userdata('employee_id') != null){
            $this->procurement_model->is_read($request_id, $this->session->userdata('employee_id'));
            $request = $this->procurement_model->get_request($request_id);
            $request_comments = $this->procurement_model->get_comments($request_id);
            //$approval_status = $this->procurement_model->get_approval_status($request_id);
            // $data['users_online'] = $this->home_model->get_users_online();
            $data['request'] = $request;
            $data['comments'] = $request_comments;
            //$data['approval_status'] = $approval_status;
            if($success != ""){
                $data['success'] = $success;
            }
            //var_dump($data['comments']);
            //exit;
            $this->load->view('view_request', $data);
        }else{
            redirect(base_url('login'), 'Location');
        }
    }

    public function do_request_comment(){
        $form_data = $this->input->dump_post();
        $form_data['comment_date'] = date("Y-m-d H:i:s");
        //$my_mail =$this->session->userdata('employee_email');
        $employee_email = $form_data['employee_email'];
        $amount = $form_data['amount'];
        $approval_status = $form_data['approval_status'];
        $last_page = $form_data['last_page'];
        unset($form_data['employee_email']);
        unset($form_data['amount']);
        unset($form_data['last_page']);
        $result = $this->procurement_model->submit_comment_approval($form_data);
        if($result === true){

            $message = "Hello,<br>A procurement request has just been submitted for your attention. <a href='http://www.thispresenthouse.org/procurement'>Click Here</a> to view your request inbox.";
            //$copy = $my_mail;
            $subject = "New request for approval";

            if($approval_status == "approved"){
                if($this->session->userdata('user_role') == 2){

                    $this->sendSwiftMail($subject, $this->budget->supervisor_email, $message);
                }
                if($amount < 250000.00 && $this->session->userdata('user_role') == 3){
                    $this->sendSwiftMail($subject, 'procurement@thispresenthouse.org', $message);
                }
                if($amount >= 250000.00 && $this->session->userdata('user_role') == 3){
                    $this->sendSwiftMail($subject, $this->coo->supervisor_email, $message);

                }
                // echo "You have approved this request successfully! ";
                redirect(base_url($last_page)."/".$approval_status);
            }
            elseif($approval_status == "disapproved"){
                $subject = "Request has been disapproved";
                $message = "Hello,<br>A request has just been disapproved. <a href='http://www.thispresenthouse.org/procurement'>Click Here</a> to view this request.";
                $this->sendSwiftMail($subject, $employee_email, $message);
                //echo "You have disapproved this request successfully!";
                redirect(base_url($last_page)."/".$approval_status);
            }
        }
        else{
            //echo "Your comment and approval/disapproval could not be submitted at this time. Please try again later.";
            redirect(base_url($last_page)."/fail");
        }
    }


    public function get_procurement_approved_request(){
        $data['lists'] = $this->procurement_model->get_vendors_list();
        $this->load->view('request_inbox', $data);
    }

    public function do_send_message(){
        $form_data = $this->input->dump_post();

        unset($form_data['last_page']);
        unset($form_data['email_cc']);

        //var_dump($form_data);
        //exit;

        $subject = $form_data['subject'];
        $email = $form_data['email_to'];
        $body = $form_data['body'];

        //$insert_id = $this->message_model->do_send_message($form_data);
        //if($insert_id !== false){
            // $this->sendSwiftMail($subject, $email, '', $body);
          $this->sendSwiftMail($subject, $email, $body);

            //echo $message_result;
            //$this->message_model->update_message_success($insert_id, $message_result);
            redirect(base_url('quotations/new'));
       // }

    }

    public function add_new_vendor(){
        if($this->session->userdata('employee_id') != null) {
            $this->load->view('add_vendor');
        }
        else{
            redirect(base_url('login'), 'Location');
        }
    }

    public function do_add_new_vendor(){
        $form_data = $this->input->dump_post();
        //var_dump($form_data);
        $this->procurement_model->do_add_new_vendor($form_data);
    }

    public function get_vendors(){
        $data['vendors'] = $this->procurement_model->get_vendors_list();
        $this->load->view('list_vendors', $data);
    }

    public function delete_vendor($vendor_id){
        //var_dump($admin_id);
        $this->procurement_model->delete_vendor($vendor_id);
    }

    public function toggle_vendor_approval(){
        $form_data = $this->input->dump_post();
        //var_dump($form_data);

        $id = $form_data['id'];
        $status = $form_data['status'];

        if($status == '1'){
            $is_approved = 0;
        }
        elseif ($status == '0'){
            $is_approved = 1;
        }

        //exit;
        $this->procurement_model->toggle_vendor_approval($id, $is_approved);
    }

    public function load_vendor_details($vendor_id){
        $data['vendor_details'] = $this->procurement_model->get_vendor($vendor_id);
        $this->load->view('vendor_details', $data);
    }



}

