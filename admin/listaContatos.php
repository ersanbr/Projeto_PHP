<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header('location:login.php');
	}
	if(isset($_GET['logout'])){
		session_destroy();
		header('location:login.php');
	}
?>
<?php require_once '../config.php'; 

$exib=$conn->prepare('SELECT * FROM contatorecebido');
	$exib->execute();
	if($exib->rowCount()==0){
		echo "Não há registros";
	}else{
		echo "<table class=\"table table-bordered table-hover table-striped\" width=\"100%\" border=\"1\" style=\"solid\" color=\"black\" align=\"center\">
			<thead>
				<tr>
					<th id=\"idcontato\">id</th>
					<th id=\"remetente\">REMETENTE</th>
					<th id=\"assunto\">ASSUNTO</th>
					<th id=\"texto\">TEXTO</th>
					<th id=\"data_envio\">DATA</th>
				</tr>
			</thead>";
		while($row=$exib->fetch()){
			echo "<tbody>
				<tr>";
				echo "<td>".$row['idcontato']."</td>";
				echo "<td>".$row['remetente']."</td>";
				echo "<td>".$row['assunto']."</td>";
				echo "<td>".$row['texto']."</td>";
				echo "<td>".$row['data_envio']."</td>";
			echo "</tbody>
				</tr>";
		}
	}

$conn = null;
?>