<?php /* SVN: $Id: $ */ ?>
<div class="searchLogs index js-response">
    <div class="page-count-block clearfix">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
    <div class="grid_left">
            <?php echo $this->Form->create('SearchLog', array('class' => 'normal search-form', 'action'=>'index')); ?>
    	<div class="filter-section clearfix">
    			<?php echo $this->Form->input('q', array('label' => __l('Keyword'))); ?>
    			<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
	</div>
	</div>

	<?php echo $this->Form->create('SearchLog', array('class' => 'normal', 'action'=>'update'));
	echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url));
	?>
<div class="overflow-block">
<table class="list">
    <tr>
        <th><?php echo __l('Select');?></th>
        <th class="actions"><?php echo __l('Actions');?></th>
        <th><?php echo $this->Paginator->sort(__l('Added On'), 'created');?></th>
        <th class="dl"><?php echo $this->Paginator->sort('search_keyword_id');?></th>
    	<th class="dl"><?php echo __l('IP');?></th>
	</tr>
<?php
if (!empty($searchLogs)):

$i = 0;
foreach ($searchLogs as $searchLog):


	$class = null;
	$status_class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
    <td><?php echo $this->Form->input('SearchLog.'.$searchLog['SearchLog']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$searchLog['SearchLog']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>
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
                            <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $searchLog['SearchLog']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
			            </li>
					 </ul>
					</div>
					<div class="action-bottom-block"></div>
				  </div>
				 </div>
        </td>
		<td class="dc"><?php echo $this->Time->timeAgoInWords($searchLog['SearchLog']['created']);?></td>
		<td class="dl"><?php echo $this->Html->cText($searchLog['SearchKeyword']['keyword']);?></td>
		<td class="dl">
			<?php if(!empty($searchLog['Ip']['ip'])): ?>
				<?php echo  $this->Html->link($searchLog['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $searchLog['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois '.$searchLog['Ip']['host'], 'escape' => false)); ?>
				<p>
					<?php if(!empty($searchLog['Ip']['Country'])): ?>
						<span class="flags flag-<?php echo strtolower($searchLog['Ip']['Country']['iso2']); ?>" title ="<?php echo $searchLog['Ip']['Country']['name']; ?>"><?php echo $searchLog['Ip']['Country']['name']; ?></span>
					<?php endif; ?>
					<?php if(!empty($searchLog['Ip']['City'])): ?>
						<span><?php echo $searchLog['Ip']['City']['name']; ?></span>
					<?php endif; ?>
				</p>
			<?php else: ?>
				<?php echo __l('N/A'); ?>
			<?php endif; ?>
		</td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="10" class="notice"><?php echo __l('No Search Logs available');?></td>
	</tr>
<?php
endif;
?>
</table>
</div>

<?php
if (!empty($searchLogs)) {
   ?>
    <div class="clearfix">
    <div class="admin-select-block grid_left">
        <div>
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
    		</div>
        <div class="admin-checkbox-button">
            <?php echo $this->Form->input('more_action_id', array('options' => $moreActions, 'class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
        </div>
        </div>
        <div class="grid_right">
             <?php  echo $this->element('paging_links'); ?>
         </div>
         </div>
<?php
}
echo $this->Form->end();
?>
</div>
