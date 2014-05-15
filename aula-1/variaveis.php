<?php

include "funcoes.php";

$idade = 27;
$nome = "Eduardo";
$ultimo_nome = 'silva';
$brasileiro = true;
$linguagens = array("php", "JavaScript");
$frameworks = array(
	"Laravel" => "php",
	"jQuery" => "JavaScript"
);
$altura = 1.7764783;

// echo $frameworks["Laravel"], "<br>", $frameworks["jQuery"], "<br>";
// echo "Idade: ", $idade;

// Comentário de uma linha

/*
 comentário
 de
 várias
 linhas
*/

$ListaFrameworks = array(
	"php" => array("Laravel", "Zend", "Symfony"),
	"javascript" => array("jQuery", "Dojo", "YUI")
);

// $ListaFrameworks["javascript"][1], '<br>';

$ListaFrameworks2 = array(
	array("Laravel", "Zend", "Symfony"),
	array("jQuery", "Dojo", "YUI")
);

// $ListaFrameworks2[1][0], '<br>';

?>
<h1>Dados pessoais</h1>
<dl>
	<dt>Idade</dt>
	<dd><?php echo $idade; ?></dd>
	<dt>Nome</dt>
	<dd><?php echo $nome; ?></dd>
	<dt>Altura</dt>
	<dd><?php echo round(dobrar($altura), 2); ?></dd>
</dl>
