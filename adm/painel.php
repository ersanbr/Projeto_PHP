<?php
	session_start();
	require_once("conexao/conexao.php");
	if(!isset($_SESSION['id'])){
		header('location:index.php');
	}
	if(isset($_GET['logout'])){
		session_destroy();
		header('location:index.php');
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<?php
		require_once("head.php");
	?>

	<body role="document">

    <!-- Fixed navbar -->
    <?php
    	require_once("menu_adm.php");
    ?>
	
	<div class="container theme-showcase" role="main">
		<div class="page-header">
			<h1>Usuários</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th>Inscrição</th>
							<th>Nome</th>
							<th>Situação</th>
							<th>Nivel de acesso</th>
							<th>Cadastrado</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Cesar Szpak</td>
							<td>Ativo</td>
							<td>Administrador</td>
							<td>10/10/1980 10:15:20</td>
							<td>
								<button type="button" class="btn btn-xs btn-success">Visualizar</button>
								<button type="button" class="btn btn-xs btn-warning">Editar</button>
								<button type="button" class="btn btn-xs btn-danger">Apagar</button>
							</td>
						</tr>              
					</tbody>
				</table>
			</div>
		</div>
	</div>
    <?php
		require_once("scripts.php");
	?>
  </body>
</html>

