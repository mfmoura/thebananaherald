<?php 

	header('Content-type: text/plain; charset=utf-8');
	setlocale(LC_ALL, "pt_BR");

	/**
	* Loga o usuário e devolve um cookie
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

			$stmt = $conn->prepare("SELECT id, ativo FROM login_geral WHERE login = ? AND senha = ?") or die;
			$stmt->bind_param("ss", $login, $senha);
			
			if ($stmt->execute()){

				$stmt->bind_result($id, $ativo);
				$stmt->fetch();

				$this->$id = $id;
				$this->ativo = $ativo;

			}
			else {
				throw new Exception("Erro na chamada do banco de dados", 5);
				
			}

			if ($this->ativo == 0) {
				throw new Exception("Este moderador está inativo", 7);
			}
		}
	}

 ?>