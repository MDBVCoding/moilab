<?php
include_once('db_con.php');

session_start();

$nombre = null;

$pwd = null;

if(isset($_POST['btn'])){
 if(isset($_POST['nombre']) && isset($_POST['pwd']) && !empty($_POST['nombre']) && !
empty($_POST['pwd'])){
 echo 'Recibio del POST', '<br />';
 $nombre = $_POST['nombre'];
 $pwd = md5($_POST['pwd']);
 
 echo $nombre, '<br />';
 echo $pwd, '<br />';
 $QUERYLog = "SELECT * FROM usuario WHERE nombre='$nombre' AND password='$pwd'";
 $rsQUERYLog = mysqli_query($conn, $QUERYLog) or die('Error: ' . mysqli_error($conn)); 
 $fileQUERYLog = mysqli_fetch_array($rsQUERYLog);
 $NofileQUERYLog = mysqli_num_rows($rsQUERYLog);
 echo $QUERYLog;
 if($NofileQUERYLog > 0){ $_SESSION['ID'] = $fileQUERYLog['ID'];
 $_SESSION['nombre'] = $fileQUERYLog['nombre'];
 
 echo '<br />';
 echo 'ID session:', $_SESSION['ID'],'<br >';
 echo 'nombre session:', $_SESSION['nombre'],'<br >';
 echo 'fotoUsuario session:', $_SESSION['fotoUsuario'],'<br >';
 header('Location: index.php');
 
 }else{
 session_destroy();
 header('Location: iniciosesion.php');
 }
 }else{
 session_destroy();
 header('Location: iniciosesion.php');
 }
}else{
 session_destroy();
 header('Location: iniciosesion.php');
}


mysqli_close($conn);
?>
