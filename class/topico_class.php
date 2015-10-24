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
		public $pontosPositivos = 0;
		public $pontosNegativos = 0;
		public $idAssunto;
		public $idSessao;
		protected $ativo;

		function __construct($input)
		{
			if (is_numeric($input)){
				$this->exibeTopico($input);
			}
			else if (preg_match("/{\"idUsuario\":\"\d{1,11}\",\"titulo\":\"\w{1,45}\",\"mensagem\":\"\w{1,1024}\",\"assunto\":\"\d{1,11}\",\"sessao\":{(\"sessao\d\":\"\d{1,11}\"(,|}))+}/", $input)){
				$this->enviaMensagem($input);

			}
			else {
				throw new Exception("Error Processing Request", 1);	
			}
		}

		private function exibeTopico($id){ // Exibe o tópico da ID referida
			include("../config/conn.php");

			$stmt = $conn->prepare("SELECT
					`usuario`,
					`titulo`,
					`mensagem`,
					`pontos_positivos`,
					`pontos_negativos`,
					`id_assunto`,
					`id_sessao`,
					`ativo`
				FROM 
					viewtopicos
				WHERE
					id = ?") or die ("Erro preparando a query" . $conn->error);
			
			$stmt->bind_param("i", $id);
			
			if ($stmt->execute()){
				
				// if ($stmt->num_rows == 0){
				// 	throw new Exception("Esse tópico não existe", 0);
					
				// }

				$stmt->bind_result(
					$idUsuario,
					$titulo,
					$mensagem,
					$pontosPositivos,
					$pontosNegativos,
					$idAssunto,
					$idSessao,
					$ativo);

				$stmt->fetch();

				$this->idUsuario = $idUsuario;
				$this->titulo = $titulo;
				$this->mensagem = $mensagem;
				$this->pontosPositivos = $pontosPositivos;
				$this->pontosNegativos = $pontosNegativos;
				$this->idAssunto = $idAssunto;
				$idSessao = explode(",", $idSessao);
				$this->ativo = $ativo;
				$this->id = $id;


				// Nomeia a array de sessões
				foreach ($idSessao as $key => $value) {
					$this->idSessao["sessao" . ($key+1)] = $value; 
				}
				

				if ($this->ativo === 0) {
					throw new Exception("Este tópico está inativo", 0);

				}

			}
			else{
				throw new Exception("Erro na chamada do banco de dados ", 5);
			}

		}

		private function enviaMensagem(){ // Grava o topico e retorna a ID criada 

			include("../config/conn.php");

			$stmt = $conn->prepare("CALL registranovotopico(?, ?, ?, ?, ?,@out)");
			$stmt->bind_param('issii', $this->idUsuario, $this->titulo, $this->mensagem, $this->idAssunto, $this->idSessao);

			if ($stmt->execute()){
				$stmt2 = $conn->prepare("SELECT @out");
				$stmt2->fetch();

				$smtp2->bind_result($this->id);
				$this->ativo = 1;

			}
			else {
				throw new Exception("Erro na chamada do banco de dados", 5);
			}
		}

		public function exibeComentarios($pagina, $mensagensPorPagina){ // Retorna uma array associativa com as IDs dos comentários da página requisitada
			include("../config/conn.php");

			$stmt = $conn->prepare("SELECT id FROM viewcomentario WHERE topico = ? LIMIT ?,?");
			$stmt->bind_param("iii", $this->id, ($pagina-1) * $mensagensPorPagina, ($pagina) * $mensagensPorPagina);

			if ($stmt->execute()){

				$stmt->bind_result($idComentario);

				$x = 0;

				while ($stmt->fetch()){
					$comentarios["comentario" . $x++] = $idComentario;
				}
			}
			else{
				throw new Exception("Erro na chamada do banco de dados", 5);	
			}

			return $comentarios;

		}

	}


 ?>