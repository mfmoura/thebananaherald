<?php 

	/**
	* Classe de sessões do site
	*/
	class sessao
	{
		public $id;
		public $nome;
		public $adminCriador;
		protected $ativo;

		function __construct($input)
		{
			if (is_numeric($input)){
				$this->exibeSessao($input);

			}
			else (preg_match("/{\"Nome\":\"(\w )+\",\"AdminCriador\":\"\d+\"}/", $input)){
				$this->enviaSessao($input);

			}
		}

		function exibeSessao($id){
			include("../config/conn.php");

			$stmt = $conn->prepare("SELECT `nome`, `admin_criador`, `ativo` FROM viewsessao WHERE id = ?");
			$stmt->bind_param("i", $id) or die ("Erro ao preparar a chamada: " . $conn->error);

			if ($stmt->execute()){

				$stmt->bind_result($nome, $adminCriador, $ativo);
				if (!is_null($stmt->fetch()){

					$this->id = $id;
					$this->nome = $nome;
					$this->adminCriador = $adminCriador;
					$this->ativo = $ativo;

					if ($this->ativo === 0){
						throw new Exception("Esta sessão inativa", 10);					
					}
				}
				else {
					throw new Exception("Essa sessão não existe", 11);
					
				}


			}
			else{
				throw new Exception("Erro na chamada do banco de dados", 5);
				
			}
		}

		function enviaSessao($json){
			$arr = json_decode($json);

			include("../config/conn.php");

			$stmt = $conn->prepare("CALL inserenovasessao(?,?,@out);") or die ("Erro ao preparar a chamada: " . $conn->error);
			$stmt->bind_param("si", $param1, $param2);

			$param1 = $arr[0];
			$param2 = $arr[1];

			if ($stmt->execute()){

				$stmt2 = $conn->prepare("SELECT @out") or die("Erro ao preparar a chamada: " . $conn->error);

				if ($stmt2->execute()){
					if (!is_null($stmt2->bind_result($id)){
						$this->id = $id;
						$this->nome = $arr[0];
						$this->adminCriador = $arr[1];
						$this->ativo = 1;
					}
				}
			}
		}

		public exibeAssuntos($id, $pagina, $assuntosPorPagina){ // Exibe os assuntos dentro dessa sessão, por página e retorna em uma array
			include("../config/conn.php");

			$stmt = $conn->prepare("SELECT id FROM viewassuntos WHERE sessao REGEXP '(^|,)?(,|$)' LIMIT ?,?");
			$stmt->bind_param("iii", $this->id, ($pagina-1) * $assuntosPorPagina, ($pagina) * $assuntosPorPagina);

			if ($stmt->execute()){

				$stmt->bind_result($idAssunto);

				$x = 0;

				while ($stmt->fetch()){
					$assuntos["assunto" . $x++] = $idAssunto;
				}
			}
			else{
				throw new Exception("Erro na chamada do banco de dados", 5);	
			}

			return $assuntos;
		}
	}
 ?>