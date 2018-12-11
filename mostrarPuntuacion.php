<?php 

session_start();

$complex= $_SESSION['complejidad']/$_SESSION['cont'];

?><html>
<p>El juego ha finalizado con exito!</p>
<p>Esta es tu puntuación sobre <strong> <?php echo $_SESSION['cont']; ?> </strong> preguntas;</p>
<br>
ACIERTOS: <?php echo $_SESSION['aciertos']; ?> <br>
FALLOS: <?php echo $_SESSION['aciertos']; ?><br>
COMPLEJIDAD MEDIA: <?php echo $complex; ?> <br>


<?php session_destroy(); ?>
<br>
¿Quieres volver a jugar? <a href="CuantoSabes.php"> Haz click Aqui </a><br>
</html>