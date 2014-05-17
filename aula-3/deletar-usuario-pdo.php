<?php

require_once 'conexao-mysql-pdo.php';

$id = $_GET['id'];

$numero_registros_removidos =
 $bd->exec("DELETE FROM usuarios WHERE id = {$id}");

header('Location: banco-pdo.php');
