<?php 
if(!empty($this->request->params['named']['city_name'])){
	$cityslug = $this->request->params['named']['city_name'];
}elseif(!empty($city_slug)){
	$cityslug = $city_slug;
}else{
$cityslug = 'All';
}

echo $this->requestAction(array('controller' => 'cities', 'action' => 'index'), array('named' => array('admin' => false, 'city' =>$cityslug), 'return')); ?>