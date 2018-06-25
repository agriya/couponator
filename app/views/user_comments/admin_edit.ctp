<?php /* SVN: $Id: admin_edit.ctp 63841 2011-08-22 06:43:03Z arovindhan_144at11 $ */ ?>
<h2><?php echo __l('Edit Comment'); ?></h2>
<div class="userComments form">
<?php echo $this->Form->create('UserComment', array('class' => 'normal'));?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('comment',array('label' => __l('Comment')));
	?>
	</fieldset>
 <div class="submit-block clearfix">
    <?php echo $this->Form->submit(__l('Update'));?>
    </div>
    <?php echo $this->Form->end();?>
</div>