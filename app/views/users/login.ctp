<div class="users form">
   <div class="community-block clearfix">
        <div class="store-left">
          <div class="store-right">
            <div class="store-center coupon-center">
    <h2><?php echo __l('Login'); ?></h2>
		<?php if (empty($this->request->params['prefix'])): ?>
	 <div class="clearfix">
	 <div class="openid-block">
        <h5><?php echo __l('Sign In using: '); ?></h5>
		<ul class="list clearfix">
			<li class="face-book">
				 <?php if(Configure::read('facebook.is_enabled_facebook_connect')):  ?>
					<?php echo $this->Html->link(__l('Sign in with Facebook'), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Sign in with Facebook'), 'escape' => false)); ?>
				 <?php endif; ?>
			</li>
			<?php if(Configure::read('twitter.is_enabled_twitter_connect')):?>
				<li class="twiiter"><?php echo $this->Html->link(__l('Sign in with Twitter'), array('controller' => 'users', 'action' => 'login',  'type'=> 'twitter', 'admin'=>false), array('class' => 'Twitter', 'title' => __l('Sign in with Twitter')));?></li>
			<?php endif;?>
			<?php if(Configure::read('user.is_enable_openid')):?>
				<li class="yahoo"><?php echo $this->Html->link(__l('Sign in with Yahoo'), array('controller' => 'users', 'action' => 'login', 'type'=>'yahoo'), array('title' => __l('Sign in with Yahoo')));?></li>
				<li class="gmail"><?php echo $this->Html->link(__l('Sign in with Gmail'), array('controller' => 'users', 'action' => 'login', 'type'=>'gmail'), array('title' => __l('Sign in with Gmail')));?></li>
				<li class="open-id"><?php 	echo $this->Html->link(__l('Sign in with Open ID'), array('controller' => 'users', 'action' => 'login','type'=>'openid'), array('class'=>'js-ajax-colorbox-openid {source:"js-dialog-body-open-login"}','title' => __l('Sign in with Open ID')));?></li>
			<?php endif;?>
		</ul>
	</div>
	</div>
	<?php endif; ?>
    <?php
	    echo $this->Form->create('User', array('action' => 'login', 'class' => 'normal'));
		echo $this->Form->input(Configure::read('user.using_to_login'));
	    echo $this->Form->input('passwd', array('label' => __l('Password')));
        ?>
                 	         
		<?php
		echo $this->Form->input('User.is_remember', array('type' => 'checkbox', 'label' => __l('Remember me on this computer.')));?>
	  	<div class="fromleft"> 	<?php echo $this->Html->link(__l('Forgot your password?') , array('controller' => 'users', 'action' => 'forgot_password', 'admin'=>false),array('title' => __l('Forgot your password?')));
	?>
	<?php if(!(!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin')):	?> |
	<?php 
			echo $this->Html->link(__l('Signup') , array('controller' => 'users',	'action' => 'register'),array('title' => __l('Signup')));
		endif;
        $f = (!empty($_GET['f'])) ? $_GET['f'] : (!empty($this->request->data['User']['f']) ? $this->request->data['User']['f'] : (($this->request->url != 'admin/users/login' && $this->request->url != 'users/login') ? $this->request->url : ''));
		if(!empty($f)) :
            echo $this->Form->input('f', array('type' => 'hidden', 'value' => $f));
        endif;
        ?>
        	</div>
        	
			<div class="clearfix submit-block">
				<?php echo $this->Form->submit(__l('Submit'));?>	
			</div> 
			<?php echo $this->Form->end();?>
     </div>
          </div>
        </div>
        <div class="coupon-bottom"></div>
      </div>
</div>