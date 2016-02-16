<?php
App::uses('Issue', 'Model');

/**
 * Issue Test Case
 *
 */
class IssueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.issue',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Issue = ClassRegistry::init('Issue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Issue);

		parent::tearDown();
	}

}
