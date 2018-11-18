<?php

	DEFINE ('BD_USUARIO', 'root');
	DEFINE ('BD_SENHA', '');
	DEFINE ('BD_SERVIDOR', 'localhost');
	DEFINE ('BD_NOME', 'admintable');

	try{
		$bdconecta = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_NOME);

		mysqli_set_charset($bdconecta, 'utf8');
	}catch(Exception $e){
		print "O sistema esta ocupado por favor tente mais tarde";
	}catch(Error $e){
		print "Ocorreu um erro. Mensagem: " . $e->getMessage();
		print "O sistema esta ocupado por favor tente mais tarde";
	}
?>