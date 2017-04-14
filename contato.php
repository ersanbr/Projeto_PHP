<form action="cadastraContato.php" method="post" enctype="multipart/form-data">
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