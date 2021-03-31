<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Laboratorio Clinico - Inicio de Sesión</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	
</head>
<body>
	<div id="divEmpleado1" class="container">
		
      <form name="form1" action="loginproce.php" method="post">
          <h2>Inicio de Sesion</h2>
 
          <label>Nombre:</label><br />
          <input class="form-control" type="nombre" name="nombre"><br />
          <label>Contraseña:</label><br />
          <input class="form-control" type="password" name="pwd"><br />
 
          <br />
          <button type="submit" class="btn btn-success btn-block" name="btn" class="btn btn-default">Entrar</button>
      </form>
	</div>
</body>
</html>