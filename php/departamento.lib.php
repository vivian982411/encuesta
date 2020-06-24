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
		$excel= new ExcelWriter("reportes/ReporteGeneral.xls");
		if ($excel==false) {
		echo $excel->error;
		die;
		}
		$myArr= array("","",utf8_encode("Instituto Tecnológico de Zitácuaro"));
		$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"25px","font-weight"=>"bolder"));

		$myArr= array("","","Subdirección de Planeación");
		$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"20px","font-weight"=>"bolder"));

		$myArr= array("","","Reporte General de Evaluación Departamental");
		$excel->writeLine($myArr,array("text-align"=>"center",'font-size'=>"18px","font-weight"=>"bolder"));

 		while($id<8){
 			$nombre="";
	 		switch ($id) {
				case '1':
					$nombre="Centro De Informacion";
					break;
				case '2':
					$nombre="Coordinacion De Carreras";
					break;
				case '3':
					$nombre="Recursos Financieros";
					break;
				case '4':
					$nombre="Residencias Profesionales";
					break;
				case '5':
					$nombre="Centro De Computo";
					break;
				case '6':
					$nombre="Servicios Escolares";
					break;
				case '7':
					$nombre="Servicio Social";
					break;
				
			}
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
 	function generarXLS($id){
 		$nombre="";
 		switch ($id) {
			case '1':
				$nombre="Centro De Informacion";
				break;
			case '2':
				$nombre="Coordinacion De Carreras";
				break;
			case '3':
				$nombre="Recursos Financieros";
				break;
			case '4':
				$nombre="Residencias Profesionales";
				break;
			case '5':
				$nombre="Centro De Computo";
				break;
			case '6':
				$nombre="Servicios Escolares";
				break;
			case '7':
				$nombre="Servicio Social";
				break;
			
		}
 		$excel= new ExcelWriter("reportes/Reporte".str_replace(' ', '', $nombre).".xls");
			if ($excel==false) {
				echo $excel->error;
				die;
			}
			$cad="SELECT nom_dep as departamento, preguntadepartamento.num_predep as Nopregunta, pre_predep as pregunta,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='1' and num_predep=Nopregunta) as terrible,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='2' and num_predep=Nopregunta) as malo,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='3' and num_predep=Nopregunta) as regular,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='4' and num_predep=Nopregunta) as bueno,(SELECT COUNT(res_resenc) FROM respuestaencuesta WHERE res_resenc='5' and num_predep=Nopregunta) as excelente FROM departamento join preguntadepartamento on departamento.id_dep=preguntadepartamento.id_dep join respuestaencuesta on respuestaencuesta.num_predep=preguntadepartamento.num_predep WHERE departamento.id_dep='".$id."' GROUP BY respuestaencuesta.num_predep";
			$res= $this->select($cad);

			$myArr= array("","",utf8_encode("Instituto Tecnológico de Zitácuaro"));
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