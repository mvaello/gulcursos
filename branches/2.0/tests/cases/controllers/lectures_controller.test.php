<?php 
/* SVN FILE: $Id$ */
/* LecturesController Test cases generated on: 2009-09-24 21:09:59 : 1253821439*/
App::import('Controller', 'Lectures');

class TestLectures extends LecturesController {
	var $autoRender = false;
}

class LecturesControllerTest extends CakeTestCase {
	var $Lectures = null;

	function setUp() {
		$this->Lectures = new TestLectures();
		$this->Lectures->constructClasses();
	}

	function testLecturesControllerInstance() {
		$this->assertTrue(is_a($this->Lectures, 'LecturesController'));
	}

	function tearDown() {
		unset($this->Lectures);
	}
}
?>