<?php 
include "ParametrosBD.php";


$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
$clave= $_GET['clave'];


$sql= "UPDATE preguntas SET dislike=dislike+1 WHERE clave='$clave'";
$result= mysqli_query($conexion,$sql);


 


 ?>
