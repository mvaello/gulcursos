<div class="courses form">
<h1><?php echo $course_title; ?></h1>
<?php echo $form->create('Course');?>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('description');
		echo $form->label('closed',__('Closed',true));
		echo $form->checkbox('closed');
		echo $form->label('proposals',__('Proposals',true));
		echo $form->checkbox('proposals');
		echo $form->label('votes',__('Votes',true));
		echo $form->checkbox('votes');
	?>
<?php echo $form->end(__('Edit',true));?>
</div>
<div class="actions">
	<?php echo $html->link(__('Return to courses list', true), array('action'=>'index'));?></li>
</div>
