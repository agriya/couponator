<?php
if(!empty($where)):
  echo $this->requestAction(array('controller' => 'coupons', 'action' => 'index','where' => $where,'view_map'=>'compact','limit' =>20), array('return'));
  elseif(!empty($what)):
  echo $this->requestAction(array('controller' => 'coupons', 'action' => 'index','what' => $what, 'view_map'=>'compact','limit' =>20), array('return'));
endif; 
?>