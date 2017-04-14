<?php
	require_once "../config.php";
	session_start();
	if(!isset($_SESSION['id'])){
		header('location:login.php');
	}
	if(isset($_GET['logout'])){
		session_destroy();
		header('location:login.php');
	}

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
		echo "	<script>
					alert('Cadastro de Usuário Realizado!');
					document.location='index.php#listaUsuarios';
				</script>";
	}
	else{
		echo "<script>alert('Erro no cadastro!')</script>";
	}	
}
if(isset($_GET['excluir'])){
	$id=$_GET['id'];
	$excluir=$conn->prepare('DELETE FROM `usuario` WHERE `usuario`.`idusuario` = :pid');
	$excluir->bindValue(':pid',$id);
	$excluir->execute();
	echo "	<script>
				alert('Registro de Curso Excluído!');
				document.location='index.php#listaUsuarios';
			</script>";
}
?>
?>