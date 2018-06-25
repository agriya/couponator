<div class="view-discount-inner offer-inner js-response js-responses">          
 <h2>
	<?php 
		if(!empty($this->request->params['named']['type']) && $this->request->params['named']['type']=='recent-visit'){
			echo __l('Recently visited stores');
		}else{
			echo __l('stores');
		}
	?>
</h2>  
<ul class="shipping-list clearfix"> 
<?php
	if (!empty($stores)):
	$i = 0;
	foreach ($stores as $store):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
?> 
<li class="clearfix">
	 
	<?php
  		echo $this->Html->link($store['Store']['name'], array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false));
 	?>
 
 <p><?php echo $store['Store']['description']; ?></p><br>
 <p><?php echo $store['Store']['address']; ?> </p> 
 </li>
 
<?php
    endforeach;
else:
?>
<li>
	<p class="notice"><?php echo __l('No stores available');?></p>
</li>
<?php
endif;
?>
</ul>
</div>