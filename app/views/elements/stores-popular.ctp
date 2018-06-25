<?php
    echo $this->requestAction(array('controller' => 'stores', 'action' => 'index','view_name' => 'popular', 'limit' => 15), array('return'));
?>