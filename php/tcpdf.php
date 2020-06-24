<?php

require_once('tcpdf/tcpdf.php');
require_once ('departamento.lib.php');
$nombre="";
switch ($_GET['id']) {
	case '1':
		$nombre="Centro de Información";
		break;
	case '2':
		$nombre="Coordinación de Carreras";
		break;
	case '3':
		$nombre="Recursos Financieros";
		break;
	case '4':
		$nombre="Residencias Profesionales";
		break;
	case '5':
		$nombre="Centro de Cómputo";
		break;
	case '6':
		$nombre="Servicios Escolares";
		break;
	case '7':
		$nombre="Servicio Social";
		break;
	
}

$dep = new Departamento();

// create new PDF document
class EDITPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
    	$origen = "../img/petirrojos.jpg";
		$destino = '../img/';
		copy($origen, $destino."logo.jpg");
        $image_file = '../img/logo.jpg';
        $this->SetFont('helvetica', 'B', 18);
        $head='<table>
        	   		<tr>
        	   			<td width="70"><img src="'.$image_file.'" width="50" height="50"></td>
        	   			<td width="570" align="center"><h2  align="center">Instituto Tecnológico de Zitácuaro</h2></td>
        	   		</tr>
        	   		<tr>
        	   			<td width="70"></td>
        	   			<td align="center"><h5 align="center">Subdirección de Planeación</h5></td>
        	   		</tr>
        	   		<tr>
        	   			<td width="70"></td>
        	   			<td align="center"><h4  align="center">Evaluación departamental [periodo]</h4></td>
        	   		</tr>
        	   	</table>';
        $this->writeHTML($head);
        // Title
        /*$this->SetXY(0, 15);
        $this->Cell(0, 15, 'Instituto Tecnológico de Zitácuaro', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetXY(0, 25);
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 15, 'Subdirección de Planeación', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetXY(0, 35);
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 15, 'Evaluación departamental [periodo]', 0, false, 'C', 0, '', 0, false, 'M', 'M');*/
        
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
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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
$pdf->Output('ComentariosDepartamento.pdf', 'I');

?>

