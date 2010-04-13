<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
	var $components = array('Auth');

	function beforeFilter() {
	    $this->Auth->allow('login');
        $this->Auth->loginRedirect=array('controller'=>'courses','action'=>'index');
		parent::beforeFilter();
	}

	function login(){
	}

	function logout(){
		$this->redirect($this->Auth->logout());
	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());

		$this->breadcrumbs[]=array(__('Users',true),array('action'=>'index'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('action'=>'index'));
		}
		$user = $this->User->read(null, $id);
		$this->set('user', $user);
		$this->breadcrumbs[]=array(__('Users',true),array('action'=>'index'));
		$this->breadcrumbs[]=array($user['User']['username'],array('action'=>'view',$id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		$this->breadcrumbs[]=array(__('Users',true),array('action'=>'index'));
		$this->breadcrumbs[]=array(__('New user',true),array('action'=>'add'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$this->breadcrumbs[]=array(__('Users',true),array('action'=>'index'));
		$this->breadcrumbs[]=array($this->data['User']['username'],array('action'=>'view',$id));
		$this->breadcrumbs[]=array(__('Edit',true),array('action'=>'edit',$id));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
