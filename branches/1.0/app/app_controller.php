<?php
class AppController extends Controller
{
	var $uses = array("User");
	
    function checkSession($url="/courses")
    {
        if (!$this->Session->check('User'))
        {
			$this->Session->write("referer", $url); 
            $this->redirect("/users/login");
            exit();
        }
    }

	function beforeFilter()
	{		
        if ($this->Session->check('User'))
		{
			$this->set('waitingusers', (count($this->User->findAll(array('accepted' => '0')))));
		}
	}
	
	function setNavigation($course=null, $lecture=null)
	{
		$this->set("navcourse", $course);
		$this->set("navlecture", $lecture);
	}
}
?>
