<?php

class PupilsController extends AppController
{
	var $name = "Pupils";
	
	function add()
	{
		$this->data['Pupil']['datetime'] = date('Y-m-d H:i:s', mktime());
		if ($this->Pupil->save($this->data))
        {
            $this->flash("Gracias por confirmar tu presencia",'/lectures/view/'.$this->data['Pupil']['lecture']);
        }
	}	
}

?>