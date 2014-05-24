<?php require_once '../util/start_admin.php'; ?>
<?php

	$erros = array();
	$mensagem = '';

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$titulo = $_POST['titulo'];

		// validação
		if(!$titulo) $erros['titulo'] = 'O título é obrigatório';

		if(!$erros) {
			$stmt = $bd->prepare("INSERT IGNORE INTO tags (titulo) VALUES (:titulo)");
			$stmt->bindValue(':titulo', $titulo);
			$resultado = $stmt->execute();

			if($resultado) {
				$mensagem = 'Tag criada com sucesso!';
			} else {
				$mensagem = 'Houve algum erro ao criar a tag!';
			}
		}
	}
?>
<?php include '../includes/head.php'; ?>
<?php include '../includes/menu_admin.php'; ?>

		<div class="acoes">
			<h2>Criar Tag</h2>
			<?php echo $mensagem; ?>
			<form method="POST">
				<div>
					<label for="titulo">Título</label>
					<input type="text" name="titulo" id="titulo" />
					<?php exibir_erro($erros, 'titulo'); ?>
				</div>
				<input type="submit" value="Criar!" />
			</form>
		</div>

<?php include '../includes/foot.php'; ?>
