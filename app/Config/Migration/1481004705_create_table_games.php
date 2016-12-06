<?php
class CreateTableGames extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'create_table_games';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'games' => array(
                    'id' => array(
                        'type'    => 'integer',
                        'null'    => false,
                        'default' => null,
                        'key'     => 'primary'
                    ),
                    'year' => array(
                        'type'    => 'integer',
                        'null'    => false,
                        'default' => null,
                    ),
                    'section' => array(
                        'type'    => 'integer',
                        'null'    => false,
                        'default' => null,
                    ),
                    'date' => array(
                    	'type' => 'date',
                    ),
                    'stadium' => array(
                    	'type' => 'string',
                    	'length' => 255
                    ),
                    'start' => array(
                    	'type' => 'time'
                    ),
                    'home_team_id' => array(
                    	'type' => 'integer',
                    	'null' => false
                    ),
                    'away_team_id' => array(
                    	'type' => 'integer',
                    	'null' => false
                    ),
                    'home_team_goals' => array(
                    	'type' => 'integer',
                    	'null' => false
                    ),
                    'away_team_goals' => array(
                    	'type' => 'integer',
                    	'null' => false
                    ),
                    'result' => array(
                    	'type' => 'integer',
                    	'null' => false
                    ),
                    'league_id' => array(
                    	'type' => 'integer',
                    	'null' => false
                    ),
			        'created' => array(
			            'type' => 'datetime'
			        ),
			        'modified' => array(
			            'type' => 'datetime'
			        ),
                    'indexes' => array(
                        'PRIMARY' => array(
                            'column' => 'id',
                            'unique' => 1
                        )
                    )
				),
				'leagues' => array(
                    'id' => array(
                        'type'    => 'integer',
                        'null'    => false,
                        'default' => null,
                        'key'     => 'primary'
                    ),
                    'name' => array(
                        'type'    => 'string',
                        'null'    => false,
                        'default' => null,
                        'length'  => 255
                    ),
			        'created' => array(
			            'type' => 'datetime'
			        ),
			        'modified' => array(
			            'type' => 'datetime'
			        ),
                    'indexes' => array(
                        'PRIMARY' => array(
                            'column' => 'id',
                            'unique' => 1
                        )
                    )
				)
			)
		),
		'down' => array(
            'drop_table' => array(
                'games',
                'leagues'
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
