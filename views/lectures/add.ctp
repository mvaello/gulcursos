<h1>Nuevo Curso</h1>
<div class="lectures form">
<?php echo $form->create('Lecture');?>
	<?php
		echo $form->input('title');
		echo $form->input('teacher');
		echo $form->input('assistedby');
		echo $form->input('briefdescription');
		echo $form->input('description');
		echo $form->input('suggestedskills');
		echo $form->label('lelel',__('Level',true));
		echo $form->select('level',array('1'=>__('very easy',true),'2'=>__('easy',true),'3'=>__('normal',true),'4'=>__('hard',true),'5'=>__('very hard',true)));
		echo $form->hidden('course',array('value'=>$course_id));
		echo $form->input('referencesurl');
		echo $form->input('room');
		echo $form->input('date');
		echo $form->input('startingtime');
		echo $form->input('endingtime');
	?>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<?php echo $html->link(__('Return to course', true), array('controller'=>'courses','action'=>'view',$course_id));?>
</div>
