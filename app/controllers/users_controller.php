<?php

class UsersController extends AppController {
	
	var $components = array('Auth');
	
	function beforeFilter() {
		$this->Auth->allow('login', 'create', 'profile');
		$this->Auth->logoutRedirect = '/';
		$this->Auth->loginRedirect = '/addict/';
		parent::beforeFilter();
	}
	
	function create() {	
		
		if(!empty($this->data)) {

			// hash the password_confirmation since the auth component automatically hashes the password field if there is a username field as well
			$this->data['User']['password_confirm'] = Security::hash($this->data['User']['password_confirm'], null, true);
			

			if($this->User->save($this->data)) {
				$this->Session->setFlash("Account Saved!");
				$this->redirect('/addict/register/successful');
				exit();
			} else {
				// clear these out so the hashes aren't populated if the account creation fails
				$this->data['User']['password'] = '';
				$this->data['User']['password_confirm'] = '';
			}
		}
	}

	// take user to their profile if logged in or go to the homepage
	function index() {
		$user = $this->Auth->user();
		if(!empty($user)) {
			$this->redirect('/addict/'.$user['User']['username']);
		} else {
			$this->redirect('/');
		}
		exit();
	}
	
	function profile() {
		$user = $this->User->find('first', array(
			'conditions' => array(
				'username' => $this->passedArgs[0]
			)
		));
		
		if(empty($user)) {
			$this->cakeError('error404');
		}
	}

	function login() {
		
	}

	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
}

?>