<?php /* SVN: $Id: admin_edit.ctp 41 2009-11-14 13:53:11Z annamalai_034ac09 $ */ ?>
<div class="categories form">
<h2><?php echo __l('Edit Category');?></h2>
<?php echo $this->Form->create('Category', array('class' => 'normal'));?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('parent_id', array('between' => '<br />', 'options' => $categories, 'empty' => '(none)'));
		echo $this->Form->input('is_active', array('label' => 'Active'));
	?>
	</fieldset>
	<div class="submit-block clearfix">
		<?php echo $this->Form->submit(__l('Update'));?>
	</div>
<?php echo $this->Form->end();?>
</div>