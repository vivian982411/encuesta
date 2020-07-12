<?php
session_start();
require_once("encuesta.lib.php");
require_once ("departamento.lib.php");
	switch ($_POST['opc']) {
		case 'encuesta':
			switch ($_POST["acc"]) {
				case 'inicial':
					echo '<div class="card m-5 animated bounceInDown" style="background-color:rgba(255,255,255,0.8); ">
						<form id="form-pregunta" action="javascript:verificarPregunta();">
							<div class="row my-5">
								<div class="col-12 m-5">
									<h1>Estoy cursando:</h1>
									<br><br>
									<input type="radio" required id="pregunta1" name="pregunta" value="0"> 
									<label class="h4" for="pregunta1">Servicio Social</label>
									<br>
									<input type="radio" required id="pregunta2" name="pregunta" value="1"> 
									<label class="h4" for="pregunta2">Residencias</label>
									<br>
									<input type="radio" required name="pregunta" id="pregunta3" value="2">
									<label class="h4" for="pregunta3">Ninguna de las anteriores</label>
									<br><br>
									<input type="submit" class="btn btn-primary" id="btniniciarEncuesta2" value="Siguiente">
								</div>
							</div>
						</form>	
					</div>';
				break;
				case 'instrucciones':
					echo '<div class="card m-5 animated bounceInDown" style="background-color:rgba(255,255,255,0.8); ">
          					<label class="display-4 text-dark" align="center">INSTRUCCIONES</label>
					          <p align="left" class="h3 m-3" style="text-align: justify;">El cuestionario que se anexa consta de una serie de afirmaciones sobre el servicio que se ofrece en el Instituto Tecnológico. En cada una califique según la experiencia que tenga, respecto a lo que se afirma.</p>
					          <p align="left" class="h3 m-3" style="text-align: justify;">1. Seleccione la calificación que le asigna usted a
								su experiencia con el servicio de que se trata.
							</p>
							<br><br>
							<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<div class="row text-center">
									<div class="col-md-1"></div>
									<div class="col-md-2"><label class="h4 font-weight-bold text-danger mr-3" aling="center">Muy Mala</label></div>
									<div class="col-md-2"><label class="h4 font-weight-bold text-warning mr-3" aling="center">Mala</label></div>
									<div class="col-md-2"><label class="h4 font-weight-bold text-secondary mr-3" aling="center">Regular</label></div>
									<div class="col-md-2"><label class="h4 font-weight-bold text-info mr-3" aling="center">Buena</label></div>
									<div class="col-md-2"><label class="h4 font-weight-bold text-success mr-3" aling="center">Excelente</label></div>
									<div class="col-md-1"></div>							
								</div>
								</div>
							<div class="col-md-1"></div>
							</div>
							<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-10 text-center">
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-2"><label class="display-3 mr-2" aling="center" style="color:yellow">★</label></div>
									<div class="col-md-2"><label class="display-3 mr-2" aling="center" style="color:yellow">★</label></div>
									<div class="col-md-2"><label class="display-3 mr-2" aling="center" style="color:yellow">★</label></div>
									<div class="col-md-2"><label class="display-3 mr-2" aling="center" style="color:yellow">★</label></div>
									<div class="col-md-2"><label class="display-3 mr-2" aling="center" style="color:yellow">★</label></div>
									<div class="col-md-1"></div>							
								</div>							
							</div>
							<div class="col-md-1"></div>
							</div>
				          <p align="left" class="h3 m-3" style="text-align: justify;">2. Si desea expresar algún comentario, sugerencia, recomendación o queja utilice el espacio destinado para ello.</p>
				          <br><br>
				          <p align="center" style="text-align: justify;" class="h2 font-weight-bold text-primary m-3">Contesta con la mayor sinceridad posible recuerda que tu opinión hace la diferencia</p>
				          <p align="center"  style="text-align: justify;" class="h2 text-danger m-3">Una vez comenzada la encuesta, procura no cerrar la ventana, o recargar la pagina, ya que se perderá tu progreso, comprueba que la conexión es estable y recuerda que hasta llegar al final tus respuestas seran registradas.</p>
				          <div class="row">
				            <div class="col-3"></div>
				            <div class="col-6">
				              <a name="iniciar" id="btniniciarEncuesta2" class="btn btn-primary my-2 form-control" onclick="mostrarVista(\'encuesta\',\'inicial\')" href="#body">Iniciar Encuesta</a>
				            </div>
				            <div class="col-3"></div>
				            </div>
				        </div>';
				}
		break;
		case 'admin':
		switch ($_POST['acc']) {
			case 'alumnos':
			$encuesta = new Encuesta();
			$alumnos = $encuesta->estadoEncuestaAlumno();
			$p = $encuesta->getPorcentajeEncuestas();
				echo '<div class="row">
					<div class="col-md-6"><label class="display-4 text-success">Estado Encuesta Alumno <i class="fas fa-chart-pie"></i> </label></div>
					<div class="col-md-6" id="grafico" style="width: 400px; height: 250px;">
					</div>
				</div>
				<div class="row">
				<div class="col-md-12">
				<table class="table table-striped">
				<tr class="bg-dark text-white h6">
				<td>No. Control</td>
				<td>Nombre del Alumno</td>
				<td>Carrera</td>
				<td>Semestre</td>
				<td>Estado</td>
				</tr>
				<tbody>
				'.$alumnos.'</tbody>
				</table>
				</div>
				</div>|||'.$p;
				break;
			
			case 'departamentos':
			$dep= new Departamento();
			$departamentos= $dep->getDepartamentos();
				echo '<div class="row">
					<div class="col-md-12">
					<label class="display-4 text-success">Departamentos <i class="fas fa-chart-bar"></i> </label>
					</div>
					<div class="row">
					<div class="col-md-12">
					'.$departamentos.'
					<div class="btn btn-success text-rigth m-1 animated bounceInDown" style="width:150px; height:60px;" onclick="javascript:mostrarVista(\'admin\',\'nuevodepartamento\');">Nuevo Departamento</div>
					</div>
					</div>
				</div>
				<div class="row">
				<div class="col-md-12 card p-2 m-2" id="contenedor-departamento">
				
				</div></div>';
				break;
				case 'nuevodepartamento':
					echo '<label class="display-4 text-success">Nuevo Departamento <i class="fas fa-plus"></i></label>
					<form action="javascript:nuevoDepartamento();">
						<div class="col-md-4 h3">Nombre:</div>
						<div class="col-md-12"><input type="text" class="form-control" id="nombre_departamento"></div>
					 <div class="row">
					 <table class="table table-striped m-3" id="tabla_preguntas_nuevo_departamento">
					 <tr class="bg-dark text-white h3">
					 <td>No.</td>
					 <td>Pregunta</td>
					 </tr>
					 </tbody>
					 <tr id="renglon1">
					 <td class="h3">1</td>
					 <td><input class="form-control" type="text" id="pregunta1">
					 </td>
					 </tr>
					 <tr id="renglon2">
					 <td class="h3">2</td>
					 <td><input class="form-control" type="text" id="pregunta2"></td>
					 </tr>
					 <tr id="renglon3">
					 <td class="h3">3</td>
					 <td><input class="form-control" type="text" id="pregunta3">
					 </td>
					 </tr>
					 <tr id="renglon4">
					 <td class="h3">4</td>
					 <td><input class="form-control" type="text" id="pregunta4">
					 </td>
					 </tr>
					 <tr id="renglon5">
					 <td class="h3">5</td>
					 <td><input class="form-control" type="text" id="pregunta5">
					 </td>
					 </tr>
					 <tr id="renglon6">
					 <td class="h3">6</td>
					 <td><input class="form-control" type="text" id="pregunta6">
					 </td>
					 </tr>
					 <tr id="renglon7">
					 <td class="h3">7</td>
					 <td><input class="form-control" type="text" id="pregunta7">
					 </td>
					 </tr>
					 <tr id="renglon8">
					 <td class="h3">8</td>
					 <td><input class="form-control" type="text" id="pregunta8">
					 </td>
					 </tr>
					 <tr id="renglon9">
					 <td class="h3">9</td>
					 <td><input class="form-control" type="text" id="pregunta9">
					 </td>
					 </tr>

					 </table>
					 </div>
					 <input type="submit" class="btn btn-success" value="Guardar">
					 <input type="button" class="btn btn-danger" onclick="javascript:mostrarVista(\'admin\',\'departamentos\');" value="Cancelar">
					</form>';
					break;
				case 'nuevaPregunta':
					echo '<label class="display-4 text-success">Nueva Pregunta <i class="fas fa-plus"></i></label>
							<form action="javascript:guardarNuevaPregunta(\''.$_POST['id'].'\',\''.$_POST['nombredep'].'\',\''.$_POST['dep'].'\');" id="form-nueva-pregunta"> <input type="text" class="form-control my-2" style="background:#EFEFEF" id="nueva_pregunta">
							<input type="submit" class="btn btn-success" value="Guardar">
							<input type="button" class="btn btn-danger" value="Cancelar" onclick="javascript:mostrarVistaDepartamento(\''.$_POST['id'].'\',\''.$_POST['nombredep'].'\',\''.$_POST['dep'].'\');">
							</form>';
					break;
			case 'reportes':
				echo '
					<div class="container" >
						<div class="row">
							<div class="col-md-12">
								<label class="display-4 text-success">Reportes <i class="fas fa-clipboard-check"></i></label>
							</div>
						</div>
						<br><br>
						<div class="row">
							<div class="col-md-5">
								<button type="button" onclick="javascript:showDepartamentos();" class="btn btn-primary btn-lg m-1 animated bounceInRight btn-block">Reporte Por Departamento</button>			
							</div>
							<div class="col-md-5"> 
								<button type="button" onclick="javascript:generarXLS(\'General\',\'General\');" class="btn btn-secondary btn-lg m-1 animated bounceInLeft btn-block">Generar Reporte General</button>
							</div>
							<div class="col-md-2"> </div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12" id="containerDepartamentos">
							</div>
						</div>
					</div>';
				break;
			case 'configuracion':
				echo '<label class="display-4 text-success">Configuración <i class="fas fa-cogs"></i></label>
					<div class="row m-3">
						<div class="col-md-5 m-3 btn btn-info animated bounceInDown" onclick="javascript:mostrarVista(\'admin\',\'configurarPeriodo\');"><label class="h2 text-white" align="left">Configurar Periodo de Encuesta Activa <i class="fas fa-clock"></i></label></div>
						<div class="col-md-5 m-3 btn btn-success animated bounceInRight" onclick="javascript:mostrarVista(\'admin\',\'configurarInfo\');"><label class="h2 text-white" align="left">Cambiar Informacion del Administrador <i class="fas fa-users-cog"></i></label></div>
					</div>
					<div class="row m-3">
						<div class="col-md-5 m-3 btn btn-warning animated bounceInLeft" onclick="javascript:mostrarVista(\'admin\',\'cargarMatricula\');"><label class="h2 text-white" align="left">Cargar matricula de alumnos <i class="fas fa-list-ol"></i></label></div>
						<div class="col-md-5 m-3 btn btn-danger animated  bounceInUp" onclick="javascript:reiniciarSistema();"><label class="h2 text-white" align="left">Reiniciar Datos del Sistema <i class="fas fa-sync-alt"></i></label></div>
					</div>';
				break;
			case 'configurarPeriodo':
				echo '<label class="display-4 text-success">Configuar Periodo de Encuesta Activa <i class="fas fa-clock"></i></label>
				<form action="javascript:configurarPeriodo();" id="form-configurar">
				<div class="row">
					<div class="col-md-6">
						<label class="h2">Inicio:</label>
						<input type="date"  class="form-control" id="fechainicio">
					</div>
					<div class="col-md-6">
						<label class="h2">Fin:</label>
						<input type="date" class="form-control" id="fechafin">
					</div>
				</div>
				<div class="row my-3">
				<input type="submit" class="btn btn-success m-2" value="Guardar">
				<input type="button" class="btn btn-danger m-2" onclick="javascript:mostrarVista(\'admin\',\'configuracion\');" value="Cancelar">
				</div>
				</form>';
				break;
			case 'configurarInfo':
				echo '<label class="display-4 text-success" align="left">Cambiar Informacion del Administrador <i class="fas fa-users-cog"></i></label>
				<form id="form-datos" action="javascript:actualizaDatosAdmin();">
				<div class="row">
					<div class="col-md-12">
						<label class="h2">Nombre Del Administrador:</label>
						<input type="text" id="nombre" class="form-control" value="'.$_SESSION['admin']['nombre'].'">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<label class="h2">Cambiar contraseña:</label>
					</div>
				</div>
				<div class="row my-2">
					<div class="col-md-6">
						<label class="h2">Contraseña Nueva:</label>
						<input id="pass1" type="password" class="form-control">
					</div>
					<div class="col-md-6">
						<label class="h2">Confirme Contraseña:</label>
						<input id="pass2" type="password" class="form-control">
					</div>
				</div>
				<div class="row">
					<input type="submit" class="btn btn-success m-2" value="Guardar">
				<input type="button" class="btn btn-danger m-2" onclick="javascript:mostrarVista(\'admin\',\'configuracion\');" value="Cancelar">
				</div>
				</form>';
				break;
			case 'cargarMatricula':
				echo '<label class="display-4 text-success" align="left">Cargar matricula de alumnos <i class="fas fa-list-ol"></i></label>
					<form>
						<div class="row">
							<div class="col-md-12">
							<label class="h3">Seleccione un archivo con extension .csv con el siguiente formato:</label>
							<table class="table table-striped">
							<tr class="bg-dark text-white">
							<td>id</td><td>NoControl</td><td>Apellido Paterno</td><td>Apellido Materno</td><td>Nombre</td><td>Carrera</td><td>Semestre</td><td>Estatus_enc</td>
							</tr>
							<tr>
							<td>1</td><td>16650286</td><td>Quiroz</td><td>Quiroz</td><td>Brandon</td><td>Ingenieria En Sistemas Computacionales</td><td>8</td><td>1</td>
							</tr>
							</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
							<label class="h3">Seleccione un Archivo:</label>
							</div>
							<div class="col-md-6">
							<input type="file" id="matricula" name="matricula" class="form-control">
							</div>
						</div>
						<div class="row">
							<input type="submit" class="btn btn-success m-2" value="Cargar">
							<input type="button" class="btn btn-danger m-2" onclick="javascript:mostrarVista(\'admin\',\'configuracion\');" value="Cancelar">
						</div>
					</form>';
				break;
		}
		break;
	}
?>