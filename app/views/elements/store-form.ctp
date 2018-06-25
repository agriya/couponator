	<?php
		echo $this->Form->input('name',array('label'=>'Name'));
		echo $this->Form->input('url', array('help' => __l('e.g., http://www.example.com'), 'label' => __l('Store URL')));
		echo $this->Form->input('description',array('label'=>'Description'));
		echo $this->Form->input('meta_keywords',array('label'=>'Meta Keywords'));
		echo $this->Form->input('meta_description',array('label'=>'Meta Description'));
		echo $this->Form->input('address',array('id' => 'VenueAddress','label'=>'Address'));
		echo $this->Form->input('zip_code',array('label'=>'Zipcode','id' => 'VenueZipcode'));
		echo $this->Form->input('city_id',array('label'=>'City'));
    	echo $this->Form->input('state_id',array('label'=>'State'));
    	echo $this->Form->input('country_id',array('label'=>'Country'));
    	echo $this->Form->input('latitude',array('type'=>'hidden','id'=>'latitude'));
    	echo $this->Form->input('longitude',array('type'=>'hidden','id'=>'longitude'));
       	echo $this->Form->input('store_status_id',array('label'=>'Status'));
       	echo $this->Form->input('is_online',array('label'=>'Online'));
		echo $this->Form->input('UserStore.filename', array('type' => 'file','size' => '33', 'label' => 'Upload Image','class' =>'browse-field'));
	?>