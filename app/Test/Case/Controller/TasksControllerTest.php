<?php
App::uses('TasksController', 'Controller');

/**
 * TasksController Test Case
 *
 */
class TasksControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.task',
		'app.user',
		'app.task_item',
		'app.task_resulte'
	);

}
