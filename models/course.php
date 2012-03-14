<?php
class Course extends AppModel 
{
	var $name = 'Course';
	var $order = 'Course.id DESC';
	var $hasMany = array('Lecture' =>
                         array('className'     => 'Lecture',
                               'conditions'    => '',
//                               'order'         => 'date ASC, startingtime ASC, (select sum(mark) from votes where lecture=Lecture.id) DESC',
                               'order' => 'date ASC, startingtime ASC',
                               'limit'         => '',
                               'foreignKey'    => 'course',
                               'dependent'     => true,
                               'exclusive'     => false,
                               'finderQuery'   => ''
                         )
                  );

	function setOrder($field)
	{
		if ($field == 'date')
			$this->hasMany['Lecture']['order'] = 'date ASC, startingtime ASC';
			
		if ($field == 'mark')
			$this->hasMany['Lecture']['order'] = '(select sum(mark) from votes where lecture=Lecture.id) DESC';
	}
}
?>
