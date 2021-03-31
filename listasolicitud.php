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
	<title>Laboratorio Clinico - Lista de Examenes</title>



	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


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
	<div class="container">
    <h2>Lista de Examenes en proceso</h2>
		  <table class="table" border="2">
    <tr>
      <th>ID</th>
      <th>Cedula</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Sexo</th>
      <th>Tipo de Examen</th>
      <th>Estado</th>
      <th>Opción</th>
    </tr>

<?php


include_once 'db_con.php';

$sql = "SELECT solicitudexamen.ID, solicitudexamen.pacientecedula AS cedula, solicitudexamen.IDTipoExamen  AS tipo, paciente.Nombre AS nombre1 , paciente.Apellido, paciente.Sexo, tipoexamen.Nombre AS nombre2, solicitudexamen.Estado FROM paciente, solicitudexamen, tipoexamen WHERE paciente.Cedula=solicitudexamen.PacienteCedula AND tipoexamen.ID=solicitudexamen.IDtipoexamen ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["cedula"]. "</td><td>" . $row["nombre1"] . "</td><td>" . $row["Apellido"] ."</td><td>" . $row["Sexo"] . "</td><td>" . $row["nombre2"]. "</td><td>" . $row["Estado"] . "</td><td><a href=eliminarsolicitud.php?ID=".$row["ID"]."&tipo=".$row["tipo"]."&cedula=".$row["cedula"].">" . "Eliminar" ."</a></td></tr>";
        }
      echo "</table>";  
    } else {
        echo "0 results";
    }

?>  

	</div>
</body>
</html>