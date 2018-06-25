<?php /* SVN: $Id: add.ctp 619 2009-07-14 13:25:33Z boopathi_23ag08 $ */ ?>
<div class="couponFlags form js-responses">

		  	<h2><?php echo __l('Flag This Coupon');?></h2>
		  <div class="offer-inner monitor-inner">
	<?php
		echo $this->Form->create('CouponFlag', array('class' => 'normal comment-form'));
		if($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
			echo $this->Form->input('user_id', array('empty' => __l('Select')));
		endif;
		echo $this->Form->input('Coupon.id',array('type' => 'hidden'));
		echo $this->Form->input('coupon_flag_category_id', array('label' => __l('Reason'), 'empty' => __l('Please Select')));
		echo $this->Form->input('message', array('label' => __l('Message')));
	?>
	<div class="submit-block clearfix">
		<?php echo $this->Form->submit(__l('Submit'));?>
	</div>
	<?php echo $this->Form->end();?>
</div>
</div>