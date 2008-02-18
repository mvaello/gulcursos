<?php

class LecturesController extends AppController
{
	var $name = "Lectures";
	var $helpers = array('Time'); 
	var $components = array('RequestHandler');

//	var $scaffold;

	// not really needed
	function index()
	{
	   	$this->set('lectures', $this->Lecture->findAll());
	}

	function view($id = null)
	{
		if ($id)
		{
			$lecture = $this->Lecture->findAllById($id);
			$this->pageTitle = $lecture[0]['Lecture']['title'];
			$this->set("lecture", $lecture);
			$this->setNavigation($lecture[0]['Course'], $lecture[0]['Lecture']);
			$this->Session->write('referer', "/lectures/view/$id");
			$this->set("clientip", $this->RequestHandler->getClientIP());
		}
	}
	
	function add($courseid=null, $coursetitle=null)
	{
		$this->checkSession("/lectures/add/{$courseid}/{$coursetitle}");
		
		if ($courseid)
		{
			$this->pageTitle = "Nuevo curso - $coursetitle";
			$this->set("courseid", $courseid);
			$this->set("coursetitle", $coursetitle);
			$this->setNavigation(array('title' => $coursetitle, 'id' => $courseid));
		}
		
		if (!empty($this->data))
		{
		    $this->data['Lecture']['date'] = $this->getDate('Lecture', 'date');
		    $this->data['Lecture']['startingtime'] = $this->getTime('Lecture', 'starting');
		    $this->data['Lecture']['endingtime'] = $this->getTime('Lecture', 'ending');
		    $this->data['Lecture']['publishedon'] = date('Y-m-d H:i:s', mktime());
//			print_r($this->data);

			if ($this->Lecture->save($this->data))
            {
                $this->flash("El nuevo curso se ha guardado!",'/courses/view/'.$this->data['Lecture']['course']);
            }
		}
	}

	function edit($id = null)
	{
		$this->checkSession("/lectures/edit/{$id}");

		if (empty($this->data))
		{
			$lecture = $this->Lecture->findAll(array('Lecture.id' => $id));
			$this->set('lecture', $lecture);
			$this->Post->id = $id;
	        $this->data = $this->Lecture->read();
			$this->pageTitle = "Editando curso " . $lecture[0]['Lecture']['title'];
			$this->setNavigation($lecture[0]['Course'], $lecture[0]['Lecture']);
		}
		else
		{
		    $this->data['Lecture']['date'] = $this->getDate('Lecture', 'date');
		    $this->data['Lecture']['startingtime'] = $this->getTime('Lecture', 'starting');
		    $this->data['Lecture']['endingtime'] = $this->getTime('Lecture', 'ending');
		    $this->data['Lecture']['publishedon'] = date('Y-m-d H:i:s', mktime());
		
			if ($this->Lecture->save($this->data))
            {
               $this->flash("El curso se ha guardado!",'/courses/view/'.$this->data['Lecture']['course']);
            }
		}	
	}
	
	function propose()
	{
		if ($this->data != null)
		{
		    $this->data['Lecture']['publishedon'] = date('Y-m-d H:i:s', mktime());

			if ($this->Lecture->save($this->data))
            {
                $this->flash("La propuesta se ha mandado!",'/courses/view/'.$this->data['Lecture']['course']);
            }
		}
	}

	function delete($id = null, $courseid = null)
	{
		$this->checkSession("/lectures/delete/{$id}/{$courseid}");
		if ($id != null)
		{
			$this->set('courseid', $courseid);
			$this->set('lectureid', $id);
		}
		
		if (!empty($this->data))
		{
			if ($this->Lecture->delete($id, true))
            {
                $this->flash("El curso y todo lo relacionado con él se ha borrado!",'/courses/view/'.$courseid);
            }
		}
	}

	function getTime($model, $field)
	{
		if ($this->data[$model][$field . '_hour'] == '')
			return null;
		else
		    return date('H:i:s', mktime(
		        intval($this->data[$model][$field . '_hour']),
		        intval($this->data[$model][$field . '_min']),
				0));
	}
		
	function getDate($model, $field)
	{
		if ($this->data[$model][$field . '_year'] == '')
			return null;
		else
	    	return date('Y-m-d', mktime(
				0, 0, 0, 
	        	intval($this->data[$model][$field . '_month']),
	        	intval($this->data[$model][$field . '_day']),
	        	intval($this->data[$model][$field . '_year'])));
	}
	
	function rss()
	{
		$this->layout = 'xml';
        	$this->set('lectures', $this->Lecture->findAll("course > 1", null, 'Lecture.id DESC', 20));
	}
}



?>
