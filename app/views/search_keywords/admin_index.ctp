<?php /* SVN: $Id: $ */ ?>
<div class="searchKeywords index js-response">
   <div class="page-count-block clearfix">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
    <div class="grid_left">
            <?php echo $this->Form->create('SearchKeyword', array('class' => 'normal search-form', 'action'=>'index')); ?>
    	<div class="filter-section clearfix">
    			<?php echo $this->Form->input('q', array('label' => __l('Keyword'))); ?>
    			<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
	</div>
	</div>
	<?php echo $this->Form->create('SearchKeyword', array('class' => 'normal', 'action'=>'update')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<div class="overflow-block">
<table class="list">
    <tr>
        <th ><?php echo __l('Select');?></th>
        <th class="actions"><?php echo __l('Actions');?></th>
        <th><?php echo $this->Paginator->sort(__l('Added On'), 'created');?></th>
        <th class="dl"><?php echo $this->Paginator->sort('keyword');?></th>
        <th><?php echo $this->Paginator->sort(__l('Searched Count'), 'search_log_count');?></th>
    </tr>
<?php
if (!empty($searchKeywords)):

$i = 0;
foreach ($searchKeywords as $searchKeyword):
	$class = null;
	$status_class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
    <td><?php echo $this->Form->input('SearchKeyword.'.$searchKeyword['SearchKeyword']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$searchKeyword['SearchKeyword']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>


                    <td class="actions">
                        <div class="action-block">
                        <span class="action-information-block">
                            <span class="action-left-block">&nbsp;&nbsp;</span>
                                <span class="action-center-block">
                                    <span class="action-info">
                                        <?php echo __l('Action');?>
                                     </span>
                                </span>
                            </span>
                            <div class="action-inner-block">
                            <div class="action-inner-left-block">
                                <ul class="action-link clearfix">
                                    <li>
                                        <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $searchKeyword['SearchKeyword']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
						            </li>
        						 </ul>
        						</div>
        						<div class="action-bottom-block"></div>
							  </div>
							 </div>
                    </td>
		<td class="dc"><?php echo $this->Html->cDateTime($searchKeyword['SearchKeyword']['created']); ?></td>
		<td class="dl"><?php echo $this->Html->cText($searchKeyword['SearchKeyword']['keyword']);?></td>
		<td class="dc"><?php echo $this->Html->cInt($searchKeyword['SearchKeyword']['search_log_count']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="6" class="notice"><?php echo __l('No Search Keywords available');?></td>
	</tr>
<?php
endif;
?>
</table>
</div>

<?php
if (!empty($searchKeywords)) {
    echo $this->element('paging_links');?>
    <div class="admin-select-block">
<div>
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
    		</div>
        <div class="admin-checkbox-button">
            <?php echo $this->Form->input('more_action_id', array( 'options' => $moreActions, 'class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
        </div></div>
<?php
}
echo $this->Form->end();
?>
</div>
