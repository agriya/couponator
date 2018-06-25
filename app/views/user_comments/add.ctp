<?php /* SVN: $Id: add.ctp 5157 2010-03-30 16:04:21Z bharathdayal_092at09 $ */ ?>
<div class="js-responses">
	<div class="userComments form">
		<h2><?php echo __l('Write to'); ?>&nbsp;<?php echo $username;?></h2>
		<?php echo $this->Form->create('UserComment', array('class' => 'normal js-ajax-comment-form comment-form', 'action' =>'add'));?>
			<fieldset>
				<?php
					echo $this->Form->input('to_user_id',array('type'=>'hidden'));
					echo $this->Form->input('username',array('type'=>'hidden'));
					echo $this->Form->input('comment');
				?>					
        	<?php echo $this->Form->input('captcha', array('label' => __l('Security Code'))); ?>
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
			</fieldset>
			<div class="submit-block clearfix">
				<?php echo $this->Form->submit(__l('Add'));?>
			</div>
		<?php echo $this->Form->end();?>
	</div>
</div>