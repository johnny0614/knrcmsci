<?php echo form_open('users/register'); ?>
<?php echo form_label('Username', 'username'); ?>
<?php echo form_input('username', set_value('username')); ?>
<?php echo form_label('Password', 'password'); ?>
<?php echo form_password('password', set_value('password')); ?>
<?php echo form_label('Confirm Password', 'confirm'); ?>
<?php echo form_password('confirm', set_value('confirm')); ?>
<?php echo form_submit('op-register', 'Register'); ?>
<?php echo form_close(); ?>