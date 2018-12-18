<?php 

sleep(1);


session_start();

include "ParametrosBD.php";

$tema=$_GET['tema'];
if($tema !="" && $tema !="undefined"){
	$_SESSION['tema']=$tema;
}
$temasesion= $_SESSION['tema'];
$nick = $_GET['nick'];
if($nick !="" && $nick !="undefined"){
	$_SESSION['nick']=$nick;
} 
  		$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);

$consulta= $sql= "SELECT * FROM preguntas WHERE tema='$temasesion'";

$res= mysqli_query($conexion,$sql);

while($sacarclaves=mysqli_fetch_array($res)){
$claves = $_SESSION['claves'];
array_push($claves, $sacarclaves['clave']);
$_SESSION['claves']=$claves;

}


$fila= mysqli_num_rows($res);
  			$aleatorio= rand(1,$fila);

  $clavealeatoria= $claves[$aleatorio-1];

$array = $_SESSION['mostradas'];
$encontrada=false;
$cont =sizeof($array);
if ($fila>3){
	$numpregunta=3;
} else {
	$numpregunta= $fila;
}
if($cont ==$numpregunta){

header ("Location: mostrarPuntuacion.php"); 
}else {
while ( $cont< $fila && $encontrada==false) {

  if (in_array($clavealeatoria,$array)) {
  		$aleatorio= rand(1,$fila);
  		  $clavealeatoria= $claves[$aleatorio-1];


  } else{
  	$encontrada=true;
  	$cont=$cont+1;
  }

}


$sql= "SELECT * FROM preguntas WHERE clave='$clavealeatoria' AND tema='$temasesion'";
$resultado= mysqli_query($conexion,$sql);

$imprimir=mysqli_fetch_array($resultado);

$array = $_SESSION['mostradas'];
array_push($array, $clavealeatoria);
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
<input type="button" onclick="MostrarPreguntasPorTema();" id="siguiente" value="Siguiente Pregunta ->"  >
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

	
	</script>		
