<h2><?php echo __l('List of All Stores'); ?></h2>

<?php
for($i = 65; $i< 91; $i++)
{
   echo $value= chr($i);
    echo $this->requestAction(array('controller' => 'stores', 'action' => 'index','type'=> $value), array('return'));
}
?>