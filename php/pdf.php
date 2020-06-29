<?php
	include_once 'fpdf/fpdf.php';
	include 'departamento.lib.php';
	class PDF extends FPDF{
        function Header(){
            //$this->Image('C:/AppServ/www/tienda/images/logo2.jpg',35,15,20);
            $this->SetFont('Arial','B','16');
            $this->Cell(80);
            $this->Cell(30,10,utf8_decode('Instituto Tecnológico de Zitácuaro'),0,1,'C');
            $this->Cell(0,30,utf8_decode('Comentarios de la Evaluación Departamental'),0,0,'C');
            $this->Ln(20);
        }
        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }
    $pdf=new PDF();
    $dep = new Departamento();

    $comentarios=$dep->getComentarios($_GET['id']);
    $comentario=explode(";",$comentarios);

    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->SetFillColor(232,232,232);
    $pdf->Ln(10);
    $pdf->Cell(30,6,"Folio",1,0,'C',1);
    $pdf->Cell(150,6,"Comentario",1,0,'C',1);
    $pdf->Ln(10);
    foreach ($comentario as $com) {
    	if (strlen(trim($com))>1) {
    		$dato=explode("|",$com);
	    	$pdf->Cell(30,25,utf8_decode($dato[0]),1,0,'C',0);
	        $pdf->Cell(150,25,utf8_decode($dato[3]),1,0,'C',0);
	        $pdf->Ln(25);
	        //var_dump($dato);
    	}
    }
    $pdf->Output();
?>