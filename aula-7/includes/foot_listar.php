		<div id="footer">
			<p>Copyright &copy; 2014 <em>minimalistica</em> &middot; Design: Luka Cvrk, <a href="http://www.solucija.com/" title="Free CSS Templates">Solucija</a></p>
		</div>	
	</div>
<script>
(function () {
	var botoesRemover = document.querySelectorAll('.btn-remover');

	for(var i = 0, len = botoesRemover.length; i < len; i++) {
		botoesRemover[i].addEventListener('click', function (evt) {
			var podeDeletar = window.confirm('Tem certeza que deseja excluir este item?');

			if(!podeDeletar) evt.preventDefault(); 
		}, false);
	}
}());
	
</script>
</body>
</html>