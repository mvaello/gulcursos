<?php 
/* SVN FILE: $Id$ */
/* CoursesController Test cases generated on: 2009-09-24 21:09:05 : 1253820605*/
App::import('Controller', 'Courses');

class TestCourses extends CoursesController {
	var $autoRender = false;
}

class CoursesControllerTest extends CakeTestCase {
	var $Courses = null;

	function setUp() {
		$this->Courses = new TestCourses();
		$this->Courses->constructClasses();
	}

	function testCoursesControllerInstance() {
		$this->assertTrue(is_a($this->Courses, 'CoursesController'));
	}

	function tearDown() {
		unset($this->Courses);
	}
}
?>