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
	$descricao=$_POST['descricao'];
	//Preparar o SQL
	$prep_grava=$conn->prepare('INSERT INTO `categoria` (`descricao`) VALUES 
	(:pdesricao);');
	$prep_grava->bindValue(':pdesricao',$descricao);
	$prep_grava->execute();
	if ($prep_grava){
		echo "	<script>
					alert('Cadastro de Categoria Realizado!');
					document.location='index.php#listaCategorias';
				</script>";
	}
	else{
		echo "<script>alert('Erro no cadastro!')</script>";
	}
}

if(isset($_GET['excluir'])){
	$id=$_GET['id'];
	$excluir=$conn->prepare('DELETE FROM `categoria` WHERE `categoria`.`idcategoria` = :pid');
	$excluir->bindValue(':pid',$id);
	$excluir->execute();
	echo "	<script>
				alert('Registro de Categoria Excluído!');
				document.location='index.php#listaCategorias';
			</script>";
}
?>