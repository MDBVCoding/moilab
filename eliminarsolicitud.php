<?php
	include_once 'db_con.php';

	if (isset($_GET['ID']) && isset($_GET['tipo']) && isset($_GET['cedula'])) {
		$ID = $_GET['ID'];
		$tipo = $_GET['tipo'];
		$cedula = $_GET['cedula'];


			$sql= "DELETE FROM examen{$tipo} WHERE cedula=".$cedula."";
			$result = $conn->query($sql) or die($conn->error);	

			$sqlcua= "DELETE FROM solicitudexamen WHERE ID={$ID} AND PacienteCedula={$cedula}";
			$result = $conn->query($sqlcua) or die($conn->error);
			echo "<meta http-equiv='refresh' content='0;url=listasolicitud.php'>";

	}


?>