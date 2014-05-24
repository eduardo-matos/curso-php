<?php
	require_once 'libs/PHPMailer/PHPMailerAutoloader.php';
	require_once 'util/funcoes.php';

	$erros = array();

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$email_validado = filter_var($email, FILTER_VALIDATE_EMAIL);
		$assunto = $_POST['assunto'];
		$mensagem = $_POST['mensagem'];

		// validação
		if(!$nome) $erros['nome'] = 'O nome é obrigatório';
		if(!$email_validado) $erros['email'] = 'Deve ser um e-mail válido';
		if(!$assunto) $erros['assunto'] = 'O assunto é obrigatório';
		if(!$mensagem) $erros['mensagem'] = 'A mensagem é obrigatória';

		if(!$erros) {
			$mail = new PHPMailer;

			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = '587';
			$mail->SMTPAuth = true;
			$mail->SMTPDebug = true;
			$mail->Username = 'eduardo.matos.silva@gmail.com';
			$mail->Password = '<sua senha>';
			$mail->SMTPSecure = 'tls';

			$mail->From = $email_validado;
			$mail->FromName = $nome;
			$mail->addAddress('seu_email@abc.com', 'Seu nome');
			$mail->isHTML(true);

			$mail->Subject = $assunto;
			$mail->Body    = $mensagem;
			$mail->AltBody = $mensagem;

			$mail->send();
		}

	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="author" content="Luka Cvrk (www.solucija.com)" />
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<title>minimalistica</title>
</head>
<body>
	<div id="content">
		<h1>minimalistica</h1>
		
		<ul id="menu">
			<li><a href="index.html">Home</a></li>
			<li><a href="historico.html">Histórico</a></li>
			<li><a href="contato.html">Contato</a></li>
		</ul>

		<div class="busca">
			<form>
				<input type="text" placeholder="Buscar" name="s" />
				<input type="submit" value="Buscar"/>
			</form>
		</div>

		<div class="post">
			<form method="POST">
				<div>
					<label for="nome">Nome</label>
					<input type="text" name="nome" id="nome" />
					<?php exibir_erro($erros, 'nome'); ?>
				</div>
				<div>
					<label for="email">E-mail</label>
					<input type="text" name="email" id="email" />
					<?php exibir_erro($erros, 'email'); ?>
				</div>
				<div>
					<label for="assunto">Assunto</label>
					<input type="text" name="assunto" id="assunto" />
					<?php exibir_erro($erros, 'assunto'); ?>
				</div>
				<div>
					<label for="mensagem">Mensagem</label>
					<textarea type="text" name="mensagem" id="mensagem"></textarea>
					<?php exibir_erro($erros, 'mensagem'); ?>
				</div>

				<input type="submit" value="Enviar!" />
			</form>
		</div>
		
		<div id="footer">
			<p>Copyright &copy; 2014 <em>minimalistica</em> &middot; Design: Luka Cvrk, <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a></p>
		</div>	
	</div>
</body>
</html>