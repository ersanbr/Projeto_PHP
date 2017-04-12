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
</br>
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
if(isset($_GET['excluir'])){
	$id=$_GET['id'];
	echo "Deseja realmente excluir?";
	echo "<br/><a href=\"index.php?excluirvdd&id=".$id."\">Sim</a> <a href=\"index.php\">Não</a>";
}
if(isset($_GET['excluirvdd'])){
	$id=$_GET['id'];
	$excluir=$conn->prepare('DELETE FROM `cadastro` WHERE `cadastro`.`id_cad` = :pid');
	$excluir->bindValue(':pid',$id);
	$excluir->execute();
	echo "Excluído com Sucesso";
}
?>	
<?php
$exib=$conn->prepare('SELECT * FROM categoria');
	$exib->execute();
	if($exib->rowCount()==0){
		echo "Não há registros";
	}else{
		echo "<table class=\"table table-bordered table-hover table-striped\" width=\"100%\" border=\"1\" style=\"solid\" color=\"black\" align=\"center\">
			<thead>
				<tr>
					<th id=\"idcategoria\">id</th>
					<th id=\"descricao\">Categoria</th>
					<th id=\"Alterar\">Alterar</th>
					<th id=\"Excluir\">Excluir</th>
				</tr>
			</thead>";
		while($row=$exib->fetch()){
			echo "<tbody>
				<tr>";
				echo "<td>".$row['idcategoria']."</td>";
				echo "<td>".$row['descricao']."</td>";
				echo "<td><a href=\"index.php?alterar&id=".$row['idcategoria']."\">Alterar</a></td>";
				echo "<td><a href=\"index.php?excluir&id=".$row['idcategoria']."\">Excluir</a></td>";
			echo "</tbody>
				</tr>";
		}
	}

$conn = null;
?>