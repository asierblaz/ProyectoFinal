<?php 

session_start();
$complex= $_SESSION['complejidad']/$_SESSION['cont'];

?><html>
<p>El juego ha finalizado con exito!</p>
<p>Esta es tu puntuación sobre <strong> <?php echo $_SESSION['cont']; ?> </strong> preguntas;</p>
<br>
ACIERTOS: <?php echo $_SESSION['aciertos']; ?> <br>
FALLOS: <?php echo $_SESSION['fallos']; ?><br>
COMPLEJIDAD MEDIA: <?php echo $complex; ?> <br>
<?php print_r( $_SESSION['mostradas']); ?><br>


<?php session_destroy(); ?>
<br>
¿Quieres volver a jugar? <a href="CuantoSabes.php"> Haz click Aqui </a><br>
</html>