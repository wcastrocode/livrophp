<?php

	//Este script é uma consulta que atualiza a senha na tabela usuarios.
	//Verifique se formulário foi enviado:
	require("mysqli_conecta.php"); //Conectar ao banco de dados
	$erros = array();//Inicializa um arrar de erros

	//Remove espaços em branco dos campos e armazena o seu conteúdo em variáveis
	$email = trim($_POST['email']);
	$senha = trim($_POST['senha1']);
	$nova_senha = trim($_POST['senha2']);
	$senha_verificacao = trim($_POST['senha3']);

	//Verifica se o usuário digitou o seu email
	if(empty($email)){
		$erros[] = 'Voce esqueceu de digitar o seu email.';
	}
	
	//Verifica se o usuário digitou a sua senha
	if(empty($senha)){
		$erros[] = 'Voce esqueceu de digitar a sua senha.';
	}

	if (!empty($nova_senha)){
		if (($nova_senha != $senha_verificacao) || ($senha == $nova_senha)){
			$erros[] = 'Sua nova senha não corresponde a senha confirmada.';
			$erros[] = 'Sua antiga senha é igual a nova senha.';
		}
	}else{
			$erros[] = "Voce nao digitou uma nova senha.";
	}

	if(empty($erros)){
		try{
		//Verifica se o usuário digitou o email/senha correto.
			$query = "SELECT id_usuario, senha FROM usuarios WHERE email=?";

			$q = mysqli_stmt_init($bdconecta);
			
			//Função usada para assegurar que somente texto seja inserido
			mysqli_stmt_prepare($q, $query);

			mysqli_stmt_bind_param($q, 's', $email);

			mysqli_stmt_execute($q);

			$resultado = mysqli_stmt_get_result($q);
			$registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

			if((mysqli_num_rows($resultado) == 1) 
				&& (password_verify($senha, $registro['senha']))){
				
				$senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

				$query = "UPDATE usuarios SET senha=? WHERE email=?";
				$q = mysqli_stmt_init($bdconecta);
				mysqli_stmt_prepare($q, $query);

				mysqli_stmt_bind_param($q, 'ss', $senha_hash, $email);

				mysqli_stmt_execute($q);

				if(mysqli_stmt_affected_rows($q) == 1){
					header ("location: alterar-senha-agradecimentos.php");
					exit;
				}else {
					$errorstring = "Erro no sistema! <br/> Voce não pode alterar a senha devido ";
					$errorstring .= "a um erro no sistema. Nós pedimos desculpa por qualquer incoveniencia.</p>";
					echo "<p class='text-center col-sm-2' style='color:red'>$errorstring</p>";
					echo '<footer class="jumbotron text-center col-sm-12"
			        style="padding-bottom:1px; padding-top:8px;">
		            include("footer.php"); 
		            </footer>';
				    exit();
				}
			}else {
				$errorstring = 'Erro! <br /> ';
		        $errorstring .= 'O endereço de email e/ou a senha não correspondem aos do arquivo.';
		        $errorstring .= "Por favor, tente novamente.";
		        echo "<p class = 'centro de texto col-sm-2' style = 'cor: vermelho'> $ errorstring </ p>";
			}
		}catch(Exception $e){
			print "O sistema está ocupado por favor tente mais tarde";
		}catch(Error $e){
			      print "O sistema esta ocupado por favor tente mais tarde";
		}
	} else { 
			$errorstring = "Error! The following error(s) occurred:<br>";
			foreach ($erros as $msg) { 
				$errorstring .= " - $msg<br>\n";
			}
			$errorstring .= "Please try again.<br>";
			echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
	}
?>
