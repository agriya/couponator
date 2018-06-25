<?php /* SVN: $Id: admin_index.ctp 10981 2010-06-30 15:15:13Z aravindan_111act10 $ */ ?>
<div class="subscriptions index js-response js-responses">
    <div class="page-count-block clearfix">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
    <div class="grid_left">
            	<?php echo $this->Form->create('Subscription', array('class' => 'normal search-form clearfix', 'action' => 'index')); ?>
    	<div class="filter-section clearfix">
    			<?php echo $this->Form->input('q', array('label' => __l('Keyword'))); ?>
	           	<?php echo $this->Form->input('type', array('type' => 'hidden')); ?>
    			<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
	</div>
	</div>
    <ul class="filter-list clearfix">
		<li <?php if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'subscribed') { echo 'class="active"';} ?>>
			<span class="active" title="<?php echo __l('Subscribed Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($subscribed,false).'<span>' .__l('Subscribed Users'). '</span>', array('controller'=>'subscriptions','action'=>'index','type' => 'subscribed'), array('escape' => false));?></span> 
		</li>
		<li <?php if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'unsubscribed') { echo 'class="active"';} ?>>
			<span class="inactive" title="<?php echo __l('Unsubscribed Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($unsubscribed,false).'<span>' .__l('Unsubscribed Users'). '</span>', array('controller'=>'subscriptions','action'=>'index','type' => 'unsubscribed'), array('escape' => false));?></span> 
		</li>
		<li <?php if (empty($this->request->params['named']['type'])) { echo 'class="active"';} ?>>
			<span title="<?php echo __l('Total'); ?>"><?php echo $this->Html->link($this->Html->cInt($subscribed + $unsubscribed,false).'<span>' .__l('Total'). '</span>', array('controller'=>'subscriptions','action'=>'index'), array('escape' => false));?></span> 
		</li>
</ul>
	
	<?php echo $this->Form->create('Subscription' , array('class' => 'normal','action' => 'update')); ?>
		<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>

		<div class="overflow-block">
			<table class="list">
				<tr>
					<th><?php echo __l('Select'); ?></th>
					<th><?php echo __l('Action'); ?></th>
					<th><div class=""><?php echo $this->Paginator->sort(__l('Subscribed On'),'Subscription.created'); ?></div></th>
					<th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Email'),'Subscription.email'); ?></div></th>
					<th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Store'),'Store.name'); ?></div></th>					
				</tr>
				<?php
					if (!empty($subscriptions)):
						$i = 0;
						foreach ($subscriptions as $subscription):
							$class = null;
							$active_class = '';		
							if ($i++ % 2 == 0):
								$class = 'altrow';
							endif;
							if($subscription['Subscription']['is_subscribed']):
								$status_class = 'js-checkbox-active';
							else:
								$status_class = 'js-checkbox-inactive';
								$active_class = ' inactive-record';		
							endif;
							$online_class = 'offline';
							if (!empty($user['CkSession']['user_id'])) {
								$online_class = 'online';
							}
				?>
				<tr class="<?php echo $class.$active_class;?>">
					<td><?php echo $this->Form->input('Subscription.'.$subscription['Subscription']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$subscription['Subscription']['id'], 'label' => false, 'class' =>$status_class.' js-checkbox-list '. $online_class)); ?></td>

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
                                        <span><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $subscription['Subscription']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
						            </li>
        						 </ul>
        						</div>
        						<div class="action-bottom-block"></div>
							  </div>
							 </div>
                    </td>

                    <td><?php echo $this->Html->cDateTime($subscription['Subscription']['created']);?></td>
					<td class="dl"><?php echo $this->Html->cText($subscription['Subscription']['email']);?></td>
					<td class="dl"><?php echo $this->Html->link($this->Html->cText($subscription['Store']['name']), array('controller' => 'stores', 'action' => 'view', $subscription['Store']['slug'], 'admin' => false), array('escape' => false));?></td>					
				</tr>
			<?php
					endforeach;
				else:
			?>
			<tr>
				<td colspan="14" class="notice"><?php echo __l('No Subscriptions available');?></td>
			</tr>
			<?php
				endif;
			?>
		</table>
	</div>
	<?php if (!empty($subscriptions)): ?>
        <div class="clearfix">
		<div class="admin-select-block grid_left">
			<div>
				<?php echo __l('Select:'); ?>
				<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
				<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None'))); ?>
				<?php if(!isset($this->request->params['named']['type'])) { ?>
					<?php echo $this->Html->link(__l('Subscribed'), '#', array('class' => 'js-admin-select-approved', 'title' => __l('Subscribed'))); ?>
					<?php echo $this->Html->link(__l('Unsubscribed'), '#', array('class' => 'js-admin-select-pending', 'title' => __l('Unsubscribed'))); ?>
				<?php } ?>
			</div>
			<div class="admin-checkbox-button"><?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?></div>
		</div>
		<div class=" grid_right"> <?php echo $this->element('paging_links'); ?> </div>
		</div>
	<?php endif; ?>
	<?php echo $this->Form->end(); ?>
</div>