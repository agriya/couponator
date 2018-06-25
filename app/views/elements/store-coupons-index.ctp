<?php
    echo $this->requestAction(array('controller' => 'coupons', 'action' => 'index','view_name' => 'store_view', 'store_id'=> $store_id,'coupon_type'=>$coupon_type, 'limit' =>10 ), array('return'));
	 
?>