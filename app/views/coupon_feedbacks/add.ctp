<?php /* SVN: $Id: $ */ ?>
<div class="couponFeedbacks form">
	<h2><?php echo __l('Add Coupon Feedback');?></h2>
<?php echo $this->Form->create('CouponFeedback', array('class' => 'normal'));?>
	<fieldset>
	<?php
		echo $this->Form->input('actual_price');
		echo $this->Form->input('purchased_price');
	?>
	</fieldset>
	<div class="clearfix submit-block">
		<?php echo $this->Form->submit(__l('Add'));?>
	</div>
	<?php echo $this->Form->end();?>
</div>
