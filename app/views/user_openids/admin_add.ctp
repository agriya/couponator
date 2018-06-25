<?php /* SVN: $Id: admin_add.ctp 12 2009-11-14 10:17:05Z annamalai_034ac09 $ */ ?>
<div class="userOpenids form">
<?php echo $this->Form->create('UserOpenid', array('class' => 'normal'));?>
	<fieldset>
 		<legend><?php echo $this->Html->link(__l('User Openids'), array('action' => 'index'),array('title' => __l('User openids')));?> &raquo; <?php echo __l('Add User Openid');?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('openid');
		echo $this->Form->input('verify',array('type' => 'checkbox'));
	?>
	</fieldset>
	<div class="submit-block clearfix">
		<?php echo $this->Form->submit(__l('Add'));?>
	</div>
	<?php echo $this->Form->end(__l('Add'));?>
</div>
