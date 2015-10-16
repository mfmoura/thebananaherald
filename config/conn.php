<?php 

	#################################################################################################
	#
	# Configuração de conexão
	#
	# Neste arquivo fica contido os parâmetros para a conexão com o banco.
	# 
	# Necessita atualização, pois está ainda marcado com os parâmetros do servidor gratuito.
	#
	#################################################################################################

	setlocale (LC_ALL, 'pt_BR');

	$host = "localhost";
	$user = "root";
	$passw = "";
	$db = "bananaherald";

	$conn = new mysqli($host, $user, $passw, $db);

	if ($conn->connect_error) {
	    die('Connect Error (' . $conn->connect_errno . ') '. $conn->connect_error);
	}

	if (!$conn->set_charset("utf8")) {
  	  die("Error loading character set utf8: %s\n" . $mysqli->error);
	} 

 ?>