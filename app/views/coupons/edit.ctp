<?php /* SVN: $Id: edit.ctp 3052 2010-02-01 08:21:03Z bharathdayal_092at09 $ */ ?>
<div class="coupons form">
	<h2><?php echo __l('Edit Coupon');?></h2>
	<?php echo $this->element('js_tiny_mce_setting', array('config' => 'sec'));?>
	<?php echo $this->Form->create('Coupon', array('class' => 'normal','enctype' => 'multipart/form-data'));?>
		<fieldset> 
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('title');
				echo $this->Form->input('store_id');
				echo $this->Form->input('category_id');
				echo $this->Form->input('saver_type_id',array('help'=>__l('If this coupon is for saver offers choose the saver type otherwise leave empty.')));
				echo $this->Form->input('brand_id',array('help'=>__l('If this coupon is branded then choose the brand type.'))); 
				echo $this->Form->input('country_id');
				echo $this->Form->input('url');
				echo $this->Form->input('start_date');
				echo $this->Form->input('end_date');
				echo $this->Form->input('image_url');
			?>
			<span><?php echo __l('Or');?></span>
			<?php 
				echo $this->Form->input('comment1');
				echo $this->Form->input('comment2');
				echo $this->Form->input('main_description',array('class' => 'js-editor','label' => __l('Main Description')));
				echo $this->Form->input('sub_description',array('class' => 'js-editor','label' => __l('Secondary Description')));
				echo $this->Form->input('coupon_code');
				echo $this->Form->input('is_percentage',array('label' => __l('Percentage Offer'),'help' => __l('if you not check this then it will be in $ offer')));
				echo $this->Form->input('list_price');
				echo $this->Form->input('sale_price');
				echo $this->Form->input('meta_keywords');
				echo $this->Form->input('meta_description',array('class' => 'js-editor'));
				echo $this->Form->input('is_free_shipping',array('label' => __l('Free shipping')));
				echo $this->Form->input('is_print',array('label' => __l('Printable')));
				echo $this->Form->input('tag', array('label' => __l('Tags'), 'help' =>__l('Coupon Tag will be helpful for customer while search coupons. (Comma separated Coupon tags)')));
			?>
		</fieldset>
		<div class="clearfix submit-block">
			<?php echo $this->Form->submit(__l('Update'));?>
		</div>
	<?php echo $this->Form->end();?>
</div>