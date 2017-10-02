<?php
 
class genpdf
{
  public function generate($html,$filename)
  {
	  
	  require_once 'assets/plugins/fpdf/fpdf.php';			
	  $pdf = new FPDF();
	  $pdf->AddPage($html);
	  $pdf->SetFont('Arial','B',16);
	  $pdf->Cell(40,10,'Hello World!');
	  $pdf->Output();
  }
}

?>