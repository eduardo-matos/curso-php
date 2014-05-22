<?php

session_start();

require_once '../util/bd.php';
require_once '../util/funcoes.php';

if(!estaLogado()) {
	header('Location: login.php');
}
