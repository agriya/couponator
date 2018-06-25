<?php /* SVN: $Id: admin_add.ctp 12 2009-11-14 10:17:05Z annamalai_034ac09 $ */ ?>
<div class="users form">
	<?php echo $this->Form->create('User', array('class' => 'normal'));?>
		<fieldset>
		<?php
			echo $this->Form->input('user_type_id');
			echo $this->Form->input('email');
			echo $this->Form->input('username');
			echo $this->Form->input('passwd', array('label' => __l('Password')));
		?>
		</fieldset>
		<div class="submit-block clearfix">
			<?php echo $this->Form->submit(__l('Add'));?>
		</div>
	<?php echo $this->Form->end();?>
</div>