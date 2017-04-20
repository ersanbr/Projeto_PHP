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
		$prep_altera=$conn->prepare('SELECT * FROM `curso` 
		WHERE `idcurso`=:pid');
		$prep_altera->bindValue(':pid',$id_alt);
		$prep_altera->execute();
		$row_alt=$prep_altera->fetch();
?>
<div class="container theme-showcase" role="main">
	<div class="page-header">
		<form action="listaCursos.php" method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<input type="hidden" name="idcurso" value="<?php echo $row_alt['idcurso']; ?>"/>
				<label for="example-text-input" class="col-2 col-form-label">Nome Curso</label>
				<div class="col-2">
					<input class="form-control" type="text" name="nomecurso" placeholder="Nome do Curso" value="<?php echo $row_alt['nomecurso']; ?>"/>
				</div>
  				<label for="example-text-input" class="col-2 col-form-label">Descrição Curso</label>
				<div class="col-2">
					<textarea class="form-control" name="descricaocurso" rows="3"><?php echo $row_alt['descricaocurso']; ?></textarea>
				</div>
				<div class="form-group">
	    			<label for="exampleSelect1">Categoria: </label>
			    	<?php
			    	$exib=$conn->prepare('SELECT * FROM categoria');
					$exib->execute();
						if($exib->rowCount()==0){
							echo "Não há registros";
						}else{
							echo "<select class='form-control' name='slctcategoria' id='slctcategoria'>";
							while($row=$exib->fetch()){
								if ($row_alt['categoriaid'] == $row['idcategoria']) {
									echo "<option value='".$row['idcategoria']."' selected>".$row['descricao']."</option>";
								} else {
							    echo "<option value='".$row['idcategoria']."\'>".$row['descricao']."</option>";
							    }
							  }
							echo "</select>";
						}
				    ?>
	  			</div>
			  	<div class="form-group">
				    <label for="imagemcurso">Imagem</label>
				    <input type="file" class="form-control-file" id="imagemcurso" aria-describedby="fileHelp" name="imagemcurso"/>
				</div>
				<div class="form-group">
					<img width='200' name='imgcurso'<?php echo "src=imagens_cursos/".$row_alt['imagemcurso'];?> />
				</div>
			</div>
			
			<input class="btn btn-primary" type="submit" value="Alterar" name="alterar"/>
		</form>

<?php }else { ?>
<div class="container theme-showcase" role="main">
	<div class="page-header">
		<form action="listaCursos.php" method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<label for="nomecurso" class="col-2 col-form-label">Nome Curso</label>
				<div class="col-2">
					<input class="form-control" type="text" name="nomecurso" placeholder="Nome do Curso">
				</div>
  				<label for="descricaocurso" class="col-2 col-form-label">Descrição Curso</label>
				<div class="col-2">
					<textarea class="form-control" name="descricaocurso" rows="3"></textarea>
				</div>
				<div class="form-group">
	    			<label for="slctcategoria">Categoria: </label>
			    	<?php
			    	$exib=$conn->prepare('SELECT * FROM categoria');
					$exib->execute();
						if($exib->rowCount()==0){
							echo "Não há registros";
						}else{
							echo "<select class='form-control' name='slctcategoria' id='slctcategoria'>";
							while($row=$exib->fetch()){
							    echo "<option value='".$row['idcategoria']."'>".$row['descricao']."</option>";
							  }
							echo "</select>";
						}
				    ?>
	  			</div>
			  	<div class="form-group">
				    <label for="imagemcurso">Imagem</label>
				    <input type="file" class="form-control-file" id="imagemcurso" aria-describedby="fileHelp" name="imagemcurso"/>
				</div>
			</div>
			<input class="btn btn-primary" type="submit" value="Gravar" name="grava"/>
		</form>
<?php } ?>
		<div class="page-header">
			<h1>Cursos</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th id=\"idcurso\">id</th>
							<th id=\"nomecurso\">Nome Curso</th>
							<th id=\"descricaocurso\">Descrição do Curso</th>
							<th id=\"categoria\">Categoria</th>
							<th id=\"imagem\">Imagem</th>
							<th id=\"acoes\">Ações</th>
						</tr>
					</thead>
					<tbody>
						<tr>

							<?php
							$exib=$conn->prepare('SELECT cur.idcurso,cur.nomecurso,cur.descricaocurso,cat.descricao,cur.imagemcurso FROM curso cur LEFT JOIN categoria cat ON cur.categoriaid=cat.idcategoria');
							$exib->execute();
							
							while($row=$exib->fetch()){
								echo "<tbody>
									<tr>";
									echo "<td>".$row['idcurso']."</td>";
									echo "<td>".$row['nomecurso']."</td>";
									echo "<td class='col-md-5'>".$row['descricaocurso']."</td>";
									echo "<td>".$row['descricao']."</td>";
									echo "<td><img width=\"100\" src=imagens_cursos/".$row['imagemcurso']."?></td>";
									echo "	<td>
												<a href='listaCursos.php?alterar&id=".$row['idcurso']."' class='btn btn-xs btn-warning'>Editar</a>
												<a href='listaCursos.php?excluir&id=".$row['idcurso']."' class='btn btn-xs btn-danger'>Apagar</a>
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
	$nomecurso=$_POST['nomecurso'];
	$descricaocurso=$_POST['descricaocurso'];
	$categoriaid = $_POST['slctcategoria'];

	$_IMAGEM['pasta']="imagens_cursos/";
	$_IMAGEM['tamanho']=1024*1024*2; //2mb
	$_IMAGEM['extensao']=array('jpg','png','jpeg');
	$_IMAGEM['renomear']=true;

	$explode=explode('.',$_FILES['imagemcurso']['name']);

	$aponta=end($explode);
	$extensao=strtolower($aponta);

	if(array_search($extensao,$_IMAGEM['extensao'])===false){
		echo "	<script>
					alert('Extensão não aceita!');
					//document.location='listaCursos.php'
				</script>";
		exit;
	}
	if($_IMAGEM['renomear']===true){
		$nome_final=md5(time()).".".$extensao;
	}else{
		$nome_final=$_FILES['imagemcurso']['name'];
	}
	if($_IMAGEM['tamanho']<=$_FILES['imagemcurso']['size']){
		echo "	<script>
					alert('Arquivo maior que 2 MB!');
					document.location='listaCursos.php'
				</script>";
		exit;
	}
	if(move_uploaded_file($_FILES['imagemcurso']['tmp_name'],
	$_IMAGEM['pasta'].$nome_final)){
		$url=$_IMAGEM['pasta'].$nome_final;
		
		$prep_grava=$conn->prepare('INSERT INTO `curso` 
		(`nomecurso`,`descricaocurso`,`categoriaid`,`imagemcurso`) VALUES 
		(:pnomecurso,:pdescricaocurso,:pcategoriaid,:pimagemcurso);');
		$prep_grava->bindValue(':pnomecurso',$nomecurso);
		$prep_grava->bindValue(':pdescricaocurso',$descricaocurso);
		$prep_grava->bindValue(':pcategoriaid',$categoriaid);
		$prep_grava->bindValue(':pimagemcurso',$nome_final);
		$prep_grava->execute();

			if ($prep_grava){
				echo "	<script>
							alert('Cadastro de Curso Realizado!');
							document.location='listaCursos.php'
						</script>";
			}
			else{
				echo "	<script>
							alert('Erro no cadastro!')
						</script>";
			}
			
		}else{
			echo "	<script>
							alert('Falha geral!');
							document.location='listaCursos.php'
						</script>";
		}
}
if(isset($_POST['alterar'])){
	$idcurso=$_POST['idcurso'];
	$nomecurso=$_POST['nomecurso'];
	$descricaocurso=$_POST['descricaocurso'];
	$categoriaid=$_POST['categoriaid'];

	$filename=$_POST['imgcurso'];
	
	if (!$_FILES['imagemcurso']['name']) {
		$prep_alt=$conn->prepare('UPDATE `curso` SET 
		`nomecurso` = :pnomecurso,
		`descricaocurso` = :pdescricaocurso,
		`categoriaid` = :pcategoriaid
		WHERE `curso`.`idcurso` = :pidcurso;');
		$prep_alt->bindValue(':pidcurso',$idcurso);
		$prep_alt->bindValue(':pnomecurso',$nomecurso);
		$prep_alt->bindValue(':pdescricaocurso',$descricaocurso);
		$prep_alt->bindValue(':pcategoriaid',$categoriaid);
		$prep_alt->execute();
		if ($prep_alt){
			echo "	<script>
						alert('Alteração de Curso Realizado!');
						document.location='listaCursos.php';
					</script>";
		}
		else{
			echo "<script>alert('Erro no cadastro!')</script>";
		}
	} else{

		
		unlink($filename);

		$_IMAGEM['pasta']="imagens_cursos/";
		$_IMAGEM['tamanho']=1024*1024*2; //2mb
		$_IMAGEM['extensao']=array('jpg','png','jpeg');
		$_IMAGEM['renomear']=true;
		$explode=explode('.',$_FILES['imagemcurso']['name']);

		$aponta=end($explode);
		$extensao=strtolower($aponta);
		if(array_search($extensao,$_IMAGEM['extensao'])===false){
			echo "	<script>
						alert('Extensão não aceita!');
						document.location='listaCursos.php'
					</script>";
			exit;
		}
		if($_IMAGEM['renomear']===true){
			$nome_final=md5(time()).".".$extensao;
		}else{
			$nome_final=$_FILES['imagemcurso']['name'];
		}
		if($_IMAGEM['tamanho']<=$_FILES['imagemcurso']['size']){
			echo "	<script>
						alert('Arquivo maior que 2 MB!');
						document.location='listaCursos.php'
					</script>";
			exit;
		}
		if(move_uploaded_file($_FILES['imagemcurso']['tmp_name'],
			$_IMAGEM['pasta'].$nome_final)){
			$url=$_IMAGEM['pasta'].$nome_final;



			$prep_alt=$conn->prepare('UPDATE `curso` SET 
			`nomecurso` = :pnomecurso,
			`descricaocurso` = :pdescricaocurso,
			`categoriaid` = :pcategoriaid,
			`imagemcurso` = :pimagemcurso 
			WHERE `curso`.`idcurso` = :pidcurso;');
			$prep_alt->bindValue(':pidcurso',$idcurso);
			$prep_alt->bindValue(':pnomecurso',$nomecurso);
			$prep_alt->bindValue(':pdescricaocurso',$descricaocurso);
			$prep_alt->bindValue(':pcategoriaid',$categoriaid);
			$prep_alt->bindValue(':pimagemcurso',$nome_final);
			$prep_alt->execute();
			if ($prep_alt){
				echo "	<script>
							alert('Alteração de Curso Realizado!');
							document.location='listaCursos.php';
						</script>";
			}
			else{
				echo "<script>alert('Erro no cadastro!')</script>";
			}
		}

	}


	$prep_alt=$conn->prepare('UPDATE `categoria` SET 
	`descricao` = :pdescricao, 
	WHERE `categoria`.`idcategoria` = :pidcategoria;');
	$prep_alt->bindValue(':pdescricao',$descricao);
	$prep_alt->bindValue(':pidcategoria',$idcategoria);
	$prep_alt->execute();
	if ($prep_alt){
		echo "	<script>
					alert('Alteração de Curso Realizada!');
					document.location='listaCursos.php';
				</script>";
	}
	else{
		echo "<script>alert('Erro no cadastro!')</script>";
	}
}

if(isset($_GET['excluir'])){
	$id=$_GET['id'];
	var_dump($id);
	$excluir=$conn->prepare('DELETE FROM `curso` WHERE `curso`.`idcurso` = :pid');
	$excluir->bindValue(':pid',$id);
	$excluir->execute();
	echo "	<script>
				alert('Registro de Curso Excluído!');
				document.location='listaCursos.php'
			</script>";
}
?>