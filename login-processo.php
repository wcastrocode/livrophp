<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	try{
		require('mysqli_conecta.php');

		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		if((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))){
			$erros[] = 'Você esqueceu de digitar o seu endereço de email';
			$erros[] = ' ou o e-mail está incorreto.';
		}

		$senha = filter_var($_POST['senha'], FILTER_SANITIZE_STRING);
		if(empty($senha)){
			$erros[] = "Você esqueceu de digitar a sua senha.";
		}

		if(empty($erros)){
			//Seleciona os dados do banco de dados
			$query = "SELECT id_usuario, senha, primeiro_nome, nivel_usuario FROM usuarios WHERE email = ?";

			$q = mysqli_stmt_init($bdconecta);

			mysqli_stmt_prepare($q, $query);

			//Atribui a variável $email na instrução SQL
			mysqli_stmt_bind_param($q, "s", $email);

			//Executa a consulta
			mysqli_stmt_execute($q);

			$resultado = mysqli_stmt_get_result($q);

			$registro = mysqli_fetch_array($resultado, MYSQLI_NUM);

			if(mysqli_num_rows($resultado) == 1){
				if(password_verify($senha, $registro[1])){
					//Uma sessão é criada se o email e a senha estiverem corretos
					session_start();

					//O nível_usuario que foi recuperado do banco de dados é armazenado em uma variável de sessão temporária no servidor para ser usado em páginas privadas.
					//(int) assegura-se de que o nível de usuário seja um inteiro.
					$_SESSION['nivel_usuario'] = (int) $registro[3];
					$url = ($_SESSION['nivel_usuario'] === 1) ? 'admin.php' : 'membros.php';
					header("Location: " . $url);
				}else {
					$erros[] = "E-mail/Senha inserido não corresponde aos nossos registros";
					$erros[] = "Talvez você precise se registrar, basta clicar no botão registrar";
					$erros[] = "no menu cabeçalho";
				}
			}else {
				$erros[] = "E-mail/Senha inserido não corresponde aos nossos registros";
				$erros[] = "Talvez você precise se registrar, basta clicar no botão registrar";
				$erros[] = "no meno cabeçalho";
			}
		}

		if (!empty($erros)){
			$errostring = "Erro! <br/> Ocorreu o seguinte erro(s)<br>";

			foreach($erros as $msg){
				$errostring .= " $msg<br>";
			}

			$errostring = "Por favor tente novamente.<br>";
			echo "<p class='text-center col-sm-2 style='color:red'>$errostring</p>";
		}

		mysqli_stmt_free_result($q);
		mysqli_stmt_close($q);		
	}catch(Exception $e){
		print "O sistema está ocupado por favor tente mais tarde";
	}catch(Error $e){
		print "O sistema está ocupado por favor try again later.";
	}

}
?>