<?php

class UsersController extends AppController
{
	var $name = "Users";

    function login()
    {
        $this->set('error', false);
		$this->pageTitle = "Entrar";

        if (!empty($this->data))
        {
            $someone = $this->User->findByUsername($this->data['User']['username']);

            if(!empty($someone['User']['password']) && $someone['User']['password'] == md5($this->data['User']['password']) && $someone['User']['accepted'] == 1)
            {
                $this->Session->write('User', $someone['User']);
				$referer = $this->Session->read('referer');
            	$this->redirect($referer);
            }
            else
            {
                $this->set('error', true);
				$this->set('errormsg', "Usuario y contraseña no válidos!");
            }
        }
    }

	function clearSession()
	{
        $this->Session->delete('User');
		$this->Session->delete('referer');		
	}	

    function logout()
    {
		$referer = $this->Session->read('referer');
		$this->clearSession();
        $this->redirect($referer);
    }

	function add()
	{
        $this->set('error', false);
		$this->pageTitle = "Crear una cuenta";

		if (empty($this->data))
		{
			$this->clearSession();			
		}
		else
		{
			$users = $this->User->findAllByUsername($this->data['User']['username']);

			if (count($users) != 0)
			{
		        $this->set('error', true);				
				$this->set('errormsg', "Ese nombre de ususario ya está pillado...");
			}
			else
			{			
				$this->data['User']['accepted'] = 0;
				$this->data['User']['password'] = md5($this->data['User']['password']);

				if ($this->User->save($this->data))
				{
	                $this->flash('
	Tu usuario se ha guardado y se activará cuando uno de los usuarios existentes te contacte para
	una entrevista y, de ser apropiado, te admita como tal.
	Si no ocurre en un tiempo prudencial, contacta con el webmaster cuyo mail no conoces, por supuesto,
	porque quizá seas una máquina de estados finitos y no deberías mandar ningún tipo de 
	contenido a este sitio.
	','/');
				}
				else
				{
	                $this->flash('Ha habido un error, contacta con el webmaster (si es que hay uno!)','/');				
				}
			}
		}
	}	
	
	function accept()
	{
		$this->checkSession("/users/accept");
		$this->pageTitle = "Apadrinar un nuevo usuario";
		
		$this->set('waitingusers', 0);
		
		if (empty($this->data))
		{
			$this->set('users', $this->User->findAll(array('accepted' => '0')));
		}
		else
		{
			$usertable = $this->data['User'];

			if (isset($_REQUEST['accept']))
				$this->User->accept($usertable);		

			if (isset($_REQUEST['reject']))
				$this->User->reject($usertable);				
			
            $this->flash('¡Cuentas al día!','/');
		}
	}
	
	
}

?>
