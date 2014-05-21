<?php

	session_start();

	require_once '../util/bd.php';
	require_once '../util/funcoes.php';

	if(estaLogado()) {
		header('Location: index.php');
	}

	$mensagem = "";

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$email = $_POST['email'];
		$senha = criarSenha($_POST['senha']);

		$stmt = $bd->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':senha', $senha);
		$stmt->execute();

		if($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$_SESSION['logado'] = true;
			$_SESSION['email'] = $usuario['email'];
			
			header('Location: index.php');
		} else {
			$mensagem = "Este usuário não foi encontrado no sistema.";
		}

	}

?>
<?php include '../includes/head.php'; ?>
<?php include '../includes/menu_publico.php'; ?>

	<?php echo $mensagem; ?>
	<form class="login" method="POST">
		<div>
			<label for="email">E-mail</label>
			<input type="text" name="email" id="email" />
		</div>
		<div>
			<label for="senha">Senha</label>
			<input type="password" name="senha" id="senha" />
		</div>
		<input type="submit" value="Login" />
	</form>

<?php include '../includes/foot.php'; ?>
