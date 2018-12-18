<?php 	session_start();
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
		<span class="right"><a href="registrarse.php">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span>
      		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></spam>
		<span><a href='TopQuizers.php'>Top Quizers</a></spam>
		<span><a href='recuperarContrasena.php'>Modificar Contraseña</a></spam>
		<span><a href='CuantoSabes.php'>¿Cuanto Sabes?. Pruebame</a></spam>
		<span><a href='creditos.html'>Creditos</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div>
<h4>Demuestra cuanto sabes</h4><br>

<div id="preguntas">

	Bienvenido a la prueba quiz, aqui podras demostrar tus conocimientos y elegir si una pregunta es de tu gusto... <br>
	
	 Puedes jugar por temas, en el cual se te mostrarán tres preguntas sobre el tema seleccionado si las hay, o jugar contestando preguntas aleatoriamente.<br>
	

	<br> Si registras un nick tus resultados quedaran guardados, ¿Conseguiras llegar al TOP1? ¡compite por ser el mejor!<br> <br>
	<input type="text" id="nick" placeholder="Introduzca su Nick"> 


<br><br><hr></hr><br>
	<input type="button" name="empezar" id="empezar" value="Jugar" onclick="jugar()" style="background: orange; size: 900px">

    <br><br><hr></hr><br>

<select id="elegirtema">
<?php 
include "ParametrosBD.php";

 $conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);

$sql= "SELECT DISTINCT tema FROM preguntas";

$resultado= mysqli_query($conexion,$sql);

while($imprimir=mysqli_fetch_array($resultado)){
 ?>

	<option><?php echo $imprimir['tema'] ?></option>


<?php  
}

?>

<input type="button" name="empezar" id="empezar" value="Jugar Por Temas" onclick="jugarPorTema()" style="background: orange; size: 900px"> 



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
 
	$_SESSION['aciertos']=0;
	$_SESSION['fallos']=0;
	$_SESSION['complejidad']=0;
	$_SESSION['cont']=0;
	$_SESSION['nick']="vacio";
$mostradas = array();

	$_SESSION['mostradas']=$mostradas;

	 ?>
	 	if (nick !=""){

alert("Jugaras con el nick "+nick+"");
}
MostrarPreguntas();
			}
		},
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


function jugarPorTema(){
	var nick= $('#nick').val();

	$.ajax({
		url: 'ComprobarSiNickEnUso.php?nick='+nick+'',

		
		success:function(datos){

			if(datos==1){
alert("El nick que has itroducido esta en uso, prueba con otro")
			} else{
<?php 
 	
	$_SESSION['aciertos']=0;
	$_SESSION['fallos']=0;
	$_SESSION['complejidad']=0;
	$_SESSION['cont']=0;
	$_SESSION['nick']="vacio";
$mostradas = array();

	$_SESSION['mostradas']=$mostradas;
$claves=array();
	$_SESSION['claves']=$claves;




	 ?>
	 	if (nick !=""){

alert("Jugaras con el nick "+nick+"");
}
MostrarPreguntasPorTema();
			}
		},
			});
		
}

function MostrarPreguntasPorTema(){
		var nick= $('#nick').val();
		var tema= $('#elegirtema').val();
		
		$.ajax({
		url: 'SeleccionarPreguntaTemas.php?nick='+nick+'&tema='+tema+'',

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
