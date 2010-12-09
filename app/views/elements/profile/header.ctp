<?php if($isCurrentUser): ?>
	<h2>My Dashboard</h2>
<?php else: ?>
	<h2><?php echo $user['User']['username']; ?>'s Profile</h2>
<?php endif; ?>