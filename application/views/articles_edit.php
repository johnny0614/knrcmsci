<?php echo form_open('articles/edit'); ?>
<?php echo form_hidden('id', set_value('id', isset($articles)?$articles[0]->id:'')); ?>
<?php echo form_label('Title', 'title'); ?>
<?php echo form_input('title', set_value('title', isset($articles)?$articles[0]->title:'')); ?>
<?php echo form_label('Content', 'content'); ?>
<?php echo form_textarea('content', set_value('content', isset($articles)?$articles[0]->content:'')); ?>
<?php echo form_label('Category', 'category_id'); ?>
<?php echo form_dropdown('category_id', $categories_list, set_value('category_id', isset($articles)?$articles[0]->category_id:'')); ?>
<?php echo form_label('Type', 'type'); ?>
<?php echo form_dropdown('type', array('post'=>'post', 'page'=>'page'), set_value('type', isset($articles)?$articles[0]->type:'')); ?>
<?php echo form_submit('op-save', 'Save'); ?>