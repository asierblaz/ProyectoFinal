<?php
	session_start();
	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("293352216358-au047flh1m7osksbvsiq0oj0trfmc7od.apps.googleusercontent.com");
	$gClient->setClientSecret("Yle5eiCpHcf9jKi8u0EhCiHn");
	$gClient->setApplicationName("Quiz Preguntas");
	$gClient->setRedirectUri("http://localhost/ProyectoFinal/ObtenerDatosGoogle.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
