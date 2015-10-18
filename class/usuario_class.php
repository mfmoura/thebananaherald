<?php 
	header('Content-Type: text/html; charset=utf-8');
	/**
	* Usuário do Site
	*/
	class usuario
	{

		// Nome, email e nascimento do usuário
		public $id = 0;
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
		public $ultimoLogin;

		// Usuario e senha, utilizados apenas para registrar novo usuario
		protected $usuario;
		protected $senha;

		function __construct($input){
			
			if(is_numeric($input)){ // Se é um número, procura a id no banco e popula o objeto
				$this->validaAcesso($input);
				return true;
			}
			if (preg_match("/{\"nome\":\"[\w ]{1,}\",\"email\":\"[\w@.]{1,}\",\"nascimento\":\"\d{4}(-\d{2}){2}\",\"sexo\":\"\d{1,}\",\"cidade\":\"\d{1,}\",\"estado\":\"\d{1,}\",\"pais\":\"\w{1,}\",\"usuario\":\"\w{1,}\",\"senha\":\"\w{32}\"}/", $input)){
				
				$assoc_array = json_decode($input, TRUE);

				$this->nome = $assoc_array["nome"];
				$this->email = $assoc_array["email"];
				$this->nascimento = $assoc_array["nascimento"];
				$this->sexo = $assoc_array["sexo"];
				$this->cidade = $assoc_array["cidade"];
				$this->estado = $assoc_array["estado"];
				$this->pais = $assoc_array["pais"];
				$this->usuario = $assoc_array["usuario"];
				$this->senha = $assoc_array["senha"];

				$this->registraNovo();
			}
			else {
				throw new Exception("Valores incorretos fornecidos na chamada da operação do usuário", 1);
			}
		}
        

        public function registraNovo(){ // Registra novo usuário comum
        	
			//Inicia uma conexão com o banco
			include("../config/conn.php");

        	$query = "CALL registranovousuario(?,?,?,?,?,?,?,?,?, @out_value);";


			if ($stmt = $conn->prepare($query)){
				$stmt->bind_param("sssiiiiss", $param1, $param2, $param3, $param4, $param5, $param6, $param7, $param8, $param9);
				
				$param1 = $this->nome;
				$param2 = $this->email;
				$param3 = $this->nascimento;
				$param4 = $this->sexo;
				$param5 = $this->cidade;
				$param6 = $this->estado;
				$param7 = $this->pais;
				$param8 = $this->usuario;
				$param9 = $this->senha;

			}
			else {
				throw new Exception("Erro na chamada do banco de dados", 5);
				die('Impossível preparar query: ' . $conn->error);
			}

			if ($stmt->execute()){
				$stmt2 = $conn->prepare("SELECT @out_value") or die('Impossível preparar query: ' . $conn->error);
				$stmt2->execute();
				$stmt2->bind_result($id);
				$stmt2->fetch();
				$this->id = $id;
			}
			else {
				echo $stmt->error . PHP_EOL;
				throw new Exception("Erro ao inserir novo usuário", 8);	
			}

		}

		public function validaAcesso($id){
			// Valida o acesso e devolve as informações do usuário, ou atira uma excessão caso não esteja ativo, esteja banido ou não exista

			//Inicia uma conexão com o banco
			include("../config/conn.php");

			$this->id = $id;

			$query = "SELECT 
					nome,
					email,
					nascimento,
					sexo,
					cidade,
					estado,
					pais,
					sexoNome,
					cidadeNome,
					estadoNome,
					paisNome,
					banimento,
					numeroDeComentarios,
					numeroDeTopicos,
					pontosPositivos,
					pontosNegativos,
					ultimoLogin,
					ativo 
				FROM
					viewUsuario 
				WHERE
					id = ?";

			if ($stmt = $conn->prepare($query)){
				$stmt->bind_param("s", $param1);
				$param1 = $id;
				$stmt->execute();
				$stmt->bind_result(
					$this->nome, 
					$this->email, 
					$this->nascimento,
					$this->sexo,
					$this->cidade,
					$this->estado,
					$this->pais,
					$this->sexoNome,
					$this->cidadeNome,
					$this->estadoNome,
					$this->paisNome,
					$banimento,
					$this->numeroDeTopicos,
					$this->numeroDeComentarios,
					$this->pontosPositivos,
					$this->pontosNegativos,
					$this->ultimoLogin,
					$this->ativo);
			}
			else {
				throw new Exception("Erro na chamada do banco de dados", 5);
			}

			if ($stmt->fetch()){

				if (!is_null($banimento)){
					$this->banimento = new datetime($banimento);
				}
				else{
					$this->banimento = new datetime("0000-00-00 00:00:00");
				}

				if (( ($this->banimento->getTimestamp() <= time()) AND ($this->ativo == 1)) OR ((is_null($this->banimento) AND ($this->ativo == 1)) )){
					return TRUE;
				}
				else if(( $this->banimento->getTimestamp() > time()) AND ($this->ativo == 1) ){
					throw new Exception("Este usuário está banido até " . $this->banimento->format("d/m/Y H:i:s"), 2);
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
		protected $moderador_ativo;
		public $sessoes;
		
		function __construct($input)
		{
			if (is_numeric($input)){
				if (parent::__construct($input)){ // Vê se é um usuário ativo
					$this->validaStatus($input);
				}
			}
		}

		public function validaStatus($id){
			//Inicia uma conexão com o banco
			include("../config/conn.php");

			$query = "SELECT 
					ativo, 
					sessoes
				FROM
					viewmoderadorsessoes 
				WHERE 
					id = ?";

			if ($stmt = $conn->prepare($query)){
				$stmt->bind_param("s", $param1);
				$param1 = $id;
				$stmt->execute();
				$stmt->bind_result($this->moderador_ativo, $sessoes);
			}
			else{
				throw new Exception("Erro na chamada do banco de dados", 5);
			}

			if ($stmt->fetch()) {
				if ($this->moderador_ativo == 1) {
					$sessoes = explode(",", $sessoes);

					foreach ($sessoes as $x => $sessao) {
						$this->sessoes["sessao".$x] = $sessao;
					}
				}
				else{
					throw new Exception("Este moderador está inativo", 7);
					
				}
			}
			else{
				throw new Exception("Este usuário não é um moderador", 6);
				
			}

		}
	}

	/**
	* Usuário Administrador do site
	*/
	class administrador extends usuario
	{
		
		public $administrador_ativo;

		function __construct($input){
			if (is_numeric($input)){
				if (parent::__construct($input)){ // Vê se é um usuário ativo
					$this->validaStatus($input);
				}
			}
		}

		public function validaStatus($id){ // Verifica no banco se é um administrador e devolve sim ou não

			//Inicia uma conexão com o banco
			include("../config/conn.php");

			$query = "SELECT 
					ativo
				FROM
					viewadministrador 
				WHERE 
					id = ?";

			if ($stmt = $conn->prepare($query)){
				$stmt->bind_param("s", $param1);
				$param1 = $id;
				$stmt->execute();
				$stmt->bind_result($this->administrador_ativo);
			}
			else{
				throw new Exception("Erro na chamada do banco de dados", 5);
			}

			if ($stmt->fetch()) {
				if ($this->administrador_ativo === 1) {
					return true;
				}
				else{
					throw new Exception("Este administrador está inativo", 8);
					
				}
			}
			else{
				throw new Exception("Este usuário não é um administrador", 6);
				
			}

		}
	}

 ?>