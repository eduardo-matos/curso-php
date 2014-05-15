<?php
	$salt = 'skldfj@hdsfghi##sljd$ar7y%riuoriu';

	$suposto_login = 'edu';
	$suposta_senha_no_banco = 'ff5d08b0db929201e6cad8293b65d045'; // senha 123

	$mensagem  = '';

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if($_POST['login'] === $suposto_login
			&& md5($_POST['senha'] . $salt) === $suposta_senha_no_banco) {
			$mensagem = 'Usuario logado!';
		} else {
			$mensagem = 'Usuario nao existe';
		}
	}

?><!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<?php echo $mensagem; ?>
	<form method="POST">
		<label>
			Login <input name="login">
		</label>
		<br>
		<label>
			Senha <input name="senha" type="password">
		</label>
		<input type="submit" value="Login!">
	</form>
</body>
</html>