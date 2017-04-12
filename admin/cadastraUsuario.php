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
<?php
if(isset($_POST['grava'])){
	$login=$_POST['login'];
	$nome=$_POST['nome'];
	$senha=sha1($_POST['senha']);
	//Preparar o SQL
	$prep_grava=$conn->prepare('INSERT INTO `usuario` 
	(`login`,`nome`,`senha`) VALUES 
	(:plogin,:pnome,:psenha);');
	$prep_grava->bindValue(':plogin',$login);
	$prep_grava->bindValue(':pnome',$nome);
	$prep_grava->bindValue(':psenha',$senha);
	$prep_grava->execute();
	if ($prep_grava){
		echo "<script>alert('Cadastro de Categoria Realizado!');document.location='../admin/painel.php'</script>";
	}
	else{
		echo "<script>alert('Erro no cadastro!')</script>";
	}
	
}
?>