<div class="couponsFlagCategories form">
<h2><?php echo __l('Add').__l(' Category');?></h2>
<?php echo $this->Form->create('CouponFlagCategory', array('class' => 'normal'));?>
<div class="padd-bg-tl">
        <div class="padd-bg-tr">
        <div class="padd-bg-tmid"></div>
        </div>
    </div>
<div class="padd-center clearfix">
	<fieldset>
    	<?php echo $this->Form->input('name', array('label' => __l('Name'))); ?>
    	<?php echo $this->Form->input('is_active',array('label'=> __l('Active'),'type'=>'checkbox')); ?>
	</fieldset>
	</div>
	<div class="padd-bg-bl">
    <div class="padd-bg-br">
    <div class="padd-bg-bmid"></div>
    </div>
    </div>
<div class="submit-block clearfix">
<?php echo $this->Form->submit(__l('Add'));?>
</div>
<?php echo $this->Form->end();?>
</div>