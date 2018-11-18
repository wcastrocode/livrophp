<?php
	session_start();//Acessa a sessão atual
	//Se a variável sessão não existir então redireciona o usuário

	if(!isset($_SESSION['nivel_usuario'])) {
		header('location:index.php');
		exit();
		//Cancela a sessão e redireciona o usuário
	}else{//destroi a sessão
		$_SESSION = array(); //Destroi as variáveis do array $_SESSION
		$params = session_get_cookie_params();
		// Destroi o cookie
		setcookie(session_name(), '', time()-42000, $params['path'], $params['domain'], 
			$params['secure'], $params['httponly']);
		if(session_status() == PHP_SESSION_ACTIVE){
			session_destroy(); // Destroi a própria sessão 
		}
		header("location:index.php");
	}

