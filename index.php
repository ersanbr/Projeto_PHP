<?php
	require_once "config.php";
?>
<!DOCTYPE html>
<html lang="UTF-8">
	<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="css/theme.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico" />
	</head>

	<body> 
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
							<ul class="nav navbar-nav js-nav-add-active-class">
								<li><a href="index.html">Home</a></li>
								<li class="active"><a href="/aboutus.html">Sobre Nós</a></li>
								<li><a href="/contato.html">Contato</a></li>
								<?php
									$exib=$conn->prepare('SELECT * FROM categoria');
									$exib->execute();
									while($row=$exib->fetch()){
										echo "<li><a href='exatas.html'>".$row['descricao']."</a></li>";
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
		</div>
		<div id="banner" class="container">
			<img class="img" src="images/internal_header_aboutMU_980x215.jpg">
	   </div>
	   <script src="js/jquery.min.js"</script>
       <script src="js/docs.min.js"></script>
	   <script src="js/bootstrap.min.js"></script>
	</body>
</html>
