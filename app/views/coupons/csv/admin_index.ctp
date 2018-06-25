<?php
$i = 0;
do {
	echo $i;
    $coupon->paginate = array(
        'conditions' => $conditions,
        'offset' => $i,
        'fields' => array(
            'Coupon.title',
            'Coupon.url',
            'Coupon.description',
            'Coupon.coupon_code',
            'Coupon.coupon_view_count',
            'Coupon.coupon_favorite_count',
            'Coupon.coupon_comment_count',
            'Coupon.coupon_rating_count',
		 //   'Store.name'
		 ),
		'order' => array(
			'Coupon.title' => 'asc'
		) ,
        'recursive' => 
    );
    if(!empty($q)){
        $user->paginate['search'] = $q;
    }
    $Coupons = $coupon->paginate();
    if (!empty($Coupons)) {
        $data = array();
        foreach($Coupons as $Coupon) {
	        $data[]['Coupon'] = array(
				__l('Name') => $Coupon['Coupon']['title'],
				__l('url') => $Coupon['Coupon']['url'],
				__l('Description') => $Coupon['Coupon']['description'],
				__l('Coupon Code') => $Coupon['Coupon']['coupon_code'] ,
				__l('Coupon View Count') => $Coupon['Coupon']['coupon_view_count'] ,
				__l('Coupon Favorite Count') => $Coupon['Coupon']['coupon_favorite_count'] ,
				__l('Coupon Comment Count') => $Coupon['Coupon']['coupon_comment_count'] ,
				__l('Coupon Rating Count') => $Coupon['Coupon']['coupon_rating_count'] ,
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
while (!empty($Coupons));
echo $this->Csv->render(true);
?>