<?php  
class UserFixture extends CakeTestFixture { 

	var $name = 'User'; 
	
	var $fields = array( 
		'id' => array('type' => 'integer', 'key' => 'primary'), 
		'username' => array('type' => 'string', 'length' => 48, 'null' => false), 
		'password' => array('type' => 'string', 'length' => 64, 'null' => false), 
		'created' => 'datetime', 
		'updated' => 'datetime' 
	);
	
	// import that table schema currently in use in the app
	//var $import = 'User'; 
	
} 
?>