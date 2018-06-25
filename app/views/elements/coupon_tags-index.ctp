<?php
if(!empty($q)):
    echo $this->requestAction(array('controller' => 'coupon_tags', 'action' => 'index', 'q' => $q), array('return'));
else:
    echo $this->requestAction(array('controller' => 'coupon_tags', 'action' => 'index'), array('return'));
endif; 
?>