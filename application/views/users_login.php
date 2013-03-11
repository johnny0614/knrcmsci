<?php 
$loginerr = $this->session->userdata('loginerror');
if (isset($loginerror)) {
?>
<p><?php echo $loginerr; ?></p>
<?php 
}
?>
<?php echo form_open('users/login'); ?>
<?php echo form_label('Username', 'username'); ?>
<?php echo form_input('username'); ?>
<?php echo form_label('Password', 'password'); ?>
<?php echo form_password('password'); ?>
<?php echo form_submit('op-login', 'Login'); ?>
<?php echo form_close(); ?>