<h2>Users</h2>
<ul><?php
foreach($users as $user):
?>
<li><?php echo $user->username; ?> <?php echo anchor('users/delete/'.$user->id, 'Delete') ?></li>
<?php 
endforeach;
?></ul>
<p><?php echo count($users).' user(s) found.' ?></p>
