<?php

class Vote extends AppModel
{
	var $name = "Vote";

	var $belongsTo = array('Lecture' =>
                           array('className'  => 'Lecture',
                                 'conditions' => '',
                                 'order'      => '',
                                 'foreignKey' => 'lecture'
                           )
                     );	
}

?>