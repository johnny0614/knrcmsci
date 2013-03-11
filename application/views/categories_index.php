<?php $this->load->view('navmenu_categories'); ?>

<h2>Categories</h2>
<ul>
<?php
foreach($categories as $category):
?>
<li><?php echo $category->name; ?> <?php echo anchor('categories/edit/'.$category->id, 'Edit'); ?>  <?php echo anchor('categories/delete/'.$category->id, 'Delete'); ?></li>
<?php 
endforeach;
?>
</ul>
<p><?php echo count($categories).' categories found.' ?></p>
