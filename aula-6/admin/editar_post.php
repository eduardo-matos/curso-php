<?php require_once '../util/start_admin.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
			<h2>Criar Post</h2>
			<form>
				<div>
					<label for="titulo">Título</label>
					<input type="text" name="titulo" id="titulo" value="Post 1" />
				</div>
				<div>
					<label for="categoria">Categoria</label>
					<select name="categoria" id="categoria">
						<option value="1" selected="selected">Categoria 1</option>
						<option value="2">Categoria 2</option>
						<option value="3">Categoria 3</option>
						<option value="4">Categoria 4</option>
					</select>
				</div>
				<div>
					<label for="publicado">Publicado</label>
					<input type="checkbox" name="publicado" id="publicado" checked="checked" />
				</div>
				<div>
					<label for="conteudo">Conteúdo</label>
					<textarea name="conteudo" id="conteudo">Conteúdo do post 1</textarea>
				</div>
				<input type="hidden" name="id" value="1" />
				<input type="submit" value="Criar!" />
			</form>
		</div>

		<div id="footer">
			<p>Copyright &copy; 2014 <em>minimalistica</em> &middot; Design: Luka Cvrk, <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a></p>
		</div>	
	</div>
</body>
</html>