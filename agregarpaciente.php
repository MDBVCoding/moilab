<?php

include_once 'db_con.php';


if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST['cedula']) && isset($_POST['sexo']) && isset($_POST['correo']) ) {
		$Nombre = $_POST["nombre"];

		$Apellido = $_POST["apellido"];

		$Cedula= $_POST["cedula"];

		$Sexo = $_POST["sexo"];

		$Correo = $_POST["correo"];


		$sql = "INSERT INTO paciente (cedula, nombre, apellido, sexo, correo) VALUES ('".$Cedula."', '".$Nombre."', '".$Apellido."', '".$Sexo."', '".$Correo."') ";
		$result = $conn->query($sql) or die("Ocurrio un error, verifique los datos");	
}
	
?>