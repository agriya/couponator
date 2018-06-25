<?php /* SVN: $Id: admin_index.ctp 801 2009-07-25 13:22:35Z boopathi_026ac09 $ */ ?>
<div class="couponFlags index js-response">
    <?php if(empty($this->request->params['named']['simple_view'])) : ?>
      <div class="page-count-block clearfix">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
    <div class="grid_left">
     <?php if (!(isset($this->request->params['isAjax']) && $this->request->params['isAjax'] == 1)): ?>
        <?php echo $this->Form->create('CouponFlag' , array('class' => 'normal search-form','action' => 'index')); ?>
    	<div class="filter-section clearfix">
    			<?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
    			<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
    	   <?php endif; ?>
	</div>
	</div>

   <?php echo $this->Form->create('CouponFlag' , array('class' => 'normal','action' => 'update')); ?>
   <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<?php endif; ?>
 
   <div class="overflow-block">
    <table class="list">
        <tr>
            <?php if(empty($this->request->params['named']['simple_view'])) : ?>
                <th class="dc"><?php echo __l('Select'); ?></th>
            <?php endif; ?>
            <th class="actions dc"><?php echo __l('Actions');?></th>
            <th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Username'),'User.username');?></div></th>
            <th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Coupon'), 'Coupon.description');?></div></th>
            <th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Category'), 'CouponFlagCategory.name');?></div></th>
            <th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Message'),'message');?></div></th>
            <th class="dc"><div class=""><?php echo $this->Paginator->sort(__l('Posted on'), 'created');?></div></th>
			<th class="dl"><?php echo __l('IP');?></th>
		</tr>
        <?php
         if (!empty($couponFlags)):
            $i = 0;
            foreach ($couponFlags as $couponFlag):
                $class = null;
                if ($i++ % 2 == 0) :
                    $class = ' class="altrow"';
                endif;
                ?>
                <tr<?php echo $class;?>>
                    <?php if(empty($this->request->params['named']['simple_view'])) : ?>
                        <td><?php echo $this->Form->input('CouponFlag.'.$couponFlag['CouponFlag']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$couponFlag['CouponFlag']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
                    <?php endif; ?>
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
                                        <span><?php echo $this->Html->link(__l('Remove this flag'), array('action' => 'delete', $couponFlag['CouponFlag']['id']), array('class' => 'delete js-delete', 'title' => __l('Remove this flag')));?></span>
						            </li>
						            <li><span><?php echo $this->Html->link(__l('Delete Coupon'), array('action' => 'delete', $couponFlag['CouponFlag']['id'], 'coupon_id' => $couponFlag['Coupon']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete Coupon')));?></span></li>
        						 </ul>
        						</div>
        						<div class="action-bottom-block"></div>
							  </div>
							 </div>
                    </td>

                    
                    <td class="dl">						
						<?php echo !empty($couponFlag['User']['username']) ? $this->Html->link($this->Html->cText($couponFlag['User']['username']), array('controller' => 'users', 'action' => 'view', $couponFlag['User']['username'], 'admin' => false), array('escape' => false)) : __l('Guest');?>
                    </td>
                    <td class="dl">
						<div class="js-truncate"><?php echo $this->Html->cText($couponFlag['Coupon']['description']); ?></div>
                    </td>
                    <td class="dl"><?php echo $this->Html->cText($couponFlag['CouponFlagCategory']['name']);?></td>
                    <td class="dl"><div class="js-truncate"><?php echo $this->Html->Truncate($couponFlag['CouponFlag']['message']);?></div></td>                    
                    <td class="dc"><?php echo $this->Html->cDateTimeHighlight($couponFlag['CouponFlag']['created']);?></td>
					<td class="dl">
						<?php if(!empty($couponFlag['Ip']['ip'])): ?>
							<?php echo  $this->Html->link($couponFlag['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $couponFlag['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois '.$couponFlag['Ip']['host'], 'escape' => false)); ?>
							<p>
								<?php if(!empty($couponFlag['Ip']['Country'])): ?>
									<span class="flags flag-<?php echo strtolower($couponFlag['Ip']['Country']['iso2']); ?>" title ="<?php echo $couponFlag['Ip']['Country']['name']; ?>"><?php echo $couponFlag['Ip']['Country']['name']; ?></span>
								<?php endif; ?>
								<?php if(!empty($couponFlag['Ip']['City'])): ?>
									<span><?php echo $couponFlag['Ip']['City']['name']; ?></span>
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
                <td colspan="15" class="notice"><?php echo __l('No Flags available');?></td>
            </tr>
            <?php
        endif;
        ?>
    </table>
    </div>
    <?php
    if (!empty($couponFlags)):
        ?>
        <?php if(empty($this->request->params['named']['simple_view'])) : ?>
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
        <?php endif; ?>
        <div class=" grid_right">
            <?php echo $this->element('paging_links'); ?>
        </div>
        </div>
        <?php if(empty($this->request->params['named']['simple_view'])) : ?>
            <div class="hide">
                <?php echo $this->Form->submit(__l('Submit'));  ?>
            </div>
        <?php endif; ?>
        <?php
    endif;
    echo $this->Form->end();
    ?>
</div>