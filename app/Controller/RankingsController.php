<?php
App::uses('AppController', 'Controller');
/**
 * Rankings Controller
 *
 * @property Ranking $Ranking
 * @property PaginatorComponent $Paginator
 */
class RankingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	// public $paginate = array(
	// 	'conditions' => array(
	// 		'Ranking.league_id' => 1,
	// 		'Ranking.year' => 2016,
	// 		'Ranking.section' => 17,
	// 		'Ranking.stage' => 1
	// 		),
	// 	'order' => array(
	// 		'rank'
	// 		)
	// );

	public function beforeFilter()
	{
		parent::beforeFilter();
		$years = array("2016" => 2016, "2017" => 2017);
		$this->set('years', $years);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		// debug($this->request);
		$league_id = 1;
		$year = 2016;
		$section = 17;
		$stage = 1;
		$redirect = false;

		// TODO:model::validate()を使う
		if ($this->params['named']['league'] && is_numeric($this->params['named']['league'])) {
			$league_id = htmlspecialchars($this->params['named']['league']);
		}
		if (isset($this->params['named']['stage']) && is_numeric($this->params['named']['stage'])) {
			$stage = htmlspecialchars($this->params['named']['stage']);
		}
		if (isset($this->params['named']['section']) && is_numeric($this->params['named']['section'])) {
			$section = htmlspecialchars($this->params['named']['section']);
		} elseif($this->request->query['section']) {
			$section = htmlspecialchars($this->request->query['section']);
			$redirect = true;
		}
		if ($this->params['named']['year'] && is_numeric($this->params['named']['year'])) {
			$year = htmlspecialchars($this->params['named']['year']);
		} elseif($this->request->query['year']['year']) {
			$year = htmlspecialchars($this->request->query['year']['year']);
			$redirect = true;
		}

		if ($redirect) {
			$this->redirect(
		        array(
		        	'controller' => 'rankings',
		        	'action' => 'index',
		        	'league' => $league_id,
		        	'section' => $section,
		        	'stage' => $stage,
		        	'year' => $year
		        	)
		    );
		}

		$options = array(
			'conditions' => array(
				'Ranking.league_id' => $league_id,
				'Ranking.year' => $year,
				'Ranking.section' => $section,
				'Ranking.stage' => $stage
				),
			'order' => array(
				'rank'
				),
			'limit' => 100
		);
		$this->Paginator->settings = $options;
		$this->Ranking->recursive = 0;
		$this->set('rankings', $this->Paginator->paginate());

		$sections = $this->Ranking->getSections($league_id);
		$this->set('sections', $sections);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ranking->exists($id)) {
			throw new NotFoundException(__('Invalid ranking'));
		}
		$options = array('conditions' => array('Ranking.' . $this->Ranking->primaryKey => $id));
		$this->set('ranking', $this->Ranking->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Ranking->create();
			if ($this->Ranking->save($this->request->data)) {
				$this->Flash->success(__('The ranking has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The ranking could not be saved. Please, try again.'));
			}
		}
		$teams = $this->Ranking->Team->find('list');
		$leagues = $this->Ranking->League->find('list');
		$this->set(compact('teams', 'leagues'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Ranking->exists($id)) {
			throw new NotFoundException(__('Invalid ranking'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ranking->save($this->request->data)) {
				$this->Flash->success(__('The ranking has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The ranking could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ranking.' . $this->Ranking->primaryKey => $id));
			$this->request->data = $this->Ranking->find('first', $options);
		}
		$teams = $this->Ranking->Team->find('list');
		$leagues = $this->Ranking->League->find('list');
		$this->set(compact('teams', 'leagues'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Ranking->id = $id;
		if (!$this->Ranking->exists()) {
			throw new NotFoundException(__('Invalid ranking'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Ranking->delete()) {
			$this->Flash->success(__('The ranking has been deleted.'));
		} else {
			$this->Flash->error(__('The ranking could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
