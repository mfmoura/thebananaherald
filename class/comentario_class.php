<?php 
/**
 *  Classe de comentários de um post
 */
	 class comentarios
	 {
	 	
	 	public $id;
	 	public $idUsuario;
	 	public $mensagem;
	 	public $pontosPositivos;
	 	public $pontosNegativos;
	 	public $idTopico;
	 	protected $ativo;


	 	function __construct($input)
	 	{
	 		if(is_numeric($input)){
	 			$this->exibeComentario($input);
	 		}
	 		else if(preg_match(pattern, $input)){
	 			$this->enviaComentario($input);
	 		}
	 	}

	 	function exibeComentario($id){
	 		include ("../config/conn.php");

	 		$stmt = $conn->prepare("SELECT 
	 				`usuario`,
					`mensagem`,
					`pontos_positivos`,
					`pontos_negativos`,
					`topico`,
					`ativo`
				FROM 
					`viewcomentarios`
				WHERE
					`id` = ?");
	 		
	 		$stmt->bind_param("i", $id) or die ("Erro preparando a query" . $conn->error);

	 		if($stmt->execute()){
	 			$stmt->bind_result($usuario, $mensagem, $pontos_positivos, $pontos_negativos, $topico, $ativo);

	 			$this->id = $id;
	 			$this->idUsuario = $usuario;
	 			$this->mensagem = $mensagem;
	 			$this->pontos_positivos = $pontos_positivos;
	 			$this->pontos_negativos = $pontos_negativos;
	 			$this->idTopico = $topico;
	 			$this->ativo = $ativo;

	 			if ($this->ativo === 0) {
	 				throw new Exception("Este comentário está inativo", 12);
	 			}
	 		}


	 	}

	 	function enviaComentario($json){
	 		$arr = json_decode($json);

	 		include ("../config/conn.php");

	 		$stmt = $conn("CALL inserenovocomentario(?,?,?)");

	 	}
	 } 

 ?>