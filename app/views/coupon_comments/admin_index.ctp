<?php /* SVN: $Id: admin_index.ctp 632 2009-12-01 08:01:06Z annamalai_034ac09 $ */ ?>
<div class="couponComments index js-response">
     <div class="page-count-block clearfix">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
    <div class="grid_left">
        <?php echo $this->Form->create('CouponComment' , array('class' => 'normal search-form','action' => 'index')); ?>
    	<div class="filter-section clearfix">
    			<?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
    			<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
	</div>
	</div>
	<?php echo $this->Form->create('CouponComment' , array('class' => 'normal','action' => 'update')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
	<table class="list">
		<tr>
			<th class="dc"><?php echo __l('Select'); ?></th>
			<th class="actions dc"><?php echo __l('Actions');?></th>
			<th class="dc"><div class=""><?php echo $this->Paginator->sort('created');?></div></th>
			<th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Coupon Description'), 'Coupon.description');?></div></th>
			<th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></div></th>
			<th class="dl"><?php echo $this->Paginator->sort(__l('Store'), 'Store.name');?></th>
			<th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Comment'), 'comment');?></div></th>
			<th><?php echo __l('IP');?></th>
		</tr>
		<?php
			if (!empty($couponComments)):
				$i = 0;
				foreach ($couponComments as $couponComment):
					$class = null;
					if ($i++ % 2 == 0) {
						$class = ' class="altrow"';
					}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Form->input('CouponComment.'.$couponComment['CouponComment']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$couponComment['CouponComment']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
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
                                <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $couponComment['CouponComment']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
				            </li>
						 </ul>
						</div>
						<div class="action-bottom-block"></div>
					  </div>
					 </div>
            </td>
			<td class="dc"><?php echo $this->Html->cDateTime($couponComment['CouponComment']['created']);?></td>
			<td class="dl">
				<div class="js-truncate"><?php echo $couponComment['Coupon']['description'];?></div>
			</td>
			<td class="dl">				
				<?php echo !empty($couponComment['User']['username']) ? $this->Html->link($this->Html->cText($couponComment['User']['username']), array('controller' => 'users', 'action' => 'view', $couponComment['User']['username'], 'admin' => false), array('escape' => false)) : __l('Guest');?>
			</td>
			<td class="dl"><?php echo $this->Html->link($this->Html->cText($couponComment['Coupon']['Store']['name']), array('controller' => 'stores', 'action' => 'view', $couponComment['Coupon']['Store']['slug'], 'admin' => false), array('escape' => false));?></td>
			<td class="dl">				
				<div class="js-truncate"><?php echo $couponComment['CouponComment']['comment'];?></div>
			</td>
			<td class="dl">
				<?php if(!empty($couponComment['Ip']['ip'])): ?>
					<?php echo  $this->Html->link($couponComment['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $couponComment['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois '.$couponComment['Ip']['host'], 'escape' => false)); ?>
					<p>
						<?php if(!empty($couponComment['Ip']['Country'])): ?>
							<span class="flags flag-<?php echo strtolower($couponComment['Ip']['Country']['iso2']); ?>" title ="<?php echo $couponComment['Ip']['Country']['name']; ?>"><?php echo $couponComment['Ip']['Country']['name']; ?></span>
						<?php endif; ?>
						<?php if(!empty($couponComment['Ip']['City'])): ?>
							<span><?php echo $couponComment['Ip']['City']['name']; ?></span>
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
			<td colspan="14" class="notice"><?php echo __l('No Coupon Comments available');?></td>
		</tr>
		<?php
			endif;
		?>
	</table>
	<?php if (!empty($couponComments)) : ?>
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
	<?php endif; ?>
	<?php echo $this->Form->end(); ?>
</div>