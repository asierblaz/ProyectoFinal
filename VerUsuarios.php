	<?php 
	sleep(1);
include "ParametrosBD.php";
 $conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);


?>


<center>
	<div>Estas son los usuarios almacenados en la base de datos</div>
	<br>
<table border="1"style="background-color: white; text-align: center;">
	<tr>
		<td><strong>EMAIL</strong></td>	
		<td><strong>Nombre y Apellido</strong></td>	
		<td><strong>Contraseña</strong></td>	
		<td><strong>Estado</strong></td>	
		<td><strong>Imagen</strong></td>
	</tr>
<?php 
$sql= "SELECT * FROM usuarios";
$resultado= mysqli_query($conexion,$sql);

while($imprimir=mysqli_fetch_array($resultado)){
 ?>
<tr>
	<td><br>&nbsp;&nbsp;<?php echo $imprimir['email'] ?>&nbsp;&nbsp;<br></td>
	<td>&nbsp;&nbsp;<?php echo $imprimir['nombre']?>&nbsp;&nbsp;</td>
	<td>&nbsp;&nbsp;<?php echo $imprimir['password']?>&nbsp;&nbsp;</td>
	<td>&nbsp;&nbsp;<?php echo $imprimir['estado']?>&nbsp;&nbsp;</td>
	<td>&nbsp;&nbsp;<?php echo $imprimir['imagen']?>&nbsp;&nbsp;</td>
		
</tr>



 <?php  
}
?>

