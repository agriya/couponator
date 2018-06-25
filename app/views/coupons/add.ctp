<?php
	if(isset($this->request->params['named']['type'])):
		$type=$this->request->params['named']['type'];
	elseif(isset($this->request->data['Coupon']['type'])):
		$type=$this->request->data['Coupon']['type'];
	else:
		$type='';
	endif;
?>
<div class="browse js-ajax-form-container">
	<div class="coupon-codes-block js-responses1">
		<div class="store-left">
			<div class="store-right">
				<div class="store-center coupon-center">
				<h3><?php echo __l('Share Your Coupon'); ?></h3>
  		        <div class="form-inner share-coupon-block">
					<div class="notice-container"></div>
					<?php if ($type != 'user'): ?>
						<p><?php echo __l('Found a coupon for'); ?> <?php echo $store['Store']['url'] . '?'; ?> </p>
					<?php endif; ?>
					<p><?php echo __l('Enter the details below to share with other users'); ?></p>
					<?php
						echo $this->Form->create('Coupon', array('action' => 'add' ,'class' => "normal clearfix js-ajax-form-coupon {container:'js-ajax-form-container',responsecontainer:'js-responses1'}"));
						if ($type!='user'):
							echo $this->Form->input('Coupon.store_name',array('label' => __l('Store'),'value' => $store['Store']['url'], 'disabled'=>'disabled'));
							echo $this->Form->input('Coupon.store',array('type' => 'hidden'));
						else:
							echo $this->Form->autocomplete('Store.name', array('label' => __l('Store'), 'acFieldKey' => 'Store.id', 'acFields' => array('Store.name'), 'acSearchFieldNames' => array('Store.name'), 'maxlength' => '255', 'help' => __l('Type keyword to find existing store name')));
						endif;
						if (!empty($is_store_id)) {
							echo $this->Form->input('Store.id',array('id' => 'StoreId_H', 'type' => 'hidden', 'value' => $this->request->data['Store']['id']));
						}
						if($type != 'user'):
							echo $this->Form->input('store_id', array('type' => 'hidden'));
						endif;
					?>
					<div class="required">
					<?php
						if ($type == 'user' && empty($is_store_id)):
							echo $this->Form->input('Store.url', array('id' => 'store_url', 'label' => __l('Store URL'), 'help' =>__l('http://www.example.com')));
						endif;
					?>
					</div>
					<?php
						echo $this->Form->input('Coupon.type', array('type' => 'hidden','value' => $type));
						echo $this->Form->input('Coupon.store_slug', array('type'=>'hidden'));
						echo $this->Form->input('Coupon.coupon_type_id',array('label' => __l('Type'),'options'=>$couponTypes,'class'=>'js-user_types','empty'=>__l('Please Select')));
						echo $this->Form->input('Coupon.coupon_code',array('label' => __l('Code'), 'help' => __l('Leave as blank, if no coupon code')));
						if(isset($this->request->data['Coupon']['coupon_type_id']) && $this->request->data['Coupon']['coupon_type_id']==1) {
							$label = __l('Tips');
						} else {
							$label = __l('Discount');
						}
						echo $this->Form->input('Coupon.description', array('label' => $label ,'class' => 'cdesc', 'help' => __l('eg:15% Off Entire Purchase')));
						echo $this->Form->input('Coupon.url',array('label' => __l('Coupon URL'), 'help' => __l('e.g. http://address.coupon.com')));
						if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
							echo $this->Form->input('Coupon.user_id',array('empty' => __l('Please select'),'label'=>__l('Username')));
						endif;
						if (empty($this->request->data['_Token'])):
							$class = 'hide';
						else:
							$class = '';
						endif;
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
					<?php echo $this->Form->input('Coupon.captcha', array('label' => __l('Security Code'))); ?>
					<div class="submit-block clearfix">
						<?php echo $this->Form->submit(__l('Share')); ?>
					</div>
					<?php echo $this->Form->end(); ?>
				</div>
				</div>
			</div>
  	<div class="coupon-bottom"></div>
		</div>
	</div>
</div>
<?php if (!empty($this->request->data['Coupon']['coupon_type_id'])): ?>
	<script>
		$(document).ready(function() {
			updateFields("<?php echo $this->request->data['Coupon']['coupon_type_id']; ?>");
		});
	</script>
<?php endif; ?>