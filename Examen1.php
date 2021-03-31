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
	<title>Laboratorio Clinico - Examen1</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<script>
		function procesar(cedula, cantidad, densidad, color, aspecto, olor, reaccion, ph, proteinas, glucosa, cetonas, sangre, urobilinogeno, bilirrubina, nitritos, leucocitos, celulas, leococitos, piocitos, hematies, cilindros, cristales, bacterias, mucina, levaduras){
        	if (!cedula || !cantidad || !densidad || !color || !aspecto || !olor || !reaccion || !ph || !proteinas || !glucosa || !cetonas || !sangre || !urobilinogeno || !bilirrubina || !nitritos || !leucocitos || !celulas || !leococitos || !piocitos || !hematies || !cilindros || !cristales || !bacterias || !mucina || !levaduras) {
        		alert("Hay campos vacios")
        	} else {
        		var parametros = {
                	"cedula" : cedula,
                	"cantidad" : cantidad,
                  "densidad": densidad,
                  "color" : color,
                  "aspecto" : aspecto,
                  "olor" : olor,
                  "reaccion" : reaccion,
                  "ph" : ph,
                  "proteinas" : proteinas,
                  "glucosa" : glucosa,
                  "cetonas" : cetonas,
                  "sangre" : sangre,
                  "urobilinogeno" : urobilinogeno,
                  "bilirrubina" : bilirrubina,
                  "nitritos" : nitritos,
                  "leucocitos" : leucocitos,
                  "celulas" : celulas,
                  "leococitos" : leococitos,
                  "piocitos" : piocitos,
                  "hematies" : hematies,
                  "cilindros" : cilindros,
                  "cristales" : cristales,
                  "bacterias" : bacterias,
                  "mucina" : mucina,
                  "levaduras" : levaduras
       		 	};
        		$.ajax({
                	data:  parametros,
                	url:   'hacerexamen1.php',
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

	<div id="divEmpleado1" class="container">
		<h3>Examen de Orina</h3>
			<label>Cedula del paciente</label><input class="form-control" type="number" name="cedula" id="cedula" required /></br>
      <div>
        <h4>Examen Físico</h3>
        <label>Cantidad</label><input class="form-control" type="text" name="cantidad" id="cantidad" required /></br>
        <label>Densidad</label><input class="form-control" type="text" name="densidad" id="densidad" required /></br>
        <label>Color</label><input class="form-control" type="text" name="color" id="color" required /></br>
        <label>Aspecto</label><input class="form-control" type="text" name="aspecto" id="aspecto" required /></br>
        <label>Olor</label><input class="form-control" type="text" name="olor" id="olor" required /></br>
        <label>Reacción</label><input class="form-control" type="text" name="reaccion" id="reaccion" required /></br>
        <label>Ph</label><input class="form-control" type="text" name="ph" id="ph" required /></br>
      </div>
      <div>
        <h4>Examen Químico</h3>
        <label>Proteínas</label><input class="form-control" type="text" name="proteinas" id="proteinas" required /></br>
        <label>Glucosa</label><input class="form-control" type="text" name="glucosa" id="glucosa" required /></br>
        <label>Cetonas</label><input class="form-control" type="text" name="cetonas" id="cetonas" required /></br>
        <label>Sangre</label><input class="form-control" type="text" name="sangre" id="sangre" required /></br>
        <label>Urobilinogeno</label><input class="form-control" type="text" name="urobilinogeno" id="urobilinogeno" required /></br>
        <label>Bilirrubina</label><input class="form-control" type="text" name="bilirrubina" id="bilirrubina" required /></br>
        <label>Nitritos</label><input class="form-control" type="text" name="nitritos" id="nitritos" required /></br>
        <label>Leucocitos</label><input class="form-control" type="text" name="leucocitos" id="leucocitos" required /></br>
      </div>
      <div>
        <h4>Examen Microscópico</h3>
        <label>Celulas Epiteliales</label><input class="form-control" type="text" name="celulas" id="celulas" required /></br>
        <label>Leococitos</label><input class="form-control" type="text" name="leococitos" id="leococitos" required /></br>
        <label>Piocitos</label><input class="form-control" type="text" name="piocitos" id="piocitos" required /></br>
        <label>Hematies</label><input class="form-control" type="text" name="hematies" id="hematies" required /></br>
        <label>Cilindros</label><input class="form-control" type="text" name="cilindros" id="cilindros" required /></br>
        <label>Cristales</label><input class="form-control" type="text" name="cristales" id="cristales" required /></br>
        <label>Bacterias</label><input class="form-control" type="text" name="bacterias" id="bacterias" required /></br>
        <label>Mucina</label><input class="form-control" type="text" name="mucina" id="mucina" required /></br>
        <label>Levaduras</label><input class="form-control" type="text" name="levaduras" id="levaduras" required /></br>
      
        <input class="btn btn-success btn-block" type="submit" onclick="procesar($('#cedula').val(), $('#cantidad').val(),$('#densidad').val(),$('#color').val(),$('#aspecto').val(),$('#olor').val(),$('#reaccion').val(),$('#ph').val(),$('#proteinas').val(),$('#glucosa').val(),$('#cetonas').val(),$('#sangre').val(),$('#urobilinogeno').val(),$('#bilirrubina').val(),$('#nitritos').val(),$('#leucocitos').val(),$('#celulas').val(),$('#leococitos').val(),$('#piocitos').val(),$('#hematies').val(),$('#cilindros').val(),$('#cristales').val(),$('#bacterias').val(),$('#mucina').val(),$('#levaduras').val() );return false;" value="Procesar" />
      </div>
			
	</div>
	<div id="divresultados" class="container text-center">
		<h1 id="resultado"></h1>
	</div>
</body>
</html>