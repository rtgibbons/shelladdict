<?php

App::import('Model', 'User');

class UserTestCase extends CakeTestCase {

	var $fixtures = array('app.user');
	//var $useDbConfig = 'test';

	function startCase() {
		$this->User =& ClassRegistry::init('User');
	}

	function testValidateEmail() {
		$this->assertFalse($this->User->save(array(
			'username' => 'bawigga',
			'email' => 'this is an invalid email',
			'password' => 'password',
			'password_confirm' => 'password'
		)));
	}
	
	function testValidateUsername() {
		$this->assertFalse($this->User->save(array(
			'username' => 'this is an invalid username',
			'email' => 'email@example.com',
			'password' => 'password',
			'password_confirm' => 'password'
		)));
	}
	
	function testValidateUsernameUnique() {

		$this->User->save(array(
			'id' => 1,
			'username' => 'username',
			'email' => 'email@example.com',
			'password' => 'password',
			'password_confirm' => 'password'
		));
		
		$this->assertFalse($this->User->save(array(
			'id' => 2,
			'username' => 'username',
			'email' => 'email@example.com',
			'password' => 'password',
			'password_confirm' => 'password'
		)));
		
	}

	function testValidatePasswordsMatch() {
		$this->assertFalse($this->User->save(array(
			'username' => 'username',
			'email' => 'email@example.com',
			'password' => 'password',
			'password_confirm' => 'p4ssw0rd'
		)));
	}
	
	function testValidatePasswordLength() {
		$this->assertFalse($this->User->save(array(
			'username' => 'username',
			'email' => 'email@example.com',
			'password' => 'pass',
			'password_confirm' => 'pass'
		)));
	}
	
	function testPasswordHashed() {
		
		$this->User->save(array(
			'username' => 'username',
			'email' => 'email@example.com',
			'password' => 'password',
			'password_confirm' => 'password'
		));
		
		$result = $this->User->find('first', array(
			'conditions' => array(
				'User.username' => 'username'
			),
			'fields' => array('password')
		));
		
		$this->assertTrue(preg_match('/[a-z0-9]{64}/', $result['User']['password']));
	}
	
}

?>