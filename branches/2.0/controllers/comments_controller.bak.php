<?php

class CommentsController extends AppController
{
	var $name = "Comments";

	function addfull($lectureid=null, $lecturetitle=null, $courseid=null)
	{
		if ($lectureid != null)
		{
			$this->set('lectureid', $lectureid);
			$this->set('lecturetitle', $lecturetitle);
			$this->set('courseid', $courseid);
		}

		if (!empty($this->data))
		{
			$this->data['Comment']['datetime'] = date('Y-m-d H:i:s', mktime());
			if ($this->Comment->save($this->data))
			{
		               $this->flash('¡Gracias por comentar!.','/lectures/view/'.$this->data['Comment']['lecture']);
			}
		}
	}	
}

?>
