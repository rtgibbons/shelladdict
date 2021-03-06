<?php

// for password hashing
App::import('Security');

class User extends AppModel {
	
	var $name = "User";
		
	var $validate = array(
		'username' => array(
			'alphaNumericOnly' => array(
				'rule' => 'alphaNumeric',
				'message' => 'Alphanumeric characters only please.'
			),
			'uniqueUsernameOnly' => array(
				'rule' => 'isUnique',
				'message' => 'This username has already been taken.'
			)
		),
		'email' => array(
			'rule' => 'email',
			'message' => 'Please enter a valid email.'
		),
		'password' => array(
			'matchesConfirmPassword' => array(
				'rule' => array('confirmPasswordsMatch'),
				'message' => 'Passwords do not match'
			),
			'minlength' => array(
				'rule' => array('minLength', 6),
				'message' => 'Password must be at least 6 characters'
			),
		)
	);
	
	function confirmPasswordsMatch($check) {
		return $this->data['User']['password'] == $this->data['User']['password_confirm'];
	}

	function afterSave() {
		
	}
	
	function getActivationHash() {
		if(!isset($this->id)) return false;
		return Security::hash($this->field('username') . $this->field('created'), null, true);
	}
	
}

?>