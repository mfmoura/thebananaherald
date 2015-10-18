<?php 

	include("../class/usuario_class.php");

	try {
    	$usuario = new moderador($_GET["id"]);
     	$info = array("id" => $usuario->id, "nome" => $usuario->nome, "email" => $usuario->email, "nascimento" => $usuario->nascimento, "sexo" =>$usuario->sexoNome, "cidade" => $usuario->cidadeNome, "país" => $usuario->paisNome, "sessoes" => $usuario->sessoes);
	 	$json = json_encode($info, JSON_UNESCAPED_UNICODE);

 	print_r($json);

	}
	catch (Exception $e) {
 	   echo 'Erro nº ', $e->getCode(), " - ", $e->getMessage(), "\n";
 	}
 ?>