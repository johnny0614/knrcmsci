<?php echo form_open('categories/edit'); ?>
<?php echo form_hidden('id', set_value('id', isset($categories)?$categories[0]->id:'')); ?>
<?php echo form_label('Name', 'name'); ?>
<?php echo form_input('name', set_value('name', isset($categories)?$categories[0]->name:'')); ?>
<?php echo form_submit('op-save', 'Save'); ?>