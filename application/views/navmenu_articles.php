<?php if ($this->auth->is_admin()) { ?>
<ul>
	<li><?php echo anchor('articles/edit', 'Add Article'); ?></li>
</ul>
<?php } ?>