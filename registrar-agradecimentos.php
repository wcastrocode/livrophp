<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<title>Obrigado pelo Registro</title>
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
				<?php include('topo-agradecimentos.php'); ?>
			</header>
			<div class="row" style="padding-left: 0px;">
		
			    <nav class="col-sm-2">
			      <ul class="nav nav-pills flex-column">
			      	<?php include('nav.php'); ?>
			  	  </ul>
			    </nav>

			    <div class="col-sm-8 text-center">
					<h2>Obrigado por se registrar</h2>
					Na página inicial, você poderá fazer login e adicionar novas cotações ao quadro de mensagens.
				  </div>

				<aside class="col-sm-2">	
					<?php include('info-col.php'); ?>
				</aside>
			</div>
			<footer class="jumbotron text-center row"style="padding-bottom:1px; padding-top:8px;">
				<?php include'rodape.php'; ?>
			</footer>
		</div>
	</body>
</html>