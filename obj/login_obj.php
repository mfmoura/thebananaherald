<?php 

    include ("../class/login_class.php");

    $login = $_GET["login"];
    $senha = $_GET["senha"];

    try {
        $login = new login($login, $senha);
        
        $json = array("id" => $login->id, "login" => $login->login, "ativo" => $login->ativo);
        echo json_encode($json);
        
    } catch (Exception $e) {
       echo 'Erro nº ', $e->getCode(), " - ", $e->getMessage(), "\n";
    }


 ?>