<?php

require_once 'conexao-mysql-pdo.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nome = $_POST['nome'];
	$peso = $_POST['peso'];
	$email = $_POST['email'];
	$bd->exec(
		"INSERT INTO usuarios(nome, peso, email) VALUES ('{$nome}', {$peso}, '{$email}')");

	header('Location: banco-pdo.php?mensagem=Usuario criado com sucesso');
}


?>

<form method="POST">
	<div>
		<label>
			Nome <input name="nome">
		</label>
	</div>
	<div>
		<label>
			Peso <input name="peso">
		</label>
	</div>
	<div>
		<label>
			E-mail <input name="email">
		</label>
	</div>
	<input type="submit" value="Salvar!">
</form>