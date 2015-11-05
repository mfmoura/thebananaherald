<?php 

	include("../class/topico_class.php");

	try {
		$topico = new topico($_POST['postInsere']);

		echo "Cadastrado com sucesso! Tópico nº. " . $topico->id . "\n";
	} 
	catch (Exception $e) {
		echo 'Erro nº ', $e->getCode(), " - ", $e->getMessage(), "\n";
	}

 ?>