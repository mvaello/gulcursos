<?php 
/* SVN FILE: $Id$ */
/* Widewisse schema generated on: 2010-04-12 12:04:27 : 1271066848*/
class WidewisseSchema extends CakeSchema {
	var $name = 'Widewisse';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $comments = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'lecture' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'datetime' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'from' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30),
		'comments' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'mark' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $courses = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'closed' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'proposals' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'votes' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $lectures = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200),
		'teacher' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'room' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'briefdescription' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'suggestedskills' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'course' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'referencesurl' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 255),
		'date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'startingtime' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'endingtime' => array('type' => 'time', 'null' => true, 'default' => NULL),
		'assistedby' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30),
		'publishedon' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'level' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $pupils = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30),
		'lecture' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'datetime' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'certificate' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'password' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'accepted' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $votes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'lecture' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'datetime' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'mark' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'from' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30),
		'comments' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'ip' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>
