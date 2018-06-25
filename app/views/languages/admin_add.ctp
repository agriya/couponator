<?php /* SVN: $Id: admin_add.ctp 12 2009-11-14 10:17:05Z annamalai_034ac09 $ */ ?>
<div class="languages form">
	<div>
		<?php echo $this->Form->create('Language',  array('class' => 'normal','action'=>'add'));?>
		<?php
			echo $this->Form->input('name');
			echo $this->Form->input('iso2');
			echo $this->Form->input('iso3');
			echo $this->Form->input('is_active', array('label' => 'Active?', 'type' => 'checkbox'));
		?>
		<div class="submit-block clearfix">
		<?php echo $this->Form->submit(__l('Add'));?>
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>