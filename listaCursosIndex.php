<?php
	$request = json_decode(file_get_contents('php://input'));
	echo $request;
	$id = $request->id;
	$id = $_POST['id'];
	require_once "config.php";

	echo("Post :");
	var_dump($_POST['id']);

if($id){
	
	if ($id) {
		$sql = "SELECT cur.idcurso,cur.nomecurso,cur.descricaocurso,cat.descricao,cur.imagemcurso FROM curso cur LEFT JOIN categoria cat ON cur.categoriaid=cat.idcategoria WHERE cat.idcategoria=".$id.";";
	} else{
		$sql = "SELECT cur.idcurso,cur.nomecurso,cur.descricaocurso,cat.descricao,cur.imagemcurso FROM curso cur LEFT JOIN categoria cat ON cur.categoriaid=cat.idcategoria;";
	}
	$exib=$conn->prepare($sql);
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
			echo "</tbody>
				</tr>";
		}
	}
} /*else {
	$exib=$conn->prepare("SELECT cur.idcurso,cur.nomecurso,cur.descricaocurso,cat.descricao,cur.imagemcurso FROM curso cur LEFT JOIN categoria cat ON cur.categoriaid=cat.idcategoria;");
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
			echo "</tbody>
				</tr>";
		}
	}

}*/

$conn = null;
?>