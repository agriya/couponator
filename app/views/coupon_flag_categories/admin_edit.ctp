<?php /* SVN: $Id: admin_edit.ctp 620 2009-07-14 14:04:22Z boopathi_23ag08 $ */ ?>
<div class="couponFlagCategories form">
<h2><?php echo __l('Edit Coupon Flag Category');?></h2>
<?php echo $this->Form->create('CouponFlagCategory', array('class' => 'normal'));?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => __l('Name')));
    	echo $this->Form->input('is_active',array('label'=>__l('Active'))); 
	?>
    <div class="submit-block clearfix">
    <?php echo $this->Form->submit(__l('Update'));?>
    </div>
    <?php echo $this->Form->end();?>
</div>