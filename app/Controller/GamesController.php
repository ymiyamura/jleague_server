<?php
App::uses('AppController', 'Controller');
/**
 * Games Controller
 */
class GamesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$years = array("2016" => 2016, "2017" => 2017);
		$this->set('years', $years);
	}

	public function index()
	{
		$league_id = 1;
		$year = 2016;
		$section = 17;
		$stage = 1;
		$options = array(
			'conditions' => array(
				'Game.league_id' => $league_id,
				'Game.year' => $year,
				'Game.section' => $section,
				'Game.stage' => $stage
				),
			'order' => array(
				'rank'
				),
			'limit' => 100
		);
		$this->Paginator->settings = $options;
		$this->Game->recursive = 0;
		$this->set('games', $this->Paginator->paginate());
	}

	public function view($id = null)
	{
		if (!$this->Game->exists($id)) {
			throw new NotFoundException(__('Invalid game'));
		}
		$options = array('conditions' => array('Game.' . $this->Game->primaryKey => $id));
		$this->set('game', $this->Game->find('first', $options));
	}
}
