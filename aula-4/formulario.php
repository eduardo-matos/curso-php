<?php

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$receber_spam = (isset($_POST['receber_spam']))? 1: 0;
		// Igual ao de cima (operador ternário).
		// if(isset($_POST['receber_spam'])) {
		// 	$receber_spam = 1;
		// } else {
		// 	$receber_spam = 0;
		// }

		// $sexo = (isset($_POST['sexo']))? $_POST['sexo']: 0;
		// $estado = $_POST['estado'];
		// $biografia = $_POST['biografia'];

		// $lista_de_hobbies = isset($_POST['hobbies'])? $_POST['hobbies']: array();

		echo '<pre>';
		var_dump($_FILES['foto']);
		echo '</pre>';


		if(!$_FILES['foto']['error']) {
			$nome_imagem = uniqid();

			// switch ($_FILES['foto']['type']) {
			// 	case 'jpeg':
			// 	case 'jpg':
			// 		$nome_imagem .= '.jpg';
			// 		break;
			// 	case 'gif':
			// 		$nome_imagem .= '.gif';
			// 		break;
			// 	case 'png':
			// 		$nome_imagem .= '.png';
			// 		break;
			// 	default:
			// 		exit('Erro!!');
			// 		break;
			// }

			$nome_imagem .= '.' . end(explode('.', $_FILES['foto']['name']));

		  	move_uploaded_file($_FILES['foto']['tmp_name'], 'imagens/' . $nome_imagem);
		}
	}

?>
<form method="POST" enctype="multipart/form-data">
	<label>
		<input type="checkbox" name="receber_spam">
		Deseja receber spam?
	</label>
	<br>
	
	<label>
		Sua foto
		<input type="file" name="foto">
	</label>

	Sexo<br>
	<label>
		<input type="radio" name="sexo" value="m"> Masculino<br>
	</label>
	<label>
		<input type="radio" name="sexo" value="f"> Feminino<br>
	</label>

	<label>
		<input type="checkbox" name="hobbies[]" value="futebol"> Futebol<br>
	</label>
	<label>
		<input type="checkbox" name="hobbies[]" value="basquete"> Basquete<br>
	</label>
	<label>
		<input type="checkbox" name="hobbies[]" value="volibol"> Voleibol<br>
	</label>
	
	<br>
	<label>
		Estado
		<select name="estado">
			<option value=""> -- </option>
			<option value="rj">Rio de Janeiro</option>
			<option value="sp">São Paulo</option>
			<option value="mg">Minas Gerais</option>
			<option value="rs">Rio Grande do Sul</option>
		</select>
	</label>
	<br>
	<label>
		Biografia
		<textarea name="biografia"></textarea>
	</label>
	<br>
	<input type="submit" name="submit" value="Postar!!">
</form>
