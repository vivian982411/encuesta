<?php
session_start();
	if (isset($_SESSION["alumno"]["nocontrol"])) {
		header('location:principal.php');
	}else{
		?>
		<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesión</title>
	<meta charset="utf-8">
	<meta name="portview" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="#">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
	<style type="text/css">
		@media screen and (max-height: : 2340){
			#divpeti,#divlogin{
				display: block;
			}
		}
	</style>
</head>
<body>

 	<div class="container">
 		<div class="row my-5">
 			<div class="col-md-5 card d-sm-block" id="divpeti" style="background-image: url(img/html-color-codes-color-tutorials-hero-00e10b1f.jpg);">
 				<div class="row">
 					<div class="col-12">
 						<center><label class="display-4 text-white my-5">Encuesta de Satisfacción</label></center>
 						<center><img src="img/petirrojos.png" class="img-fluid" id="peti" width="50%" style="float: center" onclick="javascript:administrador();"></center>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-7 d-sm-block" id="divlogin">
 				<div class="card my-5 animated bounceInRight" style="background: #FFF;">
 				<center><h1 class="text-primary mx-5 my-5"><img src="img/logoTec.png" class="img-fluid" width="10%"> &nbsp&nbspInicio De Sesión&nbsp&nbsp<img src="img/sep.png" class="img-fluid" width="20%"></h1></center>
				<form  class="form-block my-2 p-5" id="form-login" action="javascript:verificaLog();">
					<input type="text" name="nocontrol" class="form-control mr-sm-2 my-3 mx-2" placeholder="No.Control" required>
					<input type="submit" class="form-control btn btn-primary my-3 mx-2" id="btn2" name="btn_login" value="Iniciar Sesión">
				</form>
 				</div>
 			</div>
 		</div>
	</div>
	<script type="text/javascript" src="js/funciones.js"></script>
	<script type ="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<script type ="text/javascript" src="js/bootstrap.min.js"></script>
	<script type ="text/javascript" src="js/sweetalert2.all.min.js"></script>
	<script src="https://kit.fontawesome.com/b2c84686c6.js" crossorigin="anonymous"></script>
</body>
</html>
<?php
	}
?>