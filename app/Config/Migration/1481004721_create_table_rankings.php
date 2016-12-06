<?php
class CreateTableRankings extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'create_table_rankings';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'rankings' => array(
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
                    'rank' => array(
                    	'type' => 'integer',
                    ),
                    'point' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 0
                    ),
                    'team_id' => array(
                    	'type' => 'integer',
                    	'null' => false
                    ),
                    'league_id' => array(
                    	'type' => 'integer',
                    	'null' => false
                    ),
                    'games_all' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 0
                    ),
                    'games_won' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 0
                    ),
                    'games_lost' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 0
                    ),
                    'games_drawn' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 0
                    ),
                    'score_got' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 0
                    ),
                    'score_lost' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 0
                    ),
                    'score_diff' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 0
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
				'rankings'
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
