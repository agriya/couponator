<?php
	if (!empty($tag)):
		echo $this->requestAction(array('controller' => 'stores', 'action' => 'index', 'tag' => $tag, 'type' => 'top'), array('return'));
	else:
		echo $this->requestAction(array('controller' => 'stores', 'action' => 'index', 'zipcode' => $zipcode), array('return'));
	endif; 
?>