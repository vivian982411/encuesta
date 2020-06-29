<?php
require_once "conexion.php";
	class Encuesta extends Conexion{
		
		function __construct(){
			$this->open();
		}
		function getDepartamento($id){
			//echo $id;
			$con = $this->select("SELECT count(id_dep) as cuenta FROM departamento");
			$ren = $con->fetch_array();
			$cuenta=$ren['cuenta'];
			if ($cuenta>=$id) {
				$con = $this->select("SELECT * FROM departamento");
				$contador=0;
				$info="";
				while ($contador<$id) {
					//echo $contador;
					$ren = $con->fetch_array();
					$info=$ren['id_dep']."|".$ren['nom_dep'];
					$contador++;
				}
				return utf8_encode($info."|".$cuenta);
			}else{
				return 'error';
			}

		}
		function getPreguntas($id){
			$preguntas="";
			$con = $this->select("SELECT * FROM departamento join preguntadepartamento on departamento.id_dep=preguntadepartamento.id_dep where preguntadepartamento.id_dep='$id'");
			while ($ren = $con->fetch_array()) {
				$preguntas.=$ren['num_predep']."|".$ren['pre_predep'].";";
			}
			return utf8_encode($preguntas);
		}
		function guardarEncuesta($preguntas,$respuestas,$comentarios,$nocontrol){
			$estatus= $this->select("UPDATE alumno set estatus_enc='1' WHERE nocontrol_alu='$nocontrol';");
			$q="INSERT INTO encuesta VALUES(NULL,'$nocontrol');";
			//echo $q;
			$idenc = $this->insertRId($q);
			//$predep=1;
			$resp = explode(";",$respuestas);
			$preg = explode(";",$preguntas);
			for ($i=0; $i <= sizeof($resp)-1 ; $i++){ 
				$respuesta = explode("|",$resp[$i]);
				$pregunta = explode("|",$preg[$i]);
				for ($j=0; $j <sizeof($respuesta)-1; $j++){ 
					$cad="INSERT INTO respuestaencuesta VALUES(null,'$pregunta[$j]','$respuesta[$j]','$idenc');";
					//echo $cad;
					$respenc = $this->insertRId($cad);
					//$predep++;
				}
			}
			$coments = explode(";",$comentarios);
			for ($k=0; $k <sizeof($coments)-1 ; $k++) {
				if ($coments[$k]=="") {
				}else{
					$comdep=$this->insertRId("INSERT INTO comentariodepartamento VALUES(null,'".($k+1)."','$idenc','$coments[$k]');");
				}
			}
			if ($idenc>0) {
				return "ok";
			}else{
				return "error";
			}
		}
		function getPorcentajeEncuestas(){
			$query= $this->select("SELECT count(nocontrol_alu)as cuantos from encuesta;");
			$query2= $this->select("SELECT count(nocontrol_alu)as cuantos from alumno;");
			$ren= $query->fetch_array();
			$ren2= $query2->fetch_array();
			$encuestas = $ren['cuantos'];
			$alumnos= "".intval($ren2['cuantos'])-intval($ren['cuantos']);
			return "".$encuestas."|||".$alumnos; 
		}
		function estadoEncuestaAlumno(){
			$cad="";
			$query= $this->select("SELECT * FROM alumno order by id_alu asc;");
			while ($ren = $query->fetch_array()) {
				$cad.="<tr><td>".$ren['nocontrol_alu']."</td>";
				$cad.="<td>".$ren['nombre_alu']." ".$ren['ap_alu']." ".$ren['am_alu']."</td>";
				$cad.="<td>".$ren['carrera_alu']."</td>";
				$cad.="<td>".$ren['semestre_alu']."</td>";
				if ($ren['estatus_enc']==1) {
					$cad.="<td class='bg-success' style='border-radius:10px;'></td></tr>";
				}else{
					$cad.="<td class='bg-danger' style='border-radius:10px;'></td></tr>";
				}
			}

		return utf8_encode($cad);
		}
	}
?>