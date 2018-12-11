<?php 

include "ParametrosBD.php";

$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
$clave= $_GET['clave'];

$consulta="SELECT megusta,dislike FROM preguntas WHERE clave='$clave'";
$result= mysqli_query($conexion,$consulta);
$imprimir=mysqli_fetch_array($result);


?>
<FONT COLOR='green'><strong><?php  echo $imprimir['megusta']?></strong></FONT>
<?php 
echo "<html> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</html>";
?>

<FONT COLOR='red'><strong><?php  echo $imprimir['dislike']?></strong></FONT>