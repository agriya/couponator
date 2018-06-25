<?php /* SVN: $Id: add.ctp 828 2009-12-03 06:21:46Z annamalai_034ac09 $ */ ?>
<div class="js-responses">
<div class="couponComments form js-ajax-form-container">
	<h2><?php echo __l('Add Your Comment');?></h2>
	<div class="form-blocks js-corner round-5">
		<?php echo $this->Form->create('CouponComment', array('class' => 'normal js-ajax-comment-form comment-form'));?>
		<fieldset>
			<?php
				echo $this->Form->input('coupon_id', array('type' => 'hidden'));
				echo $this->Form->input('comment',array('type'=>'textarea'));
			?>
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
		</fieldset>
		<div class="submit-block clearfix">
			<?php echo $this->Form->submit(__l('Post Comment'));?>
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>
</div>