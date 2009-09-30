<?php
class LecturesController extends AppController {

	var $name = 'Lectures';
	var $helpers = array('Html', 'Form');
	var $uses = array('Lecture','Course');

	function beforeFilter() {
	        $this->Auth->allow('view','add');
		parent::beforeFilter();
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Lecture.', true));
			$this->redirect(array('action'=>'index'));
		}
		$canVote = 1;
		$lecture = $this->Lecture->read(null, $id);
		foreach($lecture['Vote'] as $vote){
			if($_SERVER['REMOTE_ADDR']==$vote['ip']){ $canVote=0; }
		}
		$this->set('canVote',$canVote);
		$this->set('lecture', $lecture);

		$this->breadcrumbs[]=array(__('Courses',true),array('controller'=>'courses','action'=>'index'));
		$this->breadcrumbs[]=array($lecture['Course']['title'],array('controller'=>'courses','action'=>'view',$lecture['Course']['id']));
		$this->breadcrumbs[]=array($lecture['Lecture']['title'],array('action'=>'view',$lecture['Lecture']['id']));
	}

	function add($course_id) {
		if (!empty($this->data)) {
			$this->Lecture->create();
			if ($this->Lecture->save($this->data)) {
				$this->Session->setFlash(__('The Lecture has been saved', true));
				$this->redirect(array('action'=>'view',$this->Lecture->id));
			} else {
				$this->Session->setFlash(__('The Lecture could not be saved. Please, try again.', true));
			}
		}
		$this->set('course_id',$course_id);
		$course = $this->Course->read(null,$course_id);
		$courses = $this->Lecture->Course->find('list');
		$this->set(compact('courses'));

		$this->breadcrumbs[]=array(__('Courses',true),array('controller'=>'courses','action'=>'index'));
		$this->breadcrumbs[]=array($course['Course']['title'],array('controller'=>'courses','action'=>'view',$course_id));
		$this->breadcrumbs[]=array(__('New lecture',true),array('action'=>'add',$course_id));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Lecture', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Lecture->save($this->data)) {
				$this->Session->setFlash(__('The Lecture has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Lecture could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Lecture->read(null, $id);
		}
		$courses = $this->Lecture->Course->find('list');
		$this->set('lecture_title',$this->data['Lecture']['title']);
		$this->set('course_id',$this->data['Course']['id']);
		$this->set(compact('courses'));

		$this->breadcrumbs[]=array(__('Courses',true),array('controller'=>'courses','action'=>'index'));
		$this->breadcrumbs[]=array($this->data['Course']['title'],array('controller'=>'courses','action'=>'view',$this->data['Course']['id']));
		$this->breadcrumbs[]=array($this->data['Lecture']['title'],array('action'=>'view',$id));
		$this->breadcrumbs[]=array(__('Edit',true),array('action'=>'edit',$id));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Lecture', true));
			$this->redirect(array('controller'=>'courses','action'=>'index'));
		}
		$lecture = $this->Lecture->read(null, $id);
		if ($this->Lecture->del($id)) {
			$this->Session->setFlash(__('Lecture deleted', true));
			$this->redirect(array('controller'=>'courses','action'=>'view',$lecture['Course']['id']));
		}
	}

}
?>
