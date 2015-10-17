<?php 

	include("../class/usuario_class.php");

	try {
    	$usuario = new usuario($_GET["id"]);
     	$info = array("id" => $usuario->id, "nome" => $usuario->nome, "email" => $usuario->email, "nascimento" => $usuario->nascimento, "sexo" =>$usuario->sexoNome, "cidade" => $usuario->cidadeNome, "país" => $usuario->paisNome);
	 	$json_return = json_encode($info);

 	print_r($json_return);

	}
	catch (Exception $e) {
 	   echo 'Erro nº ', $e->getCode(), " - ", $e->getMessage(), "\n";
 	}
 ?>