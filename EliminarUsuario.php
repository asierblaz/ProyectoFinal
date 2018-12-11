<?php 

include "ParametrosBD.php";

$email= $_GET['mail'];
$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
$sql= "DELETE FROM usuarios WHERE email='$email'";
$resultado= mysqli_query($conexion,$sql);
echo "<FONT COLOR='green'>USUARIO ELIMINADO CON EXITO </FONT>";

 ?>