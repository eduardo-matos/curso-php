<?php

require_once 'conexao-mysql-pdo.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$peso = $_POST['peso'];

var_dump($peso);

$numero_linhas_afetadas =
 $bd->exec(
	"UPDATE usuarios SET nome = '{$nome}', email = '{$email}', peso = {$peso} WHERE id = {$id}");

header('Location: banco-pdo.php');
