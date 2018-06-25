<?php /* SVN: $Id: admin_add.ctp 12 2009-11-14 10:17:05Z annamalai_034ac09 $ */ ?>
<div class="cities">
	<div>
		<?php echo $this->Form->create('City', array('class' => 'normal','action'=>'add'));?>
		<?php
			echo $this->Form->input('country_id', array('empty'=>'Please Select'));
			echo $this->Form->input('state_id', array('empty'=>'Please Select'));
			echo $this->Form->input('name');
			echo $this->Form->input('is_approved', array('label' => 'Approved?'));
		?>
		<div class="clearfix submit-block">
			<?php echo $this->Form->submit(__l('Add'));?>
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>