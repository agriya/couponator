<?php 
if(!empty($vote)):
  echo $this->requestAction(array('controller' => 'coupons', 'action' => 'index','user_id' =>$user_id,'vote'=>$vote), array('return'));
  else:
    echo $this->requestAction(array('controller' => 'coupons', 'action' => 'index','user_id' =>$user_id), array('return'));
  endif; 
?>