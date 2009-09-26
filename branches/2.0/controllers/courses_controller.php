<?php
class CoursesController extends AppController {

	var $name = 'Courses';
	var $helpers = array('Html', 'Form','Time');

	function beforeFilter() {
	        $this->Auth->allow('index','view','calendar');
		parent::beforeFilter();
	}

	function index() {
		$this->Course->recursive = 1;
		$this->set('courses', $this->paginate());
	}

	function view($id = null) {
		$this->Course->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid Course.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('course', $this->Course->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Course->create();
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash(__('The Course has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Course could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Course', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash(__('The Course has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Course could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Course->read(null, $id);
		}
		$this->set('course_title',$this->data['Course']['title']); 
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Course', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Course->del($id)) {
			$this->Session->setFlash(__('Course deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	function calendar($id = null, $assisted = null)
	{
		$this->Course->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid Course.', true));
			$this->redirect(array('action'=>'index'));
		}
		$course = $this->Course->read(null, $id);
		$this->set("assistants", ($assisted == "assist"));
		$this->set('course', $course);
		$this->pageTitle = $course['Course']['title'];
	}

	function close($id){
		if($id){
			$course = $this->Course->read(null, $id);
			$course['Course']['closed']=1;
			if($this->Course->save($course)){
				$this->Session->setFlash(__('Course closed', true));
			}else{
				$this->Session->setFlash(__('Error: Course not closed', true));
			}
			$this->redirect(array('action'=>'index'));
		}
	}

	function open($id){
		if($id){
			$course = $this->Course->read(null, $id);
			$course['Course']['closed']=0;
			if($this->Course->save($course)){
				$this->Session->setFlash(__('Course opened', true));
			}else{
				$this->Session->setFlash(__('Error: Course not opened', true));
			}
			$this->redirect(array('action'=>'index'));
		}
	}

	function denyproposals($id){
		if($id){
			$course = $this->Course->read(null, $id);
			$course['Course']['proposals']=0;
			if($this->Course->save($course)){
				$this->Session->setFlash(__('Proposals denied', true));
			}else{
				$this->Session->setFlash(__('Error: Proposals not denied', true));
			}
			$this->redirect(array('action'=>'index'));
		}
	}

	function allowproposals($id){
		if($id){
			$course = $this->Course->read(null, $id);
			$course['Course']['proposals']=1;
			if($this->Course->save($course)){
				$this->Session->setFlash(__('Proposals allowed', true));
			}else{
				$this->Session->setFlash(__('Error: Proposals not allowed', true));
			}
			$this->redirect(array('action'=>'index'));
		}
	}

	function denyvotes($id){
		if($id){
			$course = $this->Course->read(null, $id);
			$course['Course']['votes']=0;
			if($this->Course->save($course)){
				$this->Session->setFlash(__('Votes denied', true));
			}else{
				$this->Session->setFlash(__('Error: Votes not denied', true));
			}
			$this->redirect(array('action'=>'index'));
		}
	}

	function allowvotes($id){
		if($id){
			$course = $this->Course->read(null, $id);
			$course['Course']['votes']=1;
			if($this->Course->save($course)){
				$this->Session->setFlash(__('Votes allowed', true));
			}else{
				$this->Session->setFlash(__('Error: Votes not allowed', true));
			}
			$this->redirect(array('action'=>'index'));
		}
	}
}
?>
