<?php
	echo $this->Form->input('coupon_type_id', array('label' => __l('Type'), 'empty' => __l('Please Select'), 'class' => 'js-types'));
	?>
   <div class='js-category hide'>
    <?php
	echo $this->Form->input('category_id', array('empty' => __l('Please Select'),'label' => __l('Category')));
	?>
	</div>
	<?php
	echo $this->Form->input('store_id', array('empty' => __l('Please Select'),'label' => __l('Store')));
	if (isset($this->request->data['Coupon']['coupon_type_id']) && $this->request->data['Coupon']['coupon_type_id']==2 || !isset($this->request->data['Coupon']['coupon_type_id'])) {
		$coupon_class ='js-coupon';
	} else {
		$coupon_class ='hide js-coupon';
	}
?>
	<?php echo $this->Form->input('coupon_code', array('label' => __l('Code'), 'help' => __l('If there is no coupon code, leave it as blank'))); ?>
<div class="input date-time date-time-block clearfix">
	<div class="js-datetime">
		<?php echo $this->Form->input('start_date', array('orderYear' => 'asc', 'maxYear' => date('Y') + 10, 'minYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'))); ?>
	</div>
</div>
<div class="input date-time end-date-time-block date-time-block clearfix">
	<div class="js-datetime">
		<?php echo $this->Form->input('end_date', array('orderYear' => 'asc', 'maxYear' => date('Y') + 10, 'minYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'))); ?>
	</div>
</div>
<?php
	echo $this->Form->input('is_ongoing', array('label' => __l('Ongoing'), 'type' => 'checkbox','help'=>__l('When enable, there is no end point and currently in')));
	if (isset($this->request->data['Coupon']['coupon_type_id']) && $this->request->data['Coupon']['coupon_type_id'] == 1) {
		$label = __l('Tips');
	} elseif (isset($this->request->data['Coupon']['coupon_type_id']) && $this->request->data['Coupon']['coupon_type_id'] == 2) {
		$label = __l('Discount');
	} else {
		$label = __l('Description');
	}
	echo $this->Form->input('description', array('label' => $label, 'help' => __l('15% Off Entire Purchase')));
?>
	<?php echo $this->Form->input('url', array('label' => __l('URL'), 'help' => 'e.g. http://address.coupon.com')); ?>
<?php
	echo $this->Form->input('tag', array('label' => __l('Tags'), 'help' =>__l('Coupon Tag will be helpful for customer while search coupons.(Comma separated Coupon tags)')));		
	echo $this->Form->input('coupon_status_id', array('label' => __l('Status'), 'options' => $couponStatuses,'help'=>__l('Note: Sytem will change the status based on store status. eg: store status in "New store", coupon will be stored as "Check Store"')));
	echo $this->Form->input('coupon_type_status_id', array('label' => __l('Type Status'), 'options' => $couponTypeStatuses,'help' =>__l('1. Speical offer coupon - Specially offered coupon <br/> 2. Normal Coupon - Active and trustable coupon <br/> 3. Unreliable Coupon - Not sure it will work or not')));
	echo $this->Form->input('is_partner', array('label' => __l('Partner')));
?>