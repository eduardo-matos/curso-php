<?php require_once '../util/start_admin.php'; ?>
<?php
	
	$erros = array();
	$mensagem = '';

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$titulo = $_POST['titulo'];

		// validação
		if(!$titulo) $erros['titulo'] = 'O título é obrigatório';

		if(!$erros) {
			$stmt = $bd->prepare("UPDATE categorias SET titulo = :titulo WHERE id = :id");
			$stmt->bindValue(':titulo', $titulo);
			$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
			$resultado = $stmt->execute();

			if($resultado) {
				$mensagem = 'Categoria criada com sucesso!';
			} else {
				$mensagem = 'Houve algum erro ao criar a categoria!';
			}
		}
	}

	$stmt = $bd->prepare("SELECT id, titulo FROM categorias WHERE id = ?");
	$stmt->execute(array($_GET['id']));
	$categoria = $stmt->fetch();

?>
<?php include '../includes/head.php'; ?>
<?php include '../includes/menu_admin.php'; ?>

		<div class="acoes">
			<h2>Criar Categoria</h2>
			<?php echo $mensagem ?>
			<form method="POST">
				<div>
					<label for="titulo">Título</label>
					<input type="text" name="titulo" id="titulo" value="<?php echo $categoria['titulo'] ?>" />
					<?php exibir_erro($erros, 'titulo') ?>
				</div>
				<input type="submit" value="Criar!" />
			</form>
		</div>

<?php include '../includes/foot.php'; ?>
