<?php /* SVN: $Id: admin_add.ctp 215 2009-11-19 10:54:33Z annamalai_034ac09 $ */ ?>
<div class="stores form js-responses">
	<?php echo $this->Form->create('Store', array('action'=>'add','class' => 'normal js-upload-form','enctype' => 'multipart/form-data'));?>
		<fieldset>	
			<?php
				echo $this->Form->input('name',array('label' => __l('Name')));
				echo $this->Form->input('url', array('help' => __l('e.g., http://www.example.com'), 'label' => __l('Store URL')));
				echo $this->Form->input('description', array('label' => __l('Description'), 'type' => 'textarea'));
				echo $this->Form->input('meta_keywords',array('label' => __l('Meta Keywords')));
				echo $this->Form->input('meta_description',array('label' => __l('Meta Description'), 'type' => 'textarea'));
			?>
			<div class="mapblock-info">
				<div class="clearfix address-input-block">
					<?php echo $this->Form->input('address', array('label' => __l('Address'), 'id' => 'StoreAddressSearch','help'=>__l('Note: Address required for printable coupon google map listing, if not given then store will not be listed in google map'))); ?>
				</div>
				<?php	
					echo $this->Form->input('latitude',array('type'=>'hidden', 'id' => 'latitude'));
					echo $this->Form->input('longitude',array('type'=>'hidden', 'id' => 'longitude'));
					echo $this->Form->input('country_id',array('id'=>'js-country_id','type' => 'hidden'));
					echo $this->Form->input('State.name', array('type' => 'hidden'));
					echo $this->Form->input('City.name', array('type' => 'hidden'));
				?>
				<div id="address-info" class="hide"><?php echo __l('Please select correct address value'); ?></div>
				<div id="mapblock">
					<div id="mapframe">
						<div id="mapwindow"></div>
					</div>
				</div>
			</div>
			<?php
				echo $this->Form->input('zip_code',array('label' => __l('Zipcode'),'help'=>__l('Note: zip code required for site address search and google map')));
				echo $this->Form->input('store_status_id', array('label' => __l('Status')));
				echo $this->Form->input('rank', array('label' => __l('Rank'),'help'=>__l('Note: Low rank will affect the coupon listing weightage'),'options'=>$rank));
				echo $this->Form->input('is_partner', array('label' => __l('Partner')));
				echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('File'),'help'=>'Leave it as empty, if you dont have the store thumb, systerm automatically create the store thumb using thumblizr.'));
			?>
		</fieldset>
		<div class="submit-block clearfix">
			<?php echo $this->Form->submit(__l('Add')); ?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>