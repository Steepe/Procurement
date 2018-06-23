<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 16-Jan-18
 * Time: 11:44 PM
 * Project: procurement
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

//define('DOMPDF_ENABLE_AUTOLOAD', false);

require_once("./vendor/dompdf/dompdf/src/autoloader.php");
use Dompdf\Dompdf;

class Pdfgenerator{

    public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
    {
        $dompdf = new DOMPDF();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 1));
        } else {
            return $dompdf->output();
        }
    }
}