<?php 
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $games = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'year' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'section' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'date' => array('type' => 'date', 'null' => true, 'default' => null),
		'stadium' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'start' => array('type' => 'time', 'null' => true, 'default' => null),
		'home_team_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'away_team_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'home_team_goals' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'away_team_goals' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'result' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'league_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $leagues = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $rankings = array(
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

	public $schema_migrations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'class' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $teams = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'logo_image' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'color' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

}
