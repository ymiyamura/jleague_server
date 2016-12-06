<?php
App::uses('AppController', 'Controller');
/**
 * Leagues Controller
 *
 * @property League $League
 * @property PaginatorComponent $Paginator
 */
class LeaguesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->League->recursive = 0;
		$this->set('leagues', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->League->exists($id)) {
			throw new NotFoundException(__('Invalid league'));
		}
		$options = array('conditions' => array('League.' . $this->League->primaryKey => $id));
		$this->set('league', $this->League->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->League->create();
			if ($this->League->save($this->request->data)) {
				$this->Flash->success(__('The league has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The league could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->League->exists($id)) {
			throw new NotFoundException(__('Invalid league'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->League->save($this->request->data)) {
				$this->Flash->success(__('The league has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The league could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('League.' . $this->League->primaryKey => $id));
			$this->request->data = $this->League->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->League->id = $id;
		if (!$this->League->exists()) {
			throw new NotFoundException(__('Invalid league'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->League->delete()) {
			$this->Flash->success(__('The league has been deleted.'));
		} else {
			$this->Flash->error(__('The league could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
