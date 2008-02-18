<?php
class CoursesController extends AppController 
{
	var $name = 'Courses';
//	var $scaffold;

	function index()
	{
		$this->Session->write('referer', '/courses/');
		$this->set("courses", $this->Course->findAll());
		$this->pageTitle = "Todas las jornadas";
		$this->setNavigation("index", null);
	}
	
	function view($id = null, $order = null)
	{		
		if ($id)
		{
			if (!$order)
			{
				$order = "date";
			}
			
			$this->Course->setOrder($order);
			$course = $this->Course->findAll(array('id' => $id), null, null, null, null, 2);
			$this->Session->write('referer', "/courses/view/$id");
			$this->set("course", $course);
			$this->pageTitle = $course[0]['Course']['title'];
			$this->setNavigation($course[0]['Course'], null);
		}
	}
	
	function add()
	{
		$this->checkSession("/courses/add");
		if (!empty($this->data))
		{
			if ($this->Course->save($this->data))
            {
                $this->flash('La nueva jornada se ha guardado','/courses');
            }
		}
		else
		{
			$this->setNavigation("index", null);
		}
	}
	
	function close($id = null)
	{
		if ($id != null)
		{
			$this->checkSession("/courses/close/{$id}");
			$this->Course->id = $id;
			$this->Course->saveField('closed', 1);
			$this->Course->saveField('allowProposals', 0);
			$this->Course->saveField('allowVotes', 0);
			$this->flash("La jornada se ha cerrado",'/courses');
		} 
	}

	function open($id = null)
	{
		if ($id != null)
		{
			$this->checkSession("/courses/open/{$id}");
			$this->Course->id = $id;
			$this->Course->saveField('closed', 0);
            $this->flash("La jornada se ha reabierto",'/courses');
		} 
	}
	
	function allowproposals($id = null)
	{
		if ($id != null)
		{
			$this->checkSession("/courses/allowproposals/{$id}");
			$this->Course->id = $id;
			$this->Course->saveField('proposals', 1);
            $this->flash("Ya se pueden proponer cursos en estas jornadas",'/courses');
		} 		
	}

	function denyproposals($id = null)
	{
		if ($id != null)
		{
			$this->checkSession("/courses/denyproposals/{$id}");
			$this->Course->id = $id;
			$this->Course->saveField('proposals', 0);
            $this->flash("Apartir de ahora no se podrán proponer nuevos cursos",'/courses');
		} 		
	}

	function allowvotes($id = null)
	{
		if ($id != null)
		{
			$this->checkSession("/courses/allowvotes/{$id}");
			$this->Course->id = $id;
			$this->Course->saveField('votes', 1);
            $this->flash("Ya se pueden votar en estas jornadas",'/courses');
		} 		
	}

	function denyvotes($id = null)
	{
		if ($id != null)
		{
			$this->checkSession("/courses/denyvotes/{$id}");
			$this->Course->id = $id;
			$this->Course->saveField('votes', 0);
            $this->flash("Apartir de ahora no se podrá votar nada en estas jornadas",'/courses');
		} 		
	}

	function calendar($id = null, $assisted = null)
	{
		if ($id)
		{
			$this->set("assistants", ($assisted == "assist"));
			$this->Course->setOrder("date");
			$course = $this->Course->findAll(array('id' => $id), null, null, null, null, 1);
			$this->Session->write('referer', "/courses/calendar/$id");
			$this->set("course", $course);
			$this->pageTitle = $course[0]['Course']['title'];
			$this->setNavigation($course[0]['Course'], null);
		}		
	}

}
?>