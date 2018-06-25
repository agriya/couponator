<?php
    echo $this->requestAction(array('controller' => 'coupons', 'action' => 'lst', 'type' => 'home', 'limit' => Configure::read('coupon.top_coupons_limit')), array('return'));
?>