<?php
if(empty($this->request->params['named']['type']) || isset($this->request->params['named']['type']) && $this->request->params['named']['type']!='free-shipping'):?>
<div class="shipping-block coupon-codes-block clearfix">
<div class="shipping-img"></div>
<div class="shipping-info">
<h4><?php echo __l('Free Shipping'); ?></h4>
<?php  echo $this->Html->link(__l('Free Shipping Coupons! Click Here'), array('controller'=> 'coupons', 'action'=> 'lst', 'type' => 'free_shipping'));  ?>
</div>
</div>
<?php endif;  ?>