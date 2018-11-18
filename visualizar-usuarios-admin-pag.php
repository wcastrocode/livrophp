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
							require ("visualizar-usuarios-admin-processo.php");
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