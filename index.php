<?php
	require_once "config.php";
?>
<!DOCTYPE html>
<html lang="UTF-8" ng-app="ProjetoIndex">
	<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="css/theme.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico" />
	</head>

	<body ng-controller="mainController"> 
		<div class="container">
		<!-- Topper w/ logo -->
			<div class="row hidden-xs topper">
				<div class="col-xs-7 col-sm-7">
					<a href="#"><img am-TopLogo alt="SECUREVIEW"  src="images/logo.png" class="img-responsive"></a>
				</div>
				<div class="col-xs-5 col-xs-offset-1 col-sm-5 col-sm-offset-0 text-right ">
					<p am-CallNow>0 (800) CALL - NOW</p>
				</div>
			</div> <!-- End Topper -->
			  <!-- Navigation -->
			<div class="row">
				<nav class="navbar navbar-inverse" role="navigation">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
					  		</button>
					  		<a class="navbar-brand visible-xs-inline-block nav-logo" href="/"><img src="images/logo-dark.png" class="img-responsive" alt=""></a>
						</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<ul class="nav navbar-nav js-nav-add-active-class" id="menu">
								<li><a href="#home">Home</a></li>
								<li class="active"><a href="#sobre">Sobre Nós</a></li>
								<li><a href="#contato">Contato</a></li>
								<?php
									$exib=$conn->prepare('SELECT * FROM categoria');
									$exib->execute();
									while($row=$exib->fetch()){
										echo "<li id=".$row['idcategoria']."><a href='#listaCursos'>".$row['descricao']."</a></li>";
									}
									$conn = null;
								?>
					  		</ul>
					  		<ul class="nav navbar-nav navbar-right hidden-xs">
								<a type="button" class="navbar-btn btn btn-gradient-blue" am-latosans="bold" href="admin/login.php" target="_blank">Admin</a>
					  		</ul>
						</div><!-- /.navbar-collapse -->
				  	</div>
				</nav>
			</div>
			<div class="row">
				<div ng-view></div>
			</div>
		</div>
		<script	src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
		<script	src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
	   <script src="js/jquery.min.js"</script>
       <script src="js/docs.min.js"></script>
	   <script src="js/bootstrap.min.js"></script>
	   <script src="js/rotasIndex.js"></script>
	</body>
</html>
