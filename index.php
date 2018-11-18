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

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modelo para uma pagina web interativa</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" 
     crossorigin="anonymous">
</head>
<body>
	<div class="container" style="margin-top:30px">
	
		<header class="jumbotron text-center row" style="margin-bottom:2px; background:linear-gradient(white, #0073e6); padding:20px;"> 
			<?php
				if($_SESSION['nivel_usuario'] != 1){
					include('topo.php');
				}else{
					include('topo-admin.php');
				}	
			?>
			
		</header>
		
		<div class="row" style="padding-left: 0px;">
			<nav class="col-sm-2">
				<ul>
					<?php include('nav.php'); ?>
				</ul>
			</nav>
			<div class="col-sm-8">
				<h2 class="text-center">
					This is the Home Page
				</h2>
				<p>The home page content. The home page content. The home page content. The home page content. <br>
				The home page content. The home page content. The home page content. The home page content. <br>
				The home page content. The home page content. <br>
				The home page content. The home page content. The home page content. </p>
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