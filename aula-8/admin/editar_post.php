<?php require_once '../util/start_admin.php'; ?>
<?php

	$erros = array();
	$mensagem = '';

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$titulo = $_POST['titulo'];
		$categoria_id = $_POST['categoria'];
		$publicado = isset($_POST['publicado']);
		$conteudo = $_POST['conteudo'];
		$tags = $_POST['tags'];

		// validação
		if(!$titulo) $erros['titulo'] = 'O título é obrigatório';
		if(!$conteudo) $erros['conteudo'] = 'O conteudo é obrigatório';
		if($_FILES['imagem']['error']) $erros['imagem'] = 'É obrigatório escolher uma imagem';

		if(!$erros) {

			$n = $_FILES['imagem']['name'];
			$v = explode('.', $n);
			$extensao = end($v);
			$nome_imagem = uniqid() . '.' . $extensao;

			if(strtolower($extensao) === 'jpg') {
				$img = imagecreatefromjpeg($_FILES['imagem']['tmp_name']);
			} else if(strtolower($extensao) === 'png') {
				$img = imagecreatefrompng($_FILES['imagem']['tmp_name']);
			} else if(strtolower($extensao) === 'gif') {
				$img = imagecreatefromgif($_FILES['imagem']['tmp_name']);
			}

			list($src_width, $src_height) = getimagesize($_FILES['imagem']['tmp_name']);
			$img_reduzida = imagecreatetruecolor(200, 200);
			imagecopyresampled($img_reduzida, $img, 0, 0, 0, 0, 200, 200 ,$src_width, $src_height);

			if(strtolower($extensao) === 'jpg') {
				imagejpeg($img_reduzida, '../img/' . $nome_imagem);
			} else if(strtolower($extensao) === 'png') {
				imagepng($img_reduzida, '../img/' . $nome_imagem);
			} else if(strtolower($extensao) === 'gif') {
				imagegif($img_reduzida, '../img/' . $nome_imagem);
			}

			$stmt = $bd->prepare("UPDATE posts SET titulo = :titulo,
									conteudo = :conteudo, publicado = :publicado,
									imagem = :imagem, categoria_id = :categoria_id
								  WHERE id = :post_id");
			$stmt->bindValue(':titulo', $titulo);
			$stmt->bindValue(':conteudo', $conteudo);
			$stmt->bindValue(':publicado', $publicado);
			$stmt->bindValue(':imagem', $nome_imagem);
			$stmt->bindValue(':categoria_id', $categoria_id);
			$stmt->bindValue(':post_id', $_GET['id'], PDO::PARAM_INT);
			$resultado = $stmt->execute();

			$bd->prepare('DELETE FROM post_tags WHERE post_id = ?')->execute(array($_GET['id']));

			foreach($tags as $tag) {
				$stmt = $bd->prepare("INSERT INTO post_tags(post_id, tag_id) VALUES (:post_id, :tag_id)");
				$stmt->bindValue(':post_id', $_GET['id']);
				$stmt->bindValue(':tag_id', $tag);
				$stmt->execute();
			}

			if($resultado) {
				$mensagem = 'Post editado com sucesso!';
			} else {
				$mensagem = 'Houve algum erro ao editar o post!';
			}
		}
	}

	$sql = <<<SQL
		SELECT 
			P.titulo,
			p.categoria_id,
			GROUP_CONCAT(DISTINCT t.id) as tags,
			publicado,
			conteudo
		FROM posts p
		LEFT JOIN post_tags pt ON p.id = pt.post_id
		LEFT JOIN tags t ON t.id = pt.tag_id
		WHERE p.id = :post_id
SQL;

	$stmt = $bd->prepare($sql);
	$stmt->bindValue(':post_id', $_GET['id'], PDO::PARAM_INT);
	$stmt->execute();
	$post = $stmt->fetch();


?>
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
			<form method="POST" enctype="multipart/form-data">
				<div>
					<label for="titulo">Título</label>
					<input type="text" name="titulo" id="titulo" value="<?php echo $post['titulo'] ?>" />
				</div>
				<div>
					<label for="categoria">Categoria</label>
					<select name="categoria" id="categoria">
						<?php foreach ($bd->query('SELECT id, titulo FROM categorias') as $categoria): ?>
							<option value="<?php echo $categoria['id'] ?>" <?php echo ($categoria['id'] == $post['categoria_id'])? 'selected="selected"': ''; ?>><?php echo $categoria['titulo']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div>
					<label for="tags">Tags</label>
					<select multiple="multiple" id="tags" name="tags[]" size="5" style="height: auto">
						<?php $post_tags = explode(',', $post['tags']); ?>
						<?php foreach($bd->query('SELECT id, titulo FROM tags') as $tag): ?>
							<option value="<?php echo $tag['id']; ?>" <?php echo in_array($tag['id'], $post_tags)? 'selected="selected"': ''; ?>><?php echo $tag['titulo'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div>
					<label for="publicado">Publicado</label>
					<input type="checkbox" name="publicado" id="publicado" <?php echo ($post['publicado'] === '1')? 'checked="checked"': ''; ?> />
				</div>
				<div>	
					<label for="imagem">Imagem</label>
					<input type="file" name="imagem" id="imagem" />
					<?php exibir_erro($erros, 'imagem'); ?>
				</div>
				<div>
					<label for="conteudo">Conteúdo</label>
					<textarea name="conteudo" id="conteudo"><?php echo $post['conteudo']; ?></textarea>
				</div>
				<input type="submit" value="Editar!" />
			</form>
		</div>

		<div id="footer">
			<p>Copyright &copy; 2014 <em>minimalistica</em> &middot; Design: Luka Cvrk, <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a></p>
		</div>	
	</div>
</body>
</html>