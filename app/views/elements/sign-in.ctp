<div class="signin-block">
	<h2><?php echo __l("Sign In"); ?></h2>
		<div class="signin-inner">
			<p><?php echo __l("It's easy to participate- sign in to the community with an existing service account:"); ?></p>
		<h4 class="signin-account"><?php echo __l("Sign in using your account with"); ?></h4>
			<ul class="signin-link clearfix">
				<li class="facebook-1">
				<?php if(Configure::read('facebook.is_enabled_facebook_connect')):  ?>
					<?php echo $this->Html->link(__l('Sign in with Facebook'), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Sign in with Facebook'), 'escape' => false)); ?>
				 <?php endif; ?>
				 </li>
				<li class="google-1">
				 <?php echo $this->Html->link(__l('Sign in with Gmail'), array('controller' => 'users', 'action' => 'login', 'type'=>'gmail'), array('title' => __l('Sign in with Gmail')));?>
				</li>
				<li class="twitter-1">
				<?php echo $this->Html->link(__l('Sign in with Twitter'), array('controller' => 'users', 'action' => 'login',  'type'=> 'twitter', 'admin'=>false), array('class' => 'Twitter', 'title' => __l('Sign in with Twitter')));?>
				</li>
				<li class="yahoo-1">
				<?php echo $this->Html->link(__l('Sign in with Yahoo'), array('controller' => 'users', 'action' => 'login', 'type'=>'yahoo'), array('title' => __l('Sign in with Yahoo')));?>
				</li>				 
				<li class="open-id-1"><?php 	echo $this->Html->link(__l('Sign in with Open ID'), array('controller' => 'users', 'action' => 'login','type'=>'openid'), array('class'=>'js-ajax-colorbox-openid {source:"js-dialog-body-open-login"}','title' => __l('Sign in with Open ID')));?></li>
			</ul>
		</div>
	<div class="coupon-bottom"></div>
</div>