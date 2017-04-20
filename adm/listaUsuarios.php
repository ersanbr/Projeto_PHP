<?php
	session_start();
	require_once("conexao/conexao.php");
	if(!isset($_SESSION['id'])){
		header('location:index.php');
	}
	require_once("head.php");
	require_once("menu_adm.php");

	if(isset($_GET['alterar'])){
		$id_alt=$_GET['id'];
		$prep_altera=$conn->prepare('SELECT * FROM `usuario` 
		WHERE `idusuario`=:pid');
		$prep_altera->bindValue(':pid',$id_alt);
		$prep_altera->execute();
		$row_alt=$prep_altera->fetch();
?>
<div class="container theme-showcase" role="main">
	<div class="page-header">
		<form action="listaUsuarios.php" method="post">
			<div class="form-group row">
				<input type="hidden" name="idusuario" value="<?php echo $row_alt['idusuario']; ?>"/>
				<label for="example-text-input" class="col-2 col-form-label">E-Mail</label>
				<div class="col-2">
					<input class="form-control" type="text" name="login" placeholder="Digite seu E-Mail" value="<?php echo $row_alt['login']; ?>"/>
				</div>
		 		<label for="example-text-input" class="col-2 col-form-label">Nome</label>
				<div class="col-2">
					<input class="form-control" type="text" name="nome" placeholder="Digite Seu nome" value="<?php echo $row_alt['nome']; ?>"/>
				</div>
				<label for="example-text-input" class="col-2 col-form-label">Senha</label>
				<div class="col-2">
					<input class="form-control" type="password" name="senha" value="<?php echo $row_alt['senha']; ?>"/>
				</div>
			</div>
			
			<input class="btn btn-primary" type="submit" value="Alterar" name="alterar"/>
		</form>

<?php }else { ?>
<div class="container theme-showcase" role="main">
	<div class="page-header">
		<form action="listaUsuarios.php" method="post">
			<div class="form-group row">
				<label for="example-text-input" class="col-2 col-form-label">E-Mail</label>
				<div class="col-2">
					<input class="form-control" type="text" name="login" placeholder="Digite seu E-Mail">
				</div>
		 		<label for="example-text-input" class="col-2 col-form-label">Nome</label>
				<div class="col-2">
					<input class="form-control" type="text" name="nome" placeholder="Digite Seu nome">
				</div>
				<label for="example-text-input" class="col-2 col-form-label">Senha</label>
				<div class="col-2">
					<input class="form-control" type="password" name="senha">
				</div>
			</div>
			
			<input class="btn btn-primary" type="submit" value="Gravar" name="grava"/>
		</form>
<?php } ?>
		<div class="page-header">
			<h1>Usuários</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th id=\"idUsuario\">id</th>
							<th id=\"login\">Login</th>
							<th id=\"nome\">Nome</th>
							<th id=\"senha\">Ações</th>
						</tr>
					</thead>
					<tbody>
						<tr>

							<?php
							$exib=$conn->prepare('SELECT * FROM usuario');
							$exib->execute();
							
							while($row=$exib->fetch()){
								echo "<tbody>
									<tr>";
									echo "<td>".$row['idusuario']."</td>";
									echo "<td>".$row['login']."</td>";
									echo "<td>".$row['nome']."</td>";
									echo "	<td>
												<a href='listaUsuarios.php?alterar&id=".$row['idusuario']."' class='btn btn-xs btn-warning'>Editar</a>
												<a href='listaUsuarios.php?excluir&id=".$row['idusuario']."' class='btn btn-xs btn-danger'>Apagar</a>
											</td>";
								echo "</tbody>
									</tr>";
							}
						
							?>
			</div>
		</div>
	</div>
</div>
<?php
	require_once("scripts.php");
?>
</body>
</html>
<?php

if(isset($_POST['grava'])){
	$login=$_POST['login'];
	$nome=$_POST['nome'];
	$senha=sha1($_POST['senha']);
	//Preparar o SQL
	$prep_grava=$conn->prepare('INSERT INTO `usuario` 
	(`login`,`nome`,`senha`) VALUES 
	(:plogin,:pnome,:psenha);');
	$prep_grava->bindValue(':plogin',$login);
	$prep_grava->bindValue(':pnome',$nome);
	$prep_grava->bindValue(':psenha',$senha);
	$prep_grava->execute();
	if ($prep_grava){
		echo "	<script>
					alert('Cadastro de Usuário Realizado!');
					document.location='listaUsuarios.php';
				</script>";
	}
	else{
		echo "<script>alert('Erro no cadastro!')</script>";
	}	
}

if(isset($_POST['alterar'])){
	$idusuario=$_POST['idusuario'];
	$login=$_POST['login'];
	$nome=$_POST['nome'];
	$senha=sha1($_POST['senha']);
	$prep_alt=$conn->prepare('UPDATE `usuario` SET 
	`login` = :plogin, 
	`nome` = :pnome, 
	`senha` = :psenha 
	WHERE `usuario`.`idUsuario` = :pid;');
	$prep_alt->bindValue(':plogin',$login);
	$prep_alt->bindValue(':pnome',$nome);
	$prep_alt->bindValue(':psenha',$senha);
	$prep_alt->bindValue(':pid',$idusuario);
	$prep_alt->execute();
	//echo "<script>alert('Alteração do Usuário Realizado!'); </script>";
	if ($prep_alt){
		echo "	<script>
					alert('Alteração do Usuário Realizado!');
					document.location='listaUsuarios.php';
				</script>";
	}
	else{
		echo "<script>alert('Erro no cadastro!')</script>";
	}
	//header('location:listaUsuarios.php');

}

if(isset($_GET['excluir'])){
	$id=$_GET['id'];
	$excluir=$conn->prepare('DELETE FROM `usuario` WHERE `usuario`.`idusuario` = :pid');
	$excluir->bindValue(':pid',$id);
	$excluir->execute();
	if ($excluir){
		echo "	<script>
					alert('Usuário Excluido!');
					document.location='listaUsuarios.php';
				</script>";
	}
	else{
		echo "<script>alert('Erro no cadastro!')</script>";
	}
}
?>