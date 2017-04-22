
<div class="form-group row">
	<form action="contato.php" method="post">
		<div class="form-group row">
		<label for="remetente" class="col-2 col-form-label">E-Mail Remetente</label>
		<div class="col-2">
			<input class="form-control" type="text" name="remetente" placeholder="Digite seu E-Mail">
		</div>
		<label for="assunto" class="col-2 col-form-label">Assunto</label>
		<div class="col-2">
			<input class="form-control" type="text" name="assunto" placeholder="Assunto">
		</div>
		<label for="complemento" class="col-2 col-form-label">Complemento</label>
		<div class="col-2">
			<textarea class="form-control" name="complemento" rows="5"></textarea>
		</div>
		</div>
				
		<input class="btn btn-primary" type="submit" value="Gravar" name="grava"/>
	</form>
</div>

<?php
	require_once('adm/conexao/conexao.php');
	if(isset($_POST['grava'])){
		$remetente=$_POST['remetente'];
		$assunto=$_POST['assunto'];
		$complemento=$_POST['complemento'];
		$data = date("Y-m-d H:i:s");
		
		//Preparar o SQL
		$prep_grava=$conn->prepare('INSERT INTO `contatorecebido` 
		(`remetente`,`assunto`,`texto`,`data_envio`) VALUES 
		(:premetente,:passunto,:pcomplemento,:pdata);');
		$prep_grava->bindValue(':premetente',$remetente);
		$prep_grava->bindValue(':passunto',$assunto);
		$prep_grava->bindValue(':pcomplemento',$complemento);
		$prep_grava->bindValue(':pdata',$data);
		$prep_grava->execute();
		if ($prep_grava){
			echo "	<script>
						alert('Contato Enviado Realizado!');
						document.location='/universidade/';
					</script>";
		}
		else{
			echo "<script>alert('Erro no cadastro!')</script>";
		}	
	}
?>