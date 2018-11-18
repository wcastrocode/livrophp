<?php
	session_start();
	if(!isset($_SESSION['nivel_usuario'])){
		header("Location: login.php");
		exit();
	}
?>

<!DOCTYPE html>
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
						require("mysqli_conecta.php");
						
						$query = "SELECT CONCAT(ultimo_nome, ', ', primeiro_nome) AS nome, ";
						$query .= "DATE_FORMAT(data_registro, '%d %M %Y') AS datareg ";
						$query .= "FROM usuarios ORDER BY data_registro DESC";
						$resultado = mysqli_query($bdconecta, $query);
						if($resultado){
							echo   '<table class="table table-striped"><tr><th scope="col">Nome</th><th scope="col">Data de Registro</tr></th>';
							
							while ($row = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
								echo '<tr><td>' . $row['nome'] . '</td><td>' .$row['datareg'] . '</td></tr>';
							}

							echo '</table>';
							mysqli_free_result($resultado);
						}else{
							echo '<p class="error">Não foi possível exibir os usuários. Nós pedimos desculpas';
							echo ' por qualquer inconveniente.</p>';
							exit;
						}

						mysqli_close($bdconecta);
					}catch(Exception $e){
						print "O sistema está indisponível tente mais tarde";
					}catch(Error $e){
						print "O sistema está indisponível tente mais tarde";
					}
				?>
			</p>
		</div>
		<footer class="jumbotron text-center row" style="padding-bottom:1px; padding-top:8px;">
			<?php include('rodape.php'); ?>
		</footer>
	</div>
	</body>
</html>
