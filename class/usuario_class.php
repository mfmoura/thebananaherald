<?php 
	header('Content-Type: text/html; charset=utf-8');
	/**
	* Usuário do Site
	*/
	class usuario
	{

		// Nome, email e nascimento do usuário
		public $id;
		public $nome;
		public $email;
		public $nascimento;

		// ID do sexo, da cidade, do estado e do país do usuário
		public $sexo;
		public $cidade;
		public $estado;
		public $pais;

		// Nomes validados do sexo, da cidade, do estado e do país do usuário
		public $sexoNome;
		public $cidadeNome;
		public $estadoNome;
		public $paisNome;

		// Somas diversas a serem exibidas no perfil do usuário
		protected $numeroDeTopicos;
		protected $numeroDeComentarios;
		protected $pontosPositivos;
		protected $pontosNegativos;
		

		// Status do usuário - Até quando está banido e se está ativo no site
		protected $banimento;
		protected $ativo;

		// Ultima vez que o usuário se logou
		private $ultimoLogin;

		function __construct($input){
			if (is_array($input)){
				if (count($input) === 7){// Se possui exatamente sete argumentos, popula o objeto
					
					$this->nome = $input[0];
					$this->email = $input[1];
					$this->nascimento = $input[2];
					$this->sexo = $input[3];
					$this->cidade = $input[4];
					$this->estado = $input[5];
					$this->pais = $input[6];
				}
			}
			else if(is_numeric($input)){ // Se é um número, procura a id no banco e popula o objeto
				$this->validaAcesso($input);
			}
			else {
				throw new Exception("Valores incorretos fornecidos", 1);				
			}

			return null;
		}
        

        public function registraNovo(){
        	$query = "CALL ";
		}

		public function validaAcesso($id){

			//Inicia uma conexão com o banco
			include("../config/conn.php");

			// Valida o acesso e devolve as informações do usuário, ou atira uma excessão caso não esteja ativo, esteja banido ou não exista
			$this->id = $id;
			$query = "SELECT nome, email, nascimento, sexo, cidade, estado, pais, sexoNome, cidadeNome, estadoNome, paisNome, banimento, numeroDeComentarios, numeroDeTopicos, pontosPositivos, pontosNegativos, ultimoLogin, ativo FROM viewUsuario WHERE id = ?";
			if ($stmt = $conn->prepare($query)){
				$stmt->bind_param("s", $param1);
				$param1 = $id;
				$stmt->execute();
				$stmt->bind_result($this->nome, $this->email, $this->nascimento, $this->sexo, $this->cidade, $this->estado, $this->pais, $this->sexoNome, $this->cidadeNome, $this->estadoNome, $this->paisNome, $this->banimento, $this->numeroDeTopicos, $this->numeroDeComentarios, $this->pontosPositivos, $this->pontosNegativos, $this->banimento, $this->ativo);
			}
			else {
				throw new Exception("Erro na query", 5);
			}

			if ($stmt->fetch()){
				if ((($this->banimento > date("Y-m-d H:i:s") OR  is_null($this->banimento))) AND ($this->ativo == 1)){
					return TRUE;
				}
				else if($this->banimento < date("Y-m-d H:i:s")){
					throw new Exception("Este usuário está banido até " . $this->banimento, 2);
				}
				else if ($this->ativo == 0){
					throw new Exception("Este usuário está inativo", 3);
					
				}
			}
			else {
				throw new Exception("Este usuário não existe", 4);
			}

			$stmt->close();
		}
	}

	/**
	* Usuário moderador do site
	*/
	class moderador extends usuario
	{
		
		function __construct($input)
		{
			if (is_numeric($input)){
				if (parent::__construct($input)){ // Vê se é um usuário ativo
					$this->validaStatus($input);
				}
			}
		}

		public function validaStatus(){
			// Verifica no banco se é um administrador e de quais sessões
			return "TESTE!";
		}
	}

	/**
	* Usuário Administrador do site
	*/
	class administrador extends usuario
	{
		
		function __construct($input){
			if (is_numeric($input)){
				if (parent::__construct($input)){ // Vê se é um usuário ativo
					$this->validaStatus($input);
				}
			}
		}

		public function validaStatus(){
			// Verifica no banco se é um administrador e devolve sim ou não
		}
	}



 ?>