<?php

class Lecture extends AppModel
{
	var $name = "Lecture";

	var $belongsTo = array('Course' =>
                           array('className'  => 'Course',
                                 'conditions' => '',
                                 'order'      => '',
                                 'foreignKey' => 'course'
                           )
                     );

	var $hasMany = array('Vote' =>
                         array('className'     => 'Vote',
                               'conditions'    => '',
                               'order'         => '',
                               'limit'         => '',
                               'foreignKey'    => 'lecture',
                               'dependent'     => true,
                               'exclusive'     => false,
                               'finderQuery'   => ''
                         ),
						'Pupil' =>
                         array('className'     => 'Pupil',
                               'conditions'    => '',
                               'order'         => '',
                               'limit'         => '',
                               'foreignKey'    => 'lecture',
                               'dependent'     => true,
                               'exclusive'     => false,
                               'finderQuery'   => ''
                         ),
						'Comment' =>
                         array('className'     => 'Comment',
                               'conditions'    => '',
                               'order'         => '',
                               'limit'         => '',
                               'foreignKey'    => 'lecture',
                               'dependent'     => true,
                               'exclusive'     => false,
                               'finderQuery'   => ''
                         )
                  );
}

?>