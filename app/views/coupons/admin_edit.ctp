<?php /* SVN: $Id: edit.ctp 3052 2010-02-01 08:21:03Z bharathdayal_092at09 $ */ ?>
<div class="coupons form"> 
	<?php echo $this->Form->create('Coupon', array('class' => 'normal','enctype' => 'multipart/form-data'));?>
	<fieldset> 
		<?php
			echo $this->Form->input('id');
			echo $this->element('coupon-form', array('config' => 'sec')); 
		?>
	</fieldset>
	<div class="clearfix submit-block">
		<?php echo $this->Form->submit(__l('Update'));?>
	</div>
	<?php echo $this->Form->end();?>
</div>