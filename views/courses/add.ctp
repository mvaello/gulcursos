<div class="courses form">
<h1><?php echo __('New course'); ?></h1>
<?php echo $form->create('Course');?>
	<?php
		echo $form->input('title');
		echo $form->input('description');
	?>
<?php echo $form->end(__('Add',true));?>
</div>
