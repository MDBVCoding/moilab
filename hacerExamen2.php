<?php

include_once 'db_con.php';


if (isset($_POST['cedula']) && isset($_POST['color']) && isset($_POST['aspecto']) && isset($_POST['olor']) && isset($_POST['reaccion']) && isset($_POST['ph']) && isset($_POST['consistencia']) && isset($_POST['sangreoculta']) && isset($_POST['huevos']) && isset($_POST['sangre']) && isset($_POST['protozoarios']) && isset($_POST['vermesadulto']) && isset($_POST['restosalimentos']) && isset($_POST['moco']) && isset($_POST['azucaresreductores']) ) {

		$TipoExamen = 2;

		$Cedula= $_POST["cedula"];


		$color = $_POST["color"];
		$aspecto = $_POST["aspecto"];
		$olor = $_POST["olor"];
		$reaccion = $_POST["reaccion"];
		$ph = $_POST["ph"];
		$sangre = $_POST["sangre"];
		$sangreoculta = $_POST["sangreoculta"];
		$azucaresreductores = $_POST["azucaresreductores"];
		$consistencia = $_POST["consistencia"];
		$moco = $_POST["moco"];
		$protozoarios = $_POST["protozoarios"];
		$huevos = $_POST["huevos"];
		$restosalimentos = $_POST["restosalimentos"];
		$vermesadulto = $_POST["vermesadulto"];

		$completado = "completado";

		$consulta = "SELECT PacienteCedula FROM solicitudexamen WHERE PacienteCedula={$Cedula}";
		$resultado = $conn->query($consulta) or die("Ocurrio un error");
		$numresultado = mysqli_num_rows($resultado);

		if ($numresultado > 0) {

			$sql = "INSERT INTO examen2 (cedula, tipoexamen, color, aspecto, olor, consistencia, reaccion, moco, sangre, restosalimentos, sangreoculta, azucaresreductores, ph, vermesadulto, huevos, protozoarios) VALUES ('".$Cedula."', '".$TipoExamen."', '".$color."', '".$aspecto."', '".$olor."', '".$consistencia."', '".$reaccion."', '".$moco."', '".$sangre."', '".$restosalimentos."', '".$sangreoculta."', '".$azucaresreductores."', '".$ph."', '".$vermesadulto."', '".$huevos."', '".$protozoarios."') ";
				$result = $conn->query($sql) or die($conn->error);

			$sqldos = "UPDATE solicitudexamen INNER JOIN examen2 ON solicitudexamen.pacientecedula=examen2.cedula AND solicitudexamen.idtipoexamen=examen2.tipoexamen SET solicitudexamen.estado='".$completado."'";
			$resultdos = $conn->query($sqldos) or die($conn->error);


			include_once 'fpdf/fpdf.php';

		

			class PDF extends FPDF
			{
				// Cabecera de página
				function Header()
				{	

    				// Arial bold 15
    				$this->SetFont('Arial','B',18);
    				// Movernos a la derecha
   					$this->Cell(40);
    				// Título
			    	$this->Cell(90,10,'Resultados Examen de Heces',0,0,'C');
			    	// Salto de línea
    				$this->Ln(20);

 
				}

				// Pie de página
				function Footer()
				{	
    				// Posición: a 1,5 cm del final
    				$this->SetY(-15);
    				// Arial italic 8
    				$this->SetFont('Arial','I',8);
    				// Número de página
    				$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
				}
			}

			$pdfquery = "SELECT paciente.Nombre, paciente.Apellido ,paciente.Cedula, paciente.Correo,examen2.Color,examen2.Aspecto,examen2.Olor,examen2.Reaccion,examen2.Ph,examen2.Consistencia,examen2.Moco,examen2.Restosalimentos,examen2.Sangre,examen2.Sangreoculta,examen2.Azucaresreductores,examen2.Vermesadulto,examen2.Huevos,examen2.Protozoarios FROM examen2, solicitudexamen, paciente WHERE examen2.Cedula=solicitudexamen.PacienteCedula AND paciente.Cedula=solicitudexamen.PacienteCedula AND examen2.Cedula='$Cedula'";
			$pdfresult = $conn->query($pdfquery) or die($conn->error);

			$pdf = new PDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','',16);

			while ($row = $pdfresult->fetch_assoc()) {
				$pdf->Cell(40,10,'Nombre',0,0,'C');
				$pdf->Cell(40,10,'Apellido',0,0,'C');
				$pdf->Cell(40,10,'Cedula',0,1,'C');
				$pdf->Cell(40,10,$row['Nombre'],0,0,'C');
				$pdf->Cell(40,10,$row['Apellido'],0,0,'C');
				$pdf->Cell(40,10,$row['Cedula'],0,1,'C');
				$pdf->Ln(10);
				$pdf->Cell(40,10,'Color:',0,0,'C');
				$pdf->Cell(40,10,$row['Color'],0,0,'C');
				$pdf->Cell(40,10,'Aspecto:',0,0,'C');
				$pdf->Cell(40,10,$row['Aspecto'],0,1,'C');
				$pdf->Cell(40,10,'Olor:',0,0,'C');
				$pdf->Cell(40,10,$row['Olor'],0,0,'C');
				$pdf->Cell(40,10,'Reaccion:',0,0,'C');
				$pdf->Cell(40,10,$row['Reaccion'],0,1,'C');
				$pdf->Cell(40,10,'Consistencia:',0,0,'C');
				$pdf->Cell(40,10,$row['Consistencia'],0,0,'C');
				$pdf->Cell(40,10,'Moco:',0,0,'C');
				$pdf->Cell(40,10,$row['Moco'],0,1,'C');
				$pdf->Cell(40,10,'Restos Alimentos:',0,0,'C');
				$pdf->Cell(40,10,$row['Restosalimentos'],0,0,'C');
				$pdf->Cell(40,10,'Sangre Oculta:',0,0,'C');
				$pdf->Cell(40,10,$row['Sangreoculta'],0,1,'C');
				$pdf->Cell(40,10,'Sangre:',0,0,'C');
				$pdf->Cell(40,10,$row['Sangre'],0,0,'C');
				$pdf->Cell(40,10,'Azucares Reductores:',0,0,'C');
				$pdf->Cell(40,10,$row['Azucaresreductores'],0,1,'C');
				$pdf->Cell(40,10,'Vermes Adulto:',0,0,'C');
				$pdf->Cell(40,10,$row['Vermesadulto'],0,0,'C');
				$pdf->Cell(40,10,'Huevos:',0,0,'C');
				$pdf->Cell(40,10,$row['Huevos'],0,1,'C');
				$pdf->Cell(40,10,'Protozoarios:',0,0,'C');
				$pdf->Cell(40,10,$row['Protozoarios'],0,0,'C');

			}

			$pdf->Output('F', 'examen2'.$Cedula.'.pdf');
			echo "Procesado Correctamente";	
		}else {
			echo "<script>alert('Verifique que el paciente tenga una solicitud pendiente')</script>";
		}	

} 
	
?>