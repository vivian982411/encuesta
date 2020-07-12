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
	<link rel="shortcut icon" href="img/petirrojos.ico">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
</head>
<body>

 	<div class="container">
 		<div class="row my-5">
 			<div class="col-md-5 card" style="background-image: url(img/background.jpg);">
 				<div class="row">
 					<div class="col-12">
 						<center><label class="display-4 text-white my-5">Encuesta de Satisfacción</label></center>
 						<center><img src="img/petirrojoOficial.png" class="img-fluid" id="peti" width="50%" style="float: center" onclick="javascript:administrador();"></center>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-7">
 				<div class="card my-5 animated bounceInRight" style="background: #FFF;">
 				<center><h1 class="text-primary mx-5 my-5"><img src="img/SEP.png" class="img-fluid" width="20%">&nbsp;&nbsp;Inicio De Sesión&nbsp;&nbsp;<img src="img/logoTec.png" class="img-fluid" width="10%"></h1></center>
				<form  class="form-block my-2 p-5" id="form-login" action="javascript:verificaLog();">
					<input type="text" name="nocontrol" class="form-control mr-sm-2 my-3 mx-2" placeholder="No.Control" required>
					<br><br>
					<input type="submit" class="form-control btn btn-primary my-3 mx-2" id="btn2" name="btn_login" value="Iniciar Sesión">
				</form>
 				</div>
 			</div>
 		</div>
	</div>
	<div id="loading">
		<img id="loading-image" src="img/loading.svg" alt="icono cargando">
	</div>
	<!-- Footer -->
<footer class="page-footer font-small cyan darken-3">

  <!-- Footer Elements -->
  <div class="container-fluid">

    <!-- Grid row-->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-12 py-2" style="background:#E0E0E0;">
        <div class="my-2 mb-2 text-center">

          <!-- Facebook -->
          <a class="fb-ic text-dark" href="https://www.facebook.com/institutotecnologico.dezitacuaro">
            <i class="fab fa-facebook-f fa-lg  mr-md-5 mr-3 fa-2x" style="text-decoration:none;"></i>Instituto Tecnológico de Zitácuaro
		  </a>
		  <a class="fb-ic text-dark" href="http://portal.itzitacuaro.edu.mx/">
            <img class="mr-md-5 mr-3 fa-2x mx-5" src="img/petirrojos.svg" width="40px"/>Instituto Tecnológico de Zitácuaro
          </a>
		  <br>
		  <br>
          <!-- Google +-->
          <a class="gplus-ic">
            <i class="fab fa-google-plus-g fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>Vivian Juarez De la O vivian982411@gmail.com
		  </a>
		  
		  <!-- Google +-->
          <a class="gplus-ic">
            <i class="fab fa-google-plus-g fa-lg white-text mx-5 mr-md-5 mr-3 fa-2x"> </i>Brandon Quiroz Quiroz branqq1598@gmail.com
          </a>
		  
        </div>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
  <!-- Footer Elements -->

  <!-- Copyright -->
  <div class="footer-copyright text-center text-white py-3 bg-primary" >© 2020 Copyright:
    <a class="text-white" href="http://portal.itzitacuaro.edu.mx/"> Instituto Tecnológico de Zitácuaro</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
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