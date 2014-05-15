<?php

if(true) {
	echo "true: verdadeiro";
} else {
	echo "true: falso";
}

echo "<br>";

if(1) {
	echo "1: verdadeiro";
} else {
	echo "1: falso";
}

echo "<br>";

if(0) {
	echo "0: verdadeiro";
} else {
	echo "0: falso";
}

echo "<br>";

if(-1) {
	echo "-1: verdadeiro";
} else {
	echo "-1: falso";
}

echo "<br>";

if("abc") {
	echo "\"abc\": verdadeiro";
} else {
	echo "\"abc\": falso";
}

echo "<br>";

if("") {
	echo "\"\": verdadeiro";
} else {
	echo "\"\": falso";
}

echo "<br>";

if("0") {
	echo "\"0\": verdadeiro";
} else {
	echo "\"0\": falso";
}

echo "<br>";

if("0" === false) {
	echo "\"0\": verdadeiro";
} else {
	echo "\"0\": falso";
}

echo "<br>";

if(10 > 2) {
	echo "10 > 2: verdadeiro";
} else {
	echo "10 > 2: falso";
}

echo "<br>";

if(10 !== 2) {
	echo "10 !== 2: verdadeiro";
} else {
	echo "10 !== 2: falso";
}

echo "<br>";

$lista = array(1, 2, 3);
if(empty($lista)) {
	echo 'empty($lista): verdadeiro';
} else {
	echo 'empty($lista): falso';
}

echo "<br>";

if(!empty($lista) && count($lista) > 10) {
	echo 'lista nao vazia e contem mais de 10 caracteres: verdadeiro';
} else {
	echo 'lista nao vazia e contem mais de 10 caracteres: falso';
}

echo "<br>";

if(!empty($lista) || count($lista) > 10) {
	echo 'lista nao vazia e contem mais de 10 caracteres: verdadeiro';
} else {
	echo 'lista nao vazia e contem mais de 10 caracteres: falso';
}

echo "<br>";

if(count($lista) >= 3) {
	echo 'lista tem 3 ou mais caracteres: verdadeiro';
} else {
	echo 'lista tem 3 ou mais caracteres: falso';
}

echo '<br>';

$nome = 'Eduardo';

switch ($nome) {
	case 'Carlos':
		echo 'Nome eh carlos';
		break;
	case 'Joao':
		echo 'Nome eh joao';
		break;
	case 'Eduardo':
		echo 'Nome eh eduardo';
		break;
	default:
		break;
}
