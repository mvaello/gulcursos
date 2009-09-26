<?php
class PupilsController extends AppController {

	var $name = 'Pupils';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Pupil->recursive = 0;
		$this->set('pupils', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Pupil.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('pupil', $this->Pupil->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Pupil->create();
			if ($this->Pupil->save($this->data)) {
				$this->Session->setFlash(__('The Pupil has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Pupil could not be saved. Please, try again.', true));
			}
		}
		$lectures = $this->Pupil->Lecture->find('list');
		$this->set(compact('lectures'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Pupil', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Pupil->save($this->data)) {
				$this->Session->setFlash(__('The Pupil has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Pupil could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Pupil->read(null, $id);
		}
		$lectures = $this->Pupil->Lecture->find('list');
		$this->set(compact('lectures'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Pupil', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pupil->del($id)) {
			$this->Session->setFlash(__('Pupil deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>