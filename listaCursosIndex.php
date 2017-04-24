<?php
	require_once("adm/conexao/conexao.php");
	$id=$_GET['id'];

	$exib=$conn->prepare('SELECT cur.idcurso,cur.nomecurso,cur.descricaocurso,cat.descricao,cur.imagemcurso FROM curso cur LEFT JOIN categoria cat ON cur.categoriaid=cat.idcategoria WHERE cat.idcategoria=:pid');
	$exib->bindValue(':pid',$id);
	$exib->execute();
	if($exib->rowCount()==0){
		echo "Não há registros";
	}else{
		echo "<table class=\"table table-bordered table-hover table-striped\" width=\"100%\" border=\"1\" style=\"solid\" color=\"black\" align=\"center\">
			<thead>
				<tr>
					<th id=\"nomecurso\">Nome Curso</th>
					<th id=\"descricaocurso\">Descrição do Curso</th>
					<th id=\"imagem\">Imagem</th>
				</tr>
			</thead>";
		while($row=$exib->fetch()){
			echo "<tbody>
				<tr>";
				echo "<td>".$row['nomecurso']."</td>";
				echo "<td>".$row['descricaocurso']."</td>";
				echo "<td><img width=\"150\" src=adm/imagens_cursos/".$row['imagemcurso']."?></td>";
			echo "</tbody>
				</tr>";
		}
	}

$conn = null;
?>