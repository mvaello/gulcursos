<div class="courses index">
<h1 id="courses"><?php __('Courses'); ?></h1>
<p> Aquí puedes ver las jornadas en las que hemos trabajado y las que están en desarrollo.  </p>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<?php $session->flash(); ?>
<table cellpadding="0" cellspacing="0">
<tr class='head'>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo __('Courses');?></th>
	<th><?php echo __('Status');?></th>
	<?php if($myuser): ?>
		<th class="actions"><?php __('Actions');?></th>
	<?php endif; ?>
</tr>
<?php
$i = 0;
foreach ($courses as $course):
	$class = 'plain';
	if ($i++ % 2 == 0) {
		$class = ' class="alt"';
	}
?>
	<tr<?php echo $class;?>>
		<td><?php echo $html->link($course['Course']['title'],array("action"=>'view', $course['Course']['id'])); ?></td>
		<td><?php echo $course['Course']['description']; ?></td>
		<td><?php echo count($course['Lecture']); ?></td>
		<?php if($course['Course']['closed']==0): ?>
		<td class='open'>En preparación</td>
		<?php else: ?>
		<td class='closed'>Cerrada</td>
		<?php endif; ?>
		<?php if($myuser): ?>
		<td class="actions">
			<span><?php echo $html->link("Edit","/courses/edit/{$course['Course']['id']}"); ?></span>

			<br />
			<?php if($course['Course']['closed']==0): ?>
				<span class='open'><?php echo $html->link("Close","/courses/close/{$course['Course']['id']}"); ?></span>

				<br />

				<?php if($course['Course']['proposals']==0): ?>
					<span class='closed'><?php echo $html->link("Allow proposals","/courses/allowproposals/{$course['Course']['id']}"); ?></span>
				<?php else: ?>
					<span class='open'><?php echo $html->link("Deny proposals","/courses/denyproposals/{$course['Course']['id']}"); ?></span>
				<?php endif; ?>
				<br />
				<?php if($course['Course']['votes']==0): ?>
					<span class='closed'><?php echo $html->link("Allow votes","/courses/allowvotes/{$course['Course']['id']}"); ?></span>
				<?php else: ?>
					<span class='open'><?php echo $html->link("Deny votes","/courses/denyvotes/{$course['Course']['id']}"); ?></span>
				<?php endif; ?>
			<?php else: ?>
				<span class='closed'><?php echo $html->link("Open","/courses/open/{$course['Course']['id']}"); ?></span>
			<?php endif; ?>
		</td>
		<?php endif; ?>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	<div> | <?php echo $paginator->numbers();?> | </div>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<?php if($myuser): ?>
<div class="actions">
	<?php echo $html->link(__('New Course', true), array('action'=>'add')); ?>
</div>
<?php endif; ?>
