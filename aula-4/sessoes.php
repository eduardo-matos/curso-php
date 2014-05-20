<?php

session_start();

// identificação da sessão
// echo session_id();

// $_SESSION['username'] = 'teste';
echo $_SESSION['username'];
// $_SESSION['comidas'] = array('lasanha', 'macarrao');
print_r($_SESSION['comidas']);

// usado para destruir uma sessão (durante o logout por exemplo)
// session_destroy();
// $_SESSION = array();

// o 'username' está na sessão??
isset($_SESSION['username']);
