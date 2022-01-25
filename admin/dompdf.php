<?php 

// reference the Dompdf namespace
ob_start();
use Dompdf\Dompdf;

// include autoloader
require_once '../assets/vendor/dompdf/autoload.inc.php';
include "index.php";
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml(ob_get_clean());

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

 ?>


