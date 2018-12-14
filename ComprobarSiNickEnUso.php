<?php 

$nick=$_GET['nick'];

include "ParametrosBD.php";


$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);

$consulta="SELECT * FROM quizers WHERE nick='$nick'";

$result= mysqli_query($conexion,$consulta);
$fila= mysqli_num_rows($result);

if($fila>0){
	echo"1"; //incorrecto
} 
else{
	echo "0"; //correcto
}

 ?>





