<?php 
session_start();
if( $_SESSION["tipouser"]== null || $_SESSION["tipouser"]!="admin"){
	echo "<html> <h1>Solo los administradores pueden acceder a esta pagina.<h1><html>";
	die();
}
 ?>


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
  </head>
  <body onload="mostrarUsuarios();">
  <div id='page-wrap'>
	<header class='main' id='h1'>
      		<span class="right"><input type="button" id="logout" name="logout" value="Logout"></span>
      	<?php 
include "ParametrosBD.php";

		$email= $_GET['mail'];
 $conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
$sql= "SELECT imagen,nombre FROM usuarios WHERE email='$email'";
$resultado= mysqli_query($conexion,$sql);

while($imprimir=mysqli_fetch_array($resultado)){

echo $imprimir['nombre'];
?> &nbsp;&nbsp;

<?php
echo $imprimir['imagen'];
}
?>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
   
<nav class='main' id='n1' role='navigation'>
	
<?php
				
				echo"
				<span><a href='layoutadmin.php?mail=$email'>Inicio</a></spam>";
				?>
			<?php
				echo"
				<span><a href='GestionarCuentas.php?mail=$email'>Gestionar Cuentas</a></spam>";
				?>
		
<?php
				
				echo"
				<span><a href='creditosadmin.php?mail=$email'>Creditos</a></spam>";
				?>
				
			
			
	</nav>
    <section class="main" id="s1">
    
    <h3> Gestion De Cuentas</h3>
    
    <input type="button" id="mostrarUsuarios" value="Mostrar Usuarios" onclick="mostrarUsuarios();">

    <!-- slect -->

    
<select id="elegirmail">
<?php 
$sql= "SELECT email FROM usuarios";

$resultado= mysqli_query($conexion,$sql);

while($imprimir=mysqli_fetch_array($resultado)){
 ?>

	<option><?php echo $imprimir['email'] ?></option>


<?php  
}

?>



</select>

    <input type="button" id="DesbloquearUsuario" value="Desbloquear" style="background: green;" onclick="DesbloquearUsuario();">
    <input type="button" id="BloquearUsuario" value="Bloquear" style="background: orange;" onclick="BloquearUsuario();">
    <input type="button" id="EliminarUsuario" value="Eliminar" style="background: red;" onclick="EliminarUsuario();">

<div id=infoperaciones></div>

<div id=infoUsuarios>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>

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





function BloquearUsuario(){

			var email =$("#elegirmail").val();

		if(	confirm("Estas seguro de que quieres Bloquear a "+email+"")==true){

		$.ajax({

		url: 'BloquearUsuario.php?mail='+email+'',

		beforeSend:function(){
			
		$('#infoperaciones').html('<div><img src="img/loading.gif" width="30"/></div>')},


		success:function(datos){


		$('#infoperaciones').fadeIn().html(datos);},
		error:function(){
			$('#infoperaciones').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});
		mostrarUsuarios();
	}
		}

function DesbloquearUsuario(){

			var email =$("#elegirmail").val();

		if(	confirm("Estas seguro de que quieres Desbloquear a "+email+"")==true){

		$.ajax({

		url: 'DesbloquearUsuario.php?mail='+email+'',

		beforeSend:function(){
			
		$('#infoperaciones').html('<div><img src="img/loading.gif" width="30"/></div>')},


		success:function(datos){


		$('#infoperaciones').fadeIn().html(datos);},
		error:function(){
			$('#infoperaciones').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});

		mostrarUsuarios();
	}
		}



function EliminarUsuario(){

			var email =$("#elegirmail").val();
					if(	confirm("Estas seguro de que quieres Eliminar a "+email+"")==true){


		$.ajax({

		url: 'EliminarUsuario.php?mail='+email+'',

		beforeSend:function(){
			
		$('#infoperaciones').html('<div><img src="img/loading.gif" width="30"/></div>')},


		success:function(datos){


		$('#infoperaciones').fadeIn().html(datos);

		if(datos="USUARIO ELIMINADO CON EXITO"){
			recargarPagina();
		}
		else mostrarUsuarios();

	}
		

			});

			}
		}



function mostrarUsuarios(){
		$.ajax({
		url: 'VerUsuarios.php',

		beforeSend:function(){
			
			$('#infoUsuarios').html('<div><img src="img/loading.gif" width="60"/></div>')},


		success:function(datos){


		$('#infoUsuarios').fadeIn().html(datos);},
		error:function(){
			$('#infoUsuarios').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});
		}

function recargarPagina(){
	location.href="http://localhost/LabSesiones/GestionarCuentas.php";
}

</script>

</div>
<div id=inform></div>
	  </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/asierblaz/LabAJAX'>Link GITHUB</a>
	</footer>


<script>
	$("#logout").click(function() {	
	
	alert("Gracias por jugar a quiz.");

		$(location).attr('href', 'logout.php');
	});
	
</script>
</div>
</body>
</html>
