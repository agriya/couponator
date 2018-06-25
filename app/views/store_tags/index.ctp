<?php /* SVN: $Id: index.ctp 1245 2009-12-23 13:56:58Z arivuchelvan_086at09 $ */ ?>
 <h2><?php echo __l('Similar Discounts');?></h2>
<div class="view-discount-inner view-discount-inner1 offer-inner">

               <ul class="discount-list clearfix">
<?php
//1. Need to set the config variables for min, max tag class, no of tags
//2. Need to give the links for tags
//3. Need to add more link if necessary
if (!empty($tag_arr)) {
	$min_tag_classes = 1;
	$max_tag_classes = 6;
	// set min max count
	$max_qty 	=	($tag_arr) ? max(array_values($tag_arr)) : 0;
	$min_qty 	= 	($tag_arr) ? min(array_values($tag_arr)) : 0;
	// Find spread range and  Set step size
	$spread 	=	$max_qty - $min_qty;
	$spread		=	(0 == $spread) ? 1 : $spread;
	$step		=	($max_tag_classes - $min_tag_classes) / ($spread);
	// Sort tag by name
	ksort($tag_arr);
	// print tags clouds
	foreach ($tag_arr AS $key => $value)
		{
			$size = ceil($min_tag_classes + (($value - $min_qty) * $step)); ?>
			<li>
<?php            echo $this->Html->link($tag_name_arr[$key].' ', array('controller'=> 'stores', 'action'=> 'index', 'tag'=>$key),array('class'=>'tag'.$size)); ?>
</li>
<?php		}
	}else{
?>
	<li class="notice"><?php echo __l('Sorry, no tags found');?></li>
<?php
	}
?>
</ul>	
<ul class="shipping-list clearfix"> 
<?php  
	if (!empty($similarstores)):
	$i = 0;
	foreach ($similarstores  as $store):	 
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}		 
?> 
<li class="clearfix">
 <div class="discount-image-left"><?php echo $this->Html->link($this->Html->showImage('Store', $store['Attachment'], array('dimension' => 'store_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($store['Store']['name'], false)), 'title' => $this->Html->cText($store['Store']['name'], false))), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false));?> </div>
	<div class="discount-info-block">	
	<h3>
		<?php
		echo $this->Html->link($store['Store']['name'], array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false));
		?>	
	</h3>
		 <p>
		 <span class="js-desc-to-trucate"><?php echo $this->Html->cText($store['Coupon'][0]['description']);?></span>				 
		</p>
</div>
</li>
<?php
    endforeach;
else:
?>
<li class="notice">
	<p><?php echo __l('No stores available');?></p>
</li>
<?php
endif;
?>
</ul>
</div>
            
