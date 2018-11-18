<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modelo para uma pagina web interativa</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" 
     crossorigin="anonymous">
	<script src="verificarSenha.js"></script>
</head>
<body>
	<div class="container" style="margin-top:30px">
	
		<header class="jumbotron text-center row col-sm-14" style="margin-bottom:2px; background:linear-gradient(white, #0073e6); padding:20px;"> 
			<?php include('topo-login.php'); ?>
		</header>
		
		<div class="row" style="padding-left: 0px;">
			<nav class="col-sm-2">
				<ul class="nav nav-pills flex-column">
					<?php include('nav.php'); ?>
				</ul>
			</nav>

			<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST'){
					require('login-processo.php');
				}
			?>

			<div class="col-sm-8">
				<h2 class="h2 text-center">Registrar</h2>
				<form action="login.php" method="post" name="form-login" id="form-login">
					<div class="form-group row">

						<label for="email" class="col-sm-4 col-form-label">Endereço de Email: </label>
						<div class="col-sm-8">	
							<input type="text" class="form-control" id="email" name="email" placeholder="Email" maxlength="30" required value="<?php
								if(isset($_POST['email'])) 
								echo $_POST['email']; 
							?>">
						</div>

					</div>
					<div class="form-group row">
						
						<label for="senha" class="col-sm-4 col-form-label">Senha: </label>
						<div class="col-sm-8">	
							<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" maxlength="40" required value="<?php
								if(isset($_POST['senha']))
								echo $_POST['senha'];
							?>">
						</div>

					</div>

					<div class="form-group row">

						<div class="col-sm-12">
							<input id="enviar" class='btn btn-primary' type="submit" name="enviar" value="Login">
						</div>

					</div>
				</form>	
			</div>
			
			<?php
				if(!isset($errorstring)){
					echo '<aside class="col-sm-2">';
					include('info-col.php');
					echo '</aside>';
					echo '</div>';
					echo '<footer class="jumbotron text-center row col-sm-14" style="padding-bottom:1px; padding-top:8px;">';
					include("rodape.php");
				}else{
					echo '<footer class="jumbotron text-center col-sm-12" style="paddin-bottom:1px; padding-top:8px;">';
					include("rodape.php");
				}
			 ?>
		</div>
	
		</footer>
	</div>
</body>
</html>