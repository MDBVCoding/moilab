<?php 
  include_once('db_con.php');
  session_start();
  if(isset($_SESSION['ID'])){
      $ID = $_SESSION['ID'];
      $QUERY = "SELECT * FROM usuario WHERE ID='$ID'";
      $rsQUERY = mysqli_query($conn, $QUERY) or die('Error: ' . mysqli_error($conn));
      $countQUERY = mysqli_num_rows($rsQUERY);
      if($countQUERY<=0){
        header('Location: iniciosesion.php');
      }
 
  }else{
    header('Location: iniciosesion.php');
  }
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Laboratorio Clinico - Paciente</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<script>
		function agregar(nombre, apellido, cedula, sexo, correo, ){
        	if (!nombre || !apellido || !cedula || !sexo || !correo) {
        		alert("Hay campos vacios")
        	} else {
        		var parametros = {
                	"nombre" : nombre,
                	"apellido" : apellido,
                	"cedula" : cedula,
                	"sexo" : sexo,
                	"correo" : correo
       		 	};
        		$.ajax({
                	data:  parametros,
                	url:   'agregarpaciente.php',
                	type:  'post',
                	beforeSend: function () {
                        	$("#resultado").html("Procesando, espere por favor...");
                	},
                	success:  function (response) {
                        	$("#resultado").html(response);
                	}
        		});
        	}
		}
	</script>
</head>
<body>
	<nav class="navbar navbar-default">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand" href="#">MoiLab</a>
    		</div>
    		<ul class="nav navbar-nav">
              <li><a href="index.php">Inicio</a></li>
              <?php if ($ID==1) {
                echo "<li><a href='empleado.php'>Agregar Empleado</a></li>";
              } ?>
              <li><a href="paciente.php">Agregar Paciente</a></li>
              <li><a href="listapacientes.php">Lista de Pacientes</a></li>
              <li><a href="solicitudexamen.php">Solicitud de Examen</a></li>
              <li><a href="listasolicitud.php">Lista de Examenes</a></li>
              <li><a href="rellenarexamen.php">Rellenar Examen</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php
                echo $_SESSION['nombre'];?>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="logoutproce.php">Cerrar Sesión</a></li>
                </ul>
              </li>
            </ul>
  		</div>
	</nav>
	<div id="div1" class="container">
		<h3>Ingresar Información de empleado</h3>
			<label>Nombre</label><input class="form-control" type="text" name="nombre" id="nombre" required /></br>
			<label>Apellido</label><input class="form-control" type="text" name="apellido" id="apellido" required /></br>
			<label>Cedula</label><input class="form-control" type="number" name="cedula" id="cedula" required /></br>
			<label>Sexo</label></br>
			<input type="radio" id="hombre" name="sexo" value="H">
  			<label for="hombre">H</label><br>
  			<input type="radio" id="mujer" name="sexo" value="M">
  			<label for="mujer">M</label></br>
			<label>Correo</label><input class="form-control" type="email" name="correo" id="correo" required /></br>
			<input class="btn btn-success btn-block" type="submit" onclick="agregar($('#nombre').val(), $('#apellido').val(), $('#cedula').val(), $('input[name=\'sexo\']:checked').val(), $('#correo').val() );return false;" value="agregar" />
	</div>
	<div id="divresultados" class="container text-center">
		<div id="resultado">
			
		</div>
	</div>
</body>
</html>