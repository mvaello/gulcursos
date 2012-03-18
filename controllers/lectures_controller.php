<?php
class LecturesController extends AppController {

	var $name = 'Lectures';
	var $helpers = array('Html', 'Form');
	var $uses = array('Lecture','Course');
	var $components = array('Recaptcha');

	function beforeFilter() {
		$this->Recaptcha->publickey = "6Lf8_s4SAAAAAKsqyOgtf_yYymMKD6MSCPaNOfto";
		$this->Recaptcha->privatekey = "6Lf8_s4SAAAAAJ0NPNkzKKePs5tH34EvEvnKBqT_";
	        $this->Auth->allow('view','add','captcha');
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

	function add($course_id=null) {
		if (!empty($this->data)) {
			if($this->myuser===null && !$this->Recaptcha->valid($this->params['form'])){
				$this->log('Captcha incorrecto.');
				$this->Session->setFlash(__('Invalid Captcha.', true));
				$this->redirect(array('controller'=>'courses','action'=>'view',$this->data['Lecture']['course']));
			}else{
				$this->log('Grabando curso.');
				$this->Lecture->create();
				if ($this->Lecture->save($this->data)) {
					$this->Session->setFlash(__('The Lecture has been saved', true));
					$this->redirect(array('action'=>'view',$this->Lecture->id));
				} else {
					$this->Session->setFlash(__('The Lecture could not be saved. Please, try again.', true));
				}
			}
		}
        if(is_null($course_id)){
            $course_id = $this->data['Lecture']['course'];
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
				$lecture = $this->Lecture->read('course',$this->data['Lecture']['id']);
				$this->Session->setFlash(__('The Lecture has been saved', true));
				$this->redirect(array('controller'=>'courses','action'=>'view',$lecture['Lecture']['course']));
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
