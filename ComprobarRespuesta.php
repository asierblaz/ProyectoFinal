<?php 
session_start();
sleep(1);
include "ParametrosBD.php";


$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
$respuesta= $_GET['respuesta'];
$clave= $_GET['clave'];

$consulta="SELECT * FROM preguntas WHERE clave='$clave' AND respcorrecta='$respuesta'";
$result= mysqli_query($conexion,$consulta);
$fila= mysqli_num_rows($result);


if($fila>0){
echo "<FONT COLOR='green'>RESPUESTA CORRECTA</FONT>";
$_SESSION['aciertos']= $_SESSION['aciertos']+1;


}

else{
echo "<FONT COLOR='red'>LA RESPUESTA ES INCORRECTA</FONT>";
$_SESSION['fallos']= $_SESSION['fallos']+1;
}

 ?>
