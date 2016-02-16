<?php
App::uses('TaskItem', 'Model');

/**
 * TaskItem Test Case
 *
 */
class TaskItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.task_item',
		'app.task',
		'app.user',
		'app.task_resulte'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TaskItem = ClassRegistry::init('TaskItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TaskItem);

		parent::tearDown();
	}

}
