<?php
/**
 * TaskFixture
 *
 */
class TaskFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'title' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'desc' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'updated' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false, 'comment' => '状态(0未开始 1开始中 -1 删除 2 完成 )'),
		'project_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => '项目ID'),
		'rate' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => '进度 %'),
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
			'user_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'desc' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => 1,
			'updated' => 1,
			'status' => 1,
			'project_id' => 1,
			'rate' => 1,
			'start_time' => 1,
			'end_time' => 1
		),
	);

}
