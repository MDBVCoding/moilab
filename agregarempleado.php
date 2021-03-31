<?php

include_once 'db_con.php';


if (isset($_POST["nombre"]) && isset($_POST["pwds"]) ) {
		$Nombre = $_POST["nombre"];

		$Pwd = md5($_POST['pwds']);

		$sql = "INSERT INTO usuario (nombre, password) VALUES ('".$Nombre."', '".$Pwd."') ";
		$result = $conn->query($sql) or die("Ocurrio un error, verifique los datos, es posible que el usuario ya exista");	
}
	
?>