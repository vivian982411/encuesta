<?php 
require_once 'conexion.php';
	/**
	 * 
	 */
	class Administrador extends Conexion
	{
		
		function __construct()
		{
			$this->open();
		}
		function getAdmin($usuario,$pass){
			$adm="error";
			$query = $this->select("SELECT * FROM administrador WHERE usuario_adm='$usuario' AND pass_adm='$pass';");
			while ($ren = $query->fetch_array()) {
				$adm = $ren['id_adm']."|".$ren['nombre_adm']."|".$ren['usuario_adm']."|".$ren['pass_adm']."";
			}
			return utf8_encode($adm);
		}
	}
?>