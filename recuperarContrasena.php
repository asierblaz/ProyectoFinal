<?php 
session_start(); ?>
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


	<style type="text/css">
		
		.entrada{
			width: 500px;
		}
		#complejidad{
			width: 50px;
		}
	</style>		   
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
		<span><a href='creditos.html'>Creditos</a></spam>
	</nav>


    <section class="main" id="s1">

	<div>
 <div style="text-align:left;"><strong>Recuperar Contraseña</strong> </div> <br>
	<fieldset>

<form id="login" name="login" method="POST" enctype="multipart/form-data" action="recuperarContrasena.php" style="background-color: white; text-align: left;">
	Introduce el email de recuperación*:<input type="text" name="email" id="email" class="entrada" autofocus required placeholder="Introduzca su email" ><br>
	<br>
	
	<br>
	
<center> <input type="submit" id="enviar" value="Enviar"></center> 
</form>   </fieldset>
<style type="text/css">
	#error{
		
		color: #FF0000;

		
	}
</style>


<?php

if (isset($_POST['email'])){
//conectar a la base de datos
include "ParametrosBD.php";


$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos) or die
	("No se ha podido conectar con el servidor de Base de datos");


	$emailingresado= $_POST['email'];

//$consulta= "SELECT * FROM usuarios WHERE email='$emailingresado' and password='$passwordingresado'";
$consulta= "SELECT * FROM usuarios WHERE email='$emailingresado'";
			

$resultado=mysqli_query($conexion,$consulta);

$fila= mysqli_num_rows($resultado);

if($fila>0){

//email destinatario
$emailpara= $emailingresado;

$asunto= "Recuperación de Contraseña.";

$codigo= rand(10000,99999);


//variables de sesion

$_SESSION['codigo']=$codigo;
$_SESSION['email']=$emailingresado;

$mensaje=" <html>Para recuperar su contraseña,haga click en el codigo y añadalo al formulario <br>  <a href='https://ws18g20.000webhostapp.com/LabSesiones/recuperarContrasenaCodigo.php?mail=".$emailingresado."'>
<h1>".$codigo."</h1>
 </html>";

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: Usuario <'.$emailpara.'>' . "\r\n";
$cabeceras .= 'From: Recuperar Password <admin000@ehu.es>' . "\r\n";
$cabeceras .= 'Cc: admin000@ehu.es' . "\r\n";
$cabeceras .= 'Bcc: admin000@ehu.es' . "\r\n";



//ENVIAMOS EL EMAIL
mail($emailpara, $asunto, $mensaje, $cabeceras);

echo "El email se ha enviado correctamente, recibirá un código de verificación";
}else{
echo '<html><br><div id=error class="error">El email introducido no existe.</div></hmtl>';
}

}
 ?>

	</div>

	

    </section>
		<footer class='main' id='f1'>
		<a href='https://github.com/asierblaz/LabAJAX'>Link GITHUB</a>
	</footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


			
			




</body>
</html>