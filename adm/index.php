<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ersan Rafael Holstein">
    <link rel="icon" href="imagens/favicon.ico">

    <title>Area Restrita</title>

    <link href="css/theme.css" rel="stylesheet">

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
  </head>

  <body>

    <div class="container">
  
      <div class="row" id="pwd-container">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <section class="login-form">
            <form method="post" action="valida.php" role="login">
              <label for="inputEmail" class="sr-only">Usuário</label>
              <input type="email" name="txt_usuario" id="inputEmail" class="form-control" placeholder="Usuário" required autofocus>
            
              <label for="inputPassword" class="sr-only">Senha</label>
              <input type="password" name="txt_senha" id="inputPassword" class="form-control" placeholder="Senha" required>

              <button class="btn btn-lg btn-danger btn-block" name="entrar" type="submit">Acessar</button>
              <p class="text-center text-danger">
                <?php if(isset($_SESSION['loginErro'])){
                  echo $_SESSION['loginErro'];
                  unset ($_SESSION['loginErro']);
                }?>
              </p>
              <p class="text-center text-success">
                <?php if(isset($_SESSION['loginDeslogado'])){
                  echo $_SESSION['loginDeslogado'];
                  unset ($_SESSION['loginDeslogado']);
                }?>
              </p>
            </form>
          </section>  
        </div>
        <div class="col-md-4"></div>
      </div>    
    </div>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
