<?php

class Comment extends AppModel
{
	var $name = "Comment";

	var $belongsTo = array('Lecture' =>
                           array('className'  => 'Lecture',
                                 'conditions' => '',
                                 'order'      => '',
                                 'foreignKey' => 'lecture'
                           )
                     );	
}

?>