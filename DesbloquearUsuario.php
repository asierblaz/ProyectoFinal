<?php 

include "ParametrosBD.php";

$email= $_GET['mail'];
$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);

$consulta="SELECT estado FROM usuarios WHERE email='$email'";
$result= mysqli_query($conexion,$consulta);
$imprimir=mysqli_fetch_array($result);


If ($imprimir['estado']== "BLOQUEADO"){




$sql= "UPDATE usuarios SET estado='ACTIVO' WHERE email='$email'";
$resultado= mysqli_query($conexion,$sql);
echo "<FONT COLOR='green'>USUARIO ACTIVADO CON EXITO</FONT>";
}
else{
echo "<FONT COLOR='red'>USUARIO NO HA SIDO ACTIVADO PORQUE YA ESTABA ACTIVADO</FONT>";}
 ?>
