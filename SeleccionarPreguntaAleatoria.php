<?php 
sleep(1);

session_start();
include "ParametrosBD.php";

$nick = $_GET['nick'];
if($nick !="" && $nick !="undefined"){
	$_SESSION['nick']=$nick;
} 
  		$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);

$consulta= $sql= "SELECT * FROM preguntas";
$res= mysqli_query($conexion,$sql);

$fila= mysqli_num_rows($res);

  		$aleatorio= rand(1,$fila);

$array = $_SESSION['mostradas'];
$encontrada=false;
$cont =sizeof($array);

if($cont ==$fila){

header ("Location: mostrarPuntuacion.php"); 
}else {
while ( $cont< $fila && $encontrada==false) {

  if (in_array($aleatorio,$array)) {
  		$aleatorio= rand(1,$fila);

  } else{
  	$encontrada=true;
  	$cont=$cont+1;
  }

}
$sql= "SELECT * FROM preguntas WHERE clave='$aleatorio'";
$resultado= mysqli_query($conexion,$sql);

$imprimir=mysqli_fetch_array($resultado);


$array = $_SESSION['mostradas'];
array_push($array, $aleatorio);
$_SESSION['mostradas']=$array;

$_SESSION['cont']=$cont;

$_SESSION['complejidad']=$_SESSION['complejidad']+$imprimir['complejidad'];
}
 



	?>


<fieldset style="text-align: left; background: white">
<u>Datos de la pregunta</u><br><br>
		Nº: <?php echo $imprimir['clave'];  ?><br>
		Enunciado: <?php echo $imprimir['enunciado']; ?> <br>
		Tema: <?php echo $imprimir['tema']; ?> <br>
		Complejidad:  <?php echo $imprimir['complejidad']; ?><br><br>
 <img src="img/like.png" height="25" onclick="actualizarLike();">
 <img src="img/dislike.png" height="25" onclick="actualizarDislike();">
	<div id=numLikes></div>
<?php
$array = array($imprimir['respcorrecta'],  $imprimir['respincorrecta1'], $imprimir['respincorrecta2'], $imprimir['respincorrecta3']);
shuffle($array);
?>

<u>Seleccione la respuesta Correcta:</u> <br><br>

	<input type="radio" name="respuesta" id="respcorrecta" checked value="<?php echo $array[0]?>"> <?php echo $array[0];?><br>
	<input type="radio" name="respuesta" id="respincorrecta1"  value="<?php echo $array[1]; ?>"> <?php echo $array[1]; ?><br>
	<input type="radio" name="respuesta" id="respincorrecta2" value="<?php echo $array[2]; ?>"> <?php echo $array[2];?> <br>
	<input type="radio" name="respuesta" id="respincorrecta3" value="<?php echo $array[3];?>"> <?php echo $array[3]; ?> 
	<br><br>
	<div id="infoRespuestas"></div>
<br>

	<br><br>
	<div id="infoRespuestas"></div>
<br>
			<center> <?php echo $imprimir['imagen']; ?></center>

</fieldset>
<input type="button" onclick="MostrarPreguntas();" id="siguiente" value="Siguiente Pregunta ->"  >

	<input type="button" id="boton" value="Enviar" onclick="mostrarRespuesta();">
<input type="button" onclick="finalizar();" id="finalizar" value="Finalizar Juego"  >

 <div "id=resultado"></div>


	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
	
	


function mostrarRespuesta(){

	var respuesta = $('input:radio[name=respuesta]:checked').val();
	var clave= <?php echo $imprimir['clave'];  ?>;
			if(	confirm("Estas seguro de que ["+respuesta+"] es tu respuesta final?")==true){

		$.ajax({
		url: 'ComprobarRespuesta.php?respuesta='+respuesta+'&clave='+clave+'',

		beforeSend:function(){
			
			$('#infoRespuestas').html('<div><img src="img/loading.gif" width="30"/></div>')},


		success:function(datos){


		$('#infoRespuestas').fadeIn().html(datos);
	},
		error:function(){
			$('#infoRespuestas').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});}

		}
			
	function actualizarLike(){
	var clave= <?php echo $imprimir['clave'];  ?>;

		$.ajax({
		url: 'actualizarLike.php?clave='+clave+'',
		success:function(datos){


		$('#mostrarLikes').fadeIn().html(datos);},
		error:function(){
			$('#mostrarLikes').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});
		mostrarLikes();
	}
			function actualizarDislike(){
	var clave= <?php echo $imprimir['clave'];  ?>;
		$.ajax({
		url: 'actualizarDislike.php?clave='+clave+'',
		success:function(datos){


		$('#mostrarLikes').fadeIn().html(datos);},
		error:function(){
			$('#mostrarLikes').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});
		mostrarLikes();
	}
		
	
			

	function mostrarLikes(){
	var clave= <?php echo $imprimir['clave'];  ?>;

		$.ajax({
		url: 'mostrarLikes.php?clave='+clave+'',
		success:function(datos){


		$('#numLikes').fadeIn().html(datos);},
		error:function(){
			$('#numLikes').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});}
	


	function finalizar(){
	
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

			
		
</script>


