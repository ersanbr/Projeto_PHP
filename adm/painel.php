<?php
	session_start();
	require_once("conexao/conexao.php");
	if(!isset($_SESSION['id'])){
		header('location:index.php');
	}
	if(isset($_GET['logout'])){
		session_destroy();
		header('location:index.php');
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<?php
		require_once("head.php");
	?>

	<body role="document">

    <!-- Fixed navbar -->
    <?php
    	require_once("menu_adm.php");
    ?>
	
	<div class="container theme-showcase" role="main">
		<?php
		require_once("listaContatos.php");
		?>
		
	</div>
    <?php
		require_once("scripts.php");
	?>
  </body>
</html>

