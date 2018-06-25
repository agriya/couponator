<?php
    echo $this->requestAction(array('controller' => 'coupons', 'action' => 'add','type'=>$type, 'limit' =>Configure::read('coupon.top_coupons_limit')), array('return'));
?>