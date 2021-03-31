<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once 'db_con.php';



if (isset($_POST['cedula']) && isset($_POST['gch']) ) {

		$TipoExamen = 3;

		$Cedula= $_POST["cedula"];

		$GCH = $_POST["gch"];

		$completado = "completado";


		$consulta = "SELECT PacienteCedula FROM solicitudexamen WHERE PacienteCedula={$Cedula}";
		$resultado = $conn->query($consulta) or die("Ocurrio un error");
		$numresultado = mysqli_num_rows($resultado);

		if ($numresultado > 0) {
			
			$sql = "INSERT INTO examen3 (cedula, tipoexamen,GCH) VALUES ('".$Cedula."', '".$TipoExamen."', '".$GCH."') ";
			$result = $conn->query($sql) or die("Ocurrio un error verifique los datos y que el paciente tenga una solicitud pendiente");

			$sqldos = "UPDATE solicitudexamen INNER JOIN examen3 ON solicitudexamen.pacientecedula=examen3.cedula AND solicitudexamen.idtipoexamen=examen3.tipoexamen SET solicitudexamen.estado='".$completado."'";
			$resultdos = $conn->query($sqldos) or die("Ocurrio un error verifique los datos");



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
			    	$this->Cell(90,10,'Resultados Prueba de Embarazo',0,0,'C');
			    	// Salto de línea
    				$this->Ln(20);

    				$this->Cell(40,10,'Nombre',0,0,'C');
					$this->Cell(40,10,'Apellido',0,0,'C');
					$this->Cell(40,10,'Cedula',0,0,'C');
					$this->Cell(50,10,'GCH en sangre',0,1,'C');
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

			$pdfquery = "SELECT paciente.Nombre, paciente.Apellido ,paciente.Cedula, paciente.Correo,examen3.GCH FROM examen3, solicitudexamen, paciente WHERE examen3.Cedula=solicitudexamen.PacienteCedula AND paciente.Cedula=solicitudexamen.PacienteCedula AND examen3.Cedula='$Cedula'";
			$pdfresult = $conn->query($pdfquery) or die("Ocurrio un error");

			$pdf = new PDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','',16);

			while ($row = $pdfresult->fetch_assoc()) {
				$pdf->Cell(40,10,$row['Nombre'],0,0,'C');
				$pdf->Cell(40,10,$row['Apellido'],0,0,'C');
				$pdf->Cell(40,10,$row['Cedula'],0,0,'C');
				$pdf->Cell(40,10,$row['GCH'],0,1,'C');
			}
			$pdf->Output('F', 'examen3'.$Cedula.'.pdf');
			echo "Procesado Correctamente";	
		}else {
			echo "<script>alert('Verifique que el paciente tenga una solicitud pendiente')</script>";

		}


}
	
?>