<pre>
<?php # var_dump($lectures); ?>
</pre>
<div class="courses view">
<h1 id="courses"><?php echo __('Lectures'); ?></h1>
<?php if ($course['Course']['votes'] > 0): ?>
	<p><?php echo __('These are the proposed speaks for this course. The most voted speaks will be done. If you are interested in any, you can vote it clicking in the speak title.'); ?></p>
<?php else: ?>
	<p><?php echo __('These are the proposet speeks for this course. If you want to know more, click in the title of the speask.'); ?><p>
<?php endif; ?>

<?php echo __('Maybe you are interested in see the '); ?>
<?php echo $html->link("courses calendar.", "/courses/calendar/".$course['Course']['id']);?>

<?php if ($course['Course']['votes'] > 0): ?>
	<?php echo __('We are in the organization phase, the calendar could not be finished'); ?>
<?php endif; ?>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<div class="related">
	<table cellpadding="0" cellspacing="0">
	<tr class='head'>
		<th><?php echo $paginator->sort('title');?></th>
		<th><?php echo $paginator->sort('date');?></th>
		<th><?php echo $paginator->sort('hour');?></th>
		<th><?php echo $html->link('votes',array('action'=>'view',$course['Course']['id'],'desc'));?></th>
		<th><?php __('comments');?></th>
		<th><?php __('pupils');?></th>
		<?php if($myuser): ?>
			<th class="actions"><?php __('Actions');?></th>
		<?php endif; ?>
	</tr>

	<?php
		$i = 0;
		foreach ($lectures as $lecture):
			$class = "plain";
			if ($i++ % 2 == 0) {
				$class = ' class="alt"';
			}
		?>
		<tr<?php echo $class;?>>
			<td>
				<?php echo $html->link($lecture['Lecture']['title'],array('controller'=>'lectures','action'=>'view',$lecture['Lecture']['id'])); ?>
				<div class='teacher'><?php echo $lecture['Lecture']['teacher']; ?></div>
			</td>
			<td><?php echo $widewisse->date($lecture['Lecture']['date']);?></td>
			<td><?php echo $widewisse->period($lecture['Lecture']['startingtime'],$lecture['Lecture']['endingtime']);?></td>
			<td><?php echo $widewisse->votes($lecture);?></td>
			<td><?php echo $widewisse->comments($lecture);?></td>
			<td><?php echo $widewisse->pupils($lecture); ?></td>
			<?php if($myuser): ?>
			<td class="actions">
				<?php echo $html->link(__('Edit', true), array('controller'=> 'lectures', 'action'=>'edit', $lecture['Lecture']['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'lectures', 'action'=>'delete', $lecture['Lecture']['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $lecture['Lecture']['title'])); ?>
			</td>
			<?php endif; ?>
		</tr>
		<?php endforeach; ?>
	</table>

	<?php if($course['Course']['proposals']): ?>
		<div class='proposal'>
		<h2>¿Alguna propuesta?</h2>
		<p>¿Tienes alguna propuesta de curso para estas jornadas? ¿Te interesa un tema y no hay charlas sobre ello? ¡Abre la boca!</p>
		<p>Mándanos una propuesta y el resto de la comunidad podrá verla y votarla. Incluso puedes proponer al ponente y ganarte su enemistad.</p>	
		<p>Hmmm... ¿Que eres tú quien quiere dar ese curso? Pues proponte a ti mismo como ponente, alma de cántaro :)</p>
			<div class="lectures form">
			<?php echo $form->create('Lecture');?>
				<?php
					echo $form->hidden('course',array('value'=>$course['Course']['id']));
					echo $form->input('title');
					echo $form->input('teacher');
					echo $form->input('briefdescription');
				?>
			<?php echo $form->end('Submit');?>
			</div>
		</p>
		</div>
	<?php endif;?>
	</div>
	<?php echo $html->link("Return to courses", "/courses/"); ?>
	|
	<?php echo $html->link("New lecture", "/lectures/add/{$course['Course']['id']}/{$course['Course']['title']}"); ?>
</div>
