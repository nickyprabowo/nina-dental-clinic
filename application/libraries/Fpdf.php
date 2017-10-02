<?php
 
class Genpdf
{
  public function generate($html,$filename)
  {
	  
	  require('fpdf.php');
	  require_once 'assets/plugins/fpdf/fpdf.php';			
	  $pdf = new FPDF();
	  $pdf->AddPage();
	  $pdf->SetFont('Arial','B',16);
	  $pdf->Cell(40,10,'Hello World!');
	  $pdf->Output();
  }
}

?>