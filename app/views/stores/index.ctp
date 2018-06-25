<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>

<div class="responses js-response js-responses">
  <div class="stores index">
  <div class="clearfix">
  <div class="store-left">
  <div class="store-right">
    <div class="store-center coupon-center">
  <?php if(isset($search)): 
	if($search=='yes'):
  ?>
	 <h2><?php echo $keyword. __l(' Search Results');?></h2>
<?php endif; 
  else:
?>
    <h2><?php echo __l('Stores');?></h2>
 <?php endif; ?>
    <ol class="list clearfix" start="<?php echo $this->Paginator->counter(array(
    'format' => '%start%'
));?>">
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
        <?php echo $this->Html->link($this->Html->showImage('Store', !empty($store['Attachment']) ? $store['Attachment'] : array(), array('dimension' => 'normal_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($store['Store']['name'], false)), 'title' => $this->Html->cText($store['Store']['name'], false))), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false));?>
        <p class="store-info"><?php echo $this->Text->truncate($store['Store']['url'], 15, array('ending' => '...')); ?></p>
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
    </ol>
    <?php
if (!empty($stores)) {
	 if(!isset($search)):
		echo $this->element('paging_links');
	endif;
}
?>
    </div>
    </div>
    </div>
      <div class="coupon-bottom"></div>
    </div>
  
    </div>
  </div>

