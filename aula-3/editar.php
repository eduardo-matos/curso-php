<?php

require_once 'conexao-mysql.php';

function query($sql) {
	$resultado = mysql_query($sql);
	$rows  = array();
	if(mysql_num_rows($resultado)) {
		while ($row = mysql_fetch_assoc($resultado)) {
			$rows[] = $row;
		}
		return $rows;
	} else {
		return array();
	}
}

$id = $_GET['id'];

$rows = query("SELECT * FROM usuarios WHERE id = {$id}");
$usuario = $rows[0];

?>

<ul>
	<li><?php echo $usuario['nome'] ?></li>
	<li><?php echo $usuario['peso'] ?></li>
	<li><?php echo $usuario['email'] ?></li>
</ul>