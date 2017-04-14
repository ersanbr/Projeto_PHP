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

<form action="cadastraCurso.php" method="post" enctype="multipart/form-data">
	<div class="form-group row">
 		<label for="example-text-input" class="col-2 col-form-label">Nome Curso</label>
		<div class="col-10">
			<input class="form-control" type="text" name="nomeCurso" placeholder="Nome do Curso">
		</div>
  		<label for="example-text-input" class="col-2 col-form-label">Descrição Curso</label>
		<div class="col-10">
			<textarea class="form-control" name="descricaoCurso" rows="3"></textarea>
		</div>
		<div class="form-group">
	    	<label for="exampleSelect1">Categoria: </label>
	    	<?php
	    	$exib=$conn->prepare('SELECT * FROM categoria');
			$exib->execute();
				if($exib->rowCount()==0){
					echo "Não há registros";
				}else{
					echo "<select class=\"form-control\" name=\"slctCategoria\" id=\"slctCategoria\">";
					while($row=$exib->fetch()){
					    echo "<option value=\"".$row['idcategoria']."\">".$row['descricao']."</option>";
					  }
					echo "</select>";
				}
		    ?>
	  	</div>
	  	<div class="form-group">
		    <label for="exampleInputFile">Imagem</label>
		    <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name="imagemCurso">
		</div>
	</div>
	
	<input class="btn btn-primary" type="submit" value="Gravar" name="grava"/>
</form>
</br>

<?php
$exib=$conn->prepare('SELECT cur.idcurso,cur.nomecurso,cur.descricaocurso,cat.descricao,cur.imagemcurso FROM curso cur LEFT JOIN categoria cat ON cur.categoriaid=cat.idcategoria');
	$exib->execute();
	if($exib->rowCount()==0){
		echo "Não há registros";
	}else{
		echo "<table class=\"table table-bordered table-hover table-striped\" width=\"100%\" border=\"1\" style=\"solid\" color=\"black\" align=\"center\">
			<thead>
				<tr>
					<th id=\"idcurso\">id</th>
					<th id=\"nomecurso\">Nome Curso</th>
					<th id=\"descricaocurso\">Descrição do Curso</th>
					<th id=\"categoria\">Categoria</th>
					<th id=\"imagem\">Imagem</th>
					<th id=\"Excluir\">Excluir</th>
				</tr>
			</thead>";
		while($row=$exib->fetch()){
			echo "<tbody>
				<tr>";
				echo "<td>".$row['idcurso']."</td>";
				echo "<td>".$row['nomecurso']."</td>";
				echo "<td>".$row['descricaocurso']."</td>";
				echo "<td>".$row['descricao']."</td>";
				echo "<td>".$row['imagemcurso']."</td>";
				echo "<td><a href=\"cadastraCurso.php?excluir&id=".$row['idcurso']."\">Excluir</a></td>";
			echo "</tbody>
				</tr>";
		}
	}

$conn = null;
?>