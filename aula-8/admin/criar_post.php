<?php require_once '../util/start_admin.php'; ?>
<?php

	$erros = array();
	$mensagem = '';

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$titulo = $_POST['titulo'];
		$categoria_id = $_POST['categoria'];
		$publicado = isset($_POST['publicado'])? true: false;
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

			$stmt = $bd->prepare("INSERT INTO posts (titulo, conteudo, publicado, imagem, categoria_id)
				VALUES (:titulo, :conteudo, :publicado, :imagem, :categoria_id)");
			$stmt->bindValue(':titulo', $titulo);
			$stmt->bindValue(':conteudo', $conteudo);
			$stmt->bindValue(':publicado', $publicado);
			$stmt->bindValue(':imagem', $nome_imagem);
			$stmt->bindValue(':categoria_id', $categoria_id);
			$resultado = $stmt->execute();

			$post_id = $bd->lastInsertId();

			foreach($tags as $tag) {
				$stmt = $bd->prepare("INSERT INTO post_tags(post_id, tag_id) VALUES (:post_id, :tag_id)");
				$stmt->bindValue(':post_id', $post_id);
				$stmt->bindValue(':tag_id', $tag);
				$stmt->execute();
			}

			if($resultado) {
				$mensagem = 'Post criado com sucesso!';
			} else {
				$mensagem = 'Houve algum erro ao criar o post!';
			}
		}
	}
?>
<?php include '../includes/head.php'; ?>
<?php include '../includes/menu_admin.php'; ?>

		<div class="acoes">
			<h2>Criar Post</h2>
			<?php echo $mensagem; ?>
			<form method="POST" enctype="multipart/form-data">
				<div>
					<label for="titulo">Título</label>
					<input type="text" name="titulo" id="titulo" />
					<?php exibir_erro($erros, 'titulo'); ?>
				</div>
				<div>
					<label for="categoria">Categoria</label>
					<select name="categoria" id="categoria">
						<?php foreach($bd->query('SELECT id, titulo FROM categorias') as $categoria): ?>
							<option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['titulo'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div>
					<label for="tags">Tags</label>
					<select multiple="multiple" id="tags" name="tags[]" size="5" style="height: auto">
						<?php foreach($bd->query('SELECT id, titulo FROM tags') as $tag): ?>
							<option value="<?php echo $tag['id']; ?>"><?php echo $tag['titulo'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div>
					<label for="publicado">Publicado</label>
					<input type="checkbox" name="publicado" id="publicado" />
				</div>
				<div>
					<label for="imagem">Imagem</label>
					<input type="file" name="imagem" id="imagem" />
					<?php exibir_erro($erros, 'imagem'); ?>
				</div>
				<div>
					<label for="conteudo">Conteúdo</label>
					<textarea name="conteudo" id="conteudo"></textarea>
					<?php exibir_erro($erros, 'conteudo'); ?>
				</div>

				<input type="submit" value="Criar!" />
			</form>
		</div>

<?php include '../includes/foot.php'; ?>
