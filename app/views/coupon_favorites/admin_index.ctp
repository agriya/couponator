<?php /* SVN: $Id: $ */ ?>
<div class="couponFavorites index js-response">
	<div class="page-count-block clearfix">
		 <div class="grid_left">
			<?php echo $this->element('paging_counter');?>
		 </div>
		<div class="grid_left">
			<?php echo $this->Form->create('CouponFavorite' , array('class' => 'normal search-form','action' => 'index')); ?>
			<div class="filter-section clearfix">
					<?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
					<?php echo $this->Form->submit(__l('Search'));?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	<?php echo $this->Form->create('CouponFavorite' , array('class' => 'normal', 'action' => 'update')); ?>
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
			if (!empty($couponFavorites)):
				$i = 0;
				foreach ($couponFavorites as $couponFavorite):
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
		?>
			<tr<?php echo $class;?>>
				<td><?php echo $this->Form->input('CouponFavorite.'.$couponFavorite['CouponFavorite']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$couponFavorite['CouponFavorite']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>

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
                                        <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $couponFavorite['CouponFavorite']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
						            </li>
        						 </ul>
        						</div>
        						<div class="action-bottom-block"></div>
							  </div>
							 </div>
                    </td>
				<td class="dc"><?php echo $this->Html->cDateTime($couponFavorite['CouponFavorite']['created']);?></td>
				<td class="dl">
					<?php echo !empty($couponFavorite['User']['username']) ? $this->Html->link($this->Html->cText($couponFavorite['User']['username']), array('controller' => 'users', 'action' => 'view', $couponFavorite['User']['username'], 'admin' => false), array('escape' => false)) : __l('Guest');?>
				</td>
				<td class="dl"><?php echo $this->Html->link($this->Html->cText($couponFavorite['Coupon']['Store']['name']), array('controller' => 'stores', 'action' => 'view', $couponFavorite['Coupon']['Store']['slug'], 'admin' => false), array('escape' => false));?></td>
				<td class="dl"><div class="js-truncate"><?php echo $this->Html->cText($couponFavorite['Coupon']['description']);?></div></td>
				<td class="dl">
					<?php if(!empty($couponFavorite['Ip']['ip'])): ?>
						<?php echo  $this->Html->link($couponFavorite['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $couponFavorite['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois '.$couponFavorite['Ip']['host'], 'escape' => false)); ?>
						<p>
							<?php if(!empty($couponFavorite['Ip']['Country'])): ?>
								<span class="flags flag-<?php echo strtolower($couponFavorite['Ip']['Country']['iso2']); ?>" title ="<?php echo $couponFavorite['Ip']['Country']['name']; ?>"><?php echo $couponFavorite['Ip']['Country']['name']; ?></span>
							<?php endif; ?>
							<?php if(!empty($couponFavorite['Ip']['City'])): ?>
								<span><?php echo $couponFavorite['Ip']['City']['name']; ?></span>
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
				<td colspan="12" class="notice"><?php echo __l('No Coupon Favorites available');?></td>
			</tr>
		<?php
			endif;
		?>
	</table>
	<?php if (!empty($couponFavorites)) : ?>
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
				<div class="hide">
			<?php echo $this->Form->submit('Submit');  ?>
		</div>
		</div>
	
		<div class=" grid_right">
			<?php echo $this->element('paging_links'); ?>
		</div>
		</div>
	<?php endif; ?>
	<?php echo $this->Form->end(); ?>
</div>