<?php 
sleep(1);

session_start();
include "ParametrosBD.php";

$tema = $_GET['tema'];

  		$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);

$consulta= $sql= "SELECT * FROM preguntas";
$res= mysqli_query($conexion,$sql);

$fila= mysqli_num_rows($res);

  		$aleatorio= rand(1,$fila);



$sql= "SELECT * FROM preguntas WHERE clave='$aleatorio' AND tema='$tema'";
$resultado= mysqli_query($conexion,$sql);

$imprimir=mysqli_fetch_array($resultado);


echo $imprimir['clave'];
echo $imprimir['enunciado'];

 

echo "hola esto es una prueba"

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



