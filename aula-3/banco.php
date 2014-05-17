<?php

require_once 'conexao-mysql.php';

$resultado = mysql_query("SELECT * FROM usuarios");
?>

<?php if($resultado AND mysql_num_rows($resultado)): ?>
	<ul>
		<?php while ($usuario = mysql_fetch_assoc($resultado)): ?>
			<li>
				<a href="editar.php?id=<?php echo $usuario['id'] ?>">
					<?php echo $usuario['nome']; ?>
				</a>
				<br>
				<?php echo $usuario['peso']; ?><br>
				<?php echo $usuario['email']; ?>
			</li>
		<?php endwhile; ?>
	</ul>
<?php endif; ?>
