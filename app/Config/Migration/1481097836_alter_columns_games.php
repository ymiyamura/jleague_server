<?php
class AlterColumnsGames extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'alter_columns_games';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'alter_field' => array(
				'games' => array(
                    'home_team_goals' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 0
                    ),
                    'away_team_goals' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 0
                    ),
                    'result' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 0
                    ),
                )
			)
		),
		'down' => array(
			'alter_field' => array(
				'games' => array(
                    'home_team_goals' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => null
                    ),
                    'away_team_goals' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => null
                    ),
                    'result' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => null
                    ),
                )
            )
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
