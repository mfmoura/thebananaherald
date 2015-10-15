<?php 

	/**
	* Usuário do Site
	*/
	class usuario
	{
		
		function __construct($input)
		{
			if (is_array($input)){
				if (count($input) === 7){// Se possui exatamente sete argumentos, povoa o objeto
					
					$this->nome = $input[0]
					$this->email = $input[1];
					$this->nascimento = $input[2];
					$this->sexo = $input[3];
					$this->cidade = $input[4];
					$this->estado = $input[5];
					$this->pais = $input[6];
				}
			}
			else if(is_numeric($input)){ // Se é um número, procura a id no banco
				// a implementar
			}

		public $nome;
		public $email;
		public $nascimento;
		public $sexo;
		public $cidade;
		public $estado;
		public $pais;

		protected $numeroDeTopicos;
		protected $numeroDeComentarios;
		protected $pontosPositivos;
		protected $pontosNegativos;
		protected $banimento;
		protected $ativo

		private $ultimoLogin;
        

        public function registraNovo(){
        	// insere novo usuário no banco caso atenda os requisitos necessarios, respondendo sim ou não
		}

		public function validaAcesso(){
			// Valida o acesso e devolve as informações do usuário, ou atira uma excessão
		}
	}

	/**
	* Usuário moderador do site
	*/
	class moderador extends usuario
	{
		
		function __construct($input)
		{
			parent::__construct($input); //apenas chama o método construtor de usuário
		}

		public function validaStatus(){
			// Verifica no banco se é um administrador e devolve sim ou não
		}
	}

	/**
	* Usuário Administrador do site
	*/
	class administrador extends usuario
	{
		
		function __construct($input)
		{
			parent::__construct($input); //apenas chama o método construtor de usuário
		}

		public function validaStatus(){
			// Verifica no banco se é um administrador e devolve sim ou não
		}
	}



 ?>