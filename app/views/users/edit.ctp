<h2>Account Settings</h2>

<h3>Update password</h3>
<?php

	echo $form->create();
	echo $form->input('password');
	echo $form->input('password_confirm', array('type' => 'password'));
	echo $form->end('Save');

?>