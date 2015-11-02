<?php 

	/**
	* Insere e recupera assuntos do site
	*/
	class assunto
	{
		public $id;
		public $nome;
		public $adminCriador;
		public $sessao;
		protected $ativo

		function __construct($input)
		{
			if (is_numeric($input)){
				$this->exibeSessao($input);
			}
			else if (preg_match("/{\"Nome\":\"[\w ]+\",\"AdminCriador\":\"\d+\",\"sessoes\":{(\"sessao\d+\":\"\d+\",)*(\"sessao\d+\":\"\d+\"})}}/", $input)){
				$this->enviaSessao($input);
			}
		}
	}

	public exibeSessao($id){ // Popula o objeto com os atributos da sessão
		
		include("../config/conn.php");

		$stmt = $conn->prepare("SELECT
			`nome`,
			`admin_criador`,
			`nota`,
			`sessao`,
			`ativo`
		FROM 
			viewassuntos
		WHERE
			id = ?") or die ("Erro preparando a query" . $conn->error);

		$stmt->bind_param("i", $id);

		if ($stmt->execute()){

			$stmt->bind_result($nome, $admin, $nota, $sessao, $ativo);
			$stmt->fetch();

			$this->id = $id;
			$this->nome = $nome;
			$this->admin_criador = $admin;
			$this->nota = $nota;
			$this->sessao = explode(",", $sessao)
			$this->ativo = $ativo
		}
		else{
			throw new Exception("Erro na chamada do banco de dados", 5);
		}


	}

	public enviaSessao($json){ // Insere nova sessão e devolve a ID

		include("../config/conn.php");

		$arr = json_decode($json);

		$stmt = $conn->prepare("CALL inseresessao(?, ?, @out)") or die ("Erro preparando a query: " . $conn->error);
		$stmt->bind_param("si", $nome, $adminCriador)

		$nome = $arr[0];
		$adminCriador = $arr[1];

		if ($stmt->execute()){
			$stmt2 = $conn->prepare("SELECT @out")
			$stmt2->execute();
			$stmt2->bind_result($id);
			$stmt2->fetch();

			$this->id = $id;
			$this->ativo = "1";

			$stmt3 = $conn->prepare("CALL insereassuntosessao(?,?)");

			$stmt3->bind_param("ii", $paramAssunto, $paramSessao);
			$paramAssunto = $this->id;

			foreach ($arr[3] as $sessao) {
				$paramSessao = $sessao;
				$stmt3->execute() or die ("Erro inserindo assunto nas sessões: " . $conn->errors);
			}

			$this->sessao = $arr[3];

		}
		else {
			throw new Exception("Erro na chamada do banco de dados", );
		}
	}

	public exibeTopicos($id, $pagina, $topicosPorPagina){ // Exibe os topicos dentro desse assunto, por página e retorna em uma array
		include("../config/conn.php");

		$stmt = $conn->prepare("SELECT id FROM viewtopicos WHERE id_assunto = ? LIMIT ?,?");
		$stmt->bind_param("iii", $this->id, ($pagina-1) * $mensagensPorPagina, ($pagina) * $mensagensPorPagina);

		if ($stmt->execute()){

			$stmt->bind_result($idTopico);

			$x = 0;

			while ($stmt->fetch()){
				$topicos["topico" . $x++] = $idTopico;
			}
		}
		else{
			throw new Exception("Erro na chamada do banco de dados", 5);	
		}

		return $topicos;
	}

 ?>