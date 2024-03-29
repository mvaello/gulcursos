<?php
class VotesController extends AppController {

	var $name = 'Votes';
	var $helpers = array('Html', 'Form');
	var $components = array('Recaptcha');
	
	function beforeFilter() {
		$this->Recaptcha->publickey = "6Lf8_s4SAAAAAKsqyOgtf_yYymMKD6MSCPaNOfto";
		$this->Recaptcha->privatekey = "****************************************";
		parent::beforeFilter();
	}

	function add() {
		if (!empty($this->data)) {
			if($this->myuser===null && !$this->Recaptcha->valid($this->params['form'])){
				$this->Session->setFlash(__('Invalid Captcha.', true));
				$this->redirect(array('controller'=>'lectures','action'=>'view',$this->data['Vote']['lecture']));
            }else{
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
		}
		$lectures = $this->Vote->Lecture->find('list');
		$this->set(compact('lectures'));
	}
}
?>
