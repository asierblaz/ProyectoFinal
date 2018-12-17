<?php
	require_once "config.php";

	if (isset($_SESSION['access_token']))
		$gClient->setAccessToken($_SESSION['access_token']);
	else if (isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['access_token'] = $token;
	} else {

		$message = "Los datos no son correctos";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header('Location: login.php');
		exit();
	}

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();

	$_SESSION['id'] = $userData['id'];
	$_SESSION['tipouser']="alumno";
	$_SESSION['correo'] = $userData['email'];
	$_SESSION['picture'] = $userData['picture'];
	$_SESSION['familyName'] = $userData['familyName'];
	$_SESSION['givenName'] = $userData['givenName'];
	$_SESSION['conexion']="SI";

	$email = $_SESSION['correo'];
	$message = "Bienvenido al Sistema ".$_SESSION['correo']."";
	echo "<script type='text/javascript'>alert('$message');</script>";
	header('Location: layout.php?mail='.$email.'');
	exit();
?>