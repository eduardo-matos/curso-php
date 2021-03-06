<?php

	require_once '../util/bd.php';
	require_once '../util/funcoes.php';

	$erros = array();
	$nome = '';
	$email = '';

	function exibir_erro($erros, $nome) {
		echo isset($erros[$nome])? $erros[$nome]:'';
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$email_validado = filter_var($email, FILTER_VALIDATE_EMAIL);
		$senha = $_POST['senha'];
		$repetir_senha = $_POST['repetir-senha'];

		// Validação
		if(!$nome) $erros['nome'] = 'O nome é obrigatório';
		if(!$email_validado) $erros['email'] = 'E-mail inválido';
		if(!$senha) $erros['senha'] = 'É obrigatório definir uma senha';
		if($senha !== $repetir_senha) $erros['repetir-senha'] = 'A senha deve ser idêntica em ambos os campos';

		// Se não tiver erros, inserir usuário no banco de dados
		if(!$erros) {
			$senhaComSalt = criarSenha($senha);

			// verificar se já existe o e-mail cadastrado no banco
			$stmt = $bd->prepare("SELECT * FROM usuarios WHERE email = :email");
			$stmt->bindValue(':email', $email_validado);
			$stmt->execute();

			// se e-mail nao existe no sistema, criar usuário
			if(!$stmt->fetch()) {
				$stmt = $bd->prepare("INSERT INTO usuarios(nome, email, senha) VALUES (:nome, :email, :senha)");
				$stmt->bindValue(':nome', $nome);
				$stmt->bindValue(':email', $email_validado);
				$stmt->bindValue(':senha', $senhaComSalt);
				$usuario_criado = $stmt->execute();

				if($usuario_criado) {
					$mensagem = 'Usuário criado com sucesso!';
				}
			} else {
			// se e-mail existe no sistema, exibir mensagem de erro
				$mensagem = 'Já existe um usuário com este e-mail!';
			}

		}
	}


?>
<?php include '../includes/head.php'; ?>
<?php include '../includes/menu_admin.php'; ?>

		<div class="acoes">
			<h2>Criar Usuário</h2>

			<?php echo (isset($mensagem) && $mensagem)? $mensagem: ''; ?>

			<form method="POST">
				<div>
					<label for="nome">Nome</label>
					<input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" />
					<?php exibir_erro($erros, 'nome'); ?>
				</div>
				<div>
					<label for="email">E-mail</label>
					<input type="text" name="email" id="email" value="<?php echo $email ?>" />
					<?php exibir_erro($erros, 'email'); ?>
				</div>
				<div>
					<label for="senha">Senha</label>
					<input type="password" name="senha" id="senha" />
					<?php exibir_erro($erros, 'senha'); ?>
				</div>
				<div>
					<label for="repetir-senha">Repetir Senha</label>
					<input type="password" name="repetir-senha" id="repetir-senha" />
					<?php exibir_erro($erros, 'repetir-senha'); ?>
				</div>
				<input type="submit" value="Criar!" />
			</form>
		</div>

<?php include '../includes/foot.php'; ?>
