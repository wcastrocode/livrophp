<?php
	try{
		require('mysqli_conecta.php');

		$linhasPagina = 4;

		if((isset($_GET['p']) && is_numeric($_GET['p']))){
			$paginas = htmlspecialchars($_GET['p'], ENT_QUOTES);
		}else{
			$q = "SELECT COUNT(id_usuario) FROM usuarios";

			$resultado = mysqli_query ($bdconecta, $q);

			$linha = mysqli_fetch_array ($resultado, MYSQLI_NUM);

			$registros = htmlspecialchars($linha[0], ENT_QUOTES);

			if($registros > $linhasPagina){
				$paginas = ceil ($registros/$linhasPagina);
			}else{
				$paginas = 1;
			}

			if((isset($_GET['s'])) && (is_numeric($_GET['S']))){
				$inicio = htmlspecialchars($_GET['s'], ENT_QUOTES);
			}else{
				$inicio = 0;
			}

			$query = "SELECT ultimo_nome, primeiro_nome, email, ";

			$query .= "DATE_FORMAT(data_registro, '%d %M %Y')";

			$query .= " AS data_reg, id_usuario FROM usuarios ORDER BY data_registro";

			$query .= " LIMIT ?, ?";

			$q = mysqli_stmt_init($bdconecta);

			mysqli_stmt_prepare($q, $query);

			mysqli_stmt_bind_param($q, "ii", $inicio, $linhaPagina);

			$resultado = mysqli_stmt_get_result($q);

			if($resultado){
				echo '<table class="table table-striped">
					 <tr>
					 	<th scope="col">Editar</th>
					 	<th scope="col">Apagar</th>
					 	<th scope="col">Último Nome</th>
					 	<th scope="col">Primeiro Nome</th>
					 	<th scope="col">Email</th>
					 	<th scope="col">Data de Registro</th>
					 </tr>';

				while ($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

					$id_usuario = htmlspecialchars($linha['id_usuario'], ENT_QUOTES);
					$ultimo_nome = htmlspecialchars($linha['ultimo_nome'], ENT_QUOTES);
					$primeiro_nome = htmlspecialchars($linha['primeiro_nome'], ENT_QUOTES);
					$email = htmlspecialchars($linha['email'], ENT_QUOTES);
					$data_registro = htmlspecialchars($linha['data_registro'], ENT_QUOTES);
					echo '<tr>
						  <td><a href="editar_usuario.php?id=' . $id_usuario . '">Editar</a></td>
						  <td><a href="deletar_usuario.php?id=' . $id_usuario . '">Delete</a></td>
						  <td>' . $ultimo_nome . '</td>
						  <td>' . $primerio_nome. '</td>
						  <td>' . $email . '</td>
						  <td>' . $data_registro . '</td>
						  </tr>';
					}
					echo '</table>';

					mysqli_free_result($resultado);
		/*	}else{
				echo '<p class="text-center"> Os usuários não podem ser recuperados. Nós desculpe';
				echo ' por qualquer inconveniente.</p>';

				exit;
			}

			$q = "SELECT COUNT(id_usuario) FROM usuarios";

			$resultado = mysqli_query ($bdconecta, $q);

			$linha = mysqli_fetch_array($resultado, MYSQLI_NUM);

			$membros = htmlspecialchars($linha[0], ENT_QUOTES);

			mysqli_close($bdconecta);

			$echostring = "<p class='text-center'>Total Membros Registrados: $membros </p>";
			$echostring = "<p class='text-cener'>";

			if($paginas > 1){

				$pagina_atual = ($inicio/$paginalinhas) + 1;

				if($pagina_atual != 1){
					$echostring .= '<a href="visualizar-usuarios-admin.php?s=' . ($inicio - $linhaPaginas) . '&p=' . $paginas . '">Anterios</a> ';
				}

				if($pagina_atual != $paginas){
					$echostring .= '<a href="visualizar-usuarios.admin.php?s=' . ($inicio + $linhaPaginas) . '&p=' . $paginas . '">Próximo</a> ';
				}

				$echostring .= '</p>';
				echo $echostring;*/
			}
		}
	}catch(Exception $e){
		print "O sistema está ocupado por favor tente mais tarde";
	}catch(Error $e){
		print "O sistema esta ocupado por favor tente mais tarde";
	}
	
?>