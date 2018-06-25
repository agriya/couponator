<?php /* SVN: $Id: $ */ ?>
<div class="couponImpressions index js-response">
	<div class="page-count-block clearfix">
		 <div class="grid_left">
			<?php echo $this->element('paging_counter');?>
		 </div>
		<div class="grid_left">
			<?php echo $this->Form->create('CouponImpression' , array('class' => 'normal search-form','action' => 'index')); ?>
			<div class="filter-section clearfix">
					<?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
					<?php echo $this->Form->submit(__l('Search'));?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	<?php echo $this->Form->create('CouponImpression' , array('class' => 'normal', 'action' => 'update')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
	<table class="list">
		<tr>
			<th class="dc"><?php echo __l('Select'); ?></th>
			<th class="actions dc"><?php echo __l('Actions');?></th>
			<th class="dc"><?php echo $this->Paginator->sort(__l('Created'), 'created');?></th>
			<th class="dl"><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></th>
			<th class="dl"><?php echo $this->Paginator->sort(__l('Store'), 'Store.name');?></th>
			<th class="dl"><?php echo $this->Paginator->sort(__l('Coupon Description'), 'Coupon.description');?></th>
			<th class="dl"><?php echo __l('IP');?></th>
		</tr>
	<?php
	if (!empty($couponImpressions)):
	$i = 0;
	foreach ($couponImpressions as $couponImpression):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Form->input('CouponImpression.'.$couponImpression['CouponImpression']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$couponImpression['CouponImpression']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
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
                                        <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $couponImpression['CouponImpression']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
						            </li>
        						 </ul>
        						</div>
        						<div class="action-bottom-block"></div>
							  </div>
							 </div>
                    </td>
			<td class="dc"><?php echo $this->Html->cDateTime($couponImpression['CouponImpression']['created']);?></td>
			<td class="dl">				
				<?php echo !empty($couponImpression['User']['username']) ? $this->Html->link($this->Html->cText($couponImpression['User']['username']), array('controller' => 'users', 'action' => 'view', $couponImpression['User']['username'], 'admin' => false), array('escape' => false)) : __l('Guest');?>
			</td>
			<td class="dl"><?php echo $this->Html->link($this->Html->cText($couponImpression['Store']['name']), array('controller' => 'stores', 'action' => 'view', $couponImpression['Store']['slug'], 'admin' => false), array('escape' => false));?></td>
			<td class="dl"><div class="js-truncate"><?php echo $this->Html->cText($couponImpression['Coupon']['description']);?></div></td>
			<td class="dl">
				<?php if(!empty($couponImpression['Ip']['ip'])): ?>
					<?php echo  $this->Html->link($couponImpression['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $couponImpression['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois '.$couponImpression['Ip']['host'], 'escape' => false)); ?>
					<p>
						<?php if(!empty($couponImpression['Ip']['Country'])): ?>
							<span class="flags flag-<?php echo strtolower($couponImpression['Ip']['Country']['iso2']); ?>" title ="<?php echo $couponImpression['Ip']['Country']['name']; ?>"><?php echo $couponImpression['Ip']['Country']['name']; ?></span>
						<?php endif; ?>
						<?php if(!empty($couponImpression['Ip']['City'])): ?>
							<span><?php echo $couponImpression['Ip']['City']['name']; ?></span>
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
			<td colspan="15" class="notice"><?php echo __l('No Coupon Impressions available');?></td>
		</tr>
	<?php
	endif;
	?>
	</table>
	<?php if (!empty($couponImpression)) : ?>
       <div class="clearfix">
		<div class="admin-select-block clearfix grid_left">
			<div>
				<?php echo __l('Select:'); ?>
				<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
				<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
			</div>
			<div class="admin-checkbox-button">
				<?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
			</div>
		</div>
		<div class="hide grid_left">
			<?php echo $this->Form->submit('Submit');  ?>
		</div>
		<div class=" grid_right">
			<?php echo $this->element('paging_links'); ?>
		</div>
		</div>
	<?php endif; ?>
	<?php echo $this->Form->end(); ?>
</div>