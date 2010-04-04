<?php

class Pupil extends AppModel
{
	var $name = "Pupil";

	var $belongsTo = array('Lecture' =>
                           array('className'  => 'Lecture',
                                 'conditions' => '',
                                 'order'      => '',
                                 'foreignKey' => 'lecture'
                           )
                     );	
}

?>