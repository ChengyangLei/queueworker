<?php
App::uses('AppController', 'Controller');
/**
 * Vips Controller
 *
 * @property Vip $Vip
 * @property PaginatorComponent $Paginator
 */
class VipsController extends AppController {

    public $layout = "admin";

    public $prefixLayout = true;

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Vip->recursive = 0;
		$this->set('data', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Vip->exists($id)) {
			throw new NotFoundException(__('Invalid vip'));
		}
		$options = array('conditions' => array('Vip.' . $this->Vip->primaryKey => $id));
		$this->set('vip', $this->Vip->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Vip->create();
			$this->request->data['Vip']['today'] = date("Y-m-d");
			if ($this->Vip->save($this->request->data)) {
				return $this->flash(__('The vip has been saved.'), array('action' => 'index'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Vip->id = $id;
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Vip']['id'] = $id;
			if ($this->Vip->save($this->request->data)) {
				return $this->flash(__('The vip has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Vip.' . $this->Vip->primaryKey => $id));
			$this->request->data = $this->Vip->find('first', $options);
		}
	}

	/**
	 * admin_delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->Vip->id = $id;
		if (!$this->Vip->exists()) {
			throw new NotFoundException(__('Invalid vip'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Vip->delete()) {
			return $this->flash(__('The vip has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The vip could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}
}