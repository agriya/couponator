<?php
  echo $this->requestAction(array('controller' => 'coupons', 'action' => 'index','type' => 'home', 'limit' =>20 ), array('return'));
?>