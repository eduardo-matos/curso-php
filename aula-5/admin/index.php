<?php

	session_start();

	require_once '../util/funcoes.php';

	if(!estaLogado()) {
		header('Location: login.php');
	}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="author" content="Luka Cvrk (www.solucija.com)" />
	<link rel="stylesheet" href="../css/main.css" type="text/css" />
	<title>minimalistica</title>
</head>
<body class="admin">
	<div id="content">
		<h1>minimalistica</h1>

		<ul id="menu">
			<li><a href="criar_post.html">Criar Post</a></li>
			<li><a href="criar_categoria.html">Criar Categoria</a></li>
			<li><a href="criar_usuario.html">Criar Usuário</a></li>
		</ul>

		<div class="acoes">
			<h2>Posts</h2>
			<ul>
				<li><a href="#">Listar</a></li>
				<li><a href="#">Criar</a></li>
			</ul>

			<h2>Categorias</h2>
			<ul>
				<li><a href="#">Listar</a></li>
				<li><a href="#">Criar</a></li>
			</ul>

			<h2>Usuários</h2>
			<ul>
				<li><a href="#">Listar</a></li>
				<li><a href="#">Criar</a></li>
			</ul>
		</div>

		<div id="footer">
			<p>Copyright &copy; 2014 <em>minimalistica</em> &middot; Design: Luka Cvrk, <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a></p>
		</div>	
	</div>
</body>
</html>