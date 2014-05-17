<?php

require_once 'conexao-mysql-pdo.php';

$id = $_GET['id'];

$rows = $bd->query("SELECT * FROM usuarios WHERE id = {$id}");
$usuario = $rows->fetch();

// pode buscar os dados assim
// while ($row = $rows->fetch()) { }

?>

<ul>
	<li><?php echo $usuario['nome'] ?></li>
	<li><?php echo $usuario['peso'] ?></li>
	<li><?php echo $usuario['email'] ?></li>
</ul>

<form method="POST" action="alterar-pdo.php">
	<div>
		<label>
			Nome <input name="nome" value="<?php echo $usuario['nome']; ?>">
		</label>
	</div>
	<div>
		<label>
			Peso <input name="peso" value="<?php echo $usuario['peso']; ?>">
		</label>
	</div>
	<div>
		<label>
			E-mail <input name="email" value="<?php echo $usuario['email']; ?>">
		</label>
	</div>
	<input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
	<input type="submit" value="Alterar!">
</form>