<?php /* SVN: $Id: admin_index.ctp 801 2009-07-25 13:22:35Z boopathi_026ac09 $ */ ?>
<div class="couponlagCategories index js-response">
    <h2><?php echo __l('Flag Categories');?></h2>

    <div class="page-count-block clearfix">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
    <div class="grid_left">
            <?php echo $this->Form->create('CouponFlagCategory', array('class' => 'normal search-form', 'action'=>'index')); ?>
    	<div class="filter-section clearfix">
    			<?php echo $this->Form->input('filter_id',array('type'=>'select', 'empty' => __l('Please Select'))); ?>
    			<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
	</div>
	<div class="add-block grid_right">
        <?php echo $this->Html->link(__l('Add'), array('controller' => 'coupon_flag_categories', 'action' => 'add'), array('class' => 'add','title' => __l('Add'))); ?>
    </div>
	</div>
	<div class="clearfix">
    <ul class="filter-list clearfix grid_left">
        <li>
            <span class="active round-5">
            <span><?php echo __l('Approved Records : '); ?></span>
            <?php echo $this->Html->cInt($approved); ?></span>
        </li>
        <li>
            <span class="inactive round-5">
              <span><?php	echo __l('Disapproved Records : '); ?></span>
            <?php echo $this->Html->cInt($pending); ?></span>
        </li>
        <li>
            <span class="yahoo round-5">
              <span><?php	echo __l('Total Records : '); ?></span>
            <?php echo $this->Html->cInt($pending + $approved); ?></span>
        </li>
    </ul>
    </div>

    
    <?php echo $this->Form->create('CouponFlagCategory' , array('class' => 'normal','action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
    <div class="overflow-block">
    <table class="list">
        <tr>
            <th><?php echo __l('Select'); ?></th>
            <th class="actions"><?php echo __l('Actions');?></th>
            <th><?php echo $this->Paginator->sort(__l('Name'),'name');?></th>
            <th><?php echo $this->Paginator->sort(__l('Flags'),'coupon_flag_count');?></th>
			<th><?php echo $this->Paginator->sort(__l('Active?'), 'is_active'); ?></th>
        </tr>
        <?php
        if (!empty($couponFlagCategories)):

            $i = 0;
            foreach ($couponFlagCategories as $couponFlagCategory):
                $class = null;
                if ($i++ % 2 == 0) :
                    $class = ' class="altrow"';
                endif;
                if($couponFlagCategory['CouponFlagCategory']['is_active']):
            		$status_class = 'js-checkbox-active';
            	else:
            		$status_class = 'js-checkbox-inactive';
            	endif;
                ?>
                <tr<?php echo $class;?>>
                    <td><?php echo $this->Form->input('CouponFlagCategory.'.$couponFlagCategory['CouponFlagCategory']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$couponFlagCategory['CouponFlagCategory']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>


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
                                        <span><?php echo $this->Html->link(__l('Edit'), array('controller' => 'coupon_flag_categories', 'action' => 'edit', $couponFlagCategory['CouponFlagCategory']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span>
						            </li>
						            <li>
                                        <span><?php echo $this->Html->link(__l('Delete'), array('controller' => 'coupon_flag_categories', 'action' => 'delete', $couponFlagCategory['CouponFlagCategory']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
                                    </li>
        						 </ul>
        						</div>
        						<div class="action-bottom-block"></div>
							  </div>
							 </div>
                    </td>
                    <td><?php echo $this->Html->cText($couponFlagCategory['CouponFlagCategory']['name']);?></td>
                    <td>
						<?php
							if(!empty($couponFlagCategory['CouponFlag'])):
								echo $this->Html->link($this->Html->cInt(count($couponFlagCategory['CouponFlag']), false), array('controller' => 'coupon_flags', 'action' => 'index', 'coupon_flag_category_id ' => $couponFlagCategory['CouponFlagCategory']['id']));
							else:
								echo '0';
							endif;
						?>
					</td>
					<td><?php echo $this->Html->cBool($couponFlagCategory['CouponFlagCategory']['is_active']);?></td>
                </tr>
                <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="5" class="notice"><?php echo __l('No Coupon Flag Categories available');?></td>
            </tr>
            <?php
        endif;
        ?>
    </table>
    </div>
    <?php
    if (!empty($couponFlagCategories)):
        ?>
        <div class="clearfix">
        <div class="admin-select-block grid_left">
        <div>
			<?php echo __l('Select:'); ?>
			<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
			<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None'))); ?>
			<?php echo $this->Html->link(__l('Inactive'), '#', array('class' => 'js-admin-select-pending', 'title' => __l('Inactive'))); ?>
			<?php echo $this->Html->link(__l('Active'), '#', array('class' => 'js-admin-select-approved', 'title' => __l('Active'))); ?>
        </div>
        
        <div class="admin-checkbox-button">
            <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
        </div>
        </div>
        <div class=" grid_right">
            <?php echo $this->element('paging_links'); ?>
        </div>
        </div>
        <div class="hide">
            <?php echo $this->Form->submit(__l('Submit'));  ?>
        </div>
        <?php
    endif;
    echo $this->Form->end();
    ?>
</div>