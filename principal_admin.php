<?php
	session_start();
	if (!$_SESSION["admin"]["nombre"]) {
		header("location:login_admin.php");

	} else {?>
	
<!doctype html>

<html lang="en">
  <head>
  	<title>Panel Administrador</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script type="text/javascript" src="js/loader.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/animate.css">
		<link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
  </head>
  <body style="background-color: #FFF">
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5">
		  		<h3><a class="logo"><?php echo $_SESSION["admin"]["nombre"]?></a></h3>
	        <ul class="list-unstyled components mb-5">
	          
	          <li>
	              <a style="cursor: pointer;" onclick="mostrarVistaAlumnos('admin','alumnos');">Alumnos</a>
	          </li>
	          <li>
              	<a style="cursor: pointer;" onclick="mostrarVista('admin','departamentos');">Departamentos</a>
	          <li>
	          <li>
	              <a style="cursor: pointer;" onclick="mostrarVista('admin','reportes');">Reportes</a>
	          </li>
	          <li>
             	 <a style="cursor: pointer;" onclick="cerrarAdmi();" >Cerrar Sesión</a>
	          </li>
	        </ul>

	        
	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
		<div class="container-fluid" style="margin-top: 3%">
			<div class="row">
				<div class="col-md-12" id="contenido">
					<div class="row">
						<div class="col-md-9"><label class="h1 text-success">Bienvenido @<?php echo $_SESSION['admin']['nombre'];?></label></div>
						<div class="col-md-3"></div>
					</div>
					<div class="row my-3">
						<div class="col-md-10"><label class="h1 text-dark text-rigth text-justify">Sistema de Encuestas de Satisfacción de los Departamentos del Instituto Tecnológico De Zitacuaro.</label></div>
						<div class="col-md-2"><img src="img/petirrojos.png" style="width: 150px" class="img-fluid"></div>
					</div>
				</div>
			</div>
		</div>
      </div>
		</div>
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script src="js/admin.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/funciones.js"></script>
	<script type ="text/javascript" src="js/sweetalert2.all.min.js"></script>
  </body>
</html>
<?php	
	}
	
?>