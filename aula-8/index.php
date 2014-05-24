<?php
	require_once 'util/bd.php';

	// se a url diz a página atual, usá-la. se não diz, considerar página = 1.
	$pagina = isset($_GET['pagina'])? $_GET['pagina']: 1;

	// nós definimos a quantidade de posts por página
	$posts_por_pagina = 4;

	$busca = isset($_GET['busca'])? $_GET['busca']: '';

	// quantidade total de posts cadastrados no banco de dados
	$stmt = $bd->prepare('SELECT COUNT(*) AS qtd_posts FROM posts WHERE conteudo LIKE ?');
	$stmt->bindValue(1, '%'.$busca.'%');
	$stmt->execute();
	$row = $stmt->fetch();
	$qtd_posts = $row['qtd_posts'];

	// quantidade total de páginas
	$qtd_paginas = ceil($qtd_posts/$posts_por_pagina);

	$offset = $posts_por_pagina * ($pagina - 1);

	// Posts que serão exibidos na página
	$sql = <<<SQL
		SELECT p.id, p.titulo, p.conteudo, GROUP_CONCAT(DISTINCT t.titulo) AS tags
		FROM posts p
		LEFT JOIN post_tags pt ON p.id = pt.post_id 
		LEFT JOIN tags t ON t.id = pt.tag_id
		WHERE conteudo LIKE ?
		GROUP BY p.id, p.titulo, p.conteudo
		ORDER BY p.id DESC
		LIMIT 4	
		OFFSET {$offset}
SQL;

	$stmt = $bd->prepare($sql);
	$stmt->bindValue(1, '%'.$busca.'%');
	$stmt->execute();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="author" content="Luka Cvrk (www.solucija.com)" />
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<title>minimalistica</title>
</head>
<body>
	<div id="content">
		<h1>minimalistica</h1>
		
		<ul id="menu">
			<li><a href="index.html">Home</a></li>
			<li><a href="historico.html">Histórico</a></li>
			<li><a href="contato.html">Contato</a></li>
		</ul>

		<div class="busca">
			<form>
				<input type="text" placeholder="Buscar" name="busca" value="<?php echo $busca; ?>" />
				<input type="submit" value="Buscar"/>
			</form>
		</div>

		<?php $primeiro_post = $stmt->fetch(); ?>
		<div class="post">
			<div class="details">
				<h2><a href="#"><?php echo $primeiro_post['titulo']; ?></a></h2>
			</div>
			<div class="body">
				<p><?php echo $primeiro_post['conteudo']; ?></p>
				<div class="tags">
					<ul>
						<?php $lista_tags = explode(',', $primeiro_post['tags']); ?>
						<?php if($primeiro_post['tags'] !== null): ?>
							<?php foreach ($lista_tags as $tag): ?>
								<li><?php echo $tag ?></li>							
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>
			<div class="x"></div>
		</div>

		<?php $i = 1; ?>
		<?php while ($post = $stmt->fetch()): ?>
			<div class="col <?php echo ($i % 3 === 0)? 'last': ''; ?>">
				<?php $i++ ?>
				<h3><a href="#"><?php echo $post['titulo']; ?></a></h3>
				<p><?php echo substr($post['conteudo'], 0, 100); ?></p>
				<p>&not; <a href="#">read more</a></p>
				<div class="tags">
					<ul>
						<?php $lista_tags = explode(',', $post['tags']); ?>
						<?php if($post['tags'] !== null): ?>
							<?php foreach ($lista_tags as $tag): ?>
								<li><?php echo $tag ?></li>							
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		<?php endwhile; ?>

		<div class="paginacao">
			<?php if($pagina > 1): ?>
				<a href="?pagina=<?php echo $pagina - 1 ?><?php echo $busca? '&busca='.$busca: ''; ?>" >&#8592; Anterior</a>
			<?php endif; ?>

			Página <?php echo $pagina ?> de <?php echo $qtd_paginas ?>

			<?php if($pagina < $qtd_paginas): ?>
				<a href="?pagina=<?php echo $pagina + 1 ?><?php echo $busca? '&busca='.$busca: ''; ?>">Próxima &#8594;</a>
			<?php endif; ?>
		</div>

		<div id="footer">
			<p>Copyright &copy; <?php echo date('Y'); ?> <em>minimalistica</em> &middot; Design: Luka Cvrk, <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a></p>
		</div>	
	</div>
</body>
</html>