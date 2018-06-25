<?php /* SVN: $Id: view.ctp 19355 2011-01-18 08:09:18Z suresh_116act10 $ */ ?>
<div class="coupons view "><?php //pr($coupon); ?>
<h2><?php echo $this->Html->cText($coupon['Coupon']['title']) ;?></h2>
	<dl class="list clearfix"><?php $i = 0; $class = ' class="altrow"';?>
        <?php if(!empty($coupon['Store']['title'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Store');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->link($this->Html->cText($coupon['Store']['title']), array('controller' => 'coupons', 'action' => 'index','store'=> $coupon['Store']['slug']), array('escape' => false));?></dd>
		<?php endif; ?>
        <?php if(!empty($coupon['Category']['title'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Category');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->link($this->Html->cText($coupon['Category']['title']), array('controller' => 'coupons', 'action' => 'index', 'category' => $coupon['Category']['slug']), array('escape' => false));?></dd>
		<?php endif; ?>
        <?php if(!empty($coupon['Coupon']['url'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('URL');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($coupon['Coupon']['url']);?></dd>
	    <?php endif; ?>
        <?php if(!empty($coupon['Coupon']['rating_percentage'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Ratings');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cInt($coupon['Coupon']['rating_percentage']).'%';?></dd>
		<?php endif; ?>
   		  <?php if(!empty($coupon['Coupon']['coupon_code'])) : ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Coupon Code');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($coupon['Coupon']['coupon_code']);?></dd>
		<?php endif; ?>
	   </dl>
	    <?php  $coupsale_price =  $coupon['Coupon']['discount'];?>
            <p class="desc"><?php echo __l('Price: ').$number->currency($coupsale_price, 'USD');?></p>
			 

	 
 </div> 
 
 


<script>
window.print();
</script>

