<h2>Create an Account</h2>
<?php
	echo $form->create();
	echo $form->input('username');
	echo $form->input('email');
	echo $form->input('password', array('type'=>'password', 'maxlength' => 30));
	echo $form->input('password_confirm', array('type'=>'password', 'maxlength' => 30));
	echo $form->end('Create Account');	
?>