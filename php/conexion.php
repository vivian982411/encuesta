<?php

	class Conexion{
		private $con;
		function open(){
			$this->con = new mysqli("itzitacuaro.edu.mx","itzitacu_encuestaAdm","BwSEwtK0KP","itzitacu_encuesta");
			//$this->con = new mysqli("localhost","root","","encuestas");
			if (mysqli_connect_errno()) {
				exit();
			}
		}
		function select($q){
			$co = $this->con;
			$res = $co->query($q);
			return $res;
		}
		function insertRId($q){
			$co = $this->con;
			$co->query($q);
			return $co->insert_id;
		}
		function clearStoredResult(){
			$co = $this->con;
			while ($co->next_result()) {
				if ($_result = $co->store_result()) {
					$_result->free();
				}
			}
		}
	}
?>