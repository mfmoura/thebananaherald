<?php 

	#############################################
	#
	# CONFIGURAÇÕES DO SISTEMA
	# 
	# Neste arquivo ficam as configurações 
	# diversas do sistema.
	# 
	# Por favor, caso vá modificar somente alguma 
	# configuração, edite diretamente este 
	# arquivo, e não o código.
	# 
	#############################################


	// Configurações de banco

	// Os campos aqui citados são configurações do banco de dados
	// Modifique-os conforme sua necessidade

	// Endereço do banco:
	// Para a maioria dos sistemas, o endereço será 'localhost'
	// Caso o banco se encontre em outro servidor, que não o mesmo que o webhost
	// Modifique esta linha

	$endereco_banco = 'localhost';

	// Usuário e senha do banco
	// Recomenda-se criar um usuário e senha com acesso apenas às store procedures
	// e views do banco para utilizar o sistema. O sistema não precisa de acesso
	// de root para seu funcionamento. Isso aumenta a segurança do mesmo.

	$usuario_banco = 'root';
	$senha_banco = '';

	// Nome do banco
	// Por padrão, o script utilizará um banco chamado bananaherald
	// Caso não possa ser utilizado assim, especifique o novo banco

	$nome_banco = 'bananaherald';

	// Porta do MySQL
	// Padrão é 3306, modifique caso seja necessário

	$porta_banco = '3306';





 ?>