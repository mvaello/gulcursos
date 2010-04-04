<div class="votes form">
<?php echo $form->create('Vote');?>
	<fieldset>
 		<legend><?php __('Edit Vote');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('lecture');
		echo $form->input('datetime');
		echo $form->input('mark');
		echo $form->input('from');
		echo $form->input('comments');
		echo $form->input('ip');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Vote.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Vote.id'))); ?></li>
		<li><?php echo $html->link(__('List Votes', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Lectures', true), array('controller'=> 'lectures', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Lecture', true), array('controller'=> 'lectures', 'action'=>'add')); ?> </li>
	</ul>
</div>
