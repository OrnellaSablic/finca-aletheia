<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 0);


	$conexion = mysqli_connect("127.0.0.1", "root", "", "finca_aletheia");
	if (!$conexion) {
		echo "No se pudo conectar a la base de datos." . PHP_EOL;
		 //echo "Error de depuración: " . mysqli_connect_error() . PHP_EOL;

	}else{
		// echo "Se realizó una conexión exitosa a la base de datos" . PHP_EOL;
	}
	



?>