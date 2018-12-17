
<?php 
session_start();
if( $_SESSION["tipouser"]== null || $_SESSION["tipouser"]!="alumno"){
	echo "<html> <h1>Solo los alumnos pueden acceder a esta pagina.<h1><html>";
	die();
}
 ?>
 <!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
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
if ($_SESSION['correo']=="" || $_SESSION['correo']==null){
$imprimir=mysqli_fetch_array($resultado);
echo $imprimir['nombre'];
echo "<html>&nbsp;&nbsp;</html>";
echo $imprimir['imagen'];}

else{

echo $_SESSION['givenName'];
echo "<html>&nbsp;&nbsp;</html>";
echo $_SESSION['familyName'];
echo "<html>&nbsp;&nbsp;</html>";
echo "<img  width=100px src=".$_SESSION['picture'].">";


}
?>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
   
<nav class='main' id='n1' role='navigation'>
	
<?php
				
				echo"
				<span><a href='layout.php?mail=$email'>Inicio</a></spam>";
				?>
			<?php
				
				echo"
				<span><a href='preguntas.php?mail=$email'>Insertar Pregunta</a></spam>";
				?>
				<?php
				
				echo"
				<span><a href='VerPreguntasConFoto.php?mail=$email'>Ver Preguntas</a></spam>";
				?>
				<?php
				
				echo"
				<span><a href='VerPreguntasXML.php?mail=$email'>Ver Preguntas XML</a></spam>";
				?>
			<?php
				
				echo"
				<span><a href='GestionPreguntas.php?mail=$email'>Gestionar Preguntas</a></spam>";
				?>
			<?php
				
				echo"
				<span><a href='ObtenerPregunta.php?mail=$email'>ObtenerPregunta</a></spam>";
				?>
<?php
				
				echo"
				<span><a href='creditos.php?mail=$email'>Creditos</a></spam>";
				?>
				
			
			
	</nav>
    <section class="main" id="s1">
    
    <h3> Obtener Preguntas</h3>
	<div>
<fieldset>
		Inserta el numero de pregunta que deseas ver

		<input  id="clave">
	</fieldset>

	</div>

	<div id="verPreguntas">
				Aqui se muestran las preguntas.

	</div>

	  </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/asierblaz/LabAJAX'>Link GITHUB</a>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>
	$("#logout").click(function() {
		alert("Gracias por jugar a quiz.");
		$(location).attr('href', 'logout.php');
	});



	function ObtenerPregunta(){
		var clave = document.getElementById("clave").value;
		$.ajax({
		url: 'ObtenerPreguntaCliente.php?clave='+clave+'',

beforeSend:function(){
			
			$('#verPreguntas').html('<div><img src="img/loading.gif" width="60"/></div>')},
	success:function(datos){


$('#verPreguntas').fadeIn().html(datos);	
	


		}
			});
		}

 $("#clave").blur(function(){ //con blur detecta cuando el usuario ha dejado de escribir
 ObtenerPregunta();
 });
 $("#clave").keyup(function(){ //con keyup detecta cuando el usuario toca el teclado en ese campo
 ObtenerPregunta();
 });


	
</script>
</div>
</body>
</html>
