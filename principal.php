<?php
session_start();
require_once("php/alumno.lib.php");
$cabeza="";
if (isset($_SESSION["alumno"]["nocontrol"])) {
  $alu= new Alumno();
  $verificacion=$alu->verificarEncuesta($_SESSION["alumno"]["nocontrol"]);
  if($alu->verificarPeriodo() && $verificacion == ""){?>
<!DOCTYPE html>
<html>
<head>
  <title>Principal</title>
  <script type="text/javascript" src="js/funciones.js"></script>
  <meta charset="utf-8">
  <meta name="portview" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="#">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body id="body"style="background-image: url('img/petirrojoOficial.png');background-size:400px;background-position:center;background-repeat: no-repeat;">
  <!--Navbar-->

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: #003f87">
  <a class="navbar-brand" style="float: right;" href="principal.php"><i class="fas fa-user-circle"></i> Alumno <?php echo $_SESSION ['alumno']['nombre'];?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse fixed" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    
        <button class="btn btn-danger" id="btncerrar" onclick="cerrar();">Cerrar Sesión <i class="fas fa-sign-out-alt"></i></button>
     
    </ul>
  </div>
</nav>

  <!--Navbar-->
  <!--Cuerpo-->
<br>
  <div class="container-fluid mt-2">
    <div class="row">
    <div class="col-md-12">
        <div class="row">
          <div class="col-md-12" id="contenido" style="margin-bottom: 5%">
            <div class="card m-5 animated bounceInDown" style="background-color:rgba(255,255,255,0.8);">
              <br><br>
          <label class="display-4 text-dark" align="center">ENCUESTA DE SERVICIO</label>
          <p align="left" class="h3 m-3">Estimado Estudiante: @<?php echo $_SESSION['alumno']['nombre'];?></p>
          <p align="left" class="h3 m-3" style="text-align: justify;">El Instituto Tecnológico tiene el firme compromiso de satisfacer plenamente tus necesidades en el  servicio educativo que te ofrece durante tu estancia en esta casa de estudios, buscando mejorar permanentemente nuestro desempeño para servirte cada vez mejor.</p>
          <p align="left" class="h3 m-3" style="text-align: justify;">Para lograr esto, lo más valioso es tu opinión, por lo que se solicita responder con toda sinceridad este cuestionario anexo, cuya respuesta será la mejor ayuda para superarnos.</p>
          <p align="left" class="h3 m-3" style="text-align: justify;">También te pedimos si así lo consideras, aportar tus comentarios, sugerencias o quejas, para tomar en cuenta las aportaciones y atender las necesidades en cada departamento que te ofrece servicio.</p>
          <p align="left" class="h3 m-3" style="text-align: justify;">Se agradece tu atención a la presente y me reitero a tu disposición.</p>
          <p align="center" class="h3 m-3" style="text-align: center;"> ATENTAMENTE </p>
          <p align="center" class="h3 m-3" style="text-align: center;">DIRECTOR </p>
          <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
              <a name="iniciar" id="btniniciarEncuesta1" class="btn btn-primary my-2 form-control" onclick="mostrarVista('encuesta','instrucciones');" href="#body">Siguiente</a>
            </div>
          </div>
        </div>
    </div>
    </div>
  </div>
<div id="loading">
		<img id="loading-image" src="img/loading.svg" alt="icono cargando">
	</div>

  <!--Cuerpo-->
<script type ="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type ="text/javascript" src="js/bootstrap.min.js"></script>
<script type ="text/javascript" src="js/sweetalert2.all.min.js"></script>
<script src="https://kit.fontawesome.com/b2c84686c6.js" crossorigin="anonymous"></script>
</body>
</html>
<?php
  }else{
    $cabeza="error";
  }
}else{
  $cabeza="error";
}
if ($cabeza=="error") {
  session_destroy();
  header("location:index.php");
}
?>