<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>

<div class="responses js-response">
  <div class="stores index">
    <h2><?php echo __l('stores');?></h2>
    <?php echo $this->element('paging_counter');?>
    <ol class="list" start="<?php echo $this->Paginator->counter(array(
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
      <li<?php echo $class;?>>
        <p> <?php echo $this->Html->link($this->Html->showImage('Store', $store['Attachment'], array('dimension' => 'normal_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($store['Store']['name'], false)), 'title' => $this->Html->cText($store['Store']['name'], false))), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug']), array('escape' => false));?> </p>
        <p><?php echo $this->Html->cText($store['Store']['name']);?></p>
        <p><?php echo $this->Html->cText($store['Store']['url']);?></p>
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
    <div class="js-pagination">
      <?php
if (!empty($stores)) {
    echo $this->element('paging_links');
}
?>
    </div>
  </div>
</div>
