<?php 

	include ("../class/topico_class.php");
	
	try {
		$id = $_GET["id_topico"];

		$topico = new topico($id);

		print_r($topico);

	} catch (Exception $e) {
		print_r($e);
	}
	
 ?>