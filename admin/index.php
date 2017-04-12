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
<!DOCTYPE html>
<html lang="UTF-8" ng-app="Projeto">
<head>

	<!-- META -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="">
	<meta name="keywords" content="">

	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content=""/>
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="" />

	<!-- TÍTULO -->
	<title>Painel - Administração Cursos</title>

	<!-- FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600|Montserrat" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/painel.css" />

	<!-- JS -->
	<script	src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<script	src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/painel.js"></script>
	<script src="../js/rotasPainel.js"></script>

	<!-- FAVICON -->
	<link rel="shortcut icon" href="../images/favicon.ico" />

</head>
<body style="padding-bottom: 40px;" ng-controller="mainController">

	<div class="pg-painel">
		<div class="menu" tabindex="0">
			<div class="smartphone-menu-trigger"></div>
			<div class="avatar">
				<img src="../images/logo-dark.png" />
				<strong>Monster University</strong>
			</div>
			<ul class="panel-group" id="accordion">
				<li class="fa fa-home active"><a href="#home"><span>Painel de Controle</span></a></li>
				<!-- USUARIO -->
				<li class="fa fa-user"><a href="#listaUsuarios"><span>Usuários</span></a></li>
				
				<!-- CATEGORIA -->
				<li class="fa fa-pencil-square"><a href="#listaCategorias"><span>Categorias</span></a></li>
				
				<!-- CURSOS -->
				<li class="fa fa-bank"><a href="#listaCursos"><span>Cursos</span></a></li>
				
				<!-- CONTATOS RECEBIDOS -->
				<li class="fa fa-envelope"><a href="#listaContatos"><span>Contatos Recebidos</span></a></li>

				<!-- SAIR -->
				<li class="fa fa-times"><a href="login.php?logout""><span>Sair</span></a></li>          
			</ul>
		</div>
		<!-- HOME PAINEL -->
		<section id="home" class="text-center active">
			<div class="content">
				<div class="container-fluid" style=" padding-bottom: 64px; ">
					<div class="row">
						<div class="col-md-12">
							<a href="#" title="" class="btn-info" style="line-height: inherit; display: block; position: relative; height: auto; padding: 0; text-align: center; border-width: 1px; border-style: solid;border-radius: 3px;">
								
								<div style="background: 0 0; padding: 0; position: absolute; right: 70px; bottom: 19px; font-size: 30px; font-weight: 400;">
								<?php
									echo $_SESSION['nome'];
								?>
								</div>
								<div style="position: relative; overflow: hidden; padding: 10px;padding: 0; min-height: 80px;">
									<i class="fa fa-user" style="font-size: 35px; line-height: 70px; position: absolute; top: 50%; left: 15px; height: 70px; margin-top: -36px; opacity: .3;position: absolute; left: 15px; top: 43px;"></i>
								</div>
							</a>
						</div>
						
					</div>
					<div class="col-md-12" style="padding: 60px 40px;" id="main">
						<div ng-view></div>
					</div>
				</div>
			</div>
		</section>

		<footer class="rodape">
			<ul>
				<li>© Monster University 2017</li>
			</ul>
		</footer>
	</div>

</body>
</html>