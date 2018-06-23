<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 18-Nov-17
 * Time: 10:20 PM
 * Project: procurement
 */

defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->load->view('login');

       // $submit = $this->input->post("loginSubmit");

    }

    public function verify_login(){
             //$form_data = $this->input->dump_post();
             //var_dump($form_data);
             //exit;

            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

            if($this->form_validation->run() == FALSE)
            {
                //Field validation failed.  User redirected to login page
                //echo "not working";
                redirect('login');
               // $this->load->view('login');
            }
            else{
                redirect(base_url(), 'location');
            }



        //var_dump($form_data);

    }

    function check_database($password){
        //Field validation succeeded.  Validate against database
        $email = $this->input->post('email');

        //query the database
        $result = $this->login_model->login($email, $password);

        if($result)
        {
            //$sess_array = array();
            foreach($result as $row => $value)
            {
                //var_dump($value);
                //exit;
                $this->session->set_userdata($row, $value);
                // $this->session->set_userdata('employee_role', $row->user_role);
            }
            if($this->session->userdata('is_password_changed') == 0){
                redirect(base_url('admin/profile/change_password'), 'location');
            }

            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return FALSE;
        }
    }


}