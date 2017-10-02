<?php
 
class Dompdf
{
 
  public function generate($html,$filename)
  {
    // define('DOMPDF_ENABLE_AUTOLOAD', false);
    use Dompdf\Dompdf;
    require_once 'assets/plugins/dompdf/autoload.inc.php';			
	
  
	// echo $html;
	
	$dompdf = new Dompdf();
	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream($filename.'.pdf',array("Attachment"=>0));
  }
}