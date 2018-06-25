<?php 
  echo $this->requestAction(array('controller' => 'users', 'action' => 'index','user' => 'shared','type' => $type, 'limit' =>20), array('return'));
?>