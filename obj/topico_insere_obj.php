<?php 

	include("../class/topico.php");

	try {
		$topico = new topico($_POST['json_topico']);

		echo "Cadastrado com sucesso! Tópico nº. " . $topico->id . "\n";
	} 
	catch (Exception $e) {
		echo 'Erro nº ', $e->getCode(), " - ", $e->getMessage(), "\n";
	}

 ?>