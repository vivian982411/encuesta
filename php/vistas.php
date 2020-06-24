<?php
require_once("encuesta.lib.php");
	switch ($_POST['opc']) {
		case 'encuesta':
			switch ($_POST["acc"]) {
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
									<div class="col-md-2"><label class="h4 font-weight-bold text-danger mr-3" aling="center">Terrible</label></div>
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
				          <p align="left" class="h3 m-3" style="text-align: justify;">2. Si desea expresar algún comentario, sugerencia o recomendación utilice el espacio destinado para ello.</p>
				          <br><br>
				          <p align="center" style="text-align: justify;" class="h2 font-weight-bold text-primary m-3">Contesta con la mayor sinceridad posible recuerda que tu opinion hace la diferencia</p>
				          <p align="center"  style="text-align: justify;" class="h2 text-danger m-3">Una vez comenzada la encuesta, procura no cerrar la ventana, o recargar la pagina, ya que se perdera tu progreso, comprueba que tu conexión es estable y recuerda que hasta no llegar al final tus respuestas no seran registradas.</p>
				          <div class="row">
				            <div class="col-3"></div>
				            <div class="col-6">
				            <input type="hidden" id="preguntas" value="">
				              <a name="iniciar" id="btniniciarEncuesta2" class="btn btn-primary my-2 form-control" onclick="crearEncuesta(\'1\')" href="#body">Iniciar Encuesta</a>
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
					<div class="col-md-6"><label class="display-4 text-primary">Estado Encuesta Alumno</label></div>
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
				echo '<div class="row">
					<div class="col-md-12">
					<label class="display-4">Departamentos</label>
					</div>
					<div class="row">
					<div class="col-md-12">
					<div class="btn btn-primary m-1 animated bounceInDown" style="width:125px; height:60px;" onclick="javascript:mostrarVistaDepartamento(\'1\',\'mostrardepartamento\');">Centro de Información</div>
					<div class="btn btn-secondary m-1 animated bounceInUp" style="width:125px; height:60px" onclick="javascript:mostrarVistaDepartamento(\'2\',\'mostrardepartamento\');"> Coordinación de Carreras</div>
					<div class="btn btn-info m-1 animated bounceInDown" style="width:125px; height:60px" onclick="javascript:mostrarVistaDepartamento(\'3\',\'mostrardepartamento\');"> Recursos Financieros</div>
					<div class="btn btn-success m-1 animated bounceInUp" style="width:125px; height:60px" onclick="javascript:mostrarVistaDepartamento(\'4\',\'mostrardepartamento\');">Residencias Profesionales</div>
					<div class="btn btn-warning m-1 animated bounceInDown" style="width:125px; height:60px" onclick="javascript:mostrarVistaDepartamento(\'5\',\'mostrardepartamento\');">Centro de Cómputo</div>
					<div class="btn btn-danger m-1 animated bounceInUp" style="width:125px; height:60px" onclick="javascript:mostrarVistaDepartamento(\'6\',\'mostrardepartamento\');">Servicios Escolares</div>
					<div class="btn btn-dark m-1 animated bounceInDown" style="width:125px; height:60px" onclick="javascript:mostrarVistaDepartamento(\'7\',\'mostrardepartamento\');">Servicio Social</div>
					</div>
					</div>
				</div>
				<div class="row">
				<div class="col-md-12 card p-2 m-2" id="contenedor-departamento">
				
				</div></div>';
				break;
				case 'nuevaPregunta':
					echo '<label class="display-4 text-dark">Nueva Pregunta</label>
							<form action="javascript:nuevaPregunta();" id="form-nueva-pregunta"> <input type="text" class="form-control my-2" style="background:#EFEFEF" id="nuevapregunta">
							<input type="submit" class="btn btn-success" value="Guardar">
							<input type="button" class="btn btn-danger" value="Cancelar" onclick="javascript:mostrarVistaDepartamento(\''.$_POST['id'].'\',\''.$_POST['nombredep'].'\');">
							</form>';
					break;
			case 'reportes':
				echo '
					<div class="container" >
						<div class="row">
							<div class="col-md-12">
								<label class="display-4 text-primary">Reportes</label>
							</div>
						</div>
						<br><br>
						<div class="row">
							<div class="col-md-3">
								<button type="button" onclick="showDepartamentos();" class="btn btn-info btn-lg m-1 animated bounceInRight btn-block">Reporte Por Departamento</button>
								
							</div>
							<div class="col-md-3"> 
								<button type="button" onclick="generarXLS(8);" class="btn btn-secondary btn-lg m-1 animated bounceInLeft btn-block">Generar Reporte General</button>
							</div>
							<div class="col-md-6"> </div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12" id="containerDepartamentos">
							</div>
						</div>
					</div>';
				break;
		}
		break;
	}
?>