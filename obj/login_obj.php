<?php 

    include ("../class/login_class.php");

    try {
        $login = new login("mmoura", "142qwrsaf");
        print_r($login);
        
    } catch (Exception $e) {
       echo 'Erro nº ', $e->getCode(), " - ", $e->getMessage(), "\n";
    }


 ?>