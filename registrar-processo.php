<?php

	//Este script é uma consulta que insere um registro na tabela de usuários.
	//Verifica se o formulário foi enviado:
	try{ 
		$erros = array();
		
		$primeiro_nome = filter_var( $_POST['primeiro_nome'], FILTER_SANITIZE_STRING);
		//Verificar se o campo primeiro nome está vazio, removendo o espaço para fazer o teste;
		if(empty($primeiro_nome)){
			$erros[] = 'Voce esqueceu de digitar o seu primeiro nome.';
		}
		
		$ultimo_nome = filter_var($_POST['ultimo_nome'], FILTER_SANITIZE_STRING);
		//Verificar se o campo último nome está vazio, removendo o espaço para fazer o teste;
		if(empty($ultimo_nome)){
			$erros[] = 'Voce esqueceu de digitar o seu ultimo nome.';
		}

		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		//Verificar se o campo email está vazio, removendo o espaço para fazer o teste;
		if(empty($email)){
			$erros[] = 'Voce esqueceu de digitar o seu endereco de e-mail.';
		}
		
		$senha1 = filter_var($_POST['senha1'], FILTER_SANITIZE_STRING);
		$senha2 = filter_var($_POST['senha2'], FILTER_SANITIZE_STRING);
		//Verificar se o campo senha está vazio, removendo o espaço para fazer o teste;
		if(!empty($senha1)){

			//Verificar se a senha corresponde a senha confirmado.
			if($senha1 !== $senha2){
				$erros[] = 'Sua duas senhas nao correspondem.';
			}

		}else{
			$erros[] = 'Voce esqueceu de digitar a sua senha.';
		}

		if(empty($erros)){ //Se tudo estiver certo, senão há nenhum erro. 
			try{

				//Gerar uma senha de 60 caracteres
				$senha_hash = password_hash($senha1, PASSWORD_DEFAULT);
				
				//Estabelecer conexão
				require ('mysqli_conecta.php');
				
				//Registrar o usuário no banco de dados
				$query = "INSERT INTO usuarios (primeiro_nome, ultimo_nome, email, senha, data_registro)";
				$query .= "VALUES(?, ?, ?, ?, NOW())";
				
				$q = mysqli_stmt_init($bdconecta);
				
				mysqli_stmt_prepare($q, $query);
				//Essa função garanti que apenas o texto seja inserido.
				//vincula campos a uma instrução SQL
				
				mysqli_stmt_bind_param($q, 'ssss', $primeiro_nome, $ultimo_nome, $email, $senha_hash);

				//Executa a consulta
				mysqli_stmt_execute($q);
				
				if(mysqli_stmt_affected_rows($q) == 1){
					//Um registro inserido
					header ("location: registrar-agradecimentos.php");
					exit();
				}else{//Se o registro não for inserido
					$errorstring = "<p class='text-center col-sm-8' style='color:red'>";
					$errorstring .= "Erro do sistema<br />Voce não pode ser registrado devido";
					$errorstring .= "a um erro do sistema. Pedimos desculpas por qualquer inconveniente.</p>"; 
					echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
					}
					echo '<p>' . mysqli_error($bdconecta) . '<br><br>Consulta: ' .$query . '</p>';
					mysqli_close($bdconecta);
					echo '<footer class="jumbotron text-center col-sm-12"
					style="padding-bottom:1px; padding-top:8px;">';
					include("footer.php"); 
					echo '</footer>';
					exit();
				}catch(Exception $e){
					print "O sistema esta indisponivel no momento tente mais tarde";
				}catch(Error $e){
					print "O sistema esta indisponivel no momento tente mais tarde";
				}
			}else{
				$errorstring = "Erro! <br/> Ocorreu os seguintes erros:<br/>";
				foreach($erros as $msg){
					$errorstring .= " - $msg<br>\n";
				}
				$errorstring .= "Por favor tente de novo.<br>";
				echo "<p class='text-center col-sm-2' style='color:red'>$errorstring</p>";
			}
		}catch(Exception $e) // We finally handle any problems here   
		   {
		     // print "An Exception occurred. Message: " . $e->getMessage();
		     print "The system is busy please try later";
		   }
		   catch(Error $e)
		   {
		      //print "An Error occurred. Message: " . $e->getMessage();
		      print "The system is busy please try again later.";
		   }
		
?>
