<?php

require_once('tcpdf/tcpdf.php');
require_once ('departamento.lib.php');
require_once('encuesta.lib.php');
$nombre=$_GET['nombre'];
$dep = new Departamento();

// create new PDF document
class EDITPDF extends TCPDF {

    //Page header
    public function Header() {
		// Logo
		$encuesta=new Encuesta();
		$fecha=explode("|",$encuesta->getPeriodo());
		$fechai=date_format(new DateTime($fecha[0]), 'd/m/Y');
		$fechaf=date_format(new DateTime($fecha[1]), 'd/m/Y');
		$origen1 = "../img/logoTec.jpg";
		$origen2 = "../img/SEP.jpg";
		$destino = '../img/';
		copy($origen1, $destino."logo1.jpg");
		copy($origen2, $destino."logo2.jpg");
		$image_file1 = '../img/logo1.jpg';
		$image_file2 = '../img/logo2.jpg';
        $this->SetFont('helvetica', 'B', 18);
        $head='<table>
        	   		<tr>
        	   			<td width="120"><img src="'.$image_file2.'" width="110" height="50"></td>
						<td width="450" align="center"><h2  align="center">Instituto Tecnológico de Zitácuaro</h2></td>
						<td width="70"><img src="'.$image_file1.'" width="50" height="50"></td>
        	   		</tr>
        	   		<tr>
        	   			<td width="70"></td>
						<td align="center"><h5 align="center">Subdirección de Planeación</h5></td>
						<td width="70"></td>
        	   		</tr>
        	   		<tr>
        	   			<td width="70"></td>
						<td align="center"><h4  align="center">Evaluación departamental del '.$fechai.' al '.$fechaf.'</h4></td>
						<td width="70"></td>
        	   		</tr>
        	   	</table>';
        $this->writeHTML($head);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new EDITPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Subdirección de Planeación ITZ');
$pdf->SetTitle('Comentarios Depto. '.$nombre);
$pdf->SetSubject('Comentarios emitidos en la evaluación departamental: '.$nombre);
$pdf->SetKeywords('comentarios, PDF, evaluacion, departamental, departamento');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setFontSubsetting(true);

$pdf->SetFont('times', 'B', 16, '', true);

$pdf->AddPage();
$pdf->SetXY(0, 45);
$comentarios=$dep->getComentarios($_GET['id']);
$comentario=explode(";",$comentarios);

$pdf->SetFont('times', '', 14, '', true);

$html='
	<h1 align="center" >Departamento Evaluado: '.$nombre.'</h1>
	<br><br>
	<table border="1">
		<thead>
			<tr rowspan="2">
				<td align="center"  style="background-color:#E0E0E0;width: 100px;">No. Folio</td>
				<td align="center"  style="background-color:#E0E0E0;width: 550px;">Comentario</td>
			</tr>
		</thead>
		<tbody>';
foreach ($comentario as $com) {
    	if (strlen(trim($com))>1) {
    		$dato=explode("|",$com);
    		$html.='			<tr>
				<td align="center" style="width: 100px;">'.$dato[0].'</td>
				<td align="justify" style="width: 550px;">'.$dato[3].'</td>
			</tr>';
	        //var_dump($dato);
    	}
    }

$html.='		</tbody>
	</table>';
$pdf->writeHTML($html);
$pdf->Output('Comentarios_Departamento_'.$nombre.'.pdf', 'I');

?>

