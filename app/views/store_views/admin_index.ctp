<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="storeViews index js-response">

	<div class="page-count-block clearfix">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
    <div class="grid_left">
            <?php echo $this->Form->create('StoreView' , array('class' => 'normal search-form','action' => 'index')); ?>
    	<div class="filter-section clearfix">
    			<?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
    			<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
	</div>
	</div>
	<?php echo $this->Form->create('StoreView' , array('class' => 'normal','action' => 'update')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
	<table class="list">
		<tr>
			<th class="dc"><?php echo __l('Select'); ?></th>
			<th class="actions dc"><?php echo __l('Actions');?></th>
			<th class="dc"><div class=""><?php echo $this->Paginator->sort(__l('Created'), 'created');?></div></th>
			<th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Store'), 'Store.name');?></div></th>
            <th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></div></th>
			<th class="dl"><?php echo __l('IP');?></th>			
		</tr>
		<?php
			if (!empty($storeViews)):
				$i = 0;
				foreach ($storeViews as $storeView):
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Form->input('StoreView.'.$storeView['StoreView']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$storeView['StoreView']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
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
                                        <span><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $storeView['StoreView']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
						            </li>
        						 </ul>
        						</div>
        						<div class="action-bottom-block"></div>
							  </div>
							 </div>
                 </td>
            <td class="dc"><?php echo $this->Html->cDateTime($storeView['StoreView']['created']);?></td>
			<td class="dl"><?php echo $this->Html->link($this->Html->cText($storeView['Store']['name']), array('controller'=> 'stores', 'action' => 'view', $storeView['Store']['slug'],'admin'=>false), array('escape' => false));?></td>
			<td class="dl">
				<?php if(!empty($storeView['User']['username'])) { 
					echo $this->Html->getUserAvatar($storeView['User'], 'micro_thumb',false);
				}
				?>
				<?php echo !empty($storeView['User']['username']) ? $this->Html->link($this->Html->cText($storeView['User']['username']), array('controller'=> 'users', 'action' => 'view', $storeView['User']['username'],'admin'=>false), array('escape' => false)) : __l('Guest');?></td>
			<td class="dl">
				<?php if(!empty($storeView['Ip']['ip'])): ?>
					<?php echo  $this->Html->link($storeView['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $storeView['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois '.$storeView['Ip']['host'], 'escape' => false)); ?>
					<p>
						<?php if(!empty($storeView['Ip']['Country'])): ?>
							<span class="flags flag-<?php echo strtolower($storeView['Ip']['Country']['iso2']); ?>" title ="<?php echo $storeView['Ip']['Country']['name']; ?>"><?php echo $storeView['Ip']['Country']['name']; ?></span>
						<?php endif; ?>
						<?php if(!empty($storeView['Ip']['City'])): ?>
							<span><?php echo $storeView['Ip']['City']['name']; ?></span>
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
			<td colspan="12"><p class="notice"><?php echo __l('No Store Views available');?></p></td>
		</tr>
		<?php
			endif;
		?>
	</table>
	<?php if (!empty($storeViews)): ?>
	<div class="clearfix">
		<div class="admin-select-block grid_left">
			<div>
				<?php echo __l('Select:'); ?>
				<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
				<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None'))); ?>
			</div>
			<div class="admin-checkbox-button">
				<?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
			</div>
		</div>
		<div class="hide">
			<?php echo $this->Form->submit('Submit');  ?>
		</div>
		<div class=" grid_right">
			<?php echo $this->element('paging_links'); ?>
		</div>
		</div>
	<?php endif; ?>
	<?php echo $this->Form->end(); ?>
</div>