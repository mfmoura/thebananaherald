<?php  

	/**
	* Recupera ou grava uma mensagem
	*/
	class topico
	{
		public $id;
		public $idUsuario;
		public $titulo;
		public $mensagem;
		public $pontosPositivos;
		public $pontosNegativos;
		public $idAssunto;
		public $idSessao;
		protected $ativo;

		
		function __construct($input)
		{
			if (is_numeric($input)){
				exibeTopico($input);
			}
			else if (preg_match(pattern, $input)){
				enviaMensagem($input);

			}
			else {
				throw new Exception("Error Processing Request", 1);	
			}
		}

		function exibeTopico($id){
			include("../config/conn.php");

			$stmt = $conn->prepare("SELECT
					`usuario`
					`titulo`
					`mensagem`
					`pontos_positivos`
					`pontos_negativos`
					`id_assunto`
					`id_sessao`
					`ativo`
				FROM 
					viewtopico
				WHERE
					id = ?");
			
			$stmt->bind_param("i", $id);
			
			if ($stmt->execute()){
				
				$stmt->bind_result(
					$this->idUsuario,
					$this->titulo,
					$this->mensagem,
					$this->pontosPositivos,
					$this->pontosNegativos,
					$this->idAssunto,
					$this->idSessao,
					$this->ativo);

				$this->id = $id;

				if ($this->ativo === 0) {
					throw new Exception("Este tópico está inativo", 0);

				}

			}
			else{
				throw new Exception("Erro na chamada do banco de dados ", 5);
			}

		}

		function exibeComentarios($id, $pagina, $mensagensPorPagina){ // Retorna uma array associativa com as IDs dos comentários da página requisitada
			include("../config/conn.php");

			$stmt = $conn->prepare("SELECT id FROM viewcomentario WHERE topico = ? LIMIT ?,?")
			$stmt->bind_param("iii", $this->id, ($pagina-1) * $mensagensPorPagina, ($pagina) * $mensagensPorPagina);

			if ($stmt->execute()){

				$stmt->bind_result($idComentario)

				$x = 0;

				while ($stmt->fetch(){
					$comentarios["comentario" $x++] = $idComentario;
				}
			}
			else{
				throw new Exception("Erro na chamada do banco de dados", 5);	
			}

			return $comentarios;

		}

		function enviaMensagem(){ // Grava o topico e retorna a ID criada 

		}
	}


 ?>