<?php

// definição simples
function soma($valor1, $valor2) {
	return $valor1 + $valor2;
}

echo soma(1, 2);
//soma(1); // erro. falta 1 parâmetro obrigatório

echo '<br>';

// definição com valor padrão
function soma2($valor1, $valor2=10) {
	return $valor1 + $valor2;
}

echo soma2(3); // 13
echo '<br>';
echo soma2(3, 4); // 7

echo '<br>';

// definição com valor padrão
function soma3() {
	// retorna a lista de parametros
	// passados para esta função
	$argumentos = func_get_args();

	return array_sum($argumentos);
}

echo soma3(1, 2, 3);

echo '<br>';

$usuarios_do_banco = array(
	array(
		'nome' => 'Eduardo',
		'idade' => 27
	),
	array(
		'nome' => 'Carlos',
		'idade' => 27
	)
);

function concatenador($usuarios) {
	$nomes = '';
	$idades = 0;

	foreach ($usuarios as $usuario) {
		$nomes .= $usuario['nome'];
		$idades += $usuario['idade'];
	}

	return array($nomes, $idades);
}

$concatenados = concatenador($usuarios_do_banco);

echo '<pre>';
print_r($concatenados);
echo '</pre>';

list($nomeConcatenado, $somaIdades) = concatenador($usuarios_do_banco);
// identico ao de cima
// $nomeConcatenado = $concatenados[0];
// $somaIdades = $concatenados[1];

echo $nomeConcatenado;
echo '<br>';
echo $somaIdades;

// não faça isso!
function soma4($value1=1, $valoe2) {
	return $value1 + $value2;
}

// Na documentação: sempre que o parâmetro estiver
// entre colchetes, ele é opcional.
// Repare que o parâmetro $precision está entre colchetes,
// ou seja, ele É opcional!
// float round ( float $val [, int $precision ] )

// parâmetros "nomeados"
function mesclador($usuario) {
	$usuario_padrao = array('nome' => 'sem nome', 'idade' => 0);
	$usuario_final = array_merge($usuario_padrao, $usuario);

	return $usuario_final;
}

echo '<pre>';
print_r(mesclador(array('nome' => 'Jose')));
echo '</pre>';
