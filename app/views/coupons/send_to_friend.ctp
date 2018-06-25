<?php /* SVN: $Id: send_to_friend.ctp 19354 2011-01-18 08:07:04Z suresh_116act10 $ */ ?>
<div class="jobs view js-friend-responses">
 	<h2><?php echo __l('Send to a Friend');?></h2>
	<?php echo $this->Form->create('Coupon', array('url' => array('controller' =>'coupons','action' =>'send_to_friend',$slug),'class' => 'normal js-contact-form'));?>
	<fieldset>
	<?php
	
		echo $this->Form->input('your_name');
		echo $this->Form->input('your_email');

		echo $this->Form->input('friend_name');
		echo $this->Form->input('friend_email');
		echo $this->Form->input('message',array('type' => 'textarea'));
		echo $this->Form->input('slug', array('type' => 'hidden', 'value' =>$slug));
	?>
	</fieldset>
	<?php 
	echo $this->Form->submit(__l('Send'));
	echo $this->Form->end();
	?>
</div>


