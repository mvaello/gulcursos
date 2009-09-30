<div class="users form">
<h1><?php __('Edit User'); ?></h1>
<?php echo $form->create('User');?>
	<?php
		echo $form->input('id');
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
