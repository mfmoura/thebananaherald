<?php 

	include("../class/usuario_class.php");

	try {
    	$usuario = new usuario($_GET["id"]);
     	$info = array("id" => $usuario->id, "nome" => $usuario->nome, "email" => $usuario->email, "nascimento" => $usuario->nascimento, "sexo" =>$usuario->sexoNome, "cidade" => $usuario->cidadeNome, "pais" => $usuario->paisNome);
	 	print_r($info);
	 	$json_return = json_encode($info, JSON_UNESCAPED_UNICODE);

 		echo $json_return;

	}
	catch (Exception $e) {
 	   echo 'Erro nº ', $e->getCode(), " - ", $e->getMessage(), "\n";
 	}
 ?>