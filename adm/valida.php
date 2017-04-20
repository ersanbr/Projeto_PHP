<?php
	session_start();
	require_once("conexao/conexao.php");
	//Verifica se os campos possuem dados 
	if((isset($_POST['entrar'])) && (isset($_POST['txt_usuario'])) && (isset($_POST['txt_senha']))){
		$email=$_POST['txt_usuario'];
		$password=$_POST['txt_senha'];
		$ver_login=$conn->prepare('SELECT * FROM usuario WHERE login=:pemail AND senha=:psenha;');
		$ver_login->bindValue(':pemail',$email);
		$ver_login->bindValue(':psenha',sha1($password));
		$ver_login->execute();
		if($ver_login->rowCount()==0){
			echo "Login ou Senha inválido.";
		}else{
		    session_start();
		    $row=$ver_login->fetch();
		    $_SESSION['id']=$row['idusuario'];
		    $_SESSION['nome']=$row['nome'];
		    header("Location: painel.php");
		}
	}else{
		$_SESSION['loginErro'] = "Usuário ou senha inválido";
		header("Location: index.php");
	}
?>