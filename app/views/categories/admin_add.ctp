<?php /* SVN: $Id: admin_add.ctp 12 2009-11-14 10:17:05Z annamalai_034ac09 $ */ ?>
<div class="categories">
	<div>
		<?php echo $this->Form->create('Category', array('class' => 'normal','action'=>'add'));?>
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('is_active' ,array('label'=>'Active','type'=>'checkbox'));
		?>
		<div class="clearfix submit-block">
			<?php echo $this->Form->submit(__l('Add'));?>
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>