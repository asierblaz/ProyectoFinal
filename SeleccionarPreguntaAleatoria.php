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

// $_SESSION['fin']=true;
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

		 <u>Seleccione la respuesta Correcta:</u> <br><br>

	<input type="radio" name="respuesta" id="respcorrecta" value="<?php echo $imprimir['respcorrecta']; ?>"> <?php echo $imprimir['respcorrecta']; ?><br>
	<input type="radio" name="respuesta" id="respincorrecta1" checked value="<?php echo $imprimir['respincorrecta1']; ?>"> <?php echo $imprimir['respincorrecta1']; ?><br>
	<input type="radio" name="respuesta" id="respincorrecta2" value="<?php echo $imprimir['respincorrecta2']; ?>"> <?php echo $imprimir['respincorrecta2']; ?> <br>
	<input type="radio" name="respuesta" id="respincorrecta3" value="<?php echo $imprimir['respincorrecta3']; ?>"> <?php echo $imprimir['respincorrecta3']; ?> 
	<br><br>
	<div id="infoRespuestas"></div>
<br>
			<center> <?php echo $imprimir['imagen']; ?></center>

</fieldset>
	<input type="button" id="boton" value="Enviar" onclick="mostrarRespuesta()">

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
		

			
		
</script>


