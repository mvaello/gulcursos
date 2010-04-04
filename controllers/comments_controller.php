<?php
class CommentsController extends AppController {

	var $name = 'Comments';
	var $helpers = array('Html', 'Form');
	var $components = array('Captcha');

	function beforeFilter() {
	        $this->Auth->allow('view');
		parent::beforeFilter();
	}

	function add() {
		$this->data['Comment']['datetime'] = date('Y-m-d H:i:s', mktime());
		if (!empty($this->data)) {
			if($this->myuser===null && !$this->Captcha->check($this->data['Comment']['captcha'])){
				$this->Session->setFlash(__('Invalid Captcha.', true));
				$this->redirect(array('controller'=>'lectures','action'=>'view',$this->data['Comment']['lecture']));
            }else{
			    $this->Comment->create();
			    if ($this->Comment->save($this->data)) {
			    	$this->Session->setFlash(__('The Comment has been saved', true));
			    	$this->redirect(array('controller'=>'lectures','action'=>'view',$this->data['Comment']['lecture']));
			    } else {
			    	$this->Session->setFlash(__('The Comment could not be saved. Please, try again.', true));
			    }
            }
		}
		$lectures = $this->Comment->Lecture->find('list');
		$this->set(compact('lectures'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comment', true));
			$this->redirect(array('controller'=>'courses','action'=>'index'));
		}else{
			$comment = $this->Comment->read(null,$id);
		}
		if ($this->Comment->del($id)) {
			$this->Session->setFlash(__('Comment deleted', true));
			$this->redirect(array('controller'=>'lectures','action'=>'view',$comment['Comment']['lecture']));
		}
	}
}
?>
