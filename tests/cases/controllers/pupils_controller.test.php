<?php 
/* SVN FILE: $Id$ */
/* PupilsController Test cases generated on: 2009-09-24 21:09:14 : 1253821454*/
App::import('Controller', 'Pupils');

class TestPupils extends PupilsController {
	var $autoRender = false;
}

class PupilsControllerTest extends CakeTestCase {
	var $Pupils = null;

	function setUp() {
		$this->Pupils = new TestPupils();
		$this->Pupils->constructClasses();
	}

	function testPupilsControllerInstance() {
		$this->assertTrue(is_a($this->Pupils, 'PupilsController'));
	}

	function tearDown() {
		unset($this->Pupils);
	}
}
?>