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

	setlocale(LC_ALL, 'pt_BR');
	include("../config/config.php");

	$host = $endereco_banco;
	$user = $usuario_banco;
	$passw = $senha_banco;
	$db = $nome_banco;
	$port = $porta_banco;

	$conn = new mysqli($host, $user, $passw, $db, $porta_banco);

	if ($conn->connect_error) {
	    die('Erro de conexão: (' . $conn->connect_errno . ') '. $conn->connect_error);
	}

	if (!$conn->set_charset("utf8")) {
  	  die("Erro ao tentar utilizar o charset utf8: %s\n" . $mysqli->error);
	} 

 ?>