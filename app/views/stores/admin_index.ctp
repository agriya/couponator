<?php /* SVN: $Id: admin_index.ctp 4907 2010-03-03 06:08:25Z thulasi_103ac09 $ */ ?>
<div class="stores index js-response">    
	<fieldset class="form-block round-5">
		<legend><?php echo __l('Store Status'); ?></legend>
		<ul class="filter-list clearfix">
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['status_id'] == ConstStoreStatus::NewStore) { echo 'class="active"';} ?>>
				<span class="check-store" title="<?php echo __l('New'); ?>"><?php echo $this->Html->link($this->Html->cInt($store_status_count['new'],false).'<span>' .__l('New'). '</span>', array('controller'=>'stores','action'=>'index','status_id' => ConstStoreStatus::NewStore), array('escape' => false));?></span>
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['status_id'] == ConstStoreStatus::ActiveStore) { echo 'class="active"';} ?>>
				<span class="new-coupon" title="<?php echo __l('Active'); ?>"><?php echo $this->Html->link($this->Html->cInt($store_status_count['active'],false).'<span>' .__l('Active'). '</span>', array('controller'=>'stores','action'=>'index','status_id' => ConstStoreStatus::ActiveStore), array('escape' => false));?></span>
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['status_id'] == ConstStoreStatus::RejectedStore) { echo 'class="active"';} ?>>
				<span class="actives-coupon" title="<?php echo __l('Rejected'); ?>"><?php echo $this->Html->link($this->Html->cInt($store_status_count['rejected'],false).'<span>' .__l('Rejected'). '</span>', array('controller'=>'stores','action'=>'index','status_id' => ConstStoreStatus::RejectedStore), array('escape' => false));?></span>
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['status_id'] == ConstStoreStatus::Partner) { echo 'class="active"';} ?>>
				<span class="check-store" title="<?php echo __l('Partner'); ?>"><?php echo $this->Html->link($this->Html->cInt($store_status_count['party'],false).'<span>' .__l('Partner'). '</span>', array('controller'=>'stores','action'=>'index','status_id' => ConstStoreStatus::Partner), array('escape' => false));?></span>
			</li>
			
		</ul>
	</fieldset>
	<fieldset class="form-block round-5">
		<legend><?php echo __l('Update'); ?></legend>
		<ul class="filter-list clearfix">
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['update_id'] == ConstStoreUpdate::Manual) { echo 'class="active"';} ?>>				
				<span class="manual-store" title="<?php echo __l('Manually Updated'); ?>"><?php echo $this->Html->link($this->Html->cInt($store_manual_count,false).'<span>' .__l('Manually Updated'). '</span>', array('controller'=>'stores','action'=>'index','update_id' => ConstStoreUpdate::Manual), array('escape' => false));?></span>
			</li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['update_id'] == ConstStoreUpdate::Auto) { echo 'class="active"';} ?>>
				<span class="auto-store" title="<?php echo __l('Auto Updated'); ?>"><?php echo $this->Html->link($this->Html->cInt($store_auto_count,false).'<span>' .__l('Auto Updated'). '</span>', array('controller'=>'stores','action'=>'index','update_id' => ConstStoreUpdate::Auto), array('escape' => false));?></span>
			</li>
		</ul>
	</fieldset>
	<?php if (!empty($affiliateSites)): ?>
		<fieldset class="form-block round-5">
			<legend><?php echo __l('Affiliate'); ?></legend>
			<ul class="filter-list clearfix">
				<?php
					foreach($affiliateSites as $affiliate_site_id => $affiliate_site_name):
				?>
						<li <?php if (!empty($this->request->params['named']['affiliate_site_id']) && $this->request->params['named']['affiliate_site_id'] == $affiliate_site_id) { echo 'class="active"';} ?>>
							<span class="affiliate-coupon-<?php echo $affiliate_site_id; ?>" title="<?php echo $affiliate_site_name; ?>"><?php echo $this->Html->link($affiliate_store_count[$affiliate_site_id] .'<span>' .$affiliate_site_name. '</span>', array('controller'=>'stores','action'=>'index','affiliate_site_id' => $affiliate_site_id), array('escape' => false));?></span>
						</li>
				<?php
					endforeach;
				?>
			</ul>
		</fieldset>
	<?php endif; ?>
	<div class="page-count-block clearfix">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
    <div class="grid_left">
            <?php echo $this->Form->create('Store' , array('class' => 'normal search-form','action' => 'index')); ?>
    	<div class="filter-section clearfix">
    			<?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
    			<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
	</div>
	</div>
	<?php echo $this->Form->create('Store' , array('class' => 'normal','action' => 'update')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
	<div class="overflow-block">
		<table class="list" id="js-expand-table">
            <tr class="js-even">
				<th rowspan="2" class="select"><?php echo __l('Select'); ?>
               
                </th>
				<th rowspan="2" class="dl"><?php echo $this->Paginator->sort(__l('Title'), 'title');?></th>
				<th rowspan="2"><?php echo $this->Paginator->sort(__l('URL'), 'url');?></th>
				<th rowspan="2"><?php echo $this->Paginator->sort(__l('Rank'), 'rank');?></th>
				
			</tr>
			<tr class="js-even">
				
			</tr>
			<?php
				if (!empty($stores)):
					$i = 0;
					foreach ($stores as $store):
						$class = null;
						if ($i++ % 2 == 0) {
							$class ="altrow";
						}
						$status_class ='';
						$active_class ='';
						if($store['Store']['admin_suspend']):
							$status_class.= ' js-checkbox-suspended';
						else:
							$status_class.= ' js-checkbox-unsuspended';
						endif;
						if($store['Store']['is_system_flagged']):
							$status_class.= ' js-checkbox-flagged';
						else:
							$status_class.= ' js-checkbox-unflagged';
						endif;
						if (!empty($store['Store']['store_status_id'])):
							switch($store['Store']['store_status_id']) {
								case ConstStoreStatus::ActiveStore :
									$status_class.= ' js-checkbox-approved';
									$class_status = 'new-coupon';
									$status_name = __l('Active Store');
									break;
								case ConstStoreStatus::NewStore :
									$status_class.= ' js-checkbox-pending';
									$class_status = 'check-store';
									$status_name = __l('New Store');
									break;
								case ConstStoreStatus::RejectedStore :
									$status_class.= ' js-checkbox-disabled';
									$class_status = 'actives-coupon';
									$status_name = __l('Rejected Store');
									break;
							}
						endif;
						if($store['Store']['store_status_id']==ConstStoreStatus::ActiveStore):
							$status_class = 'js-checkbox-active';
						else:
							$active_class = ' inactive-record';
							$status_class = 'js-checkbox-inactive';
                        endif;
			?>
	    	<tr class="<?php echo $class.$active_class;?> expand-row js-odd">
				<td class="<?php echo $class;?> select"><div class="arrow"></div><?php echo $this->Form->input('Store.'.$store['Store']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$store['Store']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>
         		<td class="dl coupon-status-info">
         		<div class="clearfix">
					<div class="grid_left">
						<?php echo '<span class="coupon-status-info ' . $class_status. '" title=" '.$status_name. '">' . $status_name . '</span>'; ?>
						<?php echo $this->Html->link($this->Html->cText($store['Store']['name']), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug'],'admin'=> false), array('escape' => false));?>
					</div>
					<div class="grid_right">
						<?php echo '<span class="affiliate-coupon-' . $store['AffiliateSite']['id'] . '">' . $store['AffiliateSite']['name'] . '</span>'; ?>
					</div>
					</div>
				</td>
				<td class="dl"><?php echo $this->Html->cText($store['Store']['url']);?></td>
				<td><?php echo $this->Html->cText($store['Store']['rank']);?></td>
				</tr>
                <tr class="hide">
                    <td class="action-block" colspan="9">
                        <div class="action-info-block clearfix">
                           <div class="action-left-block">
                           	<h3> <?php echo __l('Action');?>  </h3>
                               <ul class="clearfix">
                                        <li>
                                            <span><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $store['Store']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span>
    						            </li>
    						            <li>
                                            <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $store['Store']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
                                        </li>
                                        <li>
                                      			<?php if( $store['Store']['is_system_flagged']):?>
                        						<span><?php echo $this->Html->link(__l('Clear flag'), array('action' => 'admin_update_status',  $store['Store']['id'], 'flag' => 'deactivate'), array('class' => 'js-admin-update-store clear-flag', 'title' => __l('Clear flag')));?></span>
                        					<?php else:?>
                        						<span><?php echo $this->Html->link(__l('Flag'), array('action' => 'admin_update_status',  $store['Store']['id'], 'flag' => 'active'), array('class' => 'js-admin-update-store flag', 'title' => __l('Flag')));?></span>
                        					<?php endif;?>
                                        </li>
                                        <li>
                                            <?php if($store['Store']['admin_suspend']):?>
                        						<span><?php echo $this->Html->link(__l('Unsuspend'), array('action' => 'admin_update_status', $store['Store']['id'], 'flag' => 'unsuspend'), array('class' => 'js-admin-update-store  unsuspend', 'title' => __l('Unsuspend')));?></span>
                        					<?php else:?>
                        						<span><?php echo $this->Html->link(__l('Suspend'), array('action' => 'admin_update_status', $store['Store']['id'], 'flag' => 'suspend'), array('class' => 'js-admin-update-store suspend', 'title' => __l('Suspend')));?></span>
                        					<?php endif;?>
                                        </li>
            					</ul>
                           </div>
                           <div class="action-right-block  clearfix">
							<div class="clearfix">
								<div class="action-right">
									<h3><?php echo __l('Count'); ?></h3>
									<dl class="clearfix">
									   <dt><?php echo __l('Coupon'); ?></dt>
									   <dd><?php echo  !empty($store['Store']['coupon_count'])?$this->Html->link( $store['Store']['coupon_count'], array('controller'=>'coupons','action' => 'index','store'=> $store['Store']['slug']), array( 'title' =>  $store['Store']['coupon_count'])):'0';?></dd>
									   <dt><?php echo __l('Click'); ?></dt>
									   <dd><?php echo $store['Store']['coupon_impression_count'];?></dd>
								   </dl>
							  </div>
							  <div class="action-right">
								<?php if(!empty($coupon['Ip']['ip'])):?>
									<div class="city-action">
										<h3><?php echo __l('Auto detected'); ?></h3>
										<dl class="clearfix">
											<dt><?php echo __l('IP');?></dt>
												<dd><?php echo !empty($store['Ip']['ip']) ? $this->Html->cText($store['Ip']['ip']) : '-'; ?></dd>
											<dt><?php echo __l('City');?></dt>
												<dd><?php echo !empty($store['Ip']['City']['name']) ? $this->Html->cText($store['Ip']['City']['name']) : '-'; ?></dd>
											<dt><?php echo __l('State');?></dt>
												<dd><?php echo !empty($store['Ip']['State']['name']) ? $this->Html->cText($store['Ip']['State']['name']) : '-'; ?></dd>
											<dt><?php echo __l('Country');?></dt>
												<dd><?php echo !empty($store['Ip']['Country']['name']) ? $this->Html->cText($store['Ip']['Country']['name']) : '-'; ?></dd>
											<dt><?php echo __l('Latitude');?></dt>
												<dd><?php echo !empty($store['Ip']['latitude']) ? $this->Html->cText($store['Ip']['latitude']) : '-'; ?></dd>
											<dt><?php echo __l('Longitude');?></dt>
												<dd><?php echo !empty($store['Ip']['longitude']) ? $this->Html->cText($store['Ip']['longitude']) : '-'; ?></dd>
										</dl>
									</div>
								<?php endif;?>
							</div>
						</div>
						<div class="city-action">
							<dl class="clearfix">
								<dt><?php echo __l('URL'); ?></dt>
									<dd>																				
										<?php $url = str_replace('&', '&amp;', $store['Store']['url']);?>
										<a href="http://www.<?php echo $url;?>" target="_blank"><?php echo $url;?></a>
									</dd>
								<dt><?php echo __l('Status: '); ?> </dt>
									<dd>
										<?php
											if($store['Store']['admin_suspend']):
												echo '<span class="suspended">'.__l('Admin Suspended').'</span>';
											endif;
											if(!empty($store['StoreFlag'])):
												echo '<span class="flagged">'.__l('Flagged').'</span>';
											endif;
											if($store['Store']['is_system_flagged']):
												echo '<span class="system-flagged">'.__l('System Flagged').'</span>';
											endif;
											if($store['Store']['is_partner']):
												echo '<span class="partner">'.__l('Partner').'</span>';
											endif;
											echo '<span class="' . $class_status. '">' . $status_name . '</span>';
										?>
            						</dd>
							</dl>
						</div>
					</div>
                          <div class="action-right-block action-right4">
                               <div class="store-img-block">
                                           <?php
                					   	$store['Attachment'] = !empty($store['Attachment']) ? $store['Attachment'] : array();
                						echo $this->Html->link($this->Html->showImage('Store', $store['Attachment'], array('dimension' => 'normal_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($store['Store']['name'], false)), 'title' => $this->Html->cText($store['Store']['name'], false))), array('controller' => 'stores', 'action' => 'view', $store['Store']['slug'], 'admin'=> false), array('escape' => false));
                				        	?>
                               </div>
                                <dl class="clearfix">
                                            <dt><?php echo __l('Added 0n').': '?>  </dt>
                                            <dd><?php echo $this->Html->cDateTime($store['Store']['created']); ?> </dd>

                                </dl>
                               </div>
                               </div>
                    </td>
                </tr>
    	<?php
					endforeach;
				else:
			?>
			<tr class="js-odd">
				<td colspan="19" class="notice"><?php echo __l('No Stores available');?></td>
			</tr>
			<?php
				endif;
			?>
		</table>
	</div>
	<?php if (!empty($stores)): ?>
	<div class="clearfix">
		<div class="admin-select-block clearfix grid_left">
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