<?php
class CreateFieldForRankingsStage extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'create_field_for_rankings_stage';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'rankings' => array(
                    'stage' => array(
                    	'type' => 'integer',
                    	'null' => false,
                    	'default' => 1
                    ),
				)
			)
		),
		'down' => array(
			'drop_field' => array(
				'rankings' => array(
                    'stage'
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
