<?php require_once '../util/start_admin.php'; ?>
<?php
	
	$mensagem = '';
	
	if($_SERVER['REQUEST_METHOD'] === 'POST') {

		$stmt = $bd->prepare("DELETE FROM categorias WHERE id = :id");
		$stmt->bindValue(':id', $_POST['categoria_id'], PDO::PARAM_INT);
		$resultado = $stmt->execute();

		if($resultado) {
			header('Location: listar_categorias.php');
		} else {
			$mensagem = 'Houve algum erro ao criar a categoria';
		}
	}

	$stmt = $bd->prepare("SELECT id, titulo FROM categorias WHERE id = ?");
	$stmt->execute(array($_GET['id']));
	$categoria = $stmt->fetch();

?>
<?php include '../includes/head.php'; ?>
<?php include '../includes/menu_admin.php'; ?>

		<div class="acoes">
			<h2>Remover Categoria</h2>			
			<p>Você realmente deseja remover a categoria "<?php echo $categoria['titulo'] ?>" ?</p>
			
			<?php if($mensagem): ?>
				<p><?php echo $mensagem ?>. Tente novamente</p>
			<?php endif; ?> 
			
			<form method="POST">
				<input type="hidden" name="categoria_id" value="<?php echo $categoria['id'] ?>" />
				<input type="submit" value="Remover!" />
			</form>
		</div>

<?php include '../includes/foot.php'; ?>
