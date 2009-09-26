<?php 
/* SVN FILE: $Id$ */
/* VotesController Test cases generated on: 2009-09-24 21:09:39 : 1253821479*/
App::import('Controller', 'Votes');

class TestVotes extends VotesController {
	var $autoRender = false;
}

class VotesControllerTest extends CakeTestCase {
	var $Votes = null;

	function setUp() {
		$this->Votes = new TestVotes();
		$this->Votes->constructClasses();
	}

	function testVotesControllerInstance() {
		$this->assertTrue(is_a($this->Votes, 'VotesController'));
	}

	function tearDown() {
		unset($this->Votes);
	}
}
?>