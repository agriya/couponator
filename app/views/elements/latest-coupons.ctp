<?php 
  echo $this->requestAction(array('controller' => 'coupons', 'action' => 'lst', 'type' => 'latest_contribution', 'limit' => 5), array('return'));
?>