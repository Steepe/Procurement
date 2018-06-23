<?php

/**
 * Created by PhpStorm.
 * Author: Oluwamayowa Steepe
 * Date: 13-Jan-16
 * Time: 4:55 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'libraries/swift_mailer/lib/swift_required.php';

class MY_Controller extends CI_Controller
{

    //public $coo ='';
    public $budget ='';

    function __construct(){
        parent::__construct();
        $this->coo = $this->procurement_model->coo();
        $this->budget = $this->procurement_model->budget();
    }


    private $username = "oluwamayowa@creyatif.com";
    private $password = "Fyetampwa123";

    function sendSwiftMail($subject, $to, $data){
        $pos_x = strpos($to, ',');
        if($pos_x !== false){
            $to = explode(',', $to);
        }

        //Create the Transport
        $transport = Swift_SmtpTransport::newInstance('smtp.zoho.com', 465, 'ssl')
            ->setUsername($this->username)
            ->setPassword($this->password);

        /*
        You could alternatively use a different transport such as Sendmail or Mail:

        //Sendmail
        $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

        //Mail
        $transport = Swift_MailTransport::newInstance();
        */

        //Create the message
        $message = Swift_Message::newInstance();

        //Give the message a subject
        $message->setSubject($subject)
            ->setFrom(array('oluwamayowa@creyatif.com'=>'HOF Portal'))
            ->setTo($to)
            ->setReturnPath('oluwamayowa@creyatif.com')
            ->setBody("<p>".$data."</p><br><br>", 'text/html');

        //Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        //Send the message
        $result = $mailer->send($message);


        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function my_globals(){
        //$coo = $this->procurement_model->coo();
        //$budget = $this->procurement_model->budget();
    }

}