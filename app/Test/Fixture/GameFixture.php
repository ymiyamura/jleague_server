<?php
/**
 * Game Fixture
 */
class GameFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'year' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'section' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'date' => array('type' => 'date', 'null' => true, 'default' => null),
		'stadium' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'start' => array('type' => 'time', 'null' => true, 'default' => null),
		'home_team_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'away_team_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'home_team_goals' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'away_team_goals' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'result' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'league_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'stage' => array('type' => 'integer', 'null' => true, 'default' => '1', 'unsigned' => false),
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
			'year' => 1,
			'section' => 1,
			'date' => '2016-12-08',
			'stadium' => 'Lorem ipsum dolor sit amet',
			'start' => '12:04:35',
			'home_team_id' => 1,
			'away_team_id' => 1,
			'home_team_goals' => 1,
			'away_team_goals' => 1,
			'result' => 1,
			'league_id' => 1,
			'created' => '2016-12-08 12:04:35',
			'modified' => '2016-12-08 12:04:35',
			'stage' => 1
		),
	);

}
