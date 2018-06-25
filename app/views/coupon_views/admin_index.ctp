<?php /* SVN: $Id: $ */ ?>
<div class="couponViews index js-response">
<h2><?php echo __l('Coupon Views');?></h2>
<?php echo $this->element('paging_counter');?>
<?php echo $this->Form->create('CouponView' , array('class' => 'normal','action' => 'update')); ?>
<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<table class="list">
    <tr>
        <th><?php echo __l('Select'); ?></th>
        <th class="actions"><?php echo __l('Actions');?></th>
        <th><?php echo $this->Paginator->sort('created');?></th>
        <th><?php echo $this->Paginator->sort('user_id');?></th>
        <th><?php echo $this->Paginator->sort('coupon_id');?></th>
        <th><?php echo $this->Paginator->sort('ip');?></th>
    </tr>
<?php
if (!empty($couponViews)):

$i = 0;
foreach ($couponViews as $couponView):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
	   	   	<td>
	<?php echo $this->Form->input('CouponView.'.$couponView['CouponView']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$couponView['CouponView']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
		<td class="actions"><span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $couponView['CouponView']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span></td>
		<td><?php echo $this->Html->cDateTime($couponView['CouponView']['created']);?></td>
		<td><?php echo $this->Html->link($this->Html->cText($couponView['User']['username']), array('controller'=> 'users', 'action'=>'view', $couponView['User']['username'],'admin'=> false), array('escape' => false));?></td>
		<td><?php echo $this->Html->link($this->Html->cText($couponView['Coupon']['title']), array('controller'=> 'coupons', 'action'=>'view', $couponView['Coupon']['slug'],'admin'=> false), array('escape' => false));?></td>
		<td><?php echo $this->Html->cText($couponView['CouponView']['ip']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="7" class="notice"><?php echo __l('No Coupon Views available');?></td>
	</tr>
<?php
endif;
?>
</table>

<?php
    if (!empty($couponViews)):
        ?>
        <div class="admin-select-block clearfix">
        <div>
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None'))); ?>
        </div>
    
        <div class="admin-checkbox-button">
            <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
        </div>
        </div>
            <div class="">
            <?php echo $this->element('paging_links'); ?>
        </div>
        <div class="hide">
            <?php echo $this->Form->submit('Submit');  ?>
        </div>
        <?php
    endif;
    echo $this->Form->end();
    ?>
</div>
