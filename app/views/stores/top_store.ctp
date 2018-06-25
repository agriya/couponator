<div class="inner">
<div class="break"></div>
<div class="merchantTopCoupon">
<?php
if (!empty($stores)):
$i = 0;
foreach ($stores as $store): 
?>
<div class="inner">
 <?php echo $this->Html->link($this->Html->showImage('Store', $store['Attachment'], array('dimension' => 'normal_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($store['Store']['name'], false)), 'title' => $this->Html->cText($store['Store']['name'], false))), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false));?>
  <p>
 <?php   echo $this->Html->link($this->Html->cText($store['Coupon'][0]['title']), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false));   ?>
     <?php echo  $this->Html->cText($store['Coupon'][0]['description']) ;?>                  </p>
  <div class="break"></div>
</div>

<?php 
	endforeach;
	endif;
?>
</div>
</div>

 