<?php

$nome = 'Eduardo';

//echo $nome;

function fazNada()
{
	global $nome;
	echo $nome;
}

fazNada();

function Contador()
{
	static $counter = 0;
	$counter++;
	echo $counter;
}

echo Contador() , '<br>';
echo Contador() , '<br>';
echo Contador() , '<br>';
echo Contador() , '<br>';
echo Contador() , '<br>';

function mais1(&$valor)
{
	return ++$valor;
}

$meu_numero = 6;

mais1($meu_numero);
echo $meu_numero;
