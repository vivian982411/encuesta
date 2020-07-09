<?php 
require_once "conexion.php";
require_once 'excelwriter.inc.php';
 /**
  * 
  */
 class Departamento extends Conexion
 {
 	
 	function __construct()
 	{
 		$this->open();
 	}
 	function nuevoDepartamento($nombre,$preguntas){
 		$iddep= $this->insertRId("INSERT INTO departamento VALUES(null,'$nombre');");
 		$pregs= explode("|",$preguntas);
 		for ($i=0; $i <sizeof($pregs)-1 ; $i++) { 
 			$insert= $this->insertRId("INSERT INTO preguntadepartamento VALUES(null,'$pregs[$i]','$iddep');");
 		}
 		return "ok";
 	}
 	function getDepartamentos(){
 		$cad= "";
 		$consul= $this->select("SELECT * FROM departamento");
 		while ($ren= $consul->fetch_array()) {
 			$cad.='<div class="btn btn-info m-1 animated bounceInDown" style="width:150px; height:60px;" onclick="javascript:mostrarVistaDepartamento(\''.$ren['id_dep'].'\',\'mostrardepartamento\',\''.ucwords($ren['nom_dep']).'\');">'.ucwords($ren['nom_dep']).'</div>';
 		}
 		return utf8_encode($cad);
 	}
 	function getDepartamentosReporte(){
 		$cad= "";
 		$consul= $this->select("SELECT * FROM departamento");
 		while ($ren= $consul->fetch_array()) {
 			$cad.=$ren['id_dep'].'|'.ucwords($ren['nom_dep']).';';
 		}
 		return $cad;
 	}
 	function getencuestaDepartamentos($id){
 		$consulta= $this->select("SELECT nom_dep as departamento, preguntadepartamento.num_predep as Nopregunta, pre_predep as pregunta,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='1' and num_predep=Nopregunta) as Terrible,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='2' and num_predep=Nopregunta) as malo,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='3' and num_predep=Nopregunta) as regular,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='4' and num_predep=Nopregunta) as bueno,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='5' and num_predep=Nopregunta) as excelente FROM departamento join preguntadepartamento on departamento.id_dep=preguntadepartamento.id_dep join respuestaencuesta on respuestaencuesta.num_predep=preguntadepartamento.num_predep WHERE departamento.id_dep='$id' GROUP BY respuestaencuesta.num_predep;");
 		$cad= "";
 		while ($fila= $consulta->fetch_array()) {
 			$cad.=$fila['Nopregunta']."|".$fila['pregunta']."|".$fila['Terrible']."|".$fila['malo']."|".$fila['regular']."|".$fila['bueno']."|".$fila['excelente'].";";
 		}
 		return utf8_encode($cad);
 	}
 	function guardarPregunta($id,$pregunta){
 		$consulta=$this->select("UPDATE preguntadepartamento set pre_predep='$pregunta' WHERE num_predep='$id';");
 		return "ok";
 	}
 	function guardarNuevaPregunta($id,$pregunta){
 		$consulta=$this->insertRId("INSERT INTO preguntadepartamento VALUES(null,'$pregunta','$id');");
 		return $consulta;
 	}
 	function getComentarios($dep){
 		$consulta=$this->select("SELECT * FROM comentariodepartamento WHERE id_dep='$dep'");
 		$cad="";
 		while ($fila= $consulta->fetch_array()) {
 			$cad.="".$fila['num_comdep']."|".$fila['id_dep']."|".$fila['id_enc']."|".$fila['com_comdep'].";";
 		}
 		return utf8_encode($cad);
 	}
 	 function generarXLSGeneral(){
 	 	$id=1;
 	 	$cont=0;
 		$consult= $this->select("SELECT count(id_dep) as cuantos FROM departamento");
 		$cuenta=$consult->fetch_array();
 		$numdeps=intval($cuenta['cuantos']);
 		$consult=$this->select("SELECT nom_dep from departamento");
 		while ($ren=$consult->fetch_array()) {
 			$nombres[$cont]=$ren['nom_dep']	;
 			$cont++;
 		}
		$excel= new ExcelWriter("reportes/ReporteGeneral.xls");
		if ($excel==false) {
		echo $excel->error;
		die;
		}
		$myArr= array("","","Instituto Tecnológico de Zitácuaro");
		$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"25px","font-weight"=>"bolder"));

		$myArr= array("","","Subdirección de Planeación");
		$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"20px","font-weight"=>"bolder"));

		$myArr= array("","","Reporte General de Evaluación Departamental");
		$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"18px","font-weight"=>"bolder"));

 		while($id<=$numdeps){
 			$nombre=$nombres[$id-1];
			$excel->writeRow();
			$excel->writeRow();
			$cad="SELECT nom_dep as departamento, preguntadepartamento.num_predep as Nopregunta, pre_predep as pregunta,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='1' and num_predep=Nopregunta) as terrible,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='2' and num_predep=Nopregunta) as malo,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='3' and num_predep=Nopregunta) as regular,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='4' and num_predep=Nopregunta) as bueno,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='5' and num_predep=Nopregunta) as excelente FROM departamento join preguntadepartamento on departamento.id_dep=preguntadepartamento.id_dep join respuestaencuesta on respuestaencuesta.num_predep=preguntadepartamento.num_predep WHERE departamento.id_dep='".$id."' GROUP BY respuestaencuesta.num_predep";
			$res= $this->select($cad);

			
			$myArr= array("","","Departamento: ".$nombre);
			$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"15px","font-weight"=>"bolder"));
			$excel->writeRow();
			$excel->writeRow();
			$myArr= array("","No,","Pregunta","Terrible","Mala","Regular","Buena","Excelente");
			$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"14px","font-weight"=>"bolder"));

			$cont=1;
			while ($ren=$res->fetch_array(MYSQLI_ASSOC)) {
				$excel->writeRow();
				$excel->writeCol("");
				$excel->writeCol($cont, array("text-align"=>"center"));
				$excel->writeCol(utf8_encode($ren['pregunta']), array("text-align"=>"left"));
				$excel->writeCol(utf8_encode($ren['terrible']), array("text-align"=>"center"));
				$excel->writeCol(utf8_encode($ren['malo']), array("text-align"=>"center"));
				$excel->writeCol(utf8_encode($ren['regular']), array("text-align"=>"center"));
				$excel->writeCol(utf8_encode($ren['bueno']), array("text-align"=>"center"));
				$excel->writeCol(utf8_encode($ren['excelente']), array("text-align"=>"center"));
				$cont++;
			}
			
			$id++;
 		}
 		$excel->close();
 	}
 	function generarXLS($id,$nombre){
 		$excel= new ExcelWriter("reportes/Reporte".$nombre.".xls");
			if ($excel==false) {
				echo $excel->error;
				die;
			}
			$cad="SELECT nom_dep as departamento, preguntadepartamento.num_predep as Nopregunta, pre_predep as pregunta,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='1' and num_predep=Nopregunta) as terrible,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='2' and num_predep=Nopregunta) as malo,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='3' and num_predep=Nopregunta) as regular,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='4' and num_predep=Nopregunta) as bueno,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='5' and num_predep=Nopregunta) as excelente FROM departamento join preguntadepartamento on departamento.id_dep=preguntadepartamento.id_dep join respuestaencuesta on respuestaencuesta.num_predep=preguntadepartamento.num_predep WHERE departamento.id_dep='".$id."' GROUP BY respuestaencuesta.num_predep";
			$res= $this->select($cad);

			$myArr= array("","","Instituto Tecnológico de Zitácuaro");
			$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"25px","font-weight"=>"bolder"));

			$myArr= array("","","Subdirección de Planeación");
			$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"20px","font-weight"=>"bolder"));

			$myArr= array("","","Reporte de Evaluación Departamental");
			$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"20px","font-weight"=>"bolder"));


			$myArr= array("","","Departamento: ".$nombre);
			$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"15px","font-weight"=>"bolder"));
			$excel->writeRow();
			$excel->writeRow();
			$myArr= array("","No,","Pregunta","Terrible","Mala","Regular","Buena","Excelente");
			$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"14px","font-weight"=>"bolder"));

			$cont=1;
			while ($ren=$res->fetch_array(MYSQLI_ASSOC)) {
				$excel->writeRow();
				$excel->writeCol("");
				$excel->writeCol($cont, array("text-align"=>"center"));
				$excel->writeCol(utf8_encode($ren['pregunta']), array("text-align"=>"left"));
				$excel->writeCol(utf8_encode($ren['terrible']), array("text-align"=>"center"));
				$excel->writeCol(utf8_encode($ren['malo']), array("text-align"=>"center"));
				$excel->writeCol(utf8_encode($ren['regular']), array("text-align"=>"center"));
				$excel->writeCol(utf8_encode($ren['bueno']), array("text-align"=>"center"));
				$excel->writeCol(utf8_encode($ren['excelente']), array("text-align"=>"center"));
				$cont++;
			}
			$excel->close();
			echo "ok";
 	}
 }
?>