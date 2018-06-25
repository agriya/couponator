<?php /* SVN: $Id: import.ctp 3972 2010-01-06 15:24:42Z senthilkumar_017ac09 $ */ ?>
<div class="deals form rightbar">
	<?php echo $this->Form->create('Store', array('controller' => 'stores', 'action'=> 'admin_import', 'class' => 'normal', 'enctype' => 'multipart/form-data'));?>
   <div class="info-details">
		<p><?php echo __l('Ensure your file has a '); ?>
        <span><?php echo __l('.CSV ' ) ;?></span>
        <?php echo __l('extension.' ) ;?>
        </p>
		<p><?php echo __l('<span>IMPORTANT</span>: Your file must be a valid CSV file in order for the import to work successfully. You can filter the imported stores under the new store and approve manually after your changes.'); ?></p>
		<p><?php echo $this->Html->link(__l("View Sample CSV File"), array('controller'=> 'files', 'action'=>'store_sample.csv', 'admin' => false), array('class'=>'download-link', 'target' => '_blank','escape' => false)); ?> </p>
    </div>
    	<h3><?php echo __l('Choose your file from your desktop.'); ?></h3>
			<?php echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => false)); ?>
				<?php if(!empty($type)):?>
					<?php echo $this->Form->input('type', array('type' => 'hidden', 'value' => $type)); ?>
				<?php endif;?>
		<?php echo __l('(OR)');?>
		<?php echo $this->Form->input('url',array('label'=>__l('Store CSV URL'),'help'=>__l('e.g. http://www.example.com/stores.csv')));?>
		 <div class="submit-block">
        <?php echo $this->Form->submit(__l('Import'));?>
        </div>
		<?php echo $this->Form->end();?>
 </div>

