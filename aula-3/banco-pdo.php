<?php require_once 'conexao-mysql-pdo.php'; ?>

<?php if(isset($_GET['mensagem'])) echo $_GET['mensagem']; ?>
<ul>
	<?php foreach ($bd->query("SELECT * FROM usuarios") as $usuario): ?>
		<li>
			<a href="editar-pdo.php?id=<?php echo $usuario['id'] ?>">
				<?php echo $usuario['nome']; ?>
			</a>
			<br>
			<?php echo $usuario['peso']; ?><br>
			<?php echo $usuario['email']; ?>
			<a href="deletar-usuario-pdo.php?id=<?php echo $usuario['id'] ?>">
				Remover</a>
		</li>
	<?php endforeach; ?>
</ul>
