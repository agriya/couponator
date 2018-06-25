	<?php
		echo $this->Form->input('store_id');
		echo $this->Form->input('name',array('label'=>'Name'));
		echo $this->Form->input('address',array('id' => 'VenueAddress','label'=>'Address'));
		echo $this->Form->input('zip_code',array('label'=>'Zipcode','id' => 'VenueZipcode'));
		echo $this->Form->autocomplete('City.name', array('label' => __l('City'), 'acFieldKey' => 'City.id', 'acFields' => array('City.name'), 'acSearchFieldNames' => array('City.name'), 'maxlength' => '255'));		
		echo $this->Form->autocomplete('State.name', array('label' => __l('State'), 'acFieldKey' => 'State.id', 'acFields' => array('State.name'), 'acSearchFieldNames' => array('State.name'), 'maxlength' => '255'));
    	echo $this->Form->input('country_id',array('label'=>'Country'));
	?>
	<fieldset class="form-block round-5">
			<legend class="round-5"><?php echo __l('Locate yourself on google maps'); ?></legend>
			<div class="show-map" style="">
			 <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo Configure::read('GoogleMap.api_key'); ?>"   type="text/javascript"></script>
			<div id="js-map"></div>
			</div>
			<?php
			echo $this->Form->input('latitude',array('type' => 'hidden', 'id'=>'latitude'));
			echo $this->Form->input('longitude',array('type' => 'hidden', 'id'=>'longitude'));
			?>
	</fieldset>