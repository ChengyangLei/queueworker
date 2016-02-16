<?php
/**
 * TaskItemFixture
 *
 */
class TaskItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'task_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false, 'comment' => '状态(0未开始 1开始中 -1 删除 2 完成 )'),
		'start_time' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'end_time' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => '完成时间'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'task_id' => 1,
			'status' => 1,
			'start_time' => 1,
			'end_time' => 1
		),
	);

}
