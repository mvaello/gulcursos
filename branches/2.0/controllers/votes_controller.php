<?php
class VotesController extends AppController {

	var $name = 'Votes';
	var $helpers = array('Html', 'Form');

	function add() {
		if (!empty($this->data)) {
			$this->Vote->create();
			$this->data['Vote']['ip']=$_SERVER['REMOTE_ADDR'];
			$this->data['Vote']['datetime']=date('Y-m-d h:i:s',time());
			$this->data['Vote']['mark']="1";
			$this->data['Vote']['from']="+1";
			if ($this->Vote->save($this->data)) {
				$this->Session->setFlash(__('The Vote has been saved', true));
				$this->redirect(array('controller'=>'lectures','action'=>'view',$this->data['Vote']['lecture']));
			} else {
				$this->Session->setFlash(__('The Vote could not be saved. Please, try again.', true));
			}
		}
		$lectures = $this->Vote->Lecture->find('list');
		$this->set(compact('lectures'));
	}
}
?>
