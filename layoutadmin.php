<?php 
session_start();
if( $_SESSION["tipouser"]== null || $_SESSION["tipouser"]!="admin"){
	echo "<html> <h1>Solo los administradores pueden acceder a esta pagina.<h1><html>";
	die();
}
 ?>

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
      		<span class="right"><input type="button" id="logout" name="logout" value="Logout"></span>
      	<?php 
include "ParametrosBD.php";

		$email= $_GET['mail'];
 $conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
$sql= "SELECT imagen,nombre FROM usuarios WHERE email='$email'";
$resultado= mysqli_query($conexion,$sql);

while($imprimir=mysqli_fetch_array($resultado)){

echo $imprimir['nombre'];
?> &nbsp;&nbsp;

<?php
echo $imprimir['imagen'];
}
?>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
   
<nav class='main' id='n1' role='navigation'>
	
<?php
				
				echo"
				<span><a href='layoutadmin.php?mail=$email'>Inicio</a></spam>";
				?>
			<?php
				echo"
				<span><a href='GestionarCuentas.php?mail=$email'>Gestionar Cuentas</a></spam>";
				?>
		
<?php
				
				echo"
				<span><a href='creditosadmin.php?mail=$email'>Creditos</a></spam>";
				?>
				
			
			
	</nav>
    <section class="main" id="s1">
    
	<div>
<h2>Bienvenido a quiz
</h2>
<img src="img/quiz.jpg" >

	</div>
    </section>
		<footer class='main' id='f1'>
		<a href='https://github.com/asierblaz/'>Link GITHUB</a>
	</footer>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
	$("#logout").click(function() {
		alert("Gracias por jugar a quiz.");
		$(location).attr('href', 'logout.php');
	});
	
	
</script>
</div>
</body>
</html>
