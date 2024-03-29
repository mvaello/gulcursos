<div class="votes index">
<h2><?php __('Votes');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('lecture');?></th>
	<th><?php echo $paginator->sort('datetime');?></th>
	<th><?php echo $paginator->sort('mark');?></th>
	<th><?php echo $paginator->sort('from');?></th>
	<th><?php echo $paginator->sort('comments');?></th>
	<th><?php echo $paginator->sort('ip');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($votes as $vote):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $vote['Vote']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($vote['Lecture']['title'], array('controller'=> 'lectures', 'action'=>'view', $vote['Lecture']['id'])); ?>
		</td>
		<td>
			<?php echo $vote['Vote']['datetime']; ?>
		</td>
		<td>
			<?php echo $vote['Vote']['mark']; ?>
		</td>
		<td>
			<?php echo $vote['Vote']['from']; ?>
		</td>
		<td>
			<?php echo $vote['Vote']['comments']; ?>
		</td>
		<td>
			<?php echo $vote['Vote']['ip']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $vote['Vote']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $vote['Vote']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $vote['Vote']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $vote['Vote']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Vote', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Lectures', true), array('controller'=> 'lectures', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Lecture', true), array('controller'=> 'lectures', 'action'=>'add')); ?> </li>
	</ul>
</div>
