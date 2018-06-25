<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>

<div class="responses js-response">
 
<div class="stores index">
<h2><?php echo __l("Top "). $tag. __l(" Stores");?></h2>
 
<ol class="list">
<?php
if (!empty($stores)):
$i = 0;
foreach ($stores as $store):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
<li<?php echo $class;?>>
			<p>
	    	<?php echo $this->Html->link($store['Store']['name'], array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false));?>	
		</p>
	 
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
</ol>
 
</div>
</div>
