<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Inicio</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="registrarse.php">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span>
      		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></spam>
		<span><a href='recuperarContrasena.php'>Modificar Contraseña</a></spam>
		<span><a href='CuantoSabes.php'>¿Cuanto Sabes?. Pruebame</a></spam>
		<span><a href='creditos.html'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div>
<h4>Top 10 Quizers</h4><br>

<p>Aquí se muestra el top 10 de usuarios con mas aciertos</p>
<br><br>
<center>

<table border="1"style="background-color: white; text-align: center;">
	<tr>
		<td><strong>Nº</strong></td>
		<td><strong>NICK</strong></td>	
		<td><strong>Nº PREGUNTAS</strong></td>	
		<td><strong>ACIERTOS</strong></td>
		<td><strong>FALLOS</strong></td>
	</tr>
<?php 
include "ParametrosBD.php";

 $conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);

$sql= "SELECT * FROM quizers ORDER BY aciertos DESC";
$resultado= mysqli_query($conexion,$sql);
$cont=0;
while($imprimir=mysqli_fetch_array($resultado)){
	$cont=$cont+1;
 ?>
<tr>
	<td>&nbsp;&nbsp;<?php echo $cont ?>&nbsp;&nbsp;</td>
	<td><br>&nbsp;&nbsp;<?php echo $imprimir['nick'] ?>&nbsp;&nbsp;<br></td>
	<td>&nbsp;&nbsp;<?php echo $imprimir['numpreguntas']?>&nbsp;&nbsp;</td>
	<td>&nbsp;&nbsp;<?php echo $imprimir['aciertos'] ?>&nbsp;&nbsp;</td>
	<td>&nbsp;&nbsp;<?php echo $imprimir['fallos']?>&nbsp;&nbsp;</td>
		
</tr>



 <?php  
}
?>

</table>


</center>




    </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/asierblaz/ProyectoFinal'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>
