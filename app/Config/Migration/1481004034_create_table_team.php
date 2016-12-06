<?php
class CreateTableTeam extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
    public $description = 'create_table_team';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
    public $migration = array(
        'up' => array(
            'create_table' => array(
                'teams' => array(
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
                    'logo_image' => array(
                        'type'    => 'string',
                        'null'    => true,
                        'default' => null,
                        'length'  => 255
                    ),
                    'color' => array(
                        'type'    => 'string',
                        'null'    => true,
                        'default' => null,
                        'length'  => 255
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
                'teams'
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
