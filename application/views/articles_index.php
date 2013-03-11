<?php $this->load->view('navmenu_articles'); ?>

<?php
if (isset($articles)) {
foreach($articles as $article) {
?>
<div id="article-<?php echo $article->id; ?>" class="article">
	<h2 id="<?php echo url_title($article->title); ?>">
		<a href="<?php echo site_url('articles/get_by_id/'.$article->id); ?>">
			<?php echo $article->title; ?>
		</a>
	</h2>
	<div>
	<?php echo $article->content; ?>
	</div>
	<p class="meta">
		Date: <?php echo $article->created; ?>  
		Category: <?php echo $this->categories_model->get_name_by_id($article->category_id); ?>
	</p>
	<?php if ($this->auth->is_admin()) { ?>
	<p><?php echo anchor('articles/edit/'.$article->id, 'Edit'); ?> <?php echo anchor('articles/delete/'.$article->id, 'Delete'); ?></p>
	<?php } ?>
</div>
<?php 
} //endforeach
?>
<div>
<?php echo $this->pagination->create_links(); ?>
<?php 
} else {
	echo '<p>Article not found.</p>';
} //endif
?>
</div>