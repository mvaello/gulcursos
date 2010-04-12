
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
			Si quieres colaborar en la organización haz click
			<?php echo $html->link("aqui.",$config['collaborate_link']); ?>
		</p>
		
		<p>
			<h1>
			<?php echo $html->link("Entrar a las Jornadas", "/courses/"); ?> 
			</h1>
		</p>
</div>


