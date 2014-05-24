<?php require_once '../util/start_admin.php'; ?>
<?php include '../includes/head.php'; ?>
<?php include '../includes/menu_admin.php'; ?>

		<div class="acoes">
			<h2>Categorias</h2>
			<table>
				<thead>
					<tr>
						<th>Título</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($bd->query('SELECT id, titulo FROM categorias') as $categoria): ?>
						<tr>
							<td><?php echo $categoria['titulo'] ?></td>
							<td>
								<a href="editar_categoria.php?id=<?php echo $categoria['id'] ?>">editar</a> |
								<a href="remover_categoria.php?id=<?php echo $categoria['id'] ?>" class="btn-remover">remover</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

<?php include '../includes/foot_listar.php'; ?>

