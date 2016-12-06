<?php
class AddFieldTeams extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_field_teams';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'teams' => array(
					'short_name' => array(
						'type' => 'string'
					),
                    'league_id' => array(
                    	'type' => 'integer',
                    	'null' => false
                    ),
				)
			)
		),
		'down' => array(
			'drop_field' => array(
				'teams' => array(
					'short_name',
					'league_id'
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
