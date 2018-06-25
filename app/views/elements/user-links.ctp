<?php
echo $this->requestAction(array('controller' => 'users', 'action' => 'view', $this->Auth->user('username'),'user'=>'compact'), array('return'));
?>