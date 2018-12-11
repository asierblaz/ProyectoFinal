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
 <div style="text-align:left;"><strong>FORMULARIO DE REGISTRO</strong> </div> <br>
	<fieldset>

<form id="registro" name="registro" method="POST" enctype="multipart/form-data" action="registrarse.php" style="background-color: white; text-align: left;">
	Email*:<input type="text" name="email" id="email" class="entrada" placeholder="email123@ikasle.ehu.eus" required pattern="[a-z]{3,200}[0-9]{3}@ikasle.ehu+\.eus$"><label id="emailvip"></label><br> 
	Nombre y Apellidos*: <input type="text" name="nombre" id="nombre" class="entrada"required><br>
	Contraseña*: <input type="password" name="password" minlength="8"id="password" class="entrada"required><label id="contraseñatop"></label><br>
	Repita su contraseña: <input type="password" name="repassword" minlength="8" id="repassword" class="entrada"required><br>
	
	<br>
	Foto de perfil: <input id="imagen" type="file" name="imagen" onchange="mostrarImagen()"><br> <br>
	
<center>	<img id="argazki" name="imagen"width="100" height="100"> </center> <br>
<center> <input type="submit" id="enviar" value="Registrarse"></center> 
</form>   </fieldset>



<?php
if (isset($_POST['email'])){
include "ParametrosBD.php";

	$conexion = mysqli_connect ($servidor,$usuario,$password) or die
	("No se ha podido conectar con el servidor de Base de datos");
	
	$db = mysqli_select_db($conexion, $basededatos) or die 
	("No se ha podido conectar a la Base de datos");
	
	//recuperar las variables
	$email=$_POST['email'];
	$nombre=$_POST['nombre'];
	$password=$_POST['password'];
	$estado="ACTIVO";
	
		$dir="img";

	$imagen=$_FILES['imagen']['name'];
	$archivo= $_FILES['imagen']['tmp_name'];

	$dir=$dir."/".$imagen;
	move_uploaded_file($archivo, $dir);

	


?>


<?php  

	//sentencia sql

$passwordEncriptada= password_hash($password, PASSWORD_DEFAULT);
	
	$sql="INSERT INTO usuarios VALUES ('$email','$nombre','$passwordEncriptada','<img  width=100px src=".$dir.">','$estado')";




	 $ejecutar=mysqli_query($conexion, $sql);
	
	 //verificacion de la ejecucioon

	 if(!$ejecutar){

						echo '<script type="text/javascript">alert("Ha ocurrido un error, puede que los datos no sean correctos");</script>';

	 }else{ 
	 echo"Registro realizado correctamente <br><a href='login.php'>¿Quieres iniciar sesion? </a>";

	 } 
	 
	 }
	 ?>﻿

	</div>

	

    </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/asierblaz/LabAJAX'>Link GITHUB</a>
	</footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>

	var valida = false;

function ComprobarPassword(){
	var password = document.getElementById("password").value;
		$.ajax({
		url: 'ClientePassword.php?password='+password+'',

	success:function(datos){
	
	if	(datos==1){

$('#contraseñatop').fadeIn().html(' <p style="color:green;">La contraseña es VALIDA</p> ');	
	valida=true;
}

else if (datos==2){
	valida=false;
$('#contraseñatop').fadeIn().html(' <p style="color:orange;">SIN SERVICIO</p> ');	

}
 else {

$('#contraseñatop').fadeIn().html(' <p style="color:red;">La contraseña es INVALIDA</p> ');	
	valida= false;
	}




		}
			});
		}

 $("#password").blur(function(){ //con blur detecta cuando el usuario ha dejado de escribir
 ComprobarPassword();
 });
 $("#password").keyup(function(){ //con keyup detecta cuando el usuario toca el teclado en ese campo
 ComprobarPassword();
 });












//---------------------------email-----------------------------------------
	var vip= false;

		function EmailVip(){
		var email = document.getElementById("email").value;
		$.ajax({
		url: 'EmailVip.php?mail='+email+'',

	success:function(datos){
	if	(datos==1){

$('#emailvip').fadeIn().html(' <p style="color:green;">El email es vip</p> ');	
	vip=true;
}
 else {
$('#emailvip').fadeIn().html(' <p style="color:red;">El email no es vip</p> ');	
	vip= false
	}


		}
			});
		}




$("#email").blur(function(){ //con blur detecta cuando el usuario ha dejado de escribir
EmailVip();
});
$("#email").keyup(function(){ //con keyup detecta cuando el usuario toca el teclado en ese campo
EmailVip();
});






//mostrar foto



function mostrarImagen(){


				
	 var preview=$("#argazki")[0]; 
	 var archivo = $("#imagen")[0].files[0];

	 var leer = new FileReader();

	 if(archivo){
	 	leer.readAsDataURL(archivo);
	 	leer.onloadend=function(){
	 		preview.src=leer.result;

	 	};	 }
} 
	$("#registro").submit(function(){


if(valida==false){
		alert("Tienes que tener una contraseña mas segura");
		return false;
	}


if(vip==false){
		alert("Tienes que tener un email vip para poderte registrar");
		return false;
	}

var expresionnombre = new RegExp(/\w+\s+\w+/)

	if(expresionnombre.test($("#nombre").val())==false){
			alert("Tienes que escribir al menos un Nombre y un Apellido");
			return false;
		}

	if($("#password").val()!=$("#repassword").val()){
				
				alert("Las contraseñas tienen que ser iguales.");
				return false;
			}

	if(valida==false){
		alert("La contraseña no es valida");
		return false;
	}


})


	</script>

			
			

</body>
</html>
