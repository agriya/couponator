<?php /* SVN: $Id: $ */ ?>
<div class="googleAds form">
	<h2><?php echo __l('Edit Google Ad');?></h2>
	<?php echo $this->Form->create('GoogleAd', array('class' => 'normal'));?>
		<fieldset>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name');
			echo $this->Form->input('content', array('type' => 'textarea'));
			echo $this->Form->input('is_active', array('label' => __l('Active'), 'type' => 'checkbox'));
		?>
		</fieldset>
		<div class="clearfix submit-block">
	<?php echo $this->Form->submit(__l('Update'));?>
	</div>
	<?php echo $this->Form->end();?>
</div>