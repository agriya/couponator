<?php /* SVN: $Id: index_lst.ctp 894 2009-12-04 11:07:24Z annamalai_034ac09 $ */ ?>
<div class="coupons index">
<h2><?php echo __l('List of All Coupons'); ?></h2>
<ol class="list">
<?php
if (!empty($coupon)):
$i = 0;
 $j=48;
echo __l('0 - 9 ');  
foreach ($coupon as $key => $coupon):
$j++;
  foreach ($coupon as $coupon_name):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
	    <p>
	    <?php echo $this->Html->link($this->Html->cText($coupon_name['Coupon']['title'],false), array('controller' => 'coupons', 'action' => 'view',$coupon_name['Coupon']['slug']), 
	    array('title' => $coupon_name['Coupon']['title'])) ;?>
	  </p>
	</li>
<?php
    endforeach;
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No coupons available');?></p>
	</li>
<?php
endif;
?>
</ol>


<ol class="list">
<?php
if (!empty($coupons)):
$i = 0;
 $j=65;

foreach ($coupons as $key => $coupon):
echo $value= chr($j);  
$j++;
if (!empty($coupon)):
  foreach ($coupon as $coupon_name):
  
  
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
	    <p>
	    <?php echo $this->Html->link($this->Html->cText($coupon_name['Coupon']['title'],false), array('controller' => 'coupons', 'action' => 'view',$coupon_name['Coupon']['slug']), 
	    array('title' => $coupon_name['Coupon']['title']));?>
	  </p>
	  </p>

		
	</li>
<?php
    endforeach;
   else:
   ?>
	<li>
		<p class="notice"><?php echo __l('No coupons available');?></p>
	</li>
<?php
   endif; 
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No coupons available');?></p>
	</li>
<?php
endif;
?>
</ol>

</div>
