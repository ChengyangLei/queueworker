<?php
App::uses('AppController', 'Controller');
/**
 * Tasks Controller
 *
 * @property Task $Task
 * @property PaginatorComponent $Paginator
 */
class TasksController extends AppController {

    public $layout = "user";

	public $helpers = array('Text');


	public $components = array('Paginator');


	public function index() {
		$this->Task->recursive = 0;
        $user_id = $this->UserAuth->getUserId();
        $this->paginate = array(
            'order'=>'Task.id desc',
            'conditions'=>array(
            	"Task.user_id"=>$user_id
            )
        );
		$this->set('status_arr',$this->Task->status_arr);
		$this->set('tasks', $this->Paginator->paginate());
	}	
	

	public function view($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
		$this->set('task', $this->Task->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Task->create();
			if ($this->Task->save($this->request->data)) {
				return $this->flash(__('The task has been saved.'), array('action' => 'index'));
			}
		}
		$users = $this->Task->User->find('list');
		$this->set(compact('users'));
	}

	
	public function edit($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Task->save($this->request->data)) {
				return $this->flash(__('The task has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
			$this->request->data = $this->Task->find('first', $options);
		}
		$users = $this->Task->User->find('list');
		$this->set(compact('users'));
	}
}