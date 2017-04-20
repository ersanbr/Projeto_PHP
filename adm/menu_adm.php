<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/universidade/adm/painel.php">Dashboard</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="fa fa-user"><a href="listaUsuarios.php">Usuários</a></li>
				<li><a class="fa fa-pencil-square" href="listaCategorias.php">Categorias</a></li>
				<li><a class="fa fa-bank" href="listaCursos.php">Cursos</a></li>
				<li><a class="fa fa-envelope" href="listaContatos.php">Contatos Recebidos</a></li>
			</ul>
			<div class="navbar-form navbar-right">					
				<a href="sair.php"><button type="submit" name="logout" class="btn btn-primary">Sair</button></a>
			</div>
		</div><!--/.nav-collapse -->				
	</div>
</nav>