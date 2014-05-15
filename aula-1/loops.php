<?php

// for
// while
// do - while
// foreach

$frutas = array('melancia', 'pera', 'goiaba');
$pratos = array(
	'salgado' => array('lasanha', 'feijoada'),
	'doce' => array('sorvete', 'picole')
);

?>

<h1>Loop For</h1>
<ol>
	<?php for($i = 0; $i < count($frutas); $i++): ?>
		<li><?php echo $frutas[$i]; ?></li>
	<?php endfor; ?>
</ol>

<h1>Loop While</h1>
<ol>
	<?php $i = 0; ?>
	<?php while($i < count($frutas)): ?>
		<li><?php echo $frutas[$i]; ?></li>
		<?php $i++; ?>
	<?php endwhile; ?>
</ol>

<h1>Loop Do-While</h1>
<ol>
	<?php $i = 0; ?>
	<?php do { ?>
		<li><?php echo $frutas[$i]; ?></li>
		<?php $i++; ?>
	<?php } while($i < count($frutas)); ?>
</ol>

<h1>Loop Foreach</h1>
<ol>
	<?php foreach($frutas as $fruta): ?>
		<li><?php echo $fruta; ?></li>
	<?php endforeach; ?>
</ol>


<h1>Loop Foreach (com chave)</h1>
<ol>
	<?php foreach($pratos as $sabor => $subpratos): ?>
		<li>
			Sabor: <?php echo $sabor; ?><br>
			<ol>
				<?php foreach($subpratos as $prato): ?>
					<li><?php echo $prato; ?></li>
				<?php endforeach; ?>
			</ol>
		</li>
	<?php endforeach; ?>
</ol>

