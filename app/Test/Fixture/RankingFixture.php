<?php
/**
 * Ranking Fixture
 */
class RankingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'year' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'section' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'rank' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'point' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'team_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'league_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'games_all' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'games_won' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'games_lost' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'games_drawn' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'score_got' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'score_lost' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'score_diff' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'rank' => 1,
			'point' => 1,
			'team_id' => 1,
			'league_id' => 1,
			'games_all' => 1,
			'games_won' => 1,
			'games_lost' => 1,
			'games_drawn' => 1,
			'score_got' => 1,
			'score_lost' => 1,
			'score_diff' => 1,
			'created' => '2016-12-06 16:11:03',
			'modified' => '2016-12-06 16:11:03'
		),
	);

}
