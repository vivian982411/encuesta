<?php
session_start();
	if (isset($_SESSION["admin"]["nombre"])) {
		header('location:principal_admin.php');
	}else{
		?>
		<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesión Administrador</title>
	<meta charset="utf-8">
	<meta name="portview" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="#">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
	<script type="text/javascript" src="js/funciones.js"></script>
</head>
<body>

 	<div class="container">
 		<div class="row my-5">
 			<div class="col-md-5 card" style="background-image: url(img/html-color-codes-color-tutorials-hero-00e10b1f.jpg);">
 				<div class="row">
 					<div class="col-12">
 						<center><label class="display-4 text-white my-5">Encuesta de Satisfacción</label></center>
 						<center><img src="img/petirrojoOficial.png" class="img-fluid" id="peti" width="50%" style="float: center" onclick="javascript:usuario();"></center>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-7">
 				<div class="card my-5 animated bounceInRight" style="background: #FFF;">
 				<center><h1 class="text-primary mx-5 my-5"><img src="img/SEP.png" class="img-fluid" width="20%">&nbsp;&nbsp;Administrador&nbsp;&nbsp;<img src="img/logoTec.png" class="img-fluid" width="10%"></h1></center>
				<form  class="form-block my-2 p-5" id="form-login-admin" action="javascript:verificaAdmin();">
					<input type="text" name="admin" id="usuario" class="form-control mr-sm-2 my-3 mx-2" placeholder="Usuario" required>
					<input type="password" name="password" id="password" class="form-control mr-sm-2 my-3 mx-2" placeholder="Contraseña" required>
					<input type="submit" class="form-control btn btn-primary my-3 mx-2" id="btn2" name="btn_login" value="Iniciar Sesión">
				</form>
 				</div>
 			</div>
 		</div>
	</div>
	
	<script type ="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<script type ="text/javascript" src="js/bootstrap.min.js"></script>
	<script type ="text/javascript" src="js/sweetalert2.all.min.js"></script>
	<script src="https://kit.fontawesome.com/b2c84686c6.js" crossorigin="anonymous"></script>
</body>
</html>
<?php
	}
?>