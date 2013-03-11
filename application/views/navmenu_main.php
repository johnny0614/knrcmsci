<ul class="navmenu">

<?php if ($this->config->item('show_home_link')): ?>
	<li><?php echo anchor(site_url(), 'Home'); ?></li>
<?php endif; ?>

<?php
if ($this->config->item('show_page_links')):
	/*
	 * Handle HMVC-style requirements using a library, 
	 * helper, or directly calling model methods 
	 */
	//$this->model_name won't work in a view
	$CI =& get_instance();
	$CI->load->model('articles_model');
	$pages = $CI->articles_model->get_list('page');
	foreach($pages as $page_id => $page_title):
?>
	<li><?php echo anchor('articles/get_by_id/'.$page_id, $page_title); ?></li>
<?php 
	endforeach;
endif;
?>

<?php if (!$this->auth->is_logged_in()): ?>
	<li><?php echo anchor('users/login', 'Login'); ?></li>
	<?php if ($this->config->item('enable_user_reg')) { ?>
		<li><?php echo anchor('users/register', 'Register'); ?></li>
	<?php } ?>
<?php else: ?>
	<?php if ($this->auth->is_admin()) { ?>
		<li><?php echo anchor('categories/index', 'Categories'); ?></li>
		<li><?php echo anchor('users/index', 'Users'); ?></li>	
		<li><?php echo anchor('articles/index', 'Articles'); ?></li>
	<?php } ?>	
	<li><?php echo anchor('users/logout', 'Logout'); ?></li>
<?php endif; ?>

</ul>
