<?php
session_start();
require_once 'encuesta.lib.php';
require_once 'alumno.lib.php';
require_once 'administrador.lib.php';
require_once 'departamento.lib.php';
	switch ($_POST["opc"]) {
		case 'encuesta':
			$enc = new Encuesta();
			switch ($_POST["acc"]) {
				case 'buscarDepartamento':
					$var= $enc->getDepartamento($_POST['idDep']);
					$info=explode("|",$var);
					echo $var."---";
					echo $preguntas=$enc->getPreguntas($info[0]);
					break;
				case 'obtenerPreguntas':
					echo $preguntas=$enc->getPreguntas($_POST['id']);
					break;
				case 'guardar':
					$encuesta = $enc->guardarEncuesta($_POST['preguntas'],$_POST['respuestas'],$_POST['comentarios'],$_SESSION['alumno']['nocontrol']);
	if ($encuesta=="ok") {
					echo "<div class='row m-5' style='background-color:rgba(255,255,255,0.8);'>
								<div class='col-md-1'></div>
								<div class='col-md-10'>
									<label class='display-4 text-dark m-5'>@".$_SESSION['alumno']['nombre']."</label><br>
									<label class='h1 text-success'>Gracias por tu tiempo.</label>
									<div class='row'>
										<div class='col-md-3'></div>
										<div class='col-md-6'>
											<input type='button' class='btn btn-success form-control' onclick='cerrar();' value='Cerrar Sesion'>
										</div>
										<div class='col-md-3'></div>
									</div>
								</div>
								<div class='col-md-1'></div>
							</div>";
				}else{
					echo "error";
				}
				break;
		}
		break;
	case 'alumno':
		switch ($_POST['acc']) {
			case 'login':
				$alu = new Alumno();
				if($alu->verificarPeriodo()){
					$verificacion=$alu->verificarEncuesta($_POST['nocontrol']);
					if($verificacion == $_POST['nocontrol']){
						echo "verificado"; 
					}else{
						$alumno = $alu->getAlumno($_POST['nocontrol']);
						if ($alumno=="error") {
							echo "error";
						}else{
						$datos = explode("|",$alumno);
						$nombre = $datos[1];
						$nocontrol = $datos[0];
						if ($nocontrol == $_POST['nocontrol']) {
							$_SESSION["alumno"]["nocontrol"] = $nocontrol;
							$_SESSION["alumno"]["nombre"] = $nombre;
							echo "ok";
						}else{
							echo "error";
						}
						}
					}
				}else{
					echo "periodo";
				}
				break;
			case 'logout':
				session_destroy();
				echo "ok";
				break;
		}
		break;
	case 'admin':
		$admin=new Administrador();
		switch ($_POST['acc']) {
			case 'login':
			$verificacion=$admin->getAdmin($_POST['usuario'],$_POST['password']);
			if ($verificacion!="error") {
				$datos = explode("|",$verificacion);
				$nombre = $datos[1];
				
				$id = $datos[0];
				$_SESSION["admin"]["nombre"] = $nombre;
				$_SESSION["admin"]["id"] = $id;
				echo "ok";
			}else{
				echo "error";
			}
				break;
			case 'logout':
				session_destroy();
				echo "ok";
				break;
			case 'alumnos':
				$contenido='Solicitudes';
				echo $contenido;
				break;
			case 'configurarPeriodo':
				echo $admin->configurarPeriodo($_POST['fechai'],$_POST['fechaf']);
				break;
		}
		break;
	case 'departamentos':
		switch ($_POST['acc']) {
			case 'mostrardepartamento':
				$dep = new Departamento();
				echo $dep->getencuestaDepartamentos($_POST['id'])."---";
				echo  $dep->getComentarios($_POST['id']);
				break;
			case 'guardarPregunta':
				$dep = new Departamento();
				$dep->guardarPregunta($_POST['id'],$_POST['pregunta']);
				break;
			case 'showdepartamentosreporte':
				$dep= new Departamento();
				echo $dep->getDepartamentosReporte();
				break;
			case 'generarXLS':
				$dep = new Departamento();
				if ($_POST['dep']=='general') {
					echo $dep->generarXLSGeneral();
				}else{
					echo $dep->generarXLS($_POST['dep'],$_POST['nombredep']);
				}
				break;
			case 'nuevaPregunta':
				$dep = new Departamento();
				$id= $dep->guardarNuevaPregunta($_POST['iddep'],$_POST['pregunta']);
				if ($id>0) {
					echo "ok";
				}else{
					echo "error";
				}
				break;
			case 'nuevoDepartamento':
				$dep= new Departamento();
				echo $dep->nuevoDepartamento($_POST['nombredep'],$_POST['preguntas']);
				break;
		}
		break;
	}
?>