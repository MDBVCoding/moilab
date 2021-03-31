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
  <title>Laboratorio Clinico - Examen de Heces</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script>
    function procesar(cedula, color, aspecto, olor, consistencia, reaccion, moco, sangre, restosalimentos, sangreoculta, azucaresreductores, ph, vermesadulto, huevos, protozoarios ){
          if (!cedula || !color || !aspecto || !olor || !consistencia || !reaccion || !moco || !sangre || !restosalimentos || !sangreoculta || !azucaresreductores || !ph || !vermesadulto || !huevos || !protozoarios) {
            alert("Hay campos vacios")
          } else {
            var parametros = {
                  "cedula" : cedula,
                  "color" : color,
                  "aspecto" : aspecto,
                  "olor" : olor,
                  "consistencia" : consistencia,
                  "reaccion" : reaccion,
                  "moco" : moco,
                  "sangre" : sangre,
                  "restosalimentos" : restosalimentos,
                  "sangreoculta" : sangreoculta,
                  "azucaresreductores" : azucaresreductores,
                  "ph" : ph,
                  "vermesadulto" : vermesadulto,
                  "huevos" : huevos,
                  "protozoarios" : protozoarios
            };
            $.ajax({
                  data:  parametros,
                  url:   'hacerexamen2.php',
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

  <div  class="container">
    <h3>Examen de Heces</h3>
      <label>Cedula del paciente</label><input class="form-control" type="number" name="cedula" id="cedula" required /></br>
      <div>
        <h4>Examen Macroscópico</h3>
        <label>Color</label><input class="form-control" type="text" name="color" id="color" required /></br>
        <label>Aspecto</label><input class="form-control" type="text" name="aspecto" id="aspecto" required /></br>
        <label>Olor</label><input class="form-control" type="text" name="olor" id="olor" required /></br>
        <label>Consistencia</label><input class="form-control" type="text" name="consistencia" id="consistencia" required /></br>
        <label>Reacción</label><input class="form-control" type="text" name="reaccion" id="reaccion" required /></br>
        <label>Moco</label><input class="form-control" type="text" name="moco" id="moco" required /></br>
        <label>Sangre</label><input class="form-control" type="text" name="sangre" id="sangre" required /></br>
        <label>Restos de Alimentos</label><input class="form-control" type="text" name="restosalimentos" id="restosalimentos" required /></br>
        <label>Sangre Oculta</label><input class="form-control" type="text" name="sangreoculta" id="sangreoculta" required /></br>
        <label>Azucares Reductores</label><input class="form-control" type="text" name="azucaresreductores" id="azucaresreductores" required /></br>
        <label>Ph</label><input class="form-control" type="text" name="ph" id="ph" required /></br>
        <label>Vermes Adulto</label><input class="form-control" type="text" name="vermesadulto" id="vermesadulto" required /></br>
      </div>
      <div>
        <h4>Examen Microscópico</h3>
        <label>Huevos</label><input class="form-control" type="text" name="huevos" id="huevos" required /></br>
        <label>Protozoarios</label><input class="form-control" type="text" name="protozoarios" id="protozoarios" required /></br>
    
      
        <input class="btn btn-success btn-block" type="submit" onclick="procesar($('#cedula').val(), $('#color').val(),$('#aspecto').val(),$('#olor').val(),$('#consistencia').val(),$('#reaccion').val(),$('#moco').val(),$('#sangre').val(),$('#restosalimentos').val(),$('#sangreoculta').val(),$('#azucaresreductores').val(),$('#ph').val(),$('#vermesadulto').val(),$('#huevos').val(),$('#protozoarios').val() );return false;" value="Procesar" />
      </div>
      
  </div>
  <div id="divresultados" class="container text-center">
    <h1 id="resultado"></h1>
  </div>
</body>
</html>