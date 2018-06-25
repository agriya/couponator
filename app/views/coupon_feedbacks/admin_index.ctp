<?php /* SVN: $Id: $ */ ?>
<div class="couponFeedbacks index js-response">
<div class="clearfix">

    <div class="page-count-block clearfix grid_left">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
    <div class="grid_left">
    <?php echo $this->Form->create('CouponFeedback', array('class' => 'normal search-form', 'action'=>'index')); ?>
    	<div class="filter-section clearfix">
            <?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
    		<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
	</div>
	</div>
    </div>
<table class="list">
    <tr>
        <th class="actions dc"><?php echo __l('Actions');?></th>
        <th class="dc"><?php echo $this->Paginator->sort(__l('Created'), 'created');?></th>
        <th class="dl"><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></th>
        <th class="dl"><?php echo $this->Paginator->sort(__l('Store'), 'Store.name');?></th>
        <th class="dl"><?php echo $this->Paginator->sort(__l('Coupon'), 'Coupon.description');?></th>
        <th class="dl"><?php echo $this->Paginator->sort(__l('Purchased'), 'purchased');?></th>
        <th class="dr"><?php echo $this->Paginator->sort(__l('Purchased Price') . ' (' . Configure::read('site.currency') . ')', 'purchased_price');?></th>
		<th class="dl"><?php echo __l('IP');?></th>
	</tr>
<?php
if (!empty($couponFeedbacks)):

$i = 0;
foreach ($couponFeedbacks as $couponFeedback):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
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
                                        <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $couponFeedback['CouponFeedback']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
						            </li>
        						 </ul>
        						</div>
        						<div class="action-bottom-block"></div>
							  </div>
							 </div>
                    </td>
		
		<td class="dc"><?php echo $this->Html->cDateTime($couponFeedback['CouponFeedback']['created']);?></td>
		<td class="dl"><?php echo !empty($couponFeedback['User']['username']) ? $this->Html->link($this->Html->cText($couponFeedback['User']['username']), array('controller' => 'users', 'action' => 'view', $couponFeedback['User']['username'], 'admin' => false), array('escape' => false)) : __l('Guest');?></td>
		<td class="dl"><?php echo $this->Html->link($this->Html->cText($couponFeedback['Coupon']['Store']['name']), array('controller' => 'stores', 'action' => 'view', $couponFeedback['Coupon']['Store']['slug'], 'admin' => false), array('escape' => false));?></td>
		<td class="dl"><div class="js-truncate"><?php echo $this->Html->cText($couponFeedback['Coupon']['description']);?></div></td>
		<td class="dl"><?php echo $this->Html->cText($couponFeedback['CouponFeedback']['purchased']);?></td>
		<td class="dr"><?php echo $this->Html->cFloat($couponFeedback['CouponFeedback']['purchased_price']);?></td>
		<td class="dl">
			<?php if(!empty($couponFeedback['Ip']['ip'])): ?>
				<?php echo  $this->Html->link($couponFeedback['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $couponFeedback['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois '.$couponFeedback['Ip']['host'], 'escape' => false)); ?>
				<p>
					<?php if(!empty($couponFeedback['Ip']['Country'])): ?>
						<span class="flags flag-<?php echo strtolower($couponFeedback['Ip']['Country']['iso2']); ?>" title ="<?php echo $couponFeedback['Ip']['Country']['name']; ?>"><?php echo $couponFeedback['Ip']['Country']['name']; ?></span>
					<?php endif; ?>
					<?php if(!empty($couponFeedback['Ip']['City'])): ?>
						<span><?php echo $couponFeedback['Ip']['City']['name']; ?></span>
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
		<td colspan="18" class="notice"><?php echo __l('No Coupon Feedbacks available');?></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($couponFeedbacks)) {
    echo $this->element('paging_links');
}
?>
</div>
