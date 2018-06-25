<?php /* SVN: $Id: admin_edit.ctp 2890 2010-08-30 11:20:12Z boopathi_026ac09 $ */ ?>
<?php echo $this->element('js_tiny_mce_setting', array('config' => 'sec'));?>
<?php if(!empty($page)): ?>
	<div class="js-tabs">
		<ul>
			<li><span><?php echo $this->Html->link(__l('Preview'), '#preview'); ?></span></li>
			<li><span><?php echo $this->Html->link(__l('Change'), '#add'); ?></span></li>
		</ul>
		<div id="preview">
			<div class="page">
				<h2><?php echo $page['Page']['title']; ?></h2>
				<div class="entry"><?php echo $page['Page']['content']; ?></div>
			</div>
		</div>
<?php endif; ?>
<div id="add">
	<h2><?php echo __l('Edit Page'); ?></h2>
	<div class="pages form">      
		<fieldset>
			<?php
				echo $this->Form->create('Page', array('class' => 'normal'));
                echo $this->Form->input('id');
                echo $this->Form->input('title', array('between' => '', 'label' => __l('Page title')));
                echo $this->Form->input('content', array('type' => 'textarea', 'class' => 'js-editor', 'label' =>__l('Body'), 'info' => __l('Available Variables: ##SITE_NAME##, ##SITE_URL##, ##ABOUT_US_URL##, ##CONTACT_US_URL##, ##FAQ_URL##, ##SITE_CONTACT_EMAIL##')));                
				?>
                <div class="submit-block page-submit-block clearfix">
                <?php echo $this->Form->submit(__l('Update'), array('name' => 'data[Page][Update]')); ?>
                <div class="cancel-block">
                       <?php  echo  $this->Html->link(__l('Cancel'), array('controllers' => 'pages', 'action' => 'index' ), array('title' => 'Cancel'));?>
                 </div>
               </div>
			<?php echo $this->Form->end(); ?>
		</fieldset>
	</div>
</div>
<?php if(!empty($page)): ?>
    </div>
<?php endif; ?>