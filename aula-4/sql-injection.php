<?php

$id = $_GET['id'];

$bd = new PDO('mysql:host=localhost;dbname=cursophp', 'root', '');

$variavel_vinda_da_url = "'; DROP DATABASE banco_qualquer; -- ";
// resultado na query:
"SELECT * FROM posts WHERE conteudo = ''; DROP DATABASE banco_qualquer; -- '";
// a função 'addslashes' ajuda no tipo de query acima 

//$stmt = $bd->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt = $bd->prepare("DELETE FROM usuarios WHERE id = ':id'");
//$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->bindValue(':id', $id);
$stmt->execute();

// não precisa preparar mais de 1 vez. basta injetar o novo valor e executar 
//$stmt->bindValue(2, $id, PDO::PARAM_INT);
//$stmt->execute();

// Não precisamos usar prepared statements se não injetamos variáveis na SQL
//$usuarios = $bd->query("SELECT * FROM usuarios"); // não há variáveis.
