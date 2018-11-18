<?php
	//A função session_start permiti somente aqueles que estão devidamente logados com o acesso correto nivel_usuario(1) a página.
	session_start();
	//Se ele não estiverem devidamento logados ou não tiverem a permissao nivel_usuario(1), serão redirecionados para a página de login. 

	if(!isset($_SESSION['nivel_usuario']) or ($_SESSION['nivel_usuario'] != 1)){
		//Redireciona para a página de login
		header("Location: login.php");
		//Garante que os usuário não prossigam para o restante da página
		exit();
	}

?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
	  	<title>Template for an interactive web page</title>
	  	<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	  	<link rel="stylesheet" 
	  	href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" 
	  	integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" 
	  	crossorigin="anonymous">
	</head>
	<body>
		<div class="container" style="margin-top:30px">

			<header class="jumbotron text-center row" style="margin-bottom:2px; background:linear-gradient(white, #0073e6); padding:20px;">
				<?php include("topo-admin.php"); ?>
			</header>

			<div class="row" style="padding-left: 0px;">

				<nav class="col-sm-2">
					<ul class="nav nav-pills flex-column">
						<?php include('nav.php'); ?>
					</ul>
				</nav>

				<div class="col-sm-8">
					<h2 class="text-center">Esta é a página de administração</h2>
					<h3>Voce tem permissão para:</h3>
					<p>&#9632;Editar e Apagar um registro</p>
					<p>&#9632;Usar o botão Visuali
zar membros para percorrer todos os membros</p>
					<p>&#9632;Usar o botão Pesquisar para localizar um membro em particular</p>
					<p>&#9632;Usar o botão nova senha para mudar sua senha.</p>
				</div>

				<aside class="col-sm-2">
					<?php include("info-col.php"); ?>
				</aside>
			</div>

			<footer class="jumbotron text-center row" style="padding-bottom:1px; padding-top:8px;">
				<?php include('rodape.php'); ?>
			</footer>
		</div>
	</body>
</html>