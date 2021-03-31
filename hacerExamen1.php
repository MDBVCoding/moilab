<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


include_once 'db_con.php';


if (isset($_POST['cedula']) && isset($_POST['cantidad']) && isset($_POST['densidad']) && isset($_POST['color']) && isset($_POST['aspecto']) && isset($_POST['olor']) && isset($_POST['reaccion']) && isset($_POST['ph']) && isset($_POST['proteinas']) && isset($_POST['glucosa']) && isset($_POST['cetonas']) && isset($_POST['sangre']) && isset($_POST['urobilinogeno']) && isset($_POST['bilirrubina']) && isset($_POST['nitritos']) && isset($_POST['leucocitos']) && isset($_POST['celulas']) && isset($_POST['leococitos']) && isset($_POST['piocitos']) && isset($_POST['hematies']) && isset($_POST['cilindros']) && isset($_POST['cristales']) && isset($_POST['bacterias']) && isset($_POST['mucina']) && isset($_POST['levaduras']) ) {

		$TipoExamen = 1;

		$Cedula= $_POST["cedula"];

		$cantidad = $_POST["cantidad"];

		$densidad = $_POST["densidad"];
		$color = $_POST["color"];
		$aspecto = $_POST["aspecto"];
		$olor = $_POST["olor"];
		$reaccion = $_POST["reaccion"];
		$ph = $_POST["ph"];
		$proteinas = $_POST["proteinas"];
		$glucosa = $_POST["glucosa"];
		$cetonas = $_POST["cetonas"];
		$sangre = $_POST["sangre"];
		$urobilinogeno = $_POST["urobilinogeno"];
		$bilirrubina = $_POST["bilirrubina"];
		$nitritos = $_POST["nitritos"];
		$leucocitos = $_POST["leucocitos"];
		$celulas = $_POST["celulas"];
		$leococitos = $_POST["leococitos"];
		$piocitos = $_POST["piocitos"];
		$hematies = $_POST["hematies"];
		$cilindros = $_POST["cilindros"];
		$cristales = $_POST["cristales"];
		$bacterias = $_POST["bacterias"];
		$mucina = $_POST["mucina"];
		$levaduras = $_POST["levaduras"];

		$completado = "completado";

		$consulta = "SELECT PacienteCedula FROM solicitudexamen WHERE PacienteCedula={$Cedula}";
		$resultado = $conn->query($consulta) or die("Ocurrio un error");
		$numresultado = mysqli_num_rows($resultado);

		if ($numresultado > 0) {
			$sql = "INSERT INTO examen1 (cedula, tipoexamen, cantidad, densidad, color, aspecto, olor, reaccion, ph, proteinas, glucosa, cetonas, sangre, urobilinogeno, bilirrubina, nitritos, leucocitos, celulasepiteliales, leococitos, piocitos, hematies, cilindros, cristales, bacterias, mucina, levaduras) VALUES ('".$Cedula."', '".$TipoExamen."', '".$cantidad."', '".$densidad."', '".$color."', '".$aspecto."', '".$olor."', '".$reaccion."', '".$ph."', '".$proteinas."', '".$glucosa."', '".$cetonas."', '".$sangre."', '".$urobilinogeno."', '".$bilirrubina."', '".$nitritos."', '".$leucocitos."', '".$celulas."', '".$leococitos."', '".$piocitos."', '".$hematies."', '".$cilindros."', '".$cristales."', '".$bacterias."', '".$mucina."', '".$levaduras."') ";
			$result = $conn->query($sql) or die("Ocurrio un error verifique los datos y que la cedula coincida con una solicitud");

			$sqldos = "UPDATE solicitudexamen INNER JOIN examen1 ON solicitudexamen.pacientecedula=examen1.cedula AND solicitudexamen.idtipoexamen=examen1.tipoexamen SET solicitudexamen.estado='".$completado."'";
			$resultdos = $conn->query($sqldos) or die("Ocurrio un error");

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
			    	$this->Cell(90,10,'Resultados Examen de Orina',0,0,'C');
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

			$pdfquery = "SELECT paciente.Nombre, paciente.Apellido ,paciente.Cedula, paciente.Correo,examen1.Cantidad,examen1.Densidad,examen1.Color,examen1.Aspecto,examen1.Olor,examen1.Reaccion,examen1.Ph,examen1.Proteinas,examen1.Glucosa,examen1.Cetonas,examen1.Sangre,examen1.Urobilinogeno,examen1.Bilirrubina,examen1.Nitritos,examen1.Leucocitos,examen1.CelulasEpiteliales,examen1.Leococitos,examen1.Piocitos,examen1.Hematies,examen1.Cilindros,examen1.Cristales,examen1.Bacterias,examen1.Mucina,examen1.Levaduras FROM examen1, solicitudexamen, paciente WHERE examen1.Cedula=solicitudexamen.PacienteCedula AND paciente.Cedula=solicitudexamen.PacienteCedula AND examen1.Cedula='$Cedula'";
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
				$pdf->Cell(40,10,'Cantidad:',0,0,'C');
				$pdf->Cell(40,10,$row['Cantidad'],0,0,'C');
				$pdf->Cell(40,10,'Densidad:',0,0,'C');
				$pdf->Cell(40,10,$row['Densidad'],0,1,'C');
				$pdf->Cell(40,10,'Color:',0,0,'C');
				$pdf->Cell(40,10,$row['Color'],0,0,'C');
				$pdf->Cell(40,10,'Aspecto:',0,0,'C');
				$pdf->Cell(40,10,$row['Aspecto'],0,1,'C');
				$pdf->Cell(40,10,'Olor:',0,0,'C');
				$pdf->Cell(40,10,$row['Olor'],0,0,'C');
				$pdf->Cell(40,10,'Reaccion:',0,0,'C');
				$pdf->Cell(40,10,$row['Reaccion'],0,1,'C');
				$pdf->Cell(40,10,'Ph:',0,0,'C');
				$pdf->Cell(40,10,$row['Ph'],0,0,'C');
				$pdf->Cell(40,10,'Proteinas:',0,0,'C');
				$pdf->Cell(40,10,$row['Proteinas'],0,1,'C');
				$pdf->Cell(40,10,'Glucosa:',0,0,'C');
				$pdf->Cell(40,10,$row['Glucosa'],0,0,'C');
				$pdf->Cell(40,10,'Cetonas:',0,0,'C');
				$pdf->Cell(40,10,$row['Cetonas'],0,1,'C');
				$pdf->Cell(40,10,'Sangre:',0,0,'C');
				$pdf->Cell(40,10,$row['Sangre'],0,0,'C');
				$pdf->Cell(40,10,'Urobilinogeno:',0,0,'C');
				$pdf->Cell(40,10,$row['Urobilinogeno'],0,1,'C');
				$pdf->Cell(40,10,'Bilirrubina:',0,0,'C');
				$pdf->Cell(40,10,$row['Bilirrubina'],0,0,'C');
				$pdf->Cell(40,10,'Nitritos:',0,0,'C');
				$pdf->Cell(40,10,$row['Nitritos'],0,1,'C');
				$pdf->Cell(40,10,'Leucocitos:',0,0,'C');
				$pdf->Cell(40,10,$row['Leucocitos'],0,0,'C');
				$pdf->Cell(40,10,'CelulasEpiteliales:',0,0,'C');
				$pdf->Cell(40,10,$row['CelulasEpiteliales'],0,1,'C');
				$pdf->Cell(40,10,'Leococitos:',0,0,'C');
				$pdf->Cell(40,10,$row['Leococitos'],0,0,'C');
				$pdf->Cell(40,10,'Piocitos:',0,0,'C');
				$pdf->Cell(40,10,$row['Piocitos'],0,1,'C');
				$pdf->Cell(40,10,'Hematies:',0,0,'C');
				$pdf->Cell(40,10,$row['Hematies'],0,0,'C');
				$pdf->Cell(40,10,'Cilindros:',0,0,'C');
				$pdf->Cell(40,10,$row['Cilindros'],0,1,'C');
				$pdf->Cell(40,10,'Cristales:',0,0,'C');
				$pdf->Cell(40,10,$row['Cristales'],0,0,'C');
				$pdf->Cell(40,10,'Bacterias:',0,0,'C');
				$pdf->Cell(40,10,$row['Bacterias'],0,1,'C');
				$pdf->Cell(40,10,'Mucina:',0,0,'C');
				$pdf->Cell(40,10,$row['Mucina'],0,0,'C');
				$pdf->Cell(40,10,'Levaduras:',0,0,'C');
				$pdf->Cell(40,10,$row['Levaduras'],0,1,'C');
				
				$correito = $row['Correo'];
			}

			$pdf->Output('F', 'examen1'.$Cedula.'.pdf');
			
			require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
            require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
            require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';

            $mail = new PHPMailer;
            $mail->isSMTP(); 
            $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
            $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
            $mail->Port = 587; // TLS only
            $mail->SMTPSecure = 'tls'; // ssl is deprecated
            $mail->SMTPAuth = true;
            $mail->Username = 'moisesdbvproyectophp@gmail.com'; // email
            $mail->Password = ''; // password
            $mail->setFrom('moisesdbvproyectophp@gmail.com', 'MoiLab'); // From email and name
            $mail->addAddress($correito, 'Paciente'); // to email and name
            $mail->Subject = 'Resultados de su Examen de Orina';
            $mail->msgHTML("Resultados"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
            $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
            // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
            $mail->AddAttachment("examen1".$Cedula.".pdf");
            $mail->SMTPOptions = array(
                        'ssl' => array(
                        '   verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
            if(!$mail->send()){
                echo "Mailer Error: " . $mail->ErrorInfo;
            }else{
                echo "Procesado Correctamente";
            }	
		} else {
			echo "<script>alert('Verifique que el paciente tenga una solicitud pendiente')</script>";
		}
}
	
?>
