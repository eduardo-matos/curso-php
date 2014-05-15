<?php

	if(isset($_POST['primeiro_nome'])) {
		$nome = $_POST['primeiro_nome'];
	} else {
		$nome = '';
	}

	$erros = array();
	if($nome === '') {
		$erros['nome'] = 'O nome nao pode ser vazio';
	} else if(strlen($nome) < 3) {
		$erros['nome'] = 'O nome precisa ter no minimo 3 letras';
	}

	if(isset($_POST['idade'])) {
		$idade = $_POST['idade'];
	} else {
		$idade = 0;
	}

?><!DOCTYPE html>
<html>
<head>
	<title>Cadastro de usuario</title>
</head>
<body>
	<h1>Cadastro de usuario</h1>
	<form method="POST">
		<label>
			Nome <input name="primeiro_nome" value="<?php echo $nome; ?>">
			<?php if(isset($erros['nome'])) { echo $erros['nome']; } ?>
		</label>
		<br>
		<label>
			Idade <input name="idade" value="<?php echo $idade; ?>">
		</label>
		<input type="submit" value="Enviar!">
	</form>
	<strong>Nome</strong> <?php echo $nome; ?><br>
	<strong>Idade</strong> <?php echo $idade; ?>
</body>
</html>