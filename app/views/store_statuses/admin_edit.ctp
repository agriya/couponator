<?php /* SVN: $Id: $ */ ?>
<div class="storeStatuses form">
	<h2><?php echo __l('Edit Store Status');?></h2>
	<?php echo $this->Form->create('StoreStatus', array('class' => 'normal'));?>
		<fieldset>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name');
		?>
		</fieldset>
		<div class="submit-block clearfix">
			<?php echo $this->Form->submit(__l('Update'));?>
		</div>
	<?php echo $this->Form->end();?>
</div>