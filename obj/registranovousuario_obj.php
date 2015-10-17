<?php
 
	include("../class/usuario_class.php");

	try {

		$json = "{\"nome\":\"Marcelo Francisco Moura\",\"email\":\"cogumetal@gmail.com\",\"nascimento\":\"1987-03-28\",\"sexo\":\"1\",\"cidade\":\"1\",\"estado\":\"1\",\"pais\":\"1\",\"usuario\":\"marcelo\",\"senha\":\"e82e0b70b23adb481fb60abd83fb5e88\"}";

    	$usuario = new usuario($json);
     	$info = array("id" => $usuario->id, "nome" => $usuario->nome, "email" => $usuario->email, "nascimento" => $usuario->nascimento, "sexo" =>$usuario->sexoNome, "cidade" => $usuario->cidadeNome, "país" => $usuario->paisNome);
	 	$json = json_encode($info);

 	print_r($json);

	}
	catch (Exception $e) {
 	   echo 'Erro nº ', $e->getCode(), " - ", $e->getMessage(), "\n";
 	}

 ?>