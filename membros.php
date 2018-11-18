<?php
	//Todo código de sessão deve ficar no topo da página
	session_start();
	//Se a sessao não existir ou se o nível do usuário não for igual a 1, o usuário sera enviado de volta a página de login.
	if(!isset($_SESSION['nivel_usuario']) or ($_SESSION['nivel_usuario'] != 0)){
		header("Location: login.php");
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
				<?php include("topo-membros.php"); ?>
			</header>

			<div class="row" style="padding-left: 0px;">

				<nav class="col-sm-2">
					<ul class="nav nav-pills flex-column">
						<?php include('nav.php'); ?>
					</ul>
				</nav>

				<div class="col-sm-8">
					<h2 class="text-center">This is the Member's Page</h2>
					<p>The members page content. The members page content. The members page content. 
					<br>The members page content. The members page content. The members page content.
					<br>The members page content. The members page content. The members page content.
					<br>The members page content. The members page content. The members page content.
					</p>
					<p class="h3 text-center">Special offers to members only.</p>
		    		<p class="text-center"><strong>T-Shirts 10.00</strong></p>
					<img class="mx-auto d-block" src="images/polo.png" alt="Polo Shirt"> 
					<br>
				</div>

				<aside class="col-sm-2">
					<?php include('info-col.php'); ?>
				</aside>
			</div>
			<footer class="jumbotron text-center row" style="padding-bottom:1px; padding-top:8px;">
				<?php include('rodape.php'); ?>
			</footer>
		</div>
	</body>
</html>

