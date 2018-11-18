<?php

	//Este código de sessão protege a página e retorna todos os usuários não autorizados para a página de login.
	//Ninguém pode acessar a página, a menos que seja um administrador(user_level = 1)
	session_start();
	if(!isset($_SESSION['nivel_usuario']) || ($_SESSION['nivel_usuario'] != 1)){
		header("Location: login.php");
		exit();
	}
?>

<html lang="en">
	<head>
		  <title>Template for an interactive web page</title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		  <!-- Bootstrap CSS File -->
		  <link rel="stylesheet" 
		  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" 
		  integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" 
		  crossorigin="anonymous">
	</head>
	<body>
		<div class="container" style="margin-top:30px">
			<header class="jumbotron text-center row"
			style="margin-bottom:2px; background:linear-gradient(white, #0073e6); padding:20px;"> 
			    <?php include('topo-admin.php'); ?>
			</header>
			<div class="row" style="padding-left: 0px;">

		  		<nav class="col-sm-2">
		    		<ul class="nav nav-pills flex-column">
		    			<?php include('nav.php'); ?>
		    		</ul>
		    	</nav>

		    	<div class="col-sm-8">
			  		<h2 class="text-center">Estes são os usuários registrados</h2>
					<p>
						<?php
							try{ 
							//Este script recupera todas os registros de todos os usuarios da tabela.

								//Conectar ao banco de dados
								require('mysqli_conecta.php');
								
								//Fazer a consulta na tabela usuários
								$query = "SELECT ultimo_nome, primeiro_nome, email, ";

								//A função DATE_FORMAT formatará o date_registro recuperado da tabela no formato de dia, mes e ano.
								$query .= "DATE_FORMAT(data_registro, '%d %M %Y') ";

								//A instrução data_reg permite recuperar a data formatada
								$query .= "AS data_reg, id_usuario FROM usuarios "; 

								//Os registros da tabela serão exibidos em ordem crescente(ASC) por data de registro 
								$query .= "ORDER BY data_reg ASC";

								//Executa a consulta
								$resultado = mysqli_query($bdconecta, $query);

								//Se ocorreu bem, exibi os registros
								if($resultado){
									echo '<table class="table table-striped">
										<tr>
											<th scope="col">Editar</th>
											<th scope="col">Apagar</th>
											<th scope="col">Último Nome</th>
											<th scope="col">Primeiro Nome</th>
											<th scope="col">Email</th>
											<th scope="col">Data de Registros</th>
										</tr>
									';

									//O código percorre todos os dados da tabela do usuário(contidos em $resultado) até que todos os dados tenham sido exibidos
									//Os dados são colocados em um array associativo chamado $linha
									while($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
										//htmlspecialchars remove os caracteres que estejam na tabela
										//Um array associativo usa uma chave (como id_usuario) em vez de um índice(número) para determinar qual coluna usar
										//Essas chaves são criadas automaticamente usando os nomes das colunas da tabela no banco de dados
										$id_usuario = htmlspecialchars($linha['id_usuario'], ENT_QUOTES);
										$ultimo_nome = htmlspecialchars($linha['ultimo_nome'], ENT_QUOTES);
										$primeiro_nome = htmlspecialchars($linha['primeiro_nome'], ENT_QUOTES);
										$email = htmlspecialchars($linha['email'], ENT_QUOTES);
										$data_registro = htmlspecialchars($linha['data_reg'], ENT_QUOTES);

										//Os dois links a seguir se conectam as páginas editar_usuario.php e deletar_usuario.php
										//A URL dos links criados irão incluir um parametro id, que recebe o valor $id_usuario que veio da tabela Usuários
										echo '<tr>
										<td><a href="editar_usuario.php?id=' . $id_usuario . '">Editar</a></td>
										<td><a href="deletar_usuario.php?id=' . $id_usuario . '">Deletar</a></td>
										<td>' . $ultimo_nome . '</td>
										<td>' . $primeiro_nome . '</td>
										<td>' . $email . '</td>
										<td>' . $data_registro . '</td>
										</tr>';

										//O $id_usuario determina qual a linha editar ou excluir
									}

									echo '</table>';

									//Libera os recursos da memória 
									mysqli_free_result($resultado);
								}else{
									echo '<p class="error">Os usuarios atuais não foram recuperados. Nós desculpe';
									echo ' por qualquer inconveniente.</p>';
									exit;
								}

								mysqli_close($bdconecta);
							}catch(Exception $e){
								print "O sistema esta ocupado por favor tente mais tarde";
							}catch(Error $e){
								print "O sistema está ocupado por favor tente mais tarde.";
							}
						?>
					</p>
				</div>

				<aside class="col-sm-2">
					<?php include('info-col.php'); ?>
				</aside>
			</div>
		
			</footer class="jumbotron text-center row" style="padding-bottom:1px; padding-top:8px;">
				<?php include('rodape.php'); ?>
			</footer>
		</div>
	</body>
</html>