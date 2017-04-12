<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header('location:login.php');
	}
	if(isset($_GET['logout'])){
		session_destroy();
		header('location:login.php');
	}
	require_once "../config.php";
?>
<form action="cadastraCategoria.php" method="post">
	<div class="form-group row">
 		<label for="example-text-input" class="col-2 col-form-label">Descrição</label>
		<div class="col-10">
			<input class="form-control" type="text" name="descricao" placeholder="Descrição da categoria">
		</div>
	</div>
	
	<input class="btn btn-primary" type="submit" value="Gravar" name="grava"/>
</form>
<?php
if(isset($_POST['grava'])){
	$descricao=$_POST['descricao'];
	//Preparar o SQL
	$prep_grava=$conn->prepare('INSERT INTO `categoria` 
	(`descricao`) VALUES 
	(:pdesricao);');
	$prep_grava->bindValue(':pdesricao',$descricao);
	$prep_grava->execute();
	if ($prep_grava){
		echo "<script>alert('Cadastro de Categoria Realizado!');
			document.location='../admin/painel.php?id=#listaCategoria';
			$(document).ready(function () { $('#listaCategoria').trigger('click'); });
			
		</script>";
	}
}
?>