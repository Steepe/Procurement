<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 16-Jan-18
 * Time: 10:59 PM
 * Project: procurement
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'third_party/dompdf/src/Autoloader.php');


class Createpdf extends CI_Controller{

    public function __construct(){
        parent::__construct();
    }

    function create_pdf($htmlcontent, $for_upload=false, $new_file=null){

    }

}