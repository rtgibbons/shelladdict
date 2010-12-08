	<nav id="UtilityNav">
		<ul>
<?php if($session->check('Auth.User')): ?>
		<li><a href="/addict/<?php echo $session->read('Auth.User.username'); ?>">My Dashboard</a></li>
		<li><a href="/addict/logout">Logout</a></li>
<?php else: ?>
		<li><a href="/addict/register">Register</a></li>
		<li>
			Login
			<?php
				echo $session->flash('auth');
				echo $this->Form->create('User', array('action' => 'login'));
				echo $this->Form->input('username');
				echo $this->Form->input('password');
				echo $this->Form->end('Login');
			?>
		</li>

<?php endif; ?>
		</ul>
	</nav>