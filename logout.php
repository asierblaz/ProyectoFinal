<?php
$xml = simplexml_load_file("contador.xml");
	$xml->value=$xml->value-1;
	$xml->asXML('contador.xml');
	session_start();
	session_destroy();	
    echo "<script language=Javascript> location.href=\"layout.html\"; </script>";
?>