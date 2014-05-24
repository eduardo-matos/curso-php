<?php

require_once 'dados.php';

function criarSenha($senhaBase) {
	global $salt;
	return sha1($salt . $senhaBase);
}

function estaLogado() {
	if(isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
		return true;
	} else {
		return false;
	}
}

function exibir_erro($erros, $nome) {
	echo isset($erros[$nome])? $erros[$nome]:'';
}
