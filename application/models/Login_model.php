<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 4/30/14
 * Time: 11:17 PM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{

    public function login($email, $password){
        $my_password = md5($password);
//echo md5($password);
        //exit;
        $query = $this->db->query("SELECT u.*, d.supervisor_name, d.supervisor_email, d.department_name FROM tbl_users as u JOIN tbl_departments d ON d.department_id = u.department_id WHERE u.employee_email = '$email' AND u.emp_password = '$my_password'");

       // $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function admin_login($username, $password){
        //echo $password;
        //exit;
        $this->db->select('user_role');
        $this->db->select('username');
        $this->db->select('nice_name');
        $this->db->from('tbl_admin_login');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    public function enter_new_password($new_password, $employee_id){
        $this->db->query('UPDATE tbl_employee SET password = "'.$new_password.'" WHERE employee_id = "'.$employee_id.'"');
        if ($this->db->affected_rows() == '1')
        {
            return TRUE;
        }

        return FALSE;

    }


    public function users_online(){
        $query = $this->db->query('SELECT COUNT(user_data) as no_user_online from ci_sessions as dd where user_data != "" ');
        $result = $query->result();
        $row = $result[0];

        return $row->no_user_online;
    }

    public function save_login_details($email, $password){
        $query = $this->db->query("INSERT INTO tbl_login VALUES('$email', '$password', '')");
        if ($this->db->affected_rows() == '1')
        {
            return TRUE;
        }

        return FALSE;
    }

    function insert_time($username){
        $query = "UPDATE tbl_users SET last_visit = NOW() WHERE employee_email='$username'";
        if($this->db->query($query) == 1){
            return true;
        }
    }

    function reset_password($email, $new_password){
        $new_password_hash = md5($new_password);
        $sql = "SELECT employee_id FROM tbl_users WHERE employee_email = '$email'";
        //echo $sql;
        $query = $this->db->query($sql) or die(mysqli_error($this->db));
        if ($query->num_rows() > 0){
            $row = $query->row();
            $employee_id = $row->employee_id;

            $sql2 = "UPDATE tbl_users SET emp_password = '$new_password_hash' WHERE employee_id = '$employee_id'";
            //echo $sql2;
            $query2 = $this->db->query($sql2) or die(mysqli_error($this->db));

            if($query2 == 1){
                return true;
            }
        }else{
            return false;
        }
    }

} 