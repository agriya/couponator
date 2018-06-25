<?php 
  echo $this->requestAction(array('controller' => 'stores', 'action' => 'index','view_name'=>'favorite','username'=>$username), array('return'));
?> 