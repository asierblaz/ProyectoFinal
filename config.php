<?php
	session_start();
	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("352189710410-jndpdfuktfhogt3g71tsrmr6ovi7q8op.apps.googleusercontent.com");
	$gClient->setClientSecret("fpyEqdwRvA7MjeF0aONTYmdg");
	$gClient->setApplicationName("Quiz Preguntas");
	$gClient->setRedirectUri("http://localhost/ProyectoFinal/ObtenerDatosGoogle.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
