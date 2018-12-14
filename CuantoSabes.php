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
<h4>Demuestra cuanto sabes</h4><br>

<input type="button" onclick="MostrarPreguntas();" id="siguiente" value="Siguiente Pregunta ->" style="visibility: hidden;" >
<input type="button" onclick="finalizar();" id="finalizar" value="Finalizar Juego" style="visibility: hidden;" >
<div id="preguntas">

	Bienvenido a la prueba quiz, aqui podras demostrar tus conocimientos y elegir si una pregunta es de tu gusto... <br>
	
	 Haz click en Jugar y comenzaremos!.<br>
	

	<br> Puedes empezar a jugar con un nick y que tus resultados queden registrados. <br>
	<input type="text" id="nick" placeholder="Introduzca su Nick"> 
	<input type="button" name="empezar" id="empezar" value="Jugar" onclick="jugar()" style="background: orange; size: 900px">

</div>




    </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/asierblaz/LabAJAX'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>


function jugar(){
		var nick= $('#nick').val();

	$.ajax({
		url: 'ComprobarSiNickEnUso.php?nick='+nick+'',

		
		success:function(datos){

			if(datos==1){
alert("El nick que has itroducido esta en uso, prueba con otro")
			} else{
<?php 
 
	session_start();
	$_SESSION['aciertos']=0;
	$_SESSION['fallos']=0;
	$_SESSION['complejidad']=0;
	$_SESSION['cont']=0;
	$_SESSION['fin']=false;
	$_SESSION['nick']="vacio";
$mostradas = array();

	$_SESSION['mostradas']=$mostradas;

	 ?>
	 	if (nick !=""){

alert("Jugaras con el nick "+nick+"");
}
	 document.getElementById('siguiente').style.visibility='visible';
	document.getElementById('finalizar').style.visibility='visible';
MostrarPreguntas();
			}
		},
			});
		
}






function finalizar(){
	document.getElementById('siguiente').style.visibility='hidden';
	document.getElementById('finalizar').style.visibility='hidden';

$.ajax({
		url: 'mostrarPuntuacion.php',

		beforeSend:function(){
			
			$('#preguntas').html('<div><img src="img/loading.gif" width="60"/></div>')},


		success:function(datos){


		$('#preguntas').fadeIn().html(datos);},
		error:function(){
			$('#preguntas').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});

	
		
}




	function MostrarPreguntas(){
		var nick= $('#nick').val();
		$.ajax({
		url: 'SeleccionarPreguntaAleatoria.php?nick='+nick+'',

		beforeSend:function(){
			
			$('#preguntas').html('<div><img src="img/loading.gif" width="60"/></div>')},


		success:function(datos){


		$('#preguntas').fadeIn().html(datos);},
		error:function(){
			$('#preguntas').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});
		}

</script>
s