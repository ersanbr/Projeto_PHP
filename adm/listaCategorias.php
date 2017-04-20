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
		$prep_altera=$conn->prepare('SELECT * FROM `categoria` 
		WHERE `idcategoria`=:pid');
		$prep_altera->bindValue(':pid',$id_alt);
		$prep_altera->execute();
		$row_alt=$prep_altera->fetch();
?>
<div class="container theme-showcase" role="main">
	<div class="page-header">
		<form action="listaCategorias.php" method="post">
			<div class="form-group row">
				<input type="hidden" name="idcategoria" value="<?php echo $row_alt['idcategoria']; ?>"/>
				<label for="example-text-input" class="col-2 col-form-label">Categoria</label>
				<div class="col-2">
					<input class="form-control" type="text" name="categoria" value="<?php echo $row_alt['descricao']; ?>"/>
				</div>
			</div>
			
			<input class="btn btn-primary" type="submit" value="Alterar" name="alterar"/>
		</form>

<?php }else { ?>
<div class="container theme-showcase" role="main">
	<div class="page-header">
		<form action="listaCategorias.php" method="post">
			<div class="form-group row">
				<label for="example-text-input" class="col-2 col-form-label">Categoria</label>
				<div class="col-2">
					<input class="form-control" type="text" name="descricao" placeholder="Digite a categoria">
				</div>
			</div>
			
			<input class="btn btn-primary" type="submit" value="Gravar" name="grava"/>
		</form>
<?php } ?>
		<div class="page-header">
			<h1>Categorias</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th id=\"idCategoria\">id</th>
							<th id=\"Categoria\">Login</th>
							<th id=\"acoes\">Ações</th>
						</tr>
					</thead>
					<tbody>
						<tr>

							<?php
							$exib=$conn->prepare('SELECT * FROM categoria');
							$exib->execute();
							
							while($row=$exib->fetch()){
								echo "<tbody>
									<tr>";
									echo "<td>".$row['idcategoria']."</td>";
									echo "<td>".$row['descricao']."</td>";
									echo "	<td>
												<a href='listaCategorias.php?alterar&id=".$row['idcategoria']."' class='btn btn-xs btn-warning'>Editar</a>
												<a href='listaCategorias.php?excluir&id=".$row['idcategoria']."' class='btn btn-xs btn-danger'>Apagar</a>
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
	$descricao=$_POST['descricao'];
	//Preparar o SQL
	$prep_grava=$conn->prepare('INSERT INTO `categoria` 
	(`descricao`) VALUES (:pdescricao);');
	$prep_grava->bindValue(':pdescricao',$descricao);
	$prep_grava->execute();
	if ($prep_grava){
		echo "	<script>
					alert('Cadastro de Categoria Realizada!');
					document.location='listaCategorias.php';
				</script>";
	}
	else{
		echo "<script>alert('Erro no cadastro!');</script>";
	}	
}
if(isset($_POST['alterar'])){
	$idcategoria=$_POST['id'];
	$descricao=$_POST['descricao'];
	$prep_alt=$conn->prepare('UPDATE `categoria` SET 
	`descricao` = :pdescricao, 
	WHERE `categoria`.`idcategoria` = :pidcategoria;');
	$prep_alt->bindValue(':pdescricao',$descricao);
	$prep_alt->bindValue(':pidcategoria',$idcategoria);
	$prep_alt->execute();
	if ($prep_alt){
		echo "	<script>
					alert('Alteração de Categoria Realizado!');
					document.location='listaCategorias.php';
				</script>";
	}
	else{
		echo "<script>alert('Erro no cadastro!')</script>";
	}
}
if(isset($_GET['excluir'])){
	$idcategoria=$_GET['id'];
	$excluir=$conn->prepare('DELETE FROM `categoria` WHERE `categoria`.`idcategoria` = :pidcategoria');
	$excluir->bindValue(':pidcategoria',$idcategoria);
	$excluir->execute();
	if ($excluir){
		echo "	<script>
					alert('Categoria Excluida!');
					document.location='listaCategorias.php';
				</script>";
	}
	else{
		echo "<script>alert('Erro no cadastro!')</script>";
	}
}
?>