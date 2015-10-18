<?php 

	header('Content-type: text/plain; charset=utf-8');
	setlocale(LC_ALL, "pt_BR");

	/**
	* Consulta as informações de login de um usuário
	*/
	class login
	{
		public $id;
		public $login;
		protected $senha;
		public $ativo;
		
		function __construct($login, $senha){
			$this->login = $login;
			$this->senha = $senha;

			$this->loginUsuario($this->login, $this->senha);
		}

		function loginUsuario($login, $senha){
			include ("../config/conn.php");

			$stmt = $conn->prepare("SELECT `id`, `ativo`  FROM login_geral WHERE `login` = ? AND `senha` = ?") or die;
			$stmt->bind_param("ss", $login, $senha);
			
			if ($stmt->execute()){

				$stmt->bind_result($this->id, $this->ativo);
				$stmt->fetch();
			}
			else {
				throw new Exception("Erro na chamada do banco de dados", 5);
				
			}

			if ($this->ativo === 0) {
				throw new Exception("Este usuário está inativo", 3);
			}
			else if (is_null($this->id)){
				throw new Exception("Não foi possível entrar no sistema: Verifique seu usuário e sua senha e tenta novamente", 9);
				
			}
		}
	}

 ?>