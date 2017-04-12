<!DOCTYPE html>
<html lang="pt-br">
  <head>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/bootstrap-theme.min.css" rel="stylesheet">
  <link href="../css/admin.css" rel="stylesheet">
  <link rel="shortcut icon" href="../images/favicon.ico" />
  </head>

  <body> 

<div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
        <form method="post" action="login.php" role="login">
          <img src="../images/logo.png" class="img-responsive" alt="" />
          <input type="email" name="email" placeholder="Email" required class="form-control input-lg" placeholder="E-Mail" />
          
          <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Senha" required="" />
          
          
          <div class="pwstrength_viewport_progress"></div>
          
          
          <button type="submit" name="entrar" class="btn btn-lg btn-primary btn-block">Entrar</button>
          <div>
            <a href="#">Criar Conta</a> ou <a href="#">Esqueceu a Senha</a>
          </div>
          
        </form>
        
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

  </div>    
  
  
</div>
  </body>
</html>
<?php
if(isset($_POST['entrar'])){
  require_once '../config.php';
  $email=$_POST['email'];
  $password=$_POST['password'];
  $ver_login=$conn->prepare('
  SELECT * FROM usuario WHERE
  login=:pemail AND 
  senha=:psenha;
  ');
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
    header('location:index.php#/home');
  }
}
?>
