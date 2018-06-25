<div class="store-center coupon-center">
<?php if(isset($success)) : ?>
    <div class="success-msg">
        <?php echo __l('Thank you, we received your message and will get back to you as soon as possible.'); ?>
    </div>
<?php else: ?>
    <h2><?php echo __l('Contact Us'); ?></h2>
    <?php
        echo $this->Form->create('Contact', array('class' => 'normal'));
        echo $this->Form->input('first_name', array('label' => __l('First Name')));
        echo $this->Form->input('last_name', array('label' => __l('Last Name')));
        echo $this->Form->input('email');
        echo $this->Form->input('telephone');
        echo $this->Form->input('subject');
        echo $this->Form->input('message');
    ?>
    <div class="captcha-block clearfix js-captcha-container">
        <div class="captcha-left">
            <?php echo $this->Html->image($this->Html->url(array('controller' => 'contacts', 'action' => 'show_captcha', md5(uniqid(time()))), true), array('alt' => __l('[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]'), 'title' => __l('CAPTCHA image'), 'class' => 'captcha-img'));?>
        </div>
        <div class="captcha-right">
            <?php echo $this->Html->link(__l('Reload CAPTCHA'), '#', array('class' => 'js-captcha-reload captcha-reload', 'title' => __l('Reload CAPTCHA')));?>
        	<div>
			  <?php echo $this->Html->link(__l('Click to play'), Router::url('/', true)."flash/securimage/play.swf?audio=". $this->Html->url(array('controller' => 'contacts', 'action' => 'captcha_play', 'contactus'), true) ."&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5&height=19&width=19&wmode=transparent", array('class' => 'js-captcha-play')); ?>
		   </div>
        </div>
    </div>
    <?php
        echo $this->Form->input('captcha', array('label' => __l('Security Code'))); ?>
        <div class="submit-block clearfix"><?php  echo $this->Form->submit(__l('Send')); ?></div>
		<?php  echo $this->Form->end();
    ?>
<?php endif; ?>
</div>