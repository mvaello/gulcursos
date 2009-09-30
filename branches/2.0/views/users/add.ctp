<div class="users form">
<h2><?php __('New User'); ?></h2>
<?php echo $form->create('User');?>
	<?php
		echo $form->input('username');
		echo $form->input('password');
		echo $form->input('email');
		echo $form->label('accepted',__('Accepted',true));
		echo $form->checkbox('accepted');
	?>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<?php echo $html->link(__('List Users', true), array('action'=>'index'));?>
</div>
