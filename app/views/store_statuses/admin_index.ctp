<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="storeStatuses index">
<h2><?php echo __l('Store Statuses');?></h2>
<?php echo $this->element('paging_counter');?>
 <table class="list">
        <tr>
            <th><?php echo __l('Actions');?></th>
            <th><div class=""><?php echo $this->Paginator->sort(__l('Name'), 'name');?></div></th>
        </tr>
   
<?php
if (!empty($storeStatuses)):

$i = 0;
foreach ($storeStatuses as $storeStatus):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td><div><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $storeStatus['StoreStatus']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></div></td>
		<td><?php echo $this->Html->cText($storeStatus['StoreStatus']['name']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td><p class="notice"><?php echo __l('No Store Statuses available');?></p></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($storeStatuses)) {
    echo $this->element('paging_links');
}
?>
</div>
