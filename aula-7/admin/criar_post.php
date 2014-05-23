<?php require_once '../util/start_admin.php'; ?>
<?php

	$erros = array();
	$mensagem = '';

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$titulo = $_POST['titulo'];
		$categoria_id = $_POST['categoria'];
		$publicado = isset($_POST['publicado'])? true: false;
		$conteudo = $_POST['conteudo'];

		// validação
		if(!$titulo) $erros['titulo'] = 'O título é obrigatório';
		if(!$conteudo) $erros['conteudo'] = 'O conteudo é obrigatório';
		if($_FILES['imagem']['error']) $erros['imagem'] = 'É obrigatório escolher uma imagem';

		if(!$erros) {
			$n = $_FILES['imagem']['name'];
			$v = explode('.', $n);
			$nome_imagem = uniqid() . '.' . end($v);
			move_uploaded_file($_FILES['imagem']['tmp_name'], '../img/' . $nome_imagem);

			$stmt = $bd->prepare("INSERT INTO posts (titulo, conteudo, publicado, imagem, categoria_id)
				VALUES (:titulo, :conteudo, :publicado, :imagem, :categoria_id)");
			$stmt->bindValue(':titulo', $titulo);
			$stmt->bindValue(':conteudo', $conteudo);
			$stmt->bindValue(':publicado', $publicado);
			$stmt->bindValue(':imagem', $nome_imagem);
			$stmt->bindValue(':categoria_id', $categoria_id);
			$resultado = $stmt->execute();

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
