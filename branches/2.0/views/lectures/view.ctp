<div class="lectures view">
<h1><?php  echo $lecture['Lecture']['title'];?></h1>
	<div id='shortdescription'>
		<?php echo $lecture['Lecture']['briefdescription']; ?>
	</div>
	<?php $session->flash(); ?>
	<div id='description'> 
		<div id='mark'><div class='title'>Puntuaci&oacute;n</div>
		<div class='<?php echo $widewisse->markclass($lecture); ?>'>
			<?php echo $widewisse->marks($lecture); ?></div>
		</div>
		<?php echo $lecture['Lecture']['description']; ?>
		<ul>
			<li> <strong> Ponente: </strong><?php echo $lecture['Lecture']['teacher']; ?></li>
			<li> <strong> Fecha: </strong><?php echo $lecture['Lecture']['date']; ?></li>
			<li> <strong> Hora de inicio: </strong><?php echo substr($lecture['Lecture']['startingtime'],0,5); ?></li>
			<li> <strong> Hora de fin: </strong><?php echo substr($lecture['Lecture']['endingtime'],0,5); ?></li>
			<li> <strong> Aula: </strong><?php echo $lecture['Lecture']['room']; ?></li>
			<li> <strong> Conocimientos previos: </strong><?php echo $lecture['Lecture']['suggestedskills']; ?></li>
			<li> <strong> Nivel (1 = b&aacute;sico, 5 = dif&iacute;cil): </strong><?php echo $lecture['Lecture']['level']; ?></li>
			<li> <strong> Referencias: </strong> <?php echo $html->link($lecture['Lecture']['referencesurl']); ?></li>
			<li> <strong> Asistido por: </strong> <?php echo $lecture['Lecture']['assistedby']; ?></li>
		</ul>		
	</div>
	<?php echo $html->link(__("Return to course",true), "/courses/view/{$lecture['Course']['id']}"); ?>
	<?php if($user): ?>
		| <?php echo $html->link(__("Edit this lecture",true), "/lectures/edit/{$lecture['Lecture']['id']}"); ?>
	<?php endif; ?>

	<?php if(($lecture['Course']['closed'] == 0) && ($lecture['Course']['votes'] == 1) && ($canVote)): ?>
		<h2> ¡Danos tu opinión! </h2>
		<p>
			Si crees que te puede interesar puedes darle un +1. 
			De esta forma el GUL sabrá qué cursos son los 
			más interesantes. Estos votos son anónimos, por cierto.
		</p>
		<p>
			En el gul tenemos la costumbre de confiar en las personas así que no hemos puesto ningún 
			filtro para los votos. No contamos las IPs ni hacemos nada para saber si votas una vez 
			por cada curso. Así que si votas más veces de las debidas o no te portas todo lo bien que
			debieras no nos vamos a dar ni cuenta.
		</p>
		
		<?php echo $form->create('Vote');?>
		<?php echo $form->hidden('lecture',array('value'=>$lecture['Lecture']['id'])); ?>
		<?php echo $form->end('Vote');?>
	<?php endif; ?>
		

	<h2><?php __("Any comment?"); ?></h2>

	<?php echo $form->create('Comment');?>
		<?php
			echo $form->input('from');
			echo $form->hidden('lecture',array('value'=>$lecture['Lecture']['id']));
			echo $form->label('mark',__('Mark',true));
			echo $form->select('mark',array('-1'=>__('negative',true),'0'=>__('neutral',true),'1'=>__('positive',true)),array('value'=>0))."<br />";
			echo $form->label('comments',__('Comments',true));
			echo $form->textarea('comments');
		?>
	<?php echo $form->end('Comment');?>

	<?php if(count($lecture['Comment'])>0): ?>
	<h2><?php __("Comments"); ?></h2>
	<?php foreach($lecture['Comment'] as $comment): ?>
	<div class='<?php if($comment['mark']>=0){ echo "commentgood"; }else{ echo "commentbad"; } ?>'>
		<h3><?php echo $comment['from']; ?> dice:</h3>
		<div class='subtitle'><?php echo substr($comment['datetime'],0,16); ?></div>
		<div class='comment'>
			<?php echo $comment['comments']; ?>
			<p>mark: <?php echo $comment['mark']; ?></p>
		</div>
	</div>
	<?php if($user): ?>
	<div class='deletecomment'><?php echo $html->link(__('Delete',true),array('controller'=>'comments','action'=>'delete',$comment['id']),null,__('Are you sure you want to delete this comment?',true)); ?></div>
	<?php endif; ?>
	<?php endforeach; ?>
	<?php endif; ?>
</div>
