<?php 

session_start();
$complex= $_SESSION['complejidad']/$_SESSION['cont'];

$aciertos=$_SESSION['aciertos'];
$fallos=$_SESSION['fallos'];
$num= $_SESSION['cont'];
?>

<html>
<p>El juego ha finalizado con exito!</p>
<p>Esta es tu puntuación sobre <strong> <?php echo $num; ?> </strong> preguntas;</p>
<br>
ACIERTOS: <?php echo $aciertos; ?> <br>
FALLOS: <?php echo  $fallos?><br>
COMPLEJIDAD MEDIA: <?php echo $complex; ?> <br>

<?php 
$nick=$_SESSION['nick'];

if($nick =="vacio" || $nick==null){
	echo "<html><br></html>";
	echo "No tienes nick, por lo tanto tus estadisticas no seran guardadas.";
	echo "<html><br></html>";
}  else{

include "ParametrosBD.php";


 $conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
$sql="INSERT INTO quizers VALUES ('$nick','$aciertos','$fallos','$num')";

$ejecutar=mysqli_query($conexion, $sql);


}

 ?>

<?php session_destroy(); ?>
<br>
¿Quieres volver a jugar? <a href="CuantoSabes.php"> Haz click Aqui </a><br>
</html>