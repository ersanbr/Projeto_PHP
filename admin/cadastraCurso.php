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
	$nomecurso=$_POST['nomeCurso'];
	$descricaocurso=$_POST['descricaoCurso'];
	$categoriaid = $_POST['slctCategoria'];
	$imagemCurso=$_FILES['imagemCurso']['name'];
	//Preparar o SQL
	$prep_grava=$conn->prepare('INSERT INTO `curso` 
	(`nomecurso`,`descricaocurso`,`categoriaid`,`imagemcurso`) VALUES 
	(:pnomecurso,:pdescricaocurso,:pcategoriaid,:pimagemcurso);');
	$prep_grava->bindValue(':pnomecurso',$nomecurso);
	$prep_grava->bindValue(':pdescricaocurso',$descricaocurso);
	$prep_grava->bindValue(':pcategoriaid',$categoriaid);
	$prep_grava->bindValue(':pimagemcurso',$imagemCurso);
	var_dump($prep_grava);
	$prep_grava->execute();

	if ($prep_grava){
		echo "	<script>
					alert('Cadastro de Curso Realizado!');
					document.location='index.php#listaCursos'
				</script>";
	}
	else{
		echo "	<script>
					alert('Erro no cadastro!')
				</script>";
	}
}

if(isset($_GET['excluir'])){
	$id=$_GET['id'];
	$excluir=$conn->prepare('DELETE FROM `curso` WHERE `curso`.`idcurso` = :pid');
	$excluir->bindValue(':pid',$id);
	$excluir->execute();
	echo "	<script>
				alert('Registro de Curso Excluído!');
				document.location='index.php#listaCursos'
			</script>";
}
?>