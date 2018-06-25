<?php /* SVN: $Id: admin_add.ctp 6608 2010-06-02 13:31:30Z sreedevi_140ac10 $ */ ?>
<div class="subscriptions form">
<?php echo $this->Form->create('Subscription', array('class' => 'normal'));?>
	<div>
 		<h2><?php echo __l('Add Subscription');?></h2>
    </div>
    <div>
    	<?php
    		echo $this->Form->input('user_id',array('label' => __l('User')));
    		echo $this->Form->input('city_id',array('label' => __l('City')));
    		echo $this->Form->input('email',array('label' => __l('Email')));
    	?>
	</div>
	<div class="submit-block clearfix">
    <?php echo $this->Form->submit(__l('Add'));?>
	</div>
    <?php echo $this->Form->end();?>
</div>
