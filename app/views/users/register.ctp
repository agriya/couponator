<div class="users form">
 <div class="community-block clearfix">
        <div class="store-left">
          <div class="store-right">
            <div class="store-center coupon-center">
<h2><?php echo __l('Register'); ?></h2>
 <div class="clearfix">
	 <div class="openid-block">
        <h5><?php echo __l('Sign In using: '); ?></h5>
		<ul class="list clearfix">
			<li class="face-book">
				 <?php if(Configure::read('facebook.is_enabled_facebook_connect')):  ?>
					<?php echo $this->Html->link(__l('Sign up with Facebook'), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Sign up with Facebook'), 'escape' => false)); ?>
				 <?php endif; ?>
			</li>
			<?php if(Configure::read('twitter.is_enabled_twitter_connect')):?>
				<li class="twiiter"><?php echo $this->Html->link(__l('Sign up with Twitter'), array('controller' => 'users', 'action' => 'login',  'type'=> 'twitter', 'admin'=>false), array('class' => 'Twitter', 'title' => __l('Sign up with Twitter')));?></li>
			<?php endif;?>
			<?php if(Configure::read('user.is_enable_openid')):?>
				<li class="yahoo"><?php echo $this->Html->link(__l('Sign up with Yahoo'), array('controller' => 'users', 'action' => 'login', 'type'=>'yahoo'), array('alt'=> __l('[Image: Yahoo]'),'title' => __l('Sign up with Yahoo')));?></li>
				<li class="gmail"><?php echo $this->Html->link(__l('Sign up with Gmail'), array('controller' => 'users', 'action' => 'login', 'type'=>'gmail'), array('alt'=> __l('[Image: Gmail]'),'title' => __l('Sign up with Gmail')));?></li>
				<li class="open-id"><?php 	echo $this->Html->link(__l('Sign up with Open ID'), array('controller' => 'users', 'action' => 'login','type'=>'openid'), array('class'=>'js-ajax-colorbox-openid {source:"js-dialog-body-open-login"}','title' => __l('Sign up with Open ID')));?></li>
			<?php endif;?>
		</ul>
	</div>
	</div>
<?php echo $this->Form->create('User', array('action' => 'register', 'class' => 'normal')); ?>
	<fieldset>
	<?php
		$terms = $this->Html->link(__l('Terms & Policies'),array('controller' => 'pages', 'action' => 'view', 'term-and-conditions', 'admin' => false), array('target' => '_blank'));	
		if(!empty($this->request->data['User']['openid_url'])):
			echo $this->Form->input('openid_url', array('type' => 'hidden', 'value' => $this->request->data['User']['openid_url']));
		endif;
		echo $this->Form->input('username');
		if(empty($this->request->data['User']['openid_url']) && empty($this->request->data['User']['fb_user_id']) && empty($this->request->data['User']['twitter_user_id'])):
			echo $this->Form->input('passwd', array('label' => __l('Password')));
		endif;
		echo $this->Form->input('email'); ?>
		<div>
          <?php
            if(!empty($this->request->data['User']['fb_user_id'])) :
                echo $this->Form->input('fb_user_id', array('type' => 'hidden', 'value' => $this->request->data['User']['fb_user_id']));
            endif;
			if(!empty($this->request->data['User']['twitter_user_id'])) :
                echo $this->Form->input('twitter_user_id', array('type' => 'hidden', 'value' => $this->request->data['User']['twitter_user_id']));
            endif;		 
			if(!empty($this->request->data['User']['twitter_access_token'])) :
                echo $this->Form->input('twitter_access_token', array('type' => 'hidden', 'value' => $this->request->data['User']['twitter_access_token']));
            endif;		 
			if(!empty($this->request->data['User']['twitter_access_key'])) :
                echo $this->Form->input('twitter_access_key', array('type' => 'hidden', 'value' => $this->request->data['User']['twitter_access_key']));
            endif;	
			if(!empty($this->request->data['User']['is_yahoo_register'])) :
                echo $this->Form->input('is_yahoo_register', array('type' => 'hidden', 'value' => $this->request->data['User']['is_yahoo_register']));
            endif;
            if(!empty($this->request->data['User']['is_gmail_register'])) :
                echo $this->Form->input('is_gmail_register', array('type' => 'hidden', 'value' => $this->request->data['User']['is_gmail_register']));
            endif;				
			echo $this->Form->input('referred_by_user_id',array('type' => 'hidden'));
		  ?>
		  
        </div>
        <?php
		if(empty($this->request->data['User']['openid_url'])): ?>            
        	<div class="input captcha-block clearfix js-captcha-container">
    			<div class="captcha-left">
    	          <?php echo $this->Html->image($this->Html->url(array('controller' => 'users', 'action' => 'show_captcha', 'register', md5(uniqid(time()))), true), array('alt' => __l('[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]'), 'title' => __l('CAPTCHA image'), 'class' => 'captcha-img'));?>
    	        </div>
    	        <div class="captcha-right">
        	        <?php echo $this->Html->link(__l('Reload CAPTCHA'), '#', array('class' => 'js-captcha-reload captcha-reload', 'title' => __l('Reload CAPTCHA')));?>
	               <div>
		              <?php echo $this->Html->link(__l('Click to play'), Router::url('/', true)."flash/securimage/play.swf?audio=". $this->Html->url(array('controller' => 'users', 'action'=>'captcha_play', 'register'), true) ."&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5&height=19&width=19&wmode=transparent", array('class' => 'js-captcha-play')); ?>
				   </div>
    	        </div>
            </div>
        	<?php echo $this->Form->input('captcha', array('label' => __l('Security Code'))); ?>
    		<?php echo $this->Form->input('is_agree_terms_conditions', array('label' => __l(' I have read, understood &amp; agree to the').' '.$terms)); ?>
            <?php
        endif; ?>
	</fieldset>
    <div class="submit-block clearfix">
<?php echo $this->Form->submit(__l('Submit')); ?>
</div>
<?php echo $this->Form->end(); ?>
 </div>
          </div>
        </div>
        <div class="coupon-bottom"></div>
      </div>
</div>
