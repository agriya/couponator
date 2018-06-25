<?php /* SVN: $Id: admin_edit.ctp 2958 2010-01-29 07:20:40Z bharathdayal_092at09 $ */ ?>
<div class="stores form js-responses">
    	<?php echo $this->Form->create('Store', array('class' => 'normal  js-upload-form {"redirecturl":"'. Router::url(array('controller' => 'stores', 'action' => 'index') , true) .'"}"','enctype' => 'multipart/form-data')); ?>
		<fieldset>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('name',array('label'=> __l('Name')));
				$this->request->data['Store']['url'] = str_replace('http://', '', $this->request->data['Store']['url']);
				$this->request->data['Store']['url'] = str_replace('www.', '', $this->request->data['Store']['url']);
				$this->request->data['Store']['url'] = 'http://www.' . $this->request->data['Store']['url'];
				echo $this->Form->input('url', array('help' => __l('e.g., http://www.example.com'), 'label' => __l('Store URL')));
				echo $this->Form->input('description',array('label'=>__l('Description'), 'type' => 'textarea'));
				echo $this->Form->input('meta_keywords',array('label'=> __l('Meta Keywords')));
				echo $this->Form->input('meta_description',array('label'=> __l('Meta Description'), 'type' => 'textarea'));
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
				echo $this->Form->input('zip_code',array('label' => __l('Zipcode'), 'id' => 'StoreZipcode','help'=>__l('Note: zip code required for site address search and google map')));
				echo $this->Form->input('store_status_id',array('label' => __l('Status')));
				echo $this->Form->input('rank', array('label' => __l('Rank'),'help'=>__l('Note: Low rank will affect the coupon listing weightage'),'options'=>$rank));
				echo $this->Form->input('is_partner', array('label' => __l('Partner')));
				echo $this->Form->input('Attachment.id', array('type' => 'hidden'));
				echo $this->Form->input('Attachment.filename', array('type' => 'file', 'label' => __l('File')));
			?>
		</fieldset>
	<div class="submit-block clearfix">
		<?php echo $this->Form->submit(__l('Update'));?>
	</div>
	<?php echo $this->Form->end();?>
</div>