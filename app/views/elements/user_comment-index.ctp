<?php
echo $this->requestAction(array('controller' => 'user_comments', 'action' => 'index', 'user_id' => $user_id), array('return'));
?>