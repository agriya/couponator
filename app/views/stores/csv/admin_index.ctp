<?php
$i = 0;
do {
    $store->paginate = array(
        'conditions' => $conditions,
        'offset' => $i,
        'fields' => array(
            'Store.name',
            'Store.url',
            'Store.city_id',
            'Store.state_id',
            'Store.country_id',
            'Store.address',
            'Store.zip_code',
			'City.name',
			'State.name',
			'Country.name',
		 ),
		'order' => array(
			'Store.name' => 'asc'
		) ,
        'recursive' => 0
    );
    if(!empty($q)){
        $user->paginate['search'] = $q;
    }
    $Stores = $store->paginate();
    if (!empty($Stores)) {
        $data = array();
        foreach($Stores as $Store) {
	        $data[]['Store'] = array(
				__l('Name') => $Store['Store']['name'],
				__l('url') => $Store['Store']['url'],
				__l('Address') => $Store['Store']['address'],
				__l('Zipcode') => $Store['Store']['zip_code'] ,
				__l('City') => $Store['City']['name'] ,
				__l('State') => $Store['State']['name'] ,
				__l('Country') => $Store['Country']['name'] ,
				);
        }
        if (!$i) {
            $this->Csv->addGrid($data);
        } else {
            $this->Csv->addGrid($data, false);
        }
    }
    $i+= 20;
}
while (!empty($Users));
echo $this->Csv->render(true);
?>