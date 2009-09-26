<?php

class VotesController extends AppController
{
	var $name = "Votes";
	var $components = array('RequestHandler');
	
	function add()
	{
		$this->data['Vote']['from'] = "+1";
		$this->data['Vote']['datetime'] = date('Y-m-d H:i:s', mktime());
		$this->data['Vote']['mark'] = 1;
		$this->data['Vote']['ip'] = $this->RequestHandler->getClientIP();
	
		$lectureid = $this->data['Vote']['lecture'];
		$senderip  = $this->data['Vote']['ip'];
		$nVotes = $this->Vote->findCount("lecture = '$lectureid' and ip = '$senderip'");

		if ($nVotes > 0)
		{
			$this->flash("S&oacute;lo deber&iacute;as votar una vez a cada curso, lech&oacute;n", "/lectures/view/$lectureid");
			exit();
		}

//		echo "la lecture $lectureid tiene $nVotes votos tuyos";
//		print_r($this->data);
//		exit();
		if ($this->Vote->save($this->data))
        	{
            		$this->flash("Tu voto será tomado en cuenta lo justo y necesario :)",'/lectures/view/'.$this->data['Vote']['lecture']);
        	}
	}	
	
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
			$this->data['Vote']['datetime'] = date('Y-m-d H:i:s', mktime());
		
			// Se puede comentar N veces pero solo puntuar una.
			$nVotes = $this->Vote->findCount("lecture = '$lectureid' and ip = '$senderip'");
			if ($nVotes > 0)
			{
				$this->data['Vote']['mark'] = 0;
			}
		
			if ($this->Vote->save($this->data))
			{
               			$this->flash('¡Gracias por comentar!.','/lectures/view/'.$this->data['Vote']['lecture']);
			}
		}
	}
	
	function view($lectureid = null, $lecturetitle)
	{
		if ($lectureid != null)
		{
			$this->set('lecturetitle', $lecturetitle);
			$this->set('votes', $this->Vote->findAll(array('lecture' => $lectureid)));
		}
	}
}

?>
