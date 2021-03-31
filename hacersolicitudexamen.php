<?php

include_once 'db_con.php';


if (isset($_POST['cedula']) && isset($_POST['tipoexamen']) ) {

		$TipoExamen = $_POST["tipoexamen"];

		$Cedula= $_POST["cedula"];



		$sql = "INSERT INTO solicitudexamen (pacientecedula, idtipoexamen, estado) VALUES ('".$Cedula."', '".$TipoExamen."', '"."Pendiente"."') ";
		$result = $conn->query($sql) or die("ocurrio un error, verifique que el paciente existe y que no tiene esta misma solicitud en la lista");

		echo "Procesado Correctamente";	
}
	
?>