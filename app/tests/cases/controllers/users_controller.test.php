<?php

class UsersControllerTest extends CakeTestCase { 

	function testLogin() {
		
		$data = array('User' => array(
			'username' => 'username',
			'password' => 'p4ssw0rd' // real password should be password
		));
		
		$result = $this->testAction('/addict/login', array(
			'fixturize' => true,
			'data' => $data,
			'method' => 'post'
		));
		
		debug('This test need to be writtern');
		
		$this->assertTrue(false);
		
	}
	
}

?>