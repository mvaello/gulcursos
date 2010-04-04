
<div class="centered">
	<br/>
	<p> 
		<h1>
		Bienvenido a <?php echo $config['title']; ?>. 
		</h1>
	</p>
	<?php echo $html->image("pizarra.png"); ?>
		<p>
			En esta página puedes ver los cursos que se han dado y los que se están gestando.
		</p>

		<p>	
			Como usuario anónimo puedes hacer lo típico: comentar los cursos pasados, proponer alguno, 
			votar los nuevos cursos, esas cosas. 
		</p>

		<p>
			Si quieres ayudar en la organización apúntate
			<?php echo $html->link("al grupo de organización de cursos del GUL.","http://wiki.gul.es/doku.php?id=gul-cursos"); ?>
		</p>
		
		<p>
			<h1>
			<?php echo $html->link("Entrar a las Jornadas", "/courses/"); ?> 
			</h1>
		</p>
</div>


