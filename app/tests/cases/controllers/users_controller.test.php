<?php

class UsersControllerTest extends CakeTestCase { 

	function startCase() {
		//CAKEPHP_UNIT_TEST_EXECUTION = true;
	}

	function testLogin() {
		
		$data = array('User' => array(
			'username' => 'username',
			'password' => 'password' // real password should be password
		));
		
		$result = $this->testAction('/addict/login', array(
			'fixturize' => true,
			'data' => $data,
			'method' => 'post'
		));
		
		debug($result);
		
		$this->assertTrue(false);
		
	}
	
}

?>