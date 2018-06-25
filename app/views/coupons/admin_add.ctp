<?php /* SVN: $Id: add.ctp 969 2009-12-08 14:12:24Z annamalai_034ac09 $ */ ?>
<div class="coupons form"> 
	<?php echo $this->Form->create('Coupon', array('class' => 'normal','enctype' => 'multipart/form-data'));?>
	<fieldset>
		<?php echo $this->element('coupon-form', array('config' => 'sec')); ?>
	</fieldset>
	<div class="submit-block clearfix">
		<?php echo $this->Form->submit(__l('Add'));?>
	</div>
	<?php echo $this->Form->end();?>
</div>