<?php

class UsersController extends AppController {
	
	var $components = array('Auth', 'Email');
	var $helpers = array('form');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->logoutRedirect = '/';
		$this->Auth->loginRedirect = '/addict/';
		$this->Auth->userScope = array('User.active' => true);
		
		$this->Auth->allow('login', 'create', 'profile', 'activate');
		
	}
	
	function login() {}
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function create() {	
		
		if(!empty($this->data)) {

			// hash the password_confirmation since the auth component automatically hashes the password field if there is a username field as well
			$this->data['User']['password_confirm'] = Security::hash($this->data['User']['password_confirm'], null, true);
			
			if($this->User->save($this->data)) {
				$this->sendActivationEmail();
				$this->Session->setFlash("An Activation email has been sent to your account!");
				$this->redirect('/addict/check-email-for-verification');
			} else {
				// clear these out so the hashes aren't populated if the account creation fails
				$this->data['User']['password'] = '';
				$this->data['User']['password_confirm'] = '';
			}
		}
	}

	function index() {
		$user = $this->Auth->user();
		if(!empty($user)) {
			$this->redirect('/addict/'.$user['User']['username']);
		} else {
			$this->redirect('/');
		}
		exit();
	}

	function edit() {
		if(!empty($this->data)) {
			// is the user updating their password?
			if(isset($this->data['User']['password']) && isset($this->data['User']['password_confirm'])) {
				
				$this->User->set($this->data);
				$this->User->id = $this->Session->read('Auth.User.id');
				
				// check that the passwords are valid
				if($this->User->validates(array('fieldList' => array('password', 'password_confirm')))) {
				
					// hash the passwords
					$password = Security::hash($this->data['User']['password'], null, true);
					$password_confirm = Security::hash($this->data['User']['password_confirm'], null, true);
				
					if($this->User->saveField('password', $password)) {
						$this->Session->setFlash('Your password has been updated successfully.');
					} else {
						$this->Session->setFlash('There was a problem saving your password', 'error');
					}
					
				} else {
					$this->User->invalidFields();
				}
				
				// clear out the fields
				$this->data['User']['password'] = '';
				$this->data['User']['password_confirm'] = '';
				
			}
		}
	}

	function activate() {

		$user = $this->User->findById($this->params['userId']);
		if(!empty($user)){

			$this->User->id = $user['User']['id'];

			if($this->User->getActivationHash() == $this->params['activationHash']) {
				$this->User->saveField('active', 1);
				$this->Session->setFlash('Your account has been activated! Please log in below.');
				$this->redirect('/addict/login/');
			}
			
			// the hash was wrong
			$this->cakeError('error500');
		} else {
			// user wasn't in the database
			$this->cakeError('error404');
		}
	}
	
	function profile() {

		$user = $this->User->find('first', array(
			'conditions' => array(
				'username' => $this->passedArgs[0],
				'active' => 1
			),
		));
		
		// error out if the user doesn't exist or isn't active
		if(empty($user)) {
			$this->cakeError('error404');
			exit();
		}

		// check if the profile is for the currently authenticated user
		$isCurrentUser = false;
		if($this->Session->read('Auth.User.username') == $user['User']['username']) {
			$isCurrentUser = true;
		}

		$this->set('user', $user);
		$this->set('isCurrentUser', $isCurrentUser);		
	}
	
	private function sendActivationEmail() {
		
		$this->Email->smtpOptions = array(
			'port'=>'1025', 
			'timeout'=>'30',
			'auth' => true,
			'host' => 'localhost',
		);
		
		$this->Email->from    = 'Shell Addict <admin@shelladdict.com>';
		$this->Email->replyTo = 'admin@shelladdict.com';
		$this->Email->to      = $this->data['User']['email'];
		$this->Email->subject = 'ShellAddict Account Activation';
		$this->Email->template = 'accountActivation';
		$this->Email->sendAs = 'both';
		$this->set('activationLink', 'http://' . $_SERVER['SERVER_NAME'] . '/addict/activate/' . $this->User->id . '/' . $this->User->getActivationHash());
		$this->Email->delivery = 'smtp';
		$this->Email->send();
		//$this->set('smtp_errors', $this->Email->smtpError);
		
	}
	
}

?>