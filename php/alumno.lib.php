<?php 
require_once 'conexion.php';
	/**
	 * 
	 */
	class Alumno extends Conexion
	{
		
		function __construct()
		{
			$this->open();
		}
		function getAlumno($nocontrol){
			$alumno="";
			$query = $this->select("SELECT nocontrol_alu,ap_alu,am_alu,nombre_alu FROM alumno WHERE nocontrol_alu='$nocontrol';");
			if ($query!="0") {
			while ($ren = $query->fetch_array()) {
				$alumno = $ren['nocontrol_alu']."|".$ren['nombre_alu']." ".$ren['ap_alu']." ".$ren['am_alu']."";
				return utf8_encode($alumno);
			}
			}else{
				return "error";
			}
		}
		function verificarEncuesta($nocontrol){
			$verificado="";
			$query = $this->select("SELECT nocontrol_alu FROM encuesta WHERE nocontrol_alu='$nocontrol';");
			$ren = $query->fetch_array();
			$verificado= $ren['nocontrol_alu'];
			return $verificado;
		}
		function verificarPeriodo(){
			$query = $this->select("SELECT * FROM periodo;");
			$ren = $query->fetch_array();
			$fecha_inicio = $ren['fechaini_per'];
			$fecha_fin =  $ren['fechafin_per'];
			$fecha = date("Y-m-d");
			if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {  
				return true;	   
			} else {
				return false;		   
			}
		}
	}
?>