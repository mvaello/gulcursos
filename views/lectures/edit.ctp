<div class="lectures form">
<h1><?php echo $lecture_title; ?></h1>
<?php echo $form->create('Lecture');?>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('teacher');
		echo $form->input('assistedby');
		echo $form->input('briefdescription');
		echo $form->input('description');
		echo $form->input('suggestedskills');
		echo $form->label('lelel',__('Level',true));
		echo $form->select('level',array('1'=>__('very easy',true),'2'=>__('easy',true),'3'=>__('normal',true),'4'=>__('hard',true),'5'=>__('very hard',true)));
		echo $form->input('referencesurl');
		echo $form->input('room');
		echo $form->input('date',array('empty'=>true));
		echo $form->input('startingtime',array('empty'=>true));
		echo $form->input('endingtime',array('empty'=>true));
	?>
	</fieldset>
<?php echo $form->end('Save');?>
</div>
<div class="actions">
	<?php echo $html->link(__('Return to course', true), array('controller'=>'courses','action'=>'view',$course_id));?>
</div>
