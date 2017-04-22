<?php
	session_start();
	require_once("conexao/conexao.php");
	if(!isset($_SESSION['id'])){
		header('location:index.php');
	}
	require_once("head.php");
	require_once("menu_adm.php");
	require_once("scripts.php");
?>


<div class="container theme-showcase" role="main">
	<div class="page-header">
		<h1>Contatos Recebidos</h1>
	</div>
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th id=\"idcontato\">id</th>
					<th id=\"remetente\">Remetente</th>
					<th id=\"assunto\">Assunto</th>
					<th id=\"complemento\">Complemento</th>
					<th id=\"data_envio\">Data Envio</th>
					<th id=\"data_envio\">Ações</th>
				</tr>
			</thead>
			<tbody>
				<tr>

					<?php
					$exib=$conn->prepare('SELECT * FROM contatorecebido');
					$exib->execute();
					$data_mysql = $row['data_envio'];

					while($row=$exib->fetch()){
						echo "<tbody>
							<tr>";
							echo "<td>".$row['idcontato']."</td>";
							echo "<td>".$row['remetente']."</td>";
							echo "<td>".$row['assunto']."</td>";
							echo "<td class='col-md-5'>".$row['texto']."</td>";
							echo "<td>".date('d/m/Y H:i:s',strtotime($row['data_envio']))."</td>";
							echo "	<td>
										<a href='listaContatos.php?excluir&id=".$row['idcontato']."' class='btn btn-xs btn-danger'>Apagar</a>
									</td>";
						echo "</tbody>
							</tr>";
					}
				
					?>
	</div>
</div>
<?php
if(isset($_GET['excluir'])){
	$idcontato=$_GET['id'];
	$excluir=$conn->prepare('DELETE FROM `contatorecebido` WHERE `contatorecebido`.`idcontato` = :pidcontato');
	$excluir->bindValue(':pidcontato',$idcontato);
	$excluir->execute();
	if ($excluir){
		echo "	<script>
					alert('Contato Excluido!');
					document.location='listaContatos.php';
				</script>";
	}
	else{
		echo "<script>alert('Erro no cadastro!')</script>";
	}
}
?>