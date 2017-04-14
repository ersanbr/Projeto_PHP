<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header('location:login.php');
		echo "string";
	}
	if(isset($_GET['logout'])){
		session_destroy();
		header('location:login.php');
	}
	require_once "../config.php";
?>
<form action="cadastraUsuario.php" method="post">
	<div class="form-group row">
		<label for="example-text-input" class="col-2 col-form-label">E-Mail</label>
		<div class="col-10">
			<input class="form-control" type="text" name="login" placeholder="Digite seu E-Mail">
		</div>
 		<label for="example-text-input" class="col-2 col-form-label">Nome</label>
		<div class="col-10">
			<input class="form-control" type="text" name="nome" placeholder="Digite Seu nome">
		</div>
		<label for="example-text-input" class="col-2 col-form-label">Senha</label>
		<div class="col-10">
			<input class="form-control" type="password" name="senha">
		</div>
	</div>
	
	<input class="btn btn-primary" type="submit" value="Gravar" name="grava"/>
</form>
</br>

<?php
$exib=$conn->prepare('SELECT * FROM usuario');
	$exib->execute();
	if($exib->rowCount()==0){
		echo "Não há registros";
	}else{
		echo "<table class=\"table table-bordered table-hover table-striped\" width=\"100%\" border=\"1\" style=\"solid\" color=\"black\" align=\"center\">
			<thead>
				<tr>
					<th id=\"idUsuario\">id</th>
					<th id=\"login\">Login</th>
					<th id=\"nome\">Nome</th>
					<th id=\"senha\">Excluir</th>
				</tr>
			</thead>";
		while($row=$exib->fetch()){
			echo "<tbody>
				<tr>";
				echo "<td>".$row['idusuario']."</td>";
				echo "<td>".$row['login']."</td>";
				echo "<td>".$row['nome']."</td>";
				echo "<td><a href=\"cadastraUsuario.php?excluir&id=".$row['idusuario']."\">Excluir</a></td>";
			echo "</tbody>
				</tr>";
		}
	}

$conn = null;
?>